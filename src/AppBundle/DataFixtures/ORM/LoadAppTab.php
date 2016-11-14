<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AppTab;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAppTab extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $this->fillComponent('Free', 'article_categories.free.description', 'article_categories.free.name', [ArticleCategoryEnum::FREE_PAYMENT_ID]);
        $this->fillComponent('Subscription', 'article_categories.subscription.description', 'article_categories.subscription.name', [ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID]);
        $this->fillComponent('Single Payment', 'article_categories.single.description', 'article_categories.single.name', [ArticleCategoryEnum::SINGLE_PAYMENT_ID]);
    }

    private function fillComponent($name, $descriptionKey, $nameKey, array $articleCategoryIds,  $appKey = 'Demo')
    {
        $appTab = new AppTab();
        $appTab
            ->setApp($this->getReference('app-'.$appKey))
            ->setName($name)
            ->setNameLabel($this->getReference('translation-'.$nameKey))
            ->setDescriptionLabel($this->getReference('translation-'.$descriptionKey))
        ;

        foreach ($articleCategoryIds as $articleCategoryId)
            $appTab->addArticleCategory($this->getReference('article_category-'.$articleCategoryId));

        $this->om->persist($appTab);
        $this->om->flush();

        $this->addReference('app_tab-'.$appTab->getNameUnique(), $appTab);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 210; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 