<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPurchaseBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Payment\Actions\PaymentUnCancelled;
use AppBundle\Payment\Actions\SubscriptionCancel;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentUnCancelledTest extends FunctionalTestCase
{
    /** @var PaymentUnCancelled */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.un_cancelled');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $payment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::COMPLETED_ID, $payment->getStatusCategory()->getId());
    }

    public function testBasicPaymentWasCompletedBeforeCancelledOk()
    {
        $this->loadAllFixtures([new LoadSubscriptionPurchaseBasic()]);
        $payment = $this->em->getRepository("AppBundle:SubscriptionEventualityPayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID, $payment->getStatusCategory()->getId());
    }

} 