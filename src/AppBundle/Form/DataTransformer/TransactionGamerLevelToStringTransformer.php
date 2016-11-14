<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\App;
use AppBundle\Entity\LevelCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TransactionGamerLevelToStringTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
    private $om;

    /** @var App*/
    private $app;

    public function __construct(EntityManagerInterface $om, App $app)
    {
        $this->om           = $om;
        $this->app = $app;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param LevelCategory $levelCategory
     * @return string
     */
    public function transform($levelCategory)
    {
        if (!$levelCategory) {
            return '';
        }

        return $levelCategory->getId();
    }

    /**
     * Transforms a string to an object
     *
     * @param mixed $level
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     *
     * @return LevelCategory
     */
    public function reverseTransform($level)
    {
        if (!$level)
            return null;

        $levelCategory = $this->om
            ->getRepository('AppBundle:AppShop')
            ->findOneByAppIdAndLevelGamer($this->app->getId(), $level)
        ;

        if (!$levelCategory)
        {
            throw new TransformationFailedException(sprintf(
                'Not shops with "%s" does not exist',
                $level
            ));
        }

        return $levelCategory;
    }
} 