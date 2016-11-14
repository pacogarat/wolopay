<?php
/**
 * Created by MGDSoftware. 08/06/2016
 */

namespace AppBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckoutGeneral extends Constraint{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return 'checkout_general_validation';
    }
}