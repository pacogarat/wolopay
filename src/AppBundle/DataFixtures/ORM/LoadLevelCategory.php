<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\LevelCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadLevelCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(LevelCategoryEnum::ROOKIE_ID, 'Rookie',true);
        $this->fillComponent(LevelCategoryEnum::MEDIUM_ID, 'Medium',true);
        $this->fillComponent(LevelCategoryEnum::EXPERT_ID, 'Expert',true);
    }

    private function fillComponent($id, $name, $isGeneric=false, $app_key=null)
    {
        $obj = new LevelCategory($id);

        $obj
            ->setName($name)
            ->setIsGeneric($isGeneric);
        if ($app_key != null)
            $obj->setApp($this->getReference('app-'.$app_key))

        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('level_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }
} 