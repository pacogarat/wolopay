<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\AppTab;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAppShopHasAppTab extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent('free', 'Demo-'.LevelCategoryEnum::ROOKIE_ID);
        $this->fillComponent('free', 'Demo-'.LevelCategoryEnum::MEDIUM_ID);
        $this->fillComponent('free', 'Demo-'.LevelCategoryEnum::EXPERT_ID);

        $this->fillComponent('subscription', 'Demo-'.LevelCategoryEnum::ROOKIE_ID);
        $this->fillComponent('subscription', 'Demo-'.LevelCategoryEnum::MEDIUM_ID);
        $this->fillComponent('subscription', 'Demo-'.LevelCategoryEnum::EXPERT_ID);

        $this->fillComponent('single_payment', 'Demo-'.LevelCategoryEnum::ROOKIE_ID);
        $this->fillComponent('single_payment', 'Demo-'.LevelCategoryEnum::MEDIUM_ID);
        $this->fillComponent('single_payment', 'Demo-'.LevelCategoryEnum::EXPERT_ID);

    }

    private function fillComponent($appTabKey, $appShopKey)
    {
        /** @var AppTab $appTab */
        $appTab = $this->getReference('app_tab-'.$appTabKey);
        $appShopHasAppTab = new AppShopHasAppTab();
        $appShopHasAppTab
            ->setAppTab($this->getReference('app_tab-'.$appTabKey))
            ->setAppShop($this->getReference('app_shop-'.$appShopKey))
        ;

        $articles = $this->om->getRepository("AppBundle:Article")->findByApp($appTab->getApp()->getId());
        foreach ($articles as $article)
        {
            if ($appTab->getArticleCategories()->contains($article->getArticleCategory()))
                $appShopHasAppTab->addArticle($article);
        }

        $this->om->persist($appShopHasAppTab);
        $this->om->flush();

        $this->addReference('app_shop_has_app_tab-'.$appShopKey.'-'.$appTabKey, $appShopHasAppTab);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 352; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 