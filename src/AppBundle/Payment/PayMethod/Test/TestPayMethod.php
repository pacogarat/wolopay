<?php

namespace AppBundle\Payment\PayMethod\Test;

use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.test_ipn_pay_method")
 *
 * Dummy payment method to sandbox environment
 */
class TestPayMethod  extends AbstractPayMethod implements PayMethodIpnExecutionInterface
{
    const PREFIX_EXTERNAL_TRANSACTION = 'TEST_';

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentInteract->setRequestResult($paymentInteract->getUrlIpn());
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $trId = $paymentInteract->getPaymentProcess()->getPaymentDetail()->getTransaction();
        //$paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.uniqid());
        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION. $trId);
        $paymentInteract->setResponseDirectly(new Response('Simulated payment correctly. You should receive notification of the payment in a few seconds.'));
    }
}