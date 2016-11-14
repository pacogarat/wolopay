<?php


namespace AppBundle\Form\DataTransformer;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class IdToStringGenericTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
    protected $om;

    /** @var string */
    protected $repository;

    /** @var string */
    protected $property;

    /** @var PropertyAccessor */
    protected $accessor;

    public function __construct(EntityManagerInterface $om, $repository = 'AppBundle:Currency', $property='id')
    {
        $this->om         = $om;
        $this->repository = $repository;
        $this->property   = $property;
        $this->accessor   = PropertyAccess::createPropertyAccessor();
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  $obj
     * @return string
     */
    public function transform($obj)
    {
        if (!$obj || $obj===null)
            return '';

        return $this->accessor->getValue($obj, $this->property);
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
        if (!$number)
            return null;

        $value = $this->om
            ->getRepository($this->repository)
            ->findOneBy([$this->property => $number])
        ;

        if (!$value)
        {
            throw new TransformationFailedException(sprintf(
                'An issue with "%s" does not exist',
                $number
            ));
        }

        return $value;
    }
} 