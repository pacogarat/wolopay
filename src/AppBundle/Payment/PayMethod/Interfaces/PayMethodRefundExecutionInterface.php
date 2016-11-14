<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\Payment;

interface PayMethodRefundExecutionInterface
{
    /**
     * If provider not notify status changed, this method will be cancel the payment and add
     * a purchase with extra cost if it was necessary
     *
     * @param Payment $payment
     * @param string $reason
     * @param bool $clientPetition
     * @return bool
     */
    public function executeRefund(Payment $payment, $reason='refund', $clientPetition=false);
} 