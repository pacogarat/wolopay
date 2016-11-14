<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Payment\Bean\PaymentFeeBean;
use Symfony\Component\EventDispatcher\Event;

class PaymentCompletedEvent extends Event
{
    const EVENT = 'shop.payment.completed';

    /** @var PaymentProcessInterface*/
    protected $paymentProcess;

    /** @var String */
    protected $transactionExternalId;

    /** @var PaymentFeeBean */
    protected $paymentFeeBean;

    /** @var PurchaseNotification[] */
    protected $purchaseNotifications;

    /** @var Payment */
    protected $payment;

    /** @var Purchase */
    protected $purchase;

    function __construct(PaymentProcessInterface $paymentProcess=null, $transactionExternalId, Payment $payment,
        Purchase $purchase, $purchaseNotifications=[], PaymentFeeBean $paymentFeeBean = null)
    {
        $this->paymentProcess        = $paymentProcess;
        $this->transactionExternalId = $transactionExternalId;
        $this->paymentFeeBean        = $paymentFeeBean;
        $this->purchaseNotifications = $purchaseNotifications;
        $this->payment               = $payment;
        $this->purchase              = $purchase;
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

    /**
     * @return String
     */
    public function getPaymentFeeBean()
    {
        return $this->paymentFeeBean;
    }

    /**
     * @return \AppBundle\Entity\PurchaseNotification[]
     */
    public function getPurchaseNotifications()
    {
        return $this->purchaseNotifications;
    }

    /**
     * @return \AppBundle\Entity\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return \AppBundle\Entity\Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }


} 