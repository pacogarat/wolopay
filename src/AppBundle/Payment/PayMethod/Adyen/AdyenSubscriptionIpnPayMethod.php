<?php

namespace AppBundle\Payment\PayMethod\Adyen;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Subscription;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\PayMethod\Exceptions\InvalidPetitionPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\SubscriptionCancelInterface;
use AppBundle\Payment\PayMethod\Interfaces\SubscriptionNeedMakePaymentRequestExecutionInterface;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.adyen_subscription_ipn_pay_method")
 */
class AdyenSubscriptionIpnPayMethod extends AdyenIpnPayMethod implements SubscriptionNeedMakePaymentRequestExecutionInterface, SubscriptionCancelInterface
{
    protected function generateParameters(PaymentPrepareInteract $paymentInteract)
    {
        $parameters = parent::generateParameters($paymentInteract);
        $parameters['recurringContract'] = 'RECURRING';

        return $parameters;
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        /** @var Subscription $paymentProcess */
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $request        = $paymentInteract->getRequest();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        $event = $request->get('eventCode');
        $this->logger->addInfo("Payment status by ADYEN: ". $event);

        switch($event){

            case 'AUTHORISATION':

                if ($request->get('success') == 'true')
                {
                    if (!$this->verifyPaymentWasSentByProvider($request, $credentialsDetailsArr['authorization']))
                    {
                        $paymentInteract->setPaymentAttemptHack("Signature is incorrect");
                        $paymentInteract->setResponseStatus(401);
                        return;
                    }

                    if ($paymentProcess->getStatusCategory()->getId() !== PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID)
                    {
                        $paymentInteract->setSubscriptionStarted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('pspReference'));
                        $paymentDetails->setExtraData(['email_used' => $paymentDetails->getTransaction()->getGamer()->getEmail()]);
                    }

                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('pspReference'));


                }

                break;
            case 'CANCELLATION':
                $paymentInteract->setPaymentCancelled('User canceled', $this->getPaymentFromSubscription($request, $paymentProcess));
                break;
            case 'NOTIFICATION_OF_FRAUD':
                $paymentInteract->setPaymentCancelled('Fraud: '.$request->get('reason'), $this->getPaymentFromSubscription($request, $paymentProcess));
                $paymentInteract->setSubscriptionFinished();
                break;
            case 'PENDING':
                $paymentInteract->setPaymentPending($request->get('reason'), $this->getPaymentFromSubscription($request, $paymentProcess));
                break;
            case 'REFUND':
                $paymentInteract->setPaymentCancelled('Refund', $this->getPaymentFromSubscription($request, $paymentProcess));
                $paymentInteract->setSubscriptionFinished();
                break;
            case "NOTIFICATION_OF_CHARGEBACK":
                $oldPayment = $this->getPaymentFromSubscription($request, $paymentProcess);
                $paymentInteract->setPaymentDispute($oldPayment);
                break;
            case "CHARGEBACK":
                $oldPayment = $this->getPaymentFromSubscription($request, $paymentProcess);
                $paymentInteract->setPaymentDisputeEnd(true, $request->get('reason'), $oldPayment);
                $paymentInteract->setExtraCost(new PurchaseExtraCostBean(CurrencyEnum::EURO, -7.5, -7.5, -7.5), 'Charge back, commision by Adyen', $oldPayment);
                break;
            case "CHARGEBACK_REVERSED":
                $oldPayment = $this->getPaymentFromSubscription($request, $paymentProcess);
                $paymentInteract->setPaymentDisputeEnd(false, $request->get('reason'), $oldPayment);
                break;
            case "REPORT_AVAILABLE":
                // do nothing
                break;
            default:
                $this->logger->addAlert("Unknown adyen event: $event");
                $paymentInteract->setResponseStatus(200);

        }

        $paymentInteract->getResponseResult()->setContent('[accepted]');
    }


    protected function getPaymentFromSubscription($request, $paymentProcess)
    {
        if (strlen($request->get('merchantReference')) > 30)
            $paymentNumber = substr($request->get('merchantReference'), 30);
        else
            $paymentNumber = 1;

        return $paymentProcess->getSubscriptionEventualities()[$paymentNumber-1]->getSubscriptionEventualityPayments()[0];
    }

    public function subscriptionNeedMakePaymentRequest(Subscription $subscription)
    {
        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $subscription->getPaymentDetail(),
            $this->getShapeProviderClientCredentials()
        );

        $request = array(
            "action" => "Payment.authorise",
            "paymentRequest.selectedRecurringDetailReference" => "LATEST",
            "paymentRequest.recurring.contract" => "RECURRING",
            "paymentRequest.merchantAccount" => $credentialsDetailsArr['merchant_account'] ?: self::MERCHANT_ACCOUNT,
            "paymentRequest.amount.currency" => $subscription->getPaymentDetail()->getCurrency()->getId(),
            "paymentRequest.amount.value" => $this->amountWithoutTwoLastNumbersAsDecimals($subscription->getAmountForEachPayment()),
            "paymentRequest.reference" => $subscription->getId().'_' . ($subscription->getNCompletedPayments()+1),
            "paymentRequest.shopperEmail" => $subscription->getPaymentDetail()->getExtraData()['email_used'],
            "paymentRequest.shopperReference" => $subscription->getGamer()->getId(),
            "paymentRequest.shopperInteraction" => "ContAuth",
            "paymentRequest.fraudOffset" => "",
            "paymentRequest.shopperIP" => $subscription->getIp(),
            "paymentRequest.shopperStatement" => "",
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getUrlPalProvider());
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC  );
        curl_setopt($ch, CURLOPT_USERPWD, ($credentialsDetailsArr['api_user'] ?:  self::API_USER) . ':' . ($credentialsDetailsArr['api_password'] ?: self::API_PASSWORD));
        curl_setopt($ch, CURLOPT_POST, count($request));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $this->logger->addInfo("Parameters sent ".urldecode(http_build_query($request)));

        $result = curl_exec($ch);
        $this->logger->addInfo('Parameters sent: '.urldecode(http_build_query($request)));

        curl_close($ch);

        $this->logger->addInfo("Parameters sent ".urldecode(http_build_query($request)));

        if($result === false)
        {
            throw new InvalidPetitionPayMethodException("Invalid petition curl error: " . curl_error($ch));

        }else{
            /**
             * If the recurring payment message passes validation a risk analysis will be done and, depending on the
             * outcome, an authorisation will be attempted. You receive a
             * payment response with the following fields:
             * - pspReference: The reference we assigned to the payment;
             * - resultCode: The result of the payment. One of Authorised, Refused or Error;
             * - authCode: An authorisation code if the payment was successful, or blank otherwise;
             * - refusalReason: If the payment was refused, the refusal reason.
             */

            parse_str($result,$result);
            $this->logger->addInfo("auto renewing: Result ".http_build_query($result));

            if (isset($result['paymentResult_resultCode']) && $result['paymentResult_resultCode'] === 'Authorised')
                return self::PREFIX_EXTERNAL_TRANSACTION . $result['paymentResult_pspReference'];
            else if (isset($result['paymentResult_authResult']))
                throw new InvalidPetitionPayMethodException("Invalid authResult, ".$result['paymentResult_resultCode']." ". (isset($result['paymentResult.refusalReason']) ? ', reason: '.$result['paymentResult.refusalReason'] : '' ));
            else
                throw new InvalidPetitionPayMethodException(http_build_query($result));
        }


    }

    /**
     * NOT USED
     */
    private function getPaymentDetailsId(Subscription $subscription)
    {
        $request = array(
            "action" => "Recurring.listRecurringDetails",
            "recurringDetailsRequest.merchantAccount" => self::MERCHANT_ACCOUNT,
            "recurringDetailsRequest.shopperReference" => $subscription->getGamer()->getId(),
            "recurringDetailsRequest.recurring.contract" => "RECURRING", // i.e.: "ONECLICK","RECURRING" or "ONECLICK,RECURRING"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getUrlPalProvider());
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC  );
        curl_setopt($ch, CURLOPT_USERPWD, self::API_USER . ':' . self::API_PASSWORD);
        curl_setopt($ch, CURLOPT_POST,count($request));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if($result === false)
            echo "Error: " . curl_error($ch);
        else{

            /**
             * The response will be a result with a list of zero or more details at least containing the following:
             * - recurringDetailReference: The reference the details are stored under.
             * - variant: The payment method (e.g. mc, visa, elv, ideal, paypal)
             * - creationDate: The date when the recurring details were created.
             */
            parse_str($result,$result);
            print_r(($result));
        }

        curl_close($ch);
    }

    public function cancelSubscription(Subscription $subscription)
    {
        return true;
    }
}