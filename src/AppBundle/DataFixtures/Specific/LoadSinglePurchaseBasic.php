<?php

namespace AppBundle\DataFixtures\Specific;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadSinglePurchaseBasic extends LoadSinglePaymentBasic implements OrderedFixtureInterface
{
    private $articleKey = null;

    function __construct($articleKey = null)
    {
        $this->articleKey  = $articleKey ;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paymentProcess = parent::load($manager, $this->articleKey);
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