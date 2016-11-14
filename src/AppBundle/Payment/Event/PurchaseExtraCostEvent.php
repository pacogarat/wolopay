<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\Purchase;
use Symfony\Component\EventDispatcher\Event;

class PurchaseExtraCostEvent extends Event
{
    const EVENT = 'shop.purchase.extra_cost';

    /**
     * @var Purchase
     */
    protected $newPurchase ;


    function __construct(Purchase $newPurchase)
    {
        $this->newPurchase = $newPurchase;
    }

    /**
     * @return \AppBundle\Entity\Purchase
     */
    public function getNewPurchase()
    {
        return $this->newPurchase;
    }


} 