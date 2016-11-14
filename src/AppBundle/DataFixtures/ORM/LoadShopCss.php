<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ShopCss;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadShopCss extends AbstractFixture implements OrderedFixtureInterface
{

    const NAME_1='Standard';
    const NAME_2='Wood';
    const NAME_3='Berserk';
    const BERSERK_MODULAR_NAME = 'Bersermodular';
    const NAME_4='Tron';
    const NAME_5='Paper';
    const NAME_6='Torofun';
    const NAME_7='IDC';
    const NAME_8='Korner';
    const NAME_9='Ragnarok';
    const NAME_10='Modular BLUE';
    const NAME_11='Cronix';
    const NAME_12='IDCModular';
    const AZT='AZT';
    const METAL_ASSAULT='Metal assault Modular';

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

        $this->fillComponent(self::NAME_1, "theme_default.less");
        $this->fillComponent(self::NAME_2, "theme_wood.less");
        $this->fillComponent(self::NAME_3, "theme_berserk.less");
        $this->fillComponent(self::BERSERK_MODULAR_NAME, "theme_berserk_modular.less", true, 1, true);
        $this->fillComponent(self::NAME_3.'h', "theme_berserk_halloween.less");
        $this->fillComponent(self::NAME_3.'christmas', "theme_berserk_christmas.less");
        $this->fillComponent(self::NAME_4, "theme_tron.less");
        $this->fillComponent(self::NAME_5, "theme_paper.less");
        $this->fillComponent(self::NAME_6, "theme_torofun.less");
        $this->fillComponent(self::NAME_7, "theme_idc.less");
        $this->fillComponent(self::NAME_7.'h', "theme_idc_halloween.less");
        $this->fillComponent(self::NAME_7.'_christmas', "theme_idc_christmas.less");
        $this->fillComponent(self::NAME_8, "theme_korner.less");
        $this->fillComponent(self::NAME_8.'h', "theme_korner_halloween.less");
        $this->fillComponent(self::NAME_8.'christmas', "theme_korner_christmas.less");
        $this->fillComponent(self::NAME_9, "theme_ragnarok.less");
        $this->fillComponent(self::NAME_9.'h', "theme_ragnarok_halloween.less");
        $this->fillComponent(self::NAME_9.'christmas', "theme_ragnarok_christmas.less");
        $this->fillComponent(self::NAME_11, "theme_cronix.less");
        $this->fillComponent(self::NAME_11.'h', "theme_cronix_halloween.less");
        $this->fillComponent(self::NAME_11.'christmas', "theme_cronix_christmas.less");
        $this->fillComponent(self::NAME_12, "theme_idc_modular.less");
//        $this->fillComponent(self::NAME_10, "theme_module_blue.less", true, 2, 2);
        $this->fillComponent(self::AZT, "theme_azt_modular.less", true, 1, false);
        $this->fillComponent(self::METAL_ASSAULT, "theme_metal_assault_modular.less", true, 1, false);

        $this->fillComponent('azt_valentin', "theme_azt_valentines_day_modular.less", true, 1, false);
        $this->fillComponent('berserk_valentin_module', "theme_berserk_valentines_day_modular.less", true, 1, true);
        $this->fillComponent('battle_space_valentin', "theme_battle_space_valentines_day.less", false, 1, false);
        $this->fillComponent('cronix_valentin', "theme_cronix_valentines_day.less", false, 1, false);
        $this->fillComponent('idc_valentin', "theme_idc_valentines_day.less", false, 1, false);
        $this->fillComponent('korner_valentin', "theme_korner_valentines_day.less", false, 1, false);
        $this->fillComponent('ragnarok_valentin', "theme_ragnarok_valentines_day.less", false, 1, false);
        $this->fillComponent('theme_early_access_modular', "theme_early_access_modular.less", true, 1, false, false, null, null, null, '_shop_tooltip');


        $this->fillComponent('theme_ragnarok_black_friday', "theme_ragnarok_black_friday.less");
        $this->fillComponent('theme_battle_space_black_friday', "theme_battle_space_black_friday.less");
        $this->fillComponent('theme_battle_space_christmas', "theme_battle_space_christmas.less");
        $this->fillComponent('theme_cronix_black_friday', "theme_cronix_black_friday.less");
        $this->fillComponent('theme_berserk_black_friday', "theme_berserk_black_friday.less");
        $this->fillComponent('theme_idc_black_friday', "theme_idc_black_friday.less");
        $this->fillComponent('theme_korner_black_friday', "theme_korner_black_friday.less");


    }

    private function fillComponent(
        $name,
        $cssUrl,
        $modular = false,
        $productRows = 1,
        $hasCategories = false,
        $hasCart = true,
        $templateLayout = null,
        $templateProducts = null,
        $templatePayMethods = null,
        $productsImgFormat = null,
        $payMethodsImgFormat = null
    )
    {
        $obj = new ShopCss();

        $obj
            ->setName($name)
            ->setCssUrl($cssUrl)
            ->setProductRows($productRows)
            ->setPayMethodRows($productRows)
            ->setModular($modular)
            ->setHasCategories($hasCategories)
            ->setHasCart($hasCart)
            ->setTemplateLayout($templateLayout)
            ->setTemplatePayMethods($templatePayMethods)
            ->setTemplateProducts($templateProducts)
            ->setProductsImgFormat($productsImgFormat)
            ->setPayMethodsImgFormat($payMethodsImgFormat)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('shop_css-'.$name, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 225; // the order in which fixtures will be loaded
    }
} 