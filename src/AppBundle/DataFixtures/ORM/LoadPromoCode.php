<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\PromoCode;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadPromoCode extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    const PROMO_1_CODE = 'demo';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;
        $this->fillComponent(self::PROMO_1_CODE, 'demo', 'Demo-'. ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100');
    }

    private function fillComponent($code, $promoKey, $articleKey, $totalNTimes=null)
    {
        $obj = new PromoCode();

        $obj
            ->setCode($code)
            ->setPromo($this->getReference('promo-'.$promoKey))
            ->setArticle($this->getReference('article-'.$articleKey))
            ->setApp($this->getReference('article-'.$articleKey)->getApp())
            ->setNTotalUses($totalNTimes)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('promo_code-'.$code, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 310; // the order in which fixtures will be loaded
    }
} 