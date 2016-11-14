<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use Symfony\Component\HttpFoundation\Request;

/**
 * Like Promo Codes
 *
 * Interface PreviousStepInterface
 * @package AppBundle\Payment\PayMethod\Interfaces
 */
interface PreviousStepInterface
{
    /**
     * @param PaymentPreviousStepsInteract $previous
     * @return mixed
     * @throws \AppBundle\Payment\PayMethod\Exceptions\*
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous);
} 