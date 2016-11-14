<?php

namespace AppBundle\Payment\PayMethod\PayPal;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Subscription;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\SubscriptionCancelInterface;
use JMS\DiExtraBundle\Annotation\Service;
use PayPal\Api as ApiPaypal;
use PayPal\Common\PayPalModel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.paypal_ipn_subscription_pay_method")
 */
class PayPalIpnSubscriptionApiRestPayMethod extends PayPalIpnApiRestPayMethod implements SubscriptionCancelInterface
{
    const PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION = 'PAYPAL_SUB_';

    /**
     * @param PaymentPrepareInteract $paymentInteract
     * @throws \Exception
     */
    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        /** @var Subscription $paymentProcess */
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();

        $plan = new ApiPaypal\Plan();

        $plan
            ->setName($paymentProcess->getId())
            ->setDescription($paymentInteract->getNameAllTranslations($paymentDetails))
            ->setType('INFINITE')
        ;

        $days = $paymentProcess->getPeriodicity();

        if ($days < 30)
        {
            $t3 = 'Day';
            $p3 = $days;
            $priceText = $this->translator->trans('days_replace', ['{[{ days }]}' => $p3], 'shop');

        }else if ($days < 365){

            $t3 = 'Month';
            $p3 = round($days/30);
            $priceText = $this->translator->trans('months_replace', ['{[{ months }]}' => $p3], 'shop');

        }else{

            $t3 = 'Year';
            $p3 = round($days/365);
            $priceText = $this->translator->trans('years_replace', ['{[{ years }]}' => $p3], 'shop');
        }

        if ($transaction->getCountryDetected() && in_array($paymentDetails->getCountry()->getId(), CountryEnum::$OTHERS_ALL))
        {
            $countryClient = $transaction->getCountryDetected();

            $currencyFromGamer = $transaction->getCountryDetected()->getCurrency();

            $priceTemp = UtilHelper::prettyPrice(
                $this->currencyService->getExchange(
                    $paymentDetails->getAmount(),
                    $paymentDetails->getCurrency(),
                    $countryClient->getCurrency()->getId()
                ),
                $countryClient->getCurrency()->getDecimalPlaces(),
                $countryClient->getDecimalFormat()
            );

            $priceText = $priceTemp.$currencyFromGamer->getSymbol().' ('.$currencyFromGamer->getId().') \\ '.$priceText;
        }else{
            $priceText = $paymentDetails->getAmount().$paymentDetails->getCurrency()->getSymbol().' ('.$paymentDetails->getCurrency()->getId().') \\ '.$priceText;
        }


        $paymentDefinition = new ApiPaypal\PaymentDefinition();
        $paymentDefinition
            ->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency($t3)
            ->setFrequencyInterval($p3)
            ->setCycles("0")
            ->setAmount(
                new ApiPaypal\Currency(array(
                    'value'    => $paymentDetails->getAmount(),
                    'currency' => $paymentDetails->getCurrency()->getId()
                ))
            )
        ;

        $merchantPreferences = new ApiPaypal\MerchantPreferences();
        $merchantPreferences
            ->setReturnUrl($paymentInteract->getUrlOk())
            ->setCancelUrl($paymentInteract->getUrlKo())
            ->setAutoBillAmount("NO")
            ->setInitialFailAmountAction("CANCEL")
            ->setMaxFailAttempts("0")
            ->setSetupFee(
                new ApiPaypal\Currency(array(
                    'value'    => $paymentDetails->getAmount(),
                    'currency' => $paymentDetails->getCurrency()->getId()
                ))
            )
        ;

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $apiContext = $this->getApiContext($paymentProcess);

        $planCreated = $plan->create($apiContext);

        $patch = new ApiPaypal\Patch();

        $value = new PayPalModel('{
          "state":"ACTIVE"
        }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new ApiPaypal\PatchRequest();
        $patchRequest->addPatch($patch);

        $planCreated->update($patchRequest, $apiContext);

        $now = new \DateTime("$days days");
        $agreement = new ApiPaypal\Agreement();
        $agreement
            ->setName($paymentProcess->getId())
            ->setDescription($paymentInteract->getNameAllTranslations($paymentDetails)."  $priceText")
            ->setStartDate($now->format(\DateTime::ISO8601))
        ;

        $payer = new ApiPaypal\Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

        $plan = new ApiPaypal\Plan();
        $plan->setId($planCreated->getId());
        $agreement->setPlan($plan);
        $agreement = $agreement->create($apiContext);

        $paymentInteract->setRequestResult($agreement->getApprovalLink());

    }

    /**
     * @param \AppBundle\Entity\PaymentProcessInterface $paymentProcess
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function executeInUrlOK(PaymentProcessInterface $paymentProcess, Request $request)
    {
        if (in_array($paymentProcess->getStatusCategory()->getId(), [PaymentStatusCategoryEnum::COMPLETED_ID, PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID]))
            return;

        $token = $request->get('token');
        $agreement = new \PayPal\Api\Agreement();

        $apiContext = $this->getApiContext($paymentProcess);
        $agreement->execute($token, $apiContext);

        $externalTransactionId = self::PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION .$agreement->getId();
        $this->logger->addInfo("External agreementId (subscriptionId): $externalTransactionId");
        $paymentProcess->setTransactionExternalId($externalTransactionId);

        $this->em->flush();
        $this->logger->addInfo("Paypal payment confirmed, waiting IPN...");
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        if ($request->get('invoice'))
            return parent::ipnStaticWhichPaymentIsIt($request);
        else
        {
            $externalTransactionId = self::PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION . $request->get('recurring_payment_id');
            $this->logger->addInfo("Searching this subscription $externalTransactionId");

            $subscription = $this->em->getRepository("AppBundle:Subscription")->findOneBy([
                    'transactionExternalId' => $externalTransactionId
            ]);

            if (!$subscription)
            {
                $externalTransactionId = self::PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION . $request->get('txn_id');

                $this->logger->addInfo("Searching this subscriptionPayment $externalTransactionId");

                $eventualityPayment = $this->em->getRepository("AppBundle:SubscriptionEventualityPayment")->findOneBy([
                        'transactionExternalId' => $externalTransactionId
                    ]);

                if ($eventualityPayment)
                {
                    $subscription = $eventualityPayment->getSubscriptionEventuality()->getSubscription();
                }
            }

            return $subscription;
        }
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        if (!$this->verifyPaymentWasSentByPayPalIPN($paymentInteract))
            return ;

        $request = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();


        // ignore
        if ($request->get('txn_id') === '8G998475VA805092E')
        {
            $paymentInteract->setResponseStatus(200);
            return;
        }

        $txnType = strtolower($request->get('txn_type'));

        $this->logger->addInfo("Payment status subscription by PayPal: $txnType");


        if ($txnType === "subscr_signup" ){

            if ($paymentInteract->validatePrice($request->get('mc_amount3'), $request->get('mc_currency'), $paymentProcess))
                $paymentInteract->setSubscriptionStarted($request->get('recurring_payment_id'));

        }else if($txnType === "recurring_payment_profile_created"){

            if ($paymentInteract->validatePrice($request->get('amount'), $request->get('currency_code'), $paymentProcess))
            {
                $paymentInteract->setSubscriptionStarted(self::PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION.$request->get('recurring_payment_id'));

                if (strtolower($request->get('initial_payment_status')) === 'completed') // initial payment can be FAIL WTF PAYPAL
                {
                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('initial_payment_txn_id'));
                }
            }

        }else if (in_array($txnType, ['subscr_cancel', 'subscr_eot', 'recurring_payment_profile_cancel', 'recurring_payment_suspended'])){

            $paymentInteract->setSubscriptionFinished();

        }else if (in_array($txnType, ['subscr_payment', 'recurring_payment'])){

            if ($paymentInteract->validatePrice($request->get('mc_gross'), $request->get('mc_currency'), $paymentProcess))
            {
                $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('txn_id'),
                    new PaymentFeeBean(
                        $request->get('mc_fee'),
                        $this->em->getRepository('AppBundle:Currency')->find($request->get('mc_currency')),
                        null,
                        null,
                        null,
                        $request->get('exchange_rate')
                    ),
                    null,
                    null,
                    409
                );
            }

        }else if (in_array($txnType, ['subscr_failed', 'recurring_payment_failed'])){

            $paymentInteract->setSubscriptionFailed();

        }else if ($txnType === "refunded" ){

            $paymentInteract->setPaymentCancelled('Refund');

        }else if ($txnType == 'recurring_payment_skipped'){

            //ignore
            $paymentInteract->setResponseStatus(200);

        }else{
            if (!$payment = $this->getPaymentFromSubscription($request->get('txn_id')))
            {
                $this->logger->addDebug("XXX ".print_r($request->request->all(), true));
                $this->logger->addDebug("YYY ".print_r($request->query->all(), true));
                $payment = $this->getPaymentFromSubscription($request->get('parent_txn_id'));
            }

            $this->processInSpecialCases($paymentInteract, $request, $payment);
        }

        if ($paymentInteract->getResponseResult()->getStatusCode() == 422 )
            $this->logger->addAlert("Payment status unknown: '$txnType'");

    }


    public function cancelSubscription(Subscription $subscription)
    {
        $apiContext = $this->getApiContext($subscription);

        $agreement = ApiPaypal\Agreement::get(
            substr($subscription->getTransactionExternalId(), strlen(self::PREFIX_EXTERNAL_TRANSACTION_SUBSCRIPTION)),
            $apiContext
        );

        $agreementStateDescriptor = new ApiPaypal\AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Suspending the agreement");

        $agreement->suspend($agreementStateDescriptor, $apiContext);

        return true;
    }

    protected function getPaymentFromSubscription($externalTransactionId)
    {
        if (!$externalTransactionId)
            return null;

        return $this->em->getRepository("AppBundle:Payment")->findOneByTransactionExternalId(self::PREFIX_EXTERNAL_TRANSACTION.$externalTransactionId);
    }

    /**
     * @param Payment $payment
     * @param string $reason
     * @param bool $clientPetition
     * @return bool
     */
    public function executeRefund(Payment $payment, $reason = 'refund', $clientPetition = false)
    {
        // implement in a future
        return false;
    }
}