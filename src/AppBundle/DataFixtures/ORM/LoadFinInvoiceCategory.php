<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\FinInvoiceCategoryEnum;
use AppBundle\Entity\FinInvoiceCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFinInvoiceCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID, 'Client invoice monthly');
        $this->fillComponent(FinInvoiceCategoryEnum::OTHER_ID, 'Other');

    }

    private function fillComponent($id, $name)
    {
        $obj = new FinInvoiceCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('fin_invoice_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }
} 