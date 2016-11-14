<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Payment\Actions\PurchaseExtraCost;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PurchaseExtraCostTest extends FunctionalTestCase
{
    /** @var PurchaseExtraCost */
    private $purchaseExtraCost;

    public function setUp()
    {
        parent::setUp();
        $this->purchaseExtraCost = $this->container->get('shop.payment.purchase_extra_cost');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];
        $this->purchaseExtraCost->purchaseExtraCost(
            new PurchaseExtraCostBean($this->em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO), -50, -50, -50),
            $purchase,
            'currency error'
        );
        $this->assertCount(2, $this->em->getRepository("AppBundle:Purchase")->findAll());
    }

} 