<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\Payment;
use AppBundle\Entity\Purchase;
use AppBundle\Payment\Bean\PaymentFeeBean;
use Symfony\Component\EventDispatcher\Event;

class PaymentCancelledEvent extends Event
{
    const EVENT = 'shop.payment.cancelled';

    /** @var Payment */
    protected $payment;

    /** @var String */
    protected $transactionExternalId;

    /** @var PaymentFeeBean */
    protected $paymentFeeBean;

    protected $wasCompletedBeforeCancelled;

    /** @var String */
    protected $reason;

    /** @var bool */
    protected $calledByMerchantNow;

    /** @var Purchase */
    protected $newPurchaseExtraCost;


    function __construct(Payment $payment, $transactionExternalId=null, $wasCompletedBeforeCancelled, $reason= '', $calledByMerchantNow=false, Purchase $newPurchaseExtraCost = null)
    {
        $this->payment                     = $payment;
        $this->transactionExternalId       = $transactionExternalId;
        $this->wasCompletedBeforeCancelled = $wasCompletedBeforeCancelled;
        $this->reason                      = $reason;
        $this->calledByMerchantNow         = $calledByMerchantNow;
        $this->newPurchaseExtraCost        = $newPurchaseExtraCost;
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return String
     */
    public function getTransactionExternalId()
    {
        return $this->transactionExternalId;
    }

    /**
     * @return mixed
     */
    public function getWasCompletedBeforeCancelled()
    {
        return $this->wasCompletedBeforeCancelled;
    }

    /**
     * @return String
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return bool
     */
    public function getCalledByMerchantNow()
    {
        return $this->calledByMerchantNow;
    }

    /**
     * @return \AppBundle\Entity\Purchase
     */
    public function getNewPurchaseExtraCost()
    {
        return $this->newPurchaseExtraCost;
    }


} 