<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\VatCategoryEnum;
use AppBundle\Entity\VatCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVatCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(VatCategoryEnum::NONE_ID, 'None');
        $this->fillComponent(VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID, 'Vat from buyer country');
    }

    private function fillComponent($id, $name)
    {
        $obj = new VatCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('vat_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }
} 