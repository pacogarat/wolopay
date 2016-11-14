<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\RoleAdminEnum;
use AppBundle\Entity\RoleAdminCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadRoleAdminCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(RoleAdminEnum::ACCOUNTING, 'Accounting');
        $this->fillComponent(RoleAdminEnum::DEVELOPER, 'Developer');
        $this->fillComponent(RoleAdminEnum::MARKETING, 'Marketing');
        $this->fillComponent(RoleAdminEnum::OWNER, 'Owner');
        $this->fillComponent(RoleAdminEnum::SUPPORT, 'Support');
        $this->fillComponent(RoleAdminEnum::DEMO_GENERAL, 'Demo general');
    }

    private function fillComponent($id, $name)
    {
        $obj = new RoleAdminCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('role_admin_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 50; // the order in which fixtures will be loaded
    }
} 