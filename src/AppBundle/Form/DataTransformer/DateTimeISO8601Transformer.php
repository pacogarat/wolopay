<?php


namespace AppBundle\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeISO8601Transformer implements DataTransformerInterface
{
    /**
     * Transforms an object to a string
     *
     * @param \DateTime $dateTime
     * @return string
     */
    public function transform($dateTime)
    {
        if (!$dateTime)
            return '';

        return $dateTime->format(\DateTime::ISO8601);
    }

    /**
     * @param string $string
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     * @return \DateTime|null
     */
    public function reverseTransform($string)
    {
        if (!$string)
            return null;

        if (!$dateTime = \DateTime::createFromFormat(\DateTime::ISO8601, $string))
        {
            throw new TransformationFailedException(sprintf(
                'Invalid date Format:  "%s", required ISO8601',
                $string
            ));
        }

        return $dateTime;
    }
} 