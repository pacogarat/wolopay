<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AppShop;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\ShopOrderTypeEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAppShop extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent('Demo', LevelCategoryEnum::ROOKIE_ID, 0, 3, 'Rookie shop', true, 'Demo-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100','',ShopOrderTypeEnum::ORDER_BY_PRICE_ASC);
        $this->fillComponent('Demo', LevelCategoryEnum::MEDIUM_ID, 3, 6, 'Normal shop');
        $this->fillComponent('Demo', LevelCategoryEnum::EXPERT_ID, 6, 10, 'Expert shop');

        $this->fillComponent('GalleGame', LevelCategoryEnum::MEDIUM_ID, 0, 9999, 'Unique');

    }

    private function fillComponent($appKey, $levelCatKey, $lowerValue, $higherValue,$name='', $tutorialEnabled=true, $tutorialArticleFree= null, $css='', $orderBy=null)
    {
        $obj = new AppShop();

        $obj
            ->setApp($this->getReference('app-'.$appKey))
            ->setLevelCategory($this->getReference('level_category-'.$levelCatKey))
            ->setValueHigher($higherValue)
            ->setValueLower($lowerValue)
            ->setName($name)
            ->setTutorialEnabled($tutorialEnabled)
            ->setCss($this->getReference('shop_css-'.LoadShopCss::BERSERK_MODULAR_NAME))
            ->setOrderType($orderBy)
        ;



        if ($tutorialArticleFree)
            $obj->setTutorialPromoCode($this->getReference('promo_code-'.LoadPromoCode::PROMO_1_CODE));

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('app_shop-'.$appKey.'-'.$levelCatKey, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 320; // the order in which fixtures will be loaded
    }
} 