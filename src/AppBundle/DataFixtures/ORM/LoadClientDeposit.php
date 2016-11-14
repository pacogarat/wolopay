<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ClientDeposit;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadClientDeposit extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent('Wolopay');
        $this->fillComponent('NviaDemo');
        $this->fillComponent('Gallegos');

    }

    private function fillComponent($clientName)
    {
        $obj = new ClientDeposit();

        $obj
            ->setDescription('init')
            ->setAmountBalance(0)
            ->setAmountBalanceRequirement(60)
            ->setAmountLimitCover(50)
            ->setAmountIncreaseIfLimitExceed(40)
            ->setUsedAt(new \DateTime())
            ->setClient($this->getReference('client-'.$clientName))

        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('client_deposit-'.$clientName, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 90; // the order in which fixtures will be loaded
    }
} 