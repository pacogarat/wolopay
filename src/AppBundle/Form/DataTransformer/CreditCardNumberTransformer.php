<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\NotPersisted\CreditCards\AbstractCreditCard;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class CreditCardNumberTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param AbstractCreditCard $creditCard
     * @return string
     */
    public function transform($creditCardNumberWithOutSpaces)
    {
        if (!$creditCardNumberWithOutSpaces) {
            return '';
        }

    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     *
     * @return null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($creditCardNumber)
    {
        if (!$creditCardNumber) {
            return '';
        }

        return str_replace(' ', '', $creditCardNumber);
    }
} 