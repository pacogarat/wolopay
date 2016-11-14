<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\EventDispatcher\Event;

class SubscriptionFinishedEvent extends Event
{
    const EVENT = 'shop.subscription.finished';

    /**
     * @var PaymentProcessInterface
     */
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