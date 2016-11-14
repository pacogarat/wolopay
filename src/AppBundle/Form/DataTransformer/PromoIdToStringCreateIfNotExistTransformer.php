<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PromoIdToStringCreateIfNotExistTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
    private $om;

    /** @var App*/
    private $app;

    /** @var Promo */
    private $promo;

    public function __construct(EntityManagerInterface $om, App $app, Promo $promo=null)
    {
        $this->om = $om;
        $this->app = $app;
        $this->promo = $promo;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param Promo $promo
     * @return string
     */
    public function transform($promo)
    {
        if (!$promo) {
            return '';
        }

        return $promo->getName();
    }

    /**
     * Transforms a string to an object
     *
     * @param  string $promoName
     *
     * @return Promo
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($promoName)
    {
        if (!$promoName)
            return null;

        $promo = $this->om
            ->getRepository('AppBundle:Promo')
            ->findOneByPromoIdAndAppId($promoName, $this->app->getId())
        ;

        if (!$promo)
        {
            $promo = new Promo();
            $promo->setApp($this->app);
            $promo->setName($promoName);
        }

        return $promo;
    }
} 