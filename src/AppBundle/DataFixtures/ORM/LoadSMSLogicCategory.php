<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\SMSLogicCategoryEnum;
use AppBundle\Entity\SMSLogicCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSMSLogicCategory extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $this->fillComponent(SMSLogicCategoryEnum::MO_AND_MT_AND_CODE, 'Mo + Mt + Code');
    }

    private function fillComponent($id, $name)
    {
        $obj = new SMSLogicCategory($id);

        $obj
            ->setName($name)
       ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('sms_logic_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

} 