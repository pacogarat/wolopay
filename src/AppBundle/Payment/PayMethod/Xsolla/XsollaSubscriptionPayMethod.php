<?php

namespace AppBundle\Payment\PayMethod\Xsolla;

use AppBundle\Entity\Subscription;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentDetailBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.xsolla_subscription_ipn_pay_method")
 */
class XsollaSubscriptionPayMethod extends XsollaPayMethod
{
    const PROYECT_ID       = '14855';
    const PROYECT_SECRET   = 'mbTqCi7U62Wyh2v4';

    const PREFIX_EXTERNAL_SUBSCRIPTION = 'XSOLLA_SUB_';

    protected $plans = [
        1   => 'f4a9149e', // 1 day
        2   => '9224f2d0', // 2
        30  => 'f9206f56', // 1 month
        60  => '36ea1517', // 2
        90  => 'd508778b', // 3
        150 => '81120f08', // 5
        180 => 'f9b8ced3', // 6
        270 => '0a9b70b4', // 9
        360 => '52528df7'  // 1 year
    ];

    protected function generatePrepareParameters(PaymentPrepareInteract $paymentInteract, $lang)
    {
        $parameters = parent::generatePrepareParameters($paymentInteract, $lang);
        /** @var Subscription $subscription */
        $subscription = $paymentInteract->getPaymentProcess();
//        unset($parameters['purchase']['checkout']);
        $parameters['purchase']['subscription'] = [
            'plan_id' => $this->calculatePlanId($subscription->getPeriodicity()),
            'allow_modify' => false,
        ];

        return $parameters;
    }

    private function calculatePlanId($days)
    {
        foreach ($this->plans as $planDays => $planId)
        {
            if ($planDays >= $days)
            {
                $this->logger->addInfo("Plan id selected $planId - $planDays days ");
                return $planId;
            }
        }

        throw new \Exception("Unknown plan id");
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        /** @var Subscription $paymentProcess */
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $this->logger->addInfo("Checkout");

        if ($request->get('notification_type') === 'payment')
        {
            $totalFee = $this->getFee($request, $paymentProcess);
            $vatPaidByXsolla = $this->getVat($request, $paymentProcess);
            $finalCurrency = $this->getFinalCurrency($request);
            $xsollaPayMethodId = $request->get('TRANSACTION[payment_method]', null, true);
            $valid = false;

            if (!$request->get('purchase[checkout][amount]', null, true) && $request->get('purchase[subscription][subscription_id]', null, true))
            {
                if ($subscription = $this->em->getRepository("AppBundle:Subscription")->findOneByTransactionExternalId(
                    static::PREFIX_EXTERNAL_SUBSCRIPTION.$request->get('purchase[subscription][subscription_id]', null, true
                    )))
                {
                    $valid = true;
                }

            }elseif ($paymentInteract->validatePrice($request->get('purchase[checkout][amount]', null, true), $request->get('purchase[checkout][currency]', null, true), $paymentProcess)){
                $valid = true;
            }

            if ($valid)
            {
                $idPayment = static::PREFIX_EXTERNAL_TRANSACTION.$request->get('transaction[id]', null, true).'_'. ($paymentProcess->getNCompletedPayments()+1);
                $externalSubscriptionId = static::PREFIX_EXTERNAL_SUBSCRIPTION.$request->get('purchase[subscription][subscription_id]', null, true);

                if (!$this->em->getRepository("AppBundle:Subscription")->findOneByTransactionExternalId($externalSubscriptionId))
                    $paymentInteract->setSubscriptionStarted($externalSubscriptionId);

                $amountSaved = $request->get('purchase[total][amount]', null, true);
                $currencySaved =  $this->em->getRepository("AppBundle:Currency")->find($request->get('purchase[total][currency]', null, true));

                $paymentInteract->setPaymentCompleted($idPayment,
                    new PaymentFeeBean($totalFee, $finalCurrency, null, null),
                    new AmountBean( $amountSaved, $currencySaved,false,false,null,null, $vatPaidByXsolla ),
                    new PaymentDetailBean(["xsollaPayMethodId"=>$xsollaPayMethodId])
                );

            }else{

                throw new \Exception("This payment is invalid");
            }
        }

        $this->logger->addDebug("end subscription xsolla.php");
    }
}