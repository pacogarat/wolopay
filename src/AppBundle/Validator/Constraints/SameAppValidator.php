<?php


namespace AppBundle\Validator\Constraints;


use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SameAppValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$value)
            return;

        $root = $this->context->getRoot();

        if ($root instanceof \Symfony\Component\Form\Form)
            $parentObject = $root->getData();
        else
            $parentObject = $root;

        if ($value instanceof Collection && is_object($parentObject))
        {
            foreach ($value as $val)
                $this->compareApps($val, $parentObject, $constraint);

            return;
        }

        $this->compareApps($value, $parentObject, $constraint);
    }

    private function compareApps($obj1, $pbj2, Constraint $constraint)
    {
        if (is_object($pbj2) && $obj1->getApp() && $obj1->getApp()->getId() !== $pbj2->getApp()->getId())
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}