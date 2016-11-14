<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\SinglePayment;
use AppBundle\Payment\Actions\PaymentBlocked;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentBlockedTest extends FunctionalTestCase
{
    /** @var PaymentBlocked */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.blocked');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($singlePayment);
        $this->assertEquals(PaymentStatusCategoryEnum::BLOCKED_ID, $singlePayment->getStatusCategory()->getId());
    }

} 