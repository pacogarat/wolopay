<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\WoloPackEnum;
use AppBundle\Entity\WoloPack;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadWoloPack extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $this->fillComponent(WoloPackEnum::STANDARD_ID, 'Standard', 40);
    }


    /**
     * @param $id
     * @param $name
     */
    private function fillComponent($id, $name, $amount)
    {
        $obj = new WoloPack($id);
        $obj
            ->setName($name)
            ->setAmountTotal($amount)
            ->setCurrency($this->getReference('currency-'.CurrencyEnum::EURO))
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('wolo_pack-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 25; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
