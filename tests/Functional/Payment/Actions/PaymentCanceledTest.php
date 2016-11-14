<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Payment\Actions\PaymentCancelled;
use AppBundle\Payment\Actions\SubscriptionCancel;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentCancelledTest extends FunctionalTestCase
{
    /** @var PaymentCancelled */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.cancelled');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $payment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::CANCELED_ID, $payment->getStatusCategory()->getId());
    }

    public function testBasicPaymentWasCompletedBeforeCancelledOk()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $payment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::CANCELED_ID, $payment->getStatusCategory()->getId());

        /** @var PurchaseNotification[] $purchaseNotifications */
        $purchaseNotifications = $this->em->getRepository("AppBundle:PurchaseNotification")->findByEvent(PurchaseNotificationEventEnum::PAYMENT_CANCELLED);

        $this->assertCount(1, $purchaseNotifications);
        $this->assertEquals(PurchaseNotificationEventEnum::PAYMENT_CANCELLED, $purchaseNotifications[0]->getEvent());
        $this->assertGreaterThan(0, count($this->em->getRepository("AppBundle:ClientUserNotification")->findAll()));
    }

} 