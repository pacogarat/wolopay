<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Payment\Bean\PaymentFeeBean;
use Symfony\Component\EventDispatcher\Event;

class PaymentFailedEvent extends Event
{
    const EVENT = 'shop.payment.failed';

    /** @var PaymentProcessInterface*/
    protected $paymentProcess;

    /** @var String */
    protected $transactionExternalId;

    /** @var PaymentFeeBean */
    protected $paymentFeeBean;


    function __construct(PaymentProcessInterface $paymentProcess, $transactionExternalId=null)
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