<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\ArticleSpecialTypeEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Item;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadItem extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use SonataMedia;

    const NAME_1='Granade';
    const NAME_2='Pistol';
    const NAME_GACHA_1='Gacha';

    const GALLE_1='Gunner';
    const GALLE_2='Gunner2';

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

        $this->fillComponent('Demo', self::NAME_1, 'granade_title', 'granade_desc', 'arma_2.png', 0.1);
        $this->fillComponent('Demo', self::NAME_2, 'pistol_title', 'pistol_desc', 'arma_1.png',  0.4);

        $this->fillComponentGacha('Demo', self::NAME_GACHA_1);

        $this->fillComponent('GalleGame', self::GALLE_1, 'gunner_title', 'gunner_desc', 'arma_4.png',  0.01);
        $this->fillComponent('GalleGame', self::GALLE_2, 'gunner2_title', 'gunner2_desc', 'arma_3.png',  0.6);
    }

    private function fillComponentGacha($appKey, $name, $image = 'gacha')
    {
        $obj = $this->fillComponent($appKey, $name, 'article.gacha.name', 'article.gacha.description', 'gacha.png', null);

        $obj
            ->setSpecialType($this->getReference('article_special_type-'.ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX))
        ;

        $this->om->flush();
    }

    private function fillComponent($appKey, $name, $transTitleRef, $transDescRef, $image, $unitaryPrice, $exchangeEur=1, $exchangeUsd=1)
    {
        $obj = new Item();

        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/'.$image, Item::SONATA_CONTEXT);

        $obj
            ->setApp($this->getReference('app-'.$appKey))
            ->setName($name)
            ->setNameLabel($this->getReference('translation-'.$transTitleRef))
            ->setDescriptionLabel($this->getReference('translation-'.$transDescRef))
            ->setImage($media)
            ->setUnitaryPrice($unitaryPrice)
            ->setUnitaryPriceCountry($this->getReference('country-'.CountryEnum::SPAIN))
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('item-'.$name, $obj);

        return $obj;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 225; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 