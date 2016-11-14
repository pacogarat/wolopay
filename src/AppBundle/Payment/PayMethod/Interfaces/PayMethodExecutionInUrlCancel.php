<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface PayMethodExecutionInUrlCancel
{
    /**
     * @param \AppBundle\Entity\PaymentProcessInterface $paymentProcess
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function executeInUrlCancel(PaymentProcessInterface $paymentProcess, Request $request);

} 