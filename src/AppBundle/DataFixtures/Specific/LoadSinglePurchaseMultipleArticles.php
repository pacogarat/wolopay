<?php

namespace AppBundle\DataFixtures\Specific;

use Doctrine\Common\Persistence\ObjectManager;


class LoadSinglePurchaseMultipleArticles extends LoadSinglePaymentMultipleArticles
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paymentProcess = parent::load($manager);
        return $this->createPurchaseByPaymentProcess($paymentProcess);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 800; // the order in which fixtures will be loaded
    }
}