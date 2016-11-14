<?php

namespace AppBundle\Tests\Functional\Payment\Actions;

use AppBundle\DataFixtures\Specific\LoadSingleCustomPaymentBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePaymentDollarBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePaymentMultipleArticles;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPaymentBasic;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPaymentPartialPayment;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Payment\Actions\PaymentCompleted;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentCompletedTest extends FunctionalTestCase
{
    /** @var PaymentCompleted */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.completed');
    }

    public function testSinglePaymentBasicOK()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];

        $this->postPayment->execute($singlePayment, '123', null);

        $this->em->refresh($singlePayment);

        $this->assertEquals(PaymentStatusCategoryEnum::COMPLETED_ID, $singlePayment->getStatusCategory()->getId());
        $this->assertEquals(TransactionStatusCategoryEnum::COMPLETED_ID, $singlePayment->getPurchase()->getTransaction()->getStatusCategory()->getId());

        $this->assertCount(1, $singlePayment->getPurchase()->getPurchaseNotification());
        $this->assertTrue($singlePayment->getPurchase()->getPurchaseNotification()[0]->getIsReadyToNotify());
        $amountNotification = $singlePayment->getPurchase()->getPurchaseNotification()[0]->getAmount();

        $this->assertEquals(42.111652892561978, $amountNotification );
        // sum article game money + WO FEE + provider + TAX = paymentDetailsPrice (total without fees)
        $this->assertEquals($singlePayment->getPaymentDetail()->getAmount() ,$amountNotification+$singlePayment->getPurchase()->getAmountWolo()+$singlePayment->getPurchase()->getAmountProvider() + $singlePayment->getPurchase()->getAmountTax());


    }


    public function testSinglePaymentExtraUrlPaymentNotificationOK()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $app = $this->em->getRepository("AppBundle:App")->findOneBy(['name' => 'Demo']);
        $app->setUrlNotificationExtra('https://sandbox.wolopay.com/pg_notification_to_app_test?petarda=1');
        $this->em->flush();

        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($singlePayment, '123', null);
        $this->em->refresh($singlePayment->getPurchase());

        $this->assertCount(2, $this->em->getRepository("AppBundle:PurchaseNotification")->findAll());
        $this->assertCount(2, $singlePayment->getPurchase()->getPurchaseNotification());
    }

    public function testSubscriptionPaymentPartialPaymentExtraUrlOK()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentPartialPayment()]);
        $app = $this->em->getRepository("AppBundle:App")->findOneBy(['name' => 'Demo']);
        $app->setUrlNotificationExtra('https://sandbox.wolopay.com/pg_notification_to_app_test?go=1');
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];

        // fist partial payment
        $this->postPayment->execute($subscription, '123', null);

        $this->em->refresh($subscription);


        $purchase = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();

        $this->em->refresh($purchase);

        $this->assertCount(2, $this->em->getRepository("AppBundle:PurchaseNotification")->findAll());
        $this->assertCount(2, $purchase->getPurchaseNotification());
        $this->assertFalse($purchase->getPurchaseNotification()[0]->getIsReadyToNotify());
        $this->assertEquals(0.25, $subscription->getAmountTotal());
        $this->assertEquals(0.25, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());

//        $amountNotification = $purchase->getPurchaseNotification()[0]->getAmount();
//        $this->assertEquals(0.099111570247933878, $amountNotification);

        // second partial payment, rerun and save extra money in next SubscriptionEventListener
        $this->postPayment->execute($subscription, '1231234', null);

        $this->em->refresh($subscription);

        $this->assertCount(2, $subscription->getSubscriptionEventualities());
        $this->assertCount(2, $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments());
        $this->assertNotNull( $subscription->getSubscriptionEventualities()[0]->getEndAt());

        $purchase = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();
        $this->em->refresh($purchase);

        $this->assertCount(2, $purchase->getPurchaseNotification());
        $this->assertTrue($purchase->getPurchaseNotification()[0]->getIsReadyToNotify());

        $this->assertEquals(0.5, $subscription->getAmountTotal());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());
        $this->assertEquals(0.2, $subscription->getSubscriptionEventualities()[1]->getTotalAmount());

//        $amountNotification = $purchase->getPurchaseNotification()[0]->getAmount();
//        $this->assertEquals(0.19822314049586776, $amountNotification);

        $purchase1 = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();
        $purchase2 = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[1]->getPurchase();
        $sepNext = $subscription->getSubscriptionEventualities()[1];

        $partial1 = $purchase1->getAmountWolo() + $purchase1->getAmountProvider() + $purchase1->getAmountGame() + $purchase1->getAmountTax();
        $partial2 = $purchase2->getAmountWolo() + $purchase2->getAmountProvider() + $purchase2->getAmountGame()+ $purchase2->getAmountTax();
        $totalAmount = $partial1 + $partial2 - $sepNext->getTotalAmount();

        // sum all partials each (game money + PG TAX + provider) - ExtraMoney = paymentDetailsPrice (total without fees)
        $this->assertEquals($subscription->getPaymentDetail()->getAmount(), $totalAmount);

        // third partial payment
        $this->postPayment->execute($subscription, '123123', null);

        $this->assertCount(3, $subscription->getSubscriptionEventualities());
        $this->assertCount(1, $subscription->getSubscriptionEventualities()[1]->getSubscriptionEventualityPayments());
        $this->assertNotNull( $subscription->getSubscriptionEventualities()[1]->getEndAt());
        $this->assertCount(4, $this->em->getRepository("AppBundle:PurchaseNotification")->findAll());
        $this->assertTrue($subscription->getSubscriptionEventualities()[1]->getSubscriptionEventualityPayments()[0]->getPurchase()->getPurchaseNotification()[0]->getIsReadyToNotify());

        $this->assertEquals(0.25+0.25+0.25, $subscription->getAmountTotal());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[1]->getTotalAmount());

    }


    public function testSinglePaymentDollarBasicOK()
    {
        $this->loadAllFixtures([new LoadSinglePaymentDollarBasic()]);

        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($singlePayment, '123', null);
        $this->em->refresh($singlePayment);

        $amountNotification = $singlePayment->getPurchase()->getPurchaseNotification()[0]->getAmount();

        $this->assertEquals( 37.778889503999999, $amountNotification);
    }

    public function testSinglePaymentMultipleItemsOK()
    {
        $this->loadAllFixtures([new LoadSinglePaymentMultipleArticles()]);
        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];

        $this->postPayment->execute($singlePayment, '123', null);

        $this->em->refresh($singlePayment);

        $this->assertCount(2, $singlePayment->getPurchase()->getPurchaseNotification());
        $this->assertTrue($singlePayment->getPurchase()->getPurchaseNotification()[0]->getIsReadyToNotify());
        $this->assertTrue($singlePayment->getPurchase()->getPurchaseNotification()[1]->getIsReadyToNotify());
        $amountNotification = $singlePayment->getPurchase()->getPurchaseNotification()[0]->getAmount();
        $amountNotification2 = $singlePayment->getPurchase()->getPurchaseNotification()[1]->getAmount();
        $this->assertEquals(42.167115077435945, $amountNotification);
        $this->assertEquals(52.509992360580611, $amountNotification2);
        // sum 2 articles game money + PG TAX + provider = paymentDetailsPrice (total without fees)
        $this->assertEquals($singlePayment->getPaymentDetail()->getAmount() ,$amountNotification+$amountNotification2+$singlePayment->getPurchase()->getAmountWolo()+$singlePayment->getPurchase()->getAmountProvider()+ $singlePayment->getPurchase()->getAmountTax());
    }

    public function testSubscriptionPaymentBasicOK()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentBasic()]);
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];

        $this->postPayment->execute($subscription, '123', null);

        $this->assertCount(1, $subscription->getSubscriptionEventualities());
        $this->assertCount(1, $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments());
        $this->assertNotNull( $subscription->getSubscriptionEventualities()[0]->getEndAt());
        $purchase = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();

        $this->assertCount(1, $purchase->getPurchaseNotification());
        $this->assertTrue($purchase->getPurchaseNotification()[0]->getIsReadyToNotify());

        $amountNotification = $purchase->getPurchaseNotification()[0]->getAmount();
        $this->assertEquals(0.13893388429752065, $amountNotification);

        // sum 1 articles game money + PG TAX + provider = paymentDetailsPrice (total without fees)
        $this->assertEquals($subscription->getPaymentDetail()->getAmount() ,$amountNotification+$purchase->getAmountWolo()+$purchase->getAmountProvider()+ $purchase->getAmountTax());
    }

    public function testSubscriptionPaymentPartialPaymentOK()
    {
        $this->loadAllFixtures([new LoadSubscriptionPaymentPartialPayment()]);
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];

        // fist partial payment
        $this->postPayment->execute($subscription, '123', null);

        $this->em->refresh($subscription);

        $this->assertCount(1, $subscription->getSubscriptionEventualities());
        $this->assertCount(1, $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments());
        $this->assertNull( $subscription->getSubscriptionEventualities()[0]->getEndAt());
        $purchase = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();

        $this->assertCount(1, $purchase->getPurchaseNotification());
        $this->assertFalse($purchase->getPurchaseNotification()[0]->getIsReadyToNotify());
        $this->assertEquals(0.25, $subscription->getAmountTotal());
        $this->assertEquals(0.25, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());

//        $amountNotification = $purchase->getPurchaseNotification()[0]->getAmount();
//        $this->assertEquals(0.099111570247933878, $amountNotification);

        // second partial payment, rerun and save extra money in next SubscriptionEventListener
        $this->postPayment->execute($subscription, '1231234', null);

        $this->em->refresh($subscription);

        $this->assertCount(2, $subscription->getSubscriptionEventualities());
        $this->assertCount(2, $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments());
        $this->assertNotNull( $subscription->getSubscriptionEventualities()[0]->getEndAt());
        $purchase = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();

        $this->assertCount(1, $purchase->getPurchaseNotification());
        $this->assertTrue($purchase->getPurchaseNotification()[0]->getIsReadyToNotify());

        $this->assertEquals(0.5, $subscription->getAmountTotal());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());
        $this->assertEquals(0.2, $subscription->getSubscriptionEventualities()[1]->getTotalAmount());

//        $amountNotification = $purchase->getPurchaseNotification()[0]->getAmount();
//        $this->assertEquals(0.19822314049586776, $amountNotification);

        $purchase1 = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[0]->getPurchase();
        $purchase2 = $subscription->getSubscriptionEventualities()[0]->getSubscriptionEventualityPayments()[1]->getPurchase();
        $sepNext = $subscription->getSubscriptionEventualities()[1];

        $partial1 = $purchase1->getAmountWolo() + $purchase1->getAmountProvider() + $purchase1->getAmountGame() + $purchase1->getAmountTax();
        $partial2 = $purchase2->getAmountWolo() + $purchase2->getAmountProvider() + $purchase2->getAmountGame()+ $purchase2->getAmountTax();
        $totalAmount = $partial1 + $partial2 - $sepNext->getTotalAmount();

        // sum all partials each (game money + PG TAX + provider) - ExtraMoney = paymentDetailsPrice (total without fees)
        $this->assertEquals($subscription->getPaymentDetail()->getAmount(), $totalAmount);

        // third partial payment
        $this->postPayment->execute($subscription, '123123', null);

        $this->assertCount(3, $subscription->getSubscriptionEventualities());
        $this->assertCount(1, $subscription->getSubscriptionEventualities()[1]->getSubscriptionEventualityPayments());
        $this->assertNotNull( $subscription->getSubscriptionEventualities()[1]->getEndAt());
        $this->assertCount(2, $this->em->getRepository("AppBundle:PurchaseNotification")->findAll());
        $this->assertTrue($subscription->getSubscriptionEventualities()[1]->getSubscriptionEventualityPayments()[0]->getPurchase()->getPurchaseNotification()[0]->getIsReadyToNotify());

        $this->assertEquals(0.25+0.25+0.25, $subscription->getAmountTotal());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[0]->getTotalAmount());
        $this->assertEquals(0.3, $subscription->getSubscriptionEventualities()[1]->getTotalAmount());

    }

    public function testSingleCustomPayment()
    {
        $this->loadAllFixtures([new LoadSingleCustomPaymentBasic()]);
        $singleCustomPayment = $this->em->getRepository("AppBundle:SingleCustomPayment")->findAll()[0];
        $this->postPayment->execute($singleCustomPayment, '123', null);

        $purchases = $this->em->getRepository("AppBundle:Purchase")->findAll();
        $purchasesNotifications = $this->em->getRepository("AppBundle:PurchaseNotification")->findAll();

        $this->assertCount(1, $purchases);
        $this->assertCount(1, $purchasesNotifications);

        $purchase = $purchases[0];

        $this->assertEquals(LoadSingleCustomPaymentBasic::AMOUNT, $purchase->getAmountTotal());
        $this->assertEquals(LoadSingleCustomPaymentBasic::AMOUNT_CURRENCY_ID, $purchase->getCurrency()->getId());
    }

    public function testSingleGacha()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic("article-Demo-".ArticleCategoryEnum::SINGLE_PAYMENT_ID."-1")]);

        $singleCustomPayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($singleCustomPayment, '123', null);

        $purchases = $this->em->getRepository("AppBundle:Purchase")->findAll();
        $purchasesNotifications = $this->em->getRepository("AppBundle:PurchaseNotification")->findAll();

        $this->assertCount(1, $purchases);
        $this->assertCount(1, $purchasesNotifications);
    }
}