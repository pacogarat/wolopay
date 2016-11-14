<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface PayMethodIpnStaticExecutionInterface extends PayMethodIpnExecutionInterface
{
    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request);

} 