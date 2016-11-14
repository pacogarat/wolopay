<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Helper\UtilHelper;
use Symfony\Component\Form\Exception\TransformationFailedException;


class ArrayIdsToCSVGenericTransformer extends IdToStringGenericTransformer
{
    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param $gamer
     * @return string
     */
    public function transform($gamer)
    {
        if (!$gamer || $gamer->isEmpty()) {
            return '';
        }

        $values = [];

        foreach ($gamer as $g)
            $values[] = parent::transform($g);

        return UtilHelper::str_putcsv($values);
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
    public function reverseTransform($number)
    {
        $result = new \Doctrine\Common\Collections\ArrayCollection();

        if (!$number)
            return $result;

        $array = str_getcsv($number);

        foreach ($array as $value)
        {
            $result[] = parent::reverseTransform($value);
        }

        return $result;
    }
} 