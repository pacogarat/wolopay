<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Language;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadLanguage extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent (LanguageEnum::SPANISH, 'Español');
        $this->fillComponent (LanguageEnum::ENGLISH, 'Ingles');
        $this->fillComponent (LanguageEnum::KOREAN, 'Korean');
    }

    private function fillComponent($id, $name)
    {
        $obj = new Language($id);

        $obj
            ->setName($name)
            ->setLocalName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('language-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }
} 