<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Payment\Actions\PaymentPending;
use AppBundle\Payment\Actions\SubscriptionCancel;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentPendingTest extends FunctionalTestCase
{
    /** @var PaymentPending */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.pending');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $payment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($payment);
        $this->assertEquals(PaymentStatusCategoryEnum::PENDING_ID, $payment->getStatusCategory()->getId());
        $this->assertEquals(TransactionStatusCategoryEnum::PENDING_PAYMENT_ID, $payment->getPaymentDetail()->getTransaction()->getStatusCategory()->getId());
    }

} 