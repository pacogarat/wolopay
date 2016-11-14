<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSubscriptionPaymentBasic;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Payment\Actions\SubscriptionFailed;
use AppBundle\Tests\Lib\FunctionalTestCase;

class SubscriptionFailedTest extends FunctionalTestCase
{
    /** @var SubscriptionFailed */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.subscription.failed');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentBasic()]);
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];
        $this->postPayment->execute($subscription);
        $this->assertEquals(PaymentStatusCategoryEnum::FAILED_ID, $subscription->getStatusCategory()->getId());
        $this->assertEquals(TransactionStatusCategoryEnum::FAILED_ID, $subscription->getPaymentDetail()
                ->getTransaction()->getStatusCategory()->getId()
        );
    }

} 