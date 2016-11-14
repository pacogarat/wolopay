<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface IntermediateStepExecutionInterface extends PayMethodIpnExecutionInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \AppBundle\Entity\PaymentProcessInterface $paymentProcessInterface
     * @return mixed
     */
    public function intermediateStep(Request $request, PaymentProcessInterface $paymentProcessInterface);

} 