<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Payment\Actions\PaymentFailed;
use AppBundle\Payment\Actions\SubscriptionCancel;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentFailedTest extends FunctionalTestCase
{
    /** @var PaymentFailed */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.failed');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $payment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::FAILED_ID, $payment->getStatusCategory()->getId());
    }

} 