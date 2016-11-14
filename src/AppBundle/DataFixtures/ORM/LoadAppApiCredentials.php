<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AppApiCredentials;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAppApiCredentials extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent('Demo', 'app_557ea6ca03e98', '78f1f3bc0b67795e6bfe3e1f05098a7767072d20');
        $this->fillComponent('GalleGame');
    }

    private function fillComponent($nameApp, $forceCodeKeyId=null, $forceApiKey=null)
    {
        $obj = new AppApiCredentials($this->getReference('app-'.$nameApp));

        if ($forceCodeKeyId)
        {
            $obj
                ->setCodeKey($forceCodeKeyId)
                ->setSecretKey($forceApiKey)
            ;
        }

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('app-'.$nameApp.'-key', $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 225; // the order in which fixtures will be loaded
    }
} 