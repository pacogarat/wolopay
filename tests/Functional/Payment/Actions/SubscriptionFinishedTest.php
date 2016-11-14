<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSubscriptionPaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Payment\Actions\SubscriptionCancelled;
use AppBundle\Tests\Lib\FunctionalTestCase;

class SubscriptionFinishedTest extends FunctionalTestCase
{
    /** @var SubscriptionCancelled */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.subscription.finished');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentBasic()]);
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];
        $this->postPayment->execute($subscription);
        $this->assertEquals(PaymentStatusCategoryEnum::COMPLETED_ID, $subscription->getStatusCategory()->getId());
        $this->assertNotNull($subscription->getEndAt());
    }

} 