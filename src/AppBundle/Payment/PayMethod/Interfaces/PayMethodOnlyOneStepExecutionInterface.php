<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;

interface PayMethodOnlyOneStepExecutionInterface
{
    /**
     * Only One Step like Promo
     *
     * @param PaymentIpnInteract $paymentPrepareInteract
     */
    public function executeOnlyOneStep(PaymentIpnInteract $paymentPrepareInteract);
} 