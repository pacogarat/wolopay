<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;

interface PayMethodIpnExecutionInterface
{
/* Need to define in all PayMethodIpnExecutionInterface
    const PREFIX_EXTERNAL_TRANSACTION = 'TO_BE_DEFINED';
*/

    /**
     * Return with response Object inside $paymentEvent, to be redirected in provider page
     *
     * @param PaymentPrepareInteract $paymentPrepareInteract
     */
    public function executePaymentPrepare(PaymentPrepareInteract $paymentPrepareInteract);

    /**
     * @param PaymentIpnInteract $paymentInteract
     */
    public function executePaymentIpn(PaymentIpnInteract $paymentInteract);
} 