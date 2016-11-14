<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\PayCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPayCategory extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(PayCategoryEnum::PREPAID_CARD_ID, 'Prepaid card');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID, 'Special provider method');
        $this->fillComponent(PayCategoryEnum::CREDIT_CARD_ID, 'Credit Card');
        $this->fillComponent(PayCategoryEnum::MOBILE_ID, 'Mobile');
        $this->fillComponent(PayCategoryEnum::VOICE_ID, 'Voice');
        $this->fillComponent(PayCategoryEnum::PROMO_CODE_ID, 'Promo code');
        $this->fillComponent(PayCategoryEnum::CASH_ID, 'Cash');
        $this->fillComponent(PayCategoryEnum::BANK_TRANSFER_ID, 'Bank transfer');
        $this->fillComponent(PayCategoryEnum::EXTERNAL_STORES_ID, 'External stores');


    }

    private function fillComponent($id, $name)
    {
        $obj = new PayCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('pay_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }
} 