<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\LevelCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadLevelCategoryCustom extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(LevelCategoryEnum::CUSTOM_ID, 'Custom Demo',false,'Demo');
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
        return 420; // the order in which fixtures will be loaded
    }
} 