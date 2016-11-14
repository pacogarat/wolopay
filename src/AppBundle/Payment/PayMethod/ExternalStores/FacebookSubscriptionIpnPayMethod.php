<?php

namespace AppBundle\Payment\PayMethod\ExternalStores;

use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use Facebook\FacebookRequest;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.facebook_subscription_ipn_pay_method")
 */
class FacebookSubscriptionIpnPayMethod extends FacebookIpnPayMethod
{
    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $paymentInteract->setResponseToDo(
            new JsonResponse([
                'payment_process_id' => $paymentProcess->getId(),
                'is_a_subscription' => true
            ])
        );
    }
}