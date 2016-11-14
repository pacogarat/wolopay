<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\Gamer;
use AppBundle\Helper\UtilHelper;
use Symfony\Component\Form\Exception\TransformationFailedException;

class GamerExternalIdsToCSVTransformer extends GamerExternalIdToStringTransformer
{

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param Gamer[] $gamer
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
     * @return Gamer[]
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number)
            return new \Doctrine\Common\Collections\ArrayCollection();

        $currencies = new \Doctrine\Common\Collections\ArrayCollection();

        $array = str_getcsv($number);

        foreach ($array as $value)
        {
            $currencies[] = parent::reverseTransform($value);
        }

        return $currencies;
    }
} 