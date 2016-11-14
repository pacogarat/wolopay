<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSubscriptionPaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Payment\Actions\SubscriptionCancel;
use AppBundle\Payment\Actions\SubscriptionStarted;
use AppBundle\Tests\Lib\FunctionalTestCase;

class SubscriptionStartedTest extends FunctionalTestCase
{
    /** @var SubscriptionStarted */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.subscription.started');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentBasic()]);
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];
        $this->postPayment->execute($subscription, 1234);
        $this->assertEquals(PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID, $subscription->getStatusCategory()->getId());
    }

} 