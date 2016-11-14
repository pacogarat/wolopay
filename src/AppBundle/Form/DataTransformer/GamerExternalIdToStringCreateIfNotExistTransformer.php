<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class GamerExternalIdToStringCreateIfNotExistTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
    private $om;

    /** @var App*/
    private $app;

    public function __construct(EntityManagerInterface $om, App $app)
    {
        $this->om = $om;
        $this->app = $app;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param Gamer $gamer
     * @return string
     */
    public function transform($gamer)
    {
        if (!$gamer) {
            return '';
        }

        return $gamer->getId();
    }

    /**
     * Transforms a string to an object
     *
     * @param  string $number
     *
     * @return Gamer
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number)
            return null;

        $gamer = $this->om
            ->getRepository('AppBundle:Gamer')
            ->findOneByAppIdAndGamerExternalId($this->app->getId(), $number)
        ;

        if (!$gamer)
        {
            $gamer = new Gamer($this->app, $number);
        }

        return $gamer;
    }
} 