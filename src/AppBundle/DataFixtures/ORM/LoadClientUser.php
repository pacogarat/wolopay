<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\ClientUserCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\RoleEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadClientUser extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent('NviaDemo', [RoleEnum::SUPER_ADMIN, RoleEnum::SONATA_ADMIN], 'mgarcia', 'miguelgd1985@gmail.com','123');
        $this->fillComponent('NviaDemo', [RoleEnum::SUPER_ADMIN, RoleEnum::SONATA_ADMIN], 'dmorillo', 'd.morillo@gmail.com','123');

        $this->fillComponent('NviaDemo', [RoleEnum::CLIENT_BASIC], 'currito', 'miguelgd1982@gmail.com','123');
        $this->fillComponent('Gallegos', [RoleEnum::CLIENT_BASIC], 'gallego', 'galle@go.com','123');

        $this->fillComponent('NviaDemo', [RoleEnum::SONATA_FIN_MOVEMENT], 'billing', 'billing@wolopay.com','123');
        $this->fillComponent('NviaDemo', [RoleEnum::SONATA_STATS_INTERNAL], 'stats', 'stats@wolopay.com','123');


    }

    private function fillComponent($companyKey, array $roles, $userName, $email, $password='123')
    {
        $obj = new ClientUser();

        $obj
            ->setClient($this->getReference('client-'.$companyKey))
            ->setRoles($roles)
            ->setUsername($userName)
            ->setCountry($this->getReference('country-'.CountryEnum::SPAIN))
            ->setName($userName)
            ->setEmail($email)
            ->setPlainPassword($password)
            ->setEnabled(true)
            ->setLanguage($this->getReference('language-'.LanguageEnum::SPANISH))
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('client_user-'.$userName, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 120; // the order in which fixtures will be loaded
    }
} 