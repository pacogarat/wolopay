<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Promo;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadPromo extends AbstractFixture implements OrderedFixtureInterface
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
        $this->fillComponent('Demo', 'demo');
    }

    private function fillComponent($appKey, $name,  $totalNTimes=null)
    {
        $obj = new Promo();

        $obj
            ->setApp($this->getReference('app-'.$appKey))
            ->setName($name)
            ->setNTotalUses(100)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('promo-'.$name, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 250; // the order in which fixtures will be loaded
    }
} 