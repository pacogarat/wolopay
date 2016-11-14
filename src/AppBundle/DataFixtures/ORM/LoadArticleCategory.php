<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadArticleCategory extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

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

        $this->fillComponent(ArticleCategoryEnum::FREE_PAYMENT_ID, 'Free');
        $this->fillComponent(ArticleCategoryEnum::SINGLE_PAYMENT_ID, 'Single Payment');
        $this->fillComponent(ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, 'Subscription Payment');

    }


    /**
     * @param $id
     * @param $name
     */
    private function fillComponent($id, $name)
    {
        $obj = new ArticleCategory($id);
        $obj->setName($name);

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('article_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
