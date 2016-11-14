<?php

namespace AppBundle\Payment\PayMethod\PayPal;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Subscription;
use AppBundle\Payment\Bean\PaymentExtraCostBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("shop.payment.paypal_ipn_subscription_pay_method_old")
 */
class PayPalIpnSubscriptionBasicPayMethod extends PayPalIpnBasicPayMethod implements PayMethodIpnExecutionInterface
{
    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        /** @var Subscription $paymentProcess */
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetail  = $paymentProcess->getPaymentDetail();

        $lang = strtoupper($this->locale);

        if (in_array($paymentDetail->getLanguage()->getId(), self::$availableLanguages))
            $lang = $paymentDetail->getLanguage()->getId();

        $days = $paymentProcess->getPeriodicity();
        $t3 = $p3 = null;

        if ($days < 30)
        {
            $t3 = 'D';
            $p3 = $days;

        }else if ($days < 365){

            $t3 = 'M';
            $p3 = round($days/30);

        }else{

            $t3 = 'Y';
            $p3 = round($days/365);

        }

        $postParameters = [
            'cmd'        => '_xclick-subscriptions',
            'business'   => $this->providerEmail,
            'rm'         => '2',
            'lc'         => $lang,
            'src'        => 1,
            'sra'        => 1,
            'no_shipping'=> 1,

            'item_name'=> $paymentInteract->getNameAllTranslations($paymentDetail),

            // Amount
            'a3'             => $paymentDetail->getAmount(),
            'currency_code'  => $paymentInteract->getCurrencyPaymentISO(),

            // Periodicity properties
            'p3'         => $p3,
            't3'         => $t3,

            'notify_url'    => $paymentInteract->getUrlIpn(),
            'cancel_return' => $paymentInteract->getUrlKo(),
            'return'        => $paymentInteract->getUrlOk(),

            'charset'       => 'utf-8',

        ];

        $this->logger->addInfo('Parameters sent: '.http_build_query($postParameters));

        $paymentInteract->setRequestResult($this->getUrlPaypal(), 'POST', $postParameters);
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        if (!$this->verifyPaymentWasSentByPayPal($paymentInteract))
            return ;

        $request = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $this->logger->addInfo("Payment status subscription by PayPal: ". $request->get('payment_status'));

        $this->processInSpecialCases($paymentInteract, $request, $paymentProcess);
        $txnType= strtolower($request->get('txn_type'));

        if ($txnType === "subscr_signup" ){

            if ($paymentInteract->validatePrice($request->get('mc_amount3'), $request->get('mc_currency'), $paymentProcess))
                $paymentInteract->setSubscriptionStarted($request->get('subscr_id'));

        }else if ($txnType === "subscr_cancel" && $txnType === "subscr_eot" ){

            $paymentInteract->setSubscriptionFinished('PAYPAL_SUB_'.$request->get('subscr_id'));

        }else if ($txnType === "subscr_payment" ){

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
                    )
                );
            }
        }else if ($txnType === "subscr_failed" ){

            $paymentInteract->setSubscriptionFailed();

        }else{

            $this->logger->addAlert("Payment status unknown: '".$request->get('payment_status')."'");
        }

    }

    protected function processInSpecialCases(PaymentIpnInteract $paymentInteract, Request $request, PaymentProcessInterface $payment)
    {
        $currency = $payment->getPaymentDetail()->getCurrency();

        if (strtolower($request->get('txn_type') === "new_case"))
        {
            $paymentInteract->setPaymentDispute($payment);
        }

        if (strtolower($request->get('payment_status')) === "reversed"){

            $paymentInteract->setPaymentCancelled(strtolower($request->get('reason_code')). ' reversed', $this->getPayment($request->get('parent_txn_id')));
            if ($extraCost = $request->get('mc_fee'))
            {
                $paymentInteract->setExtraCost(
                    new PurchaseExtraCostBean(null, $extraCost, $extraCost, $extraCost),
                    strtolower($request->get('reason_code'))
                );
            }

        }else if (strtolower($request->get('payment_status')) === "refunded"){

            $paymentInteract->setPaymentCancelled('refunded', $this->getPayment($request->get('parent_txn_id')));

        }else if (strtolower($request->get('payment_status')) === "canceled_reversal"){

            $paymentInteract->setPaymentUnBlocked($this->getPayment($request->get('parent_txn_id')));

        }
    }

    private function getPayment($externalId)
    {
        if (!$payment = $this->em->getRepository("AppBundle:SubscriptionEventualityPayment")->findOneBy(['transactionExternalId' => self::PREFIX_EXTERNAL_TRANSACTION.$externalId]))
            throw new \Exception("Invalid external transacion paypal $externalId");

        return $payment;
    }

}
