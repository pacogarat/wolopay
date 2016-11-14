<?php


namespace AppBundle\Form\DataTransformer;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;

class BooleanToStringViewTransformer implements DataTransformerInterface
{

    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        if ($value==='0' || $value === 0 || $value === null || $value === false)
            return null;

        if (is_bool($value))
            return (string) $value;

        return $value;
    }
}