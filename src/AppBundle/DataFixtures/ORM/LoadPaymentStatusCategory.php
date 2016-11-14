<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\PaymentStatusCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPaymentStatusCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(PaymentStatusCategoryEnum::BEGIN_ID, 'Begin');
        $this->fillComponent(PaymentStatusCategoryEnum::PENDING_ID, 'Pending');
        $this->fillComponent(PaymentStatusCategoryEnum::PROCESSING_ID, 'Processing');
        $this->fillComponent(PaymentStatusCategoryEnum::COMPLETED_ID, 'Completed');
        $this->fillComponent(PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID, 'Subscription Active');
        $this->fillComponent(PaymentStatusCategoryEnum::CANCELED_ID, 'Completed');
        $this->fillComponent(PaymentStatusCategoryEnum::FAILED_ID, 'Failed');
        $this->fillComponent(PaymentStatusCategoryEnum::BLOCKED_ID, 'Blocked');
        $this->fillComponent(PaymentStatusCategoryEnum::REFUNDED_ID, 'Refunded');

    }

    private function fillComponent($id, $name)
    {
        $obj = new PaymentStatusCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('payment_status_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 50; // the order in which fixtures will be loaded
    }
} 