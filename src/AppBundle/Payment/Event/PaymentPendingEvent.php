<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\EventDispatcher\Event;

class PaymentPendingEvent extends Event
{
    const EVENT = 'shop.payment.pending';

    /** @var PaymentProcessInterface*/
    protected $paymentProcess;


    function __construct(PaymentProcessInterface $paymentProcess)
    {
        $this->paymentProcess = $paymentProcess;
    }

    /**
     * @return PaymentProcessInterface
     */
    public function getPaymentProcess()
    {
        return $this->paymentProcess;
    }

} 