<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\PaymentProcessInterface;
use Symfony\Component\EventDispatcher\Event;

class SubscriptionStartedEvent extends Event
{
    const EVENT = 'shop.subscription.started';

    /**
     * @var PaymentProcessInterface
     */
    protected $paymentProcess;

    /**
     * @var String
     */
    protected $transactionExternalId;


    function __construct(PaymentProcessInterface $paymentProcess, $transactionExternalId)
    {
        $this->paymentProcess = $paymentProcess;
        $this->transactionExternalId = $transactionExternalId;
    }

    /**
     * @return PaymentProcessInterface
     */
    public function getPaymentProcess()
    {
        return $this->paymentProcess;
    }

    /**
     * @return String
     */
    public function getTransactionExternalId()
    {
        return $this->transactionExternalId;
    }

} 