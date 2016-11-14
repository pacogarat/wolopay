<?php


namespace AppBundle\Tests\Functional\Command;


use AppBundle\Command\BusinessIntelligentCommand;
use AppBundle\DataFixtures\Specific\LoadSingleCustomPurchaseBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\DataFixtures\Specific\LoadSinglePurchaseMultipleArticles;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPurchaseBasic;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPurchaseWithOffer;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\SinglePayment;
use AppBundle\Tests\Lib\FunctionalTestCase;


class FakeBusinessIntelligentCommand extends BusinessIntelligentCommand
{
    /**
     * @inheritdoc
     */
    public function createMessagesOnPurchase($payment, $paymentProcess, $paymentDetail, $transaction, $msg = null)
    {
        return parent::createMessagesOnPurchase($payment, $paymentProcess, $paymentDetail, $transaction, $msg);
    }

    /**
     * @inheritdoc
     */
    public function createMessageOnExtraCost($newPurchase, $oldPurchaseReference, $oldPaymentProcess, $oldPayment)
    {
        return parent::createMessageOnExtraCost( $newPurchase, $oldPurchaseReference, $oldPaymentProcess, $oldPayment);
    }
}

class BusinessIntelligentCommandTest extends FunctionalTestCase
{
    /** @var FakeBusinessIntelligentCommand */
    private $businnes;

    public function setUp()
    {
        parent::setUp();
        $this->businnes = new FakeBusinessIntelligentCommand(
            $this->em,
            $this->container->get('logger'),
            true,
            $this->container->get('common.currency'),
            '',
            '',
            $this->container->get('common.ip_info'),
            ''
        );
    }

    public function testSinglePurchaseReplaceAll()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $purchase->getPayment(),
            $purchase->getPayment()->getPaymentDetail(),
            $purchase->getPayment()->getPaymentDetail()->getTransaction()
        );

        foreach ($msg as $ms)
        {
            $this->assertNotContains('{{' , $ms);
        }
    }

    public function testSubscriptionPurchaseReplaceAll()
    {
        $this->loadAllFixtures([new LoadSubscriptionPurchaseBasic()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];

        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $subscription,
            $subscription->getPaymentDetail(),
            $subscription->getPaymentDetail()->getTransaction()
        );

//        echo $msg;die;

        foreach ($msg as $ms)
            $this->assertNotContains('{{' , $ms);
    }

    public function testSubscriptionPurchaseWithOfferReplaceAll()
    {
        $this->loadAllFixtures([new LoadSubscriptionPurchaseWithOffer()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];

        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $subscription,
            $subscription->getPaymentDetail(),
            $subscription->getPaymentDetail()->getTransaction()
        );

//                echo $msg;die;

        foreach ($msg as $ms)
            $this->assertNotContains('{{' , $ms);
    }

    public function testExtraCost()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);

        $oldPurchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];
        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];

        $newPurchase = new Purchase();
        $newPurchase
            ->setCurrency(new Currency(CurrencyEnum::DOLLAR))
            ->setCountry(new Country(CountryEnum::SPAIN))
            ->setAmountTotal(-10)
            ->setAmountGame(-10)
            ->setAmountWolo(0)
            ->setAmountTax(0)
            ->setAmountBeforeTaxes(0)
        ;

        $msg = $this->businnes->createMessageOnExtraCost(
            $newPurchase,
            $oldPurchase,
            $singlePayment,
            $singlePayment
        );

        $expected = 'WOLO2|RPAYMENT|'.$oldPurchase->getTransactionId().'|'.$newPurchase->getId().'|';
        $this->assertEquals(substr($msg, 0, strlen($expected) ), $expected);

        $this->assertNotContains('{{' ,$msg);

    }


    public function testMultipleArticles()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseMultipleArticles()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $purchase->getPayment(),
            $purchase->getPayment()->getPaymentDetail(),
            $purchase->getPayment()->getPaymentDetail()->getTransaction()
        );

        $this->assertTrue(is_array($msg));

        $old = '';
        foreach ($msg as $message)
        {
            $this->assertNotContains('{{' , $message);
            $this->assertNotEquals($old, $msg);
            $old = $message;
        }
    }

    public function testSinglePurchaseMultipleArticles()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseMultipleArticles()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];
        $count = 1; // +1 because first msg is COMPRA
        foreach ($purchase->getPayment()->getPaymentDetail()->getPaymentDetailHasArticles() as $pdha)
        {
            $count += $pdha->getArticlesQuantity();
        }
        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $purchase->getPayment(),
            $purchase->getPayment()->getPaymentDetail(),
            $purchase->getPayment()->getPaymentDetail()->getTransaction()
        );

        foreach ($msg as $index => $ms)
        {
            if ($index == 0)
                $this->assertContains('|COMPRA|', $ms);
            else
                $this->assertContains('|DETALLE|', $ms);

            $this->assertNotContains('{{' , $ms);
        }

        $this->assertCount($count, $msg);
    }

    public function testSinglePurchaseCustom()
    {
        $this->loadAllFixtures([new LoadSingleCustomPurchaseBasic()]);

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $msg = $this->businnes->createMessagesOnPurchase(
            $purchase->getPayment(),
            $purchase->getPayment(),
            $purchase->getPayment()->getPaymentDetail(),
            $purchase->getPayment()->getPaymentDetail()->getTransaction()
        );

        $this->assertContains('|COMPRA|', $msg);
    }

} 