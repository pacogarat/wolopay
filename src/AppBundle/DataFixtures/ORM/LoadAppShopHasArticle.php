<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AppShop;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Offer;
use AppBundle\Helper\UtilHelper;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAppShopHasArticle extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $shopsDemo = $this->getAllShops("Demo");

//        $oP=new OfferProgrammer();
//        $oP
//            ->setApp($this->getReference('app-Demo'))
//            ->setName('demo offer programmer')
//            ->setOfferFrom(new \DateTime())
//        ;
//
//        $this->om->persist($oP);
//        $this->om->flush();
//
//        $offer = new Offer();
//        $offer
//            ->setAmount(4.33)
//            ->setNumber(8)
//            ->setAppShopHasArticle()
//        ;
//
//        $this->om->persist($offer);
//        $this->om->flush();

        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100',CountryEnum::USA, 1.65, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100',CountryEnum::OTHER, 1.65, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-800',CountryEnum::USA, 98, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-300',CountryEnum::USA, 1,$shopsDemo);

        // Gacha
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-1', CountryEnum::SPAIN, 50, $shopsDemo);

        $this->fillComponent('Demo-'.ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID.'-100',CountryEnum::USA, 0.3,$shopsDemo);

        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100',CountryEnum::TURKEY, 3, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100',CountryEnum::POLAND, 4, $shopsDemo);

        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100',CountryEnum::SPAIN, 53, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-800',CountryEnum::SPAIN, 66, $shopsDemo);
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID.'-100',CountryEnum::SPAIN, 0.3, $shopsDemo);
        // Mobile AND Voice
        $this->fillComponent('Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-122', CountryEnum::SPAIN, 0, $shopsDemo, null,
            [LoadSMS::SHORT_NUMBER_1, LoadSMS::SHORT_NUMBER_2],
            [LoadVoice::NUMBER_1]
        );

        // Promo code
        $this->fillComponent('Demo-'.ArticleCategoryEnum::FREE_PAYMENT_ID.'-152', CountryEnum::SPAIN, 0, $shopsDemo);

        $shopsGalle = $this->getAllShops("GalleGame");

        $this->fillComponent('GalleGame-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-50',CountryEnum::SPAIN, 19, $shopsGalle);

        $masive= function($number) use ($shopsGalle){
            $this->fillComponent('GalleGame-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-'.$number,CountryEnum::SPAIN, 53, $shopsGalle);
        };

        UtilHelper::nTimesCallback($masive, 12);

    }

    /**
     * @param $appName
     * @return AppShop[]
     */
    private function getAllShops($appName)
    {
        $result = [];

        if ($this->hasReference("app_shop-$appName-".LevelCategoryEnum::ROOKIE_ID))
            $result[] = $this->getReference('app_shop-Demo-'.LevelCategoryEnum::ROOKIE_ID);

        if ($this->hasReference("app_shop-$appName-".LevelCategoryEnum::MEDIUM_ID))
            $result[] = $this->getReference("app_shop-$appName-".LevelCategoryEnum::MEDIUM_ID);

        if ($this->hasReference("app_shop-$appName-".LevelCategoryEnum::EXPERT_ID))
            $result[] = $this->getReference("app_shop-$appName-".LevelCategoryEnum::EXPERT_ID);

        return $result;
    }

    /**
     * @param null $articleKey
     * @param null $countryKey
     * @param $amount
     * @param AppShop[] $appShops
     * @param Offer $offer
     * @param array $sms
     * @param array $voice
     */
    private function fillComponent($articleKey, $countryKey, $amount, array $appShops, Offer $offer = null, array $sms=[],array $voice = [])
    {
        foreach ($appShops as $appShop)
        {
            $obj = new AppShopHasArticle();

            $obj
                ->setArticle($this->getReference('article-'.$articleKey))
                ->setCountry($this->getReference('country-'.$countryKey))
            ;

            $obj
                ->setAmount($amount)
                ->setAppShop($appShop)
                ->setOffer($offer)
            ;

            foreach ($sms as $s)
                $obj->addSMS($this->getReference('sms-'.$s));

            foreach ($voice as $v)
                $obj->addVoice($this->getReference('voice-'.$v));

            $this->om->persist($obj);
            $this->om->flush();

            $this->addReference('app_shop_has_articles-'.$articleKey.'-'.$countryKey.'-'.$appShop->getLevelCategory()->getId(), $obj);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 350; // the order in which fixtures will be loaded
    }
} 