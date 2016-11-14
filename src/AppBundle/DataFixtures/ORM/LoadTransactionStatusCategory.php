<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\TransactionStatusCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTransactionStatusCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(TransactionStatusCategoryEnum::BEGIN_ID, 'Begin');
        $this->fillComponent(TransactionStatusCategoryEnum::SHOPPING_ID, 'Shopping');
        $this->fillComponent(TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID, 'Processing Payment');
        $this->fillComponent(TransactionStatusCategoryEnum::PENDING_PAYMENT_ID, 'Pending Payment');
        $this->fillComponent(TransactionStatusCategoryEnum::COMPLETED_ID, 'Completed');
        $this->fillComponent(TransactionStatusCategoryEnum::FAILED_ID, 'Failed');
        $this->fillComponent(TransactionStatusCategoryEnum::EXPIRED_ID, 'Expired');
        $this->fillComponent(TransactionStatusCategoryEnum::BLACKLISTED_COUNTRY, "Blacklisted country");
        $this->fillComponent(TransactionStatusCategoryEnum::BLACKLISTED_GAMER, "Blacklisted gamer");
        $this->fillComponent(TransactionStatusCategoryEnum::BLACKLISTED_IP, "Blacklisted ip");

    }

    private function fillComponent($id, $name)
    {
        $obj = new TransactionStatusCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('transaction_status_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 50; // the order in which fixtures will be loaded
    }
} 