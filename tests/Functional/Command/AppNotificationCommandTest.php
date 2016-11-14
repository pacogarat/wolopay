<?php

namespace AppBundle\Tests\Functional\Command;


use AppBundle\Command\AppNotificationCommand;
use AppBundle\DataFixtures\Specific\LoadPurchaseNotificationBasic;
use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\PayCategory;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\Provider;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Guzzle\Http\Exception\CurlException;

/**
 * Because need a environment to notify
 * test duration 2.12 min, test need modifications in a future
 */
class AppNotificationCommandTest extends FunctionalTestCase
{
    /** @var  AppNotificationCommand */
    private $serviceNotification;

    private $routeToNotificate;

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->serviceNotification = $this->container->get('command.shop.app_notification.send');
        $this->routeToNotificate = $this->getDomaintoTest(). $this->router->generate('payment_pg_notification_test');
    }

    /**
     * @group E2E
     */
    public function testSimpleOK()
    {
        // if this test fail verify folder permissions
        $notification = $this->prepareNotification(false, 5, '', $this->routeToNotificate);

        $this->mockToNotificationResponse();
        $this->serviceNotification->sendNotifications([$notification]);

        $this->assertEquals(1, $notification->getAttempts());
        $this->assertEquals(true, $notification->getWasReceived());
        $result = $notification->getRequestExact();
        $this->assertEquals(200, $result['response']['http_code']);

        $this->assertContains($this->router->generate('payment_pg_notification_test'), $notification->getRequestExact()['request']['url']);
    }

    public function testExceptionUnknownKO()
    {
        $notification = $this->prepareNotification(false, 5, '', $this->getDomaintoTest(). '/tutututu');

        $request = $this->mockToNotificationResponse();
        $request
            ->expects($this->any())
            ->method('send')
            ->will($this->throwException(new CurlException('fail', 408)))
        ;

        $this->serviceNotification->sendNotifications([$notification]);

        $this->assertEquals(1, $notification->getAttempts());
        $this->assertEquals(false, $notification->getWasReceived());
        $result = $notification->getRequestExact();
        $this->assertEquals(520, $result['response']['http_code']);
        $this->assertEquals(520, $result['response']['http_code']);
    }

    public function testSubscriptionOK()
    {
        $url = $this->router->generate('payment_pg_notification_test'). '?tutu=tu';
        $notification = $this->prepareNotification(true, 5, '', '', $this->getDomaintoTest(). $url);
        $this->mockToNotificationResponse();
        $this->serviceNotification->sendNotifications([$notification]);

        $this->assertEquals(1, $notification->getAttempts());
        $this->assertEquals(true, $notification->getWasReceived());
        $result = $notification->getRequestExact();
        $this->assertEquals(200, $result['response']['http_code']);
        $this->assertContains($url, $result['request']['url']);
        $this->assertEquals(1, substr_count($result['request']['url'],'?'));
    }

    public function testExceptionBadRequestMaxNotificationsKO()
    {
        $this->loadAllFixtures([new LoadPurchaseNotificationBasic()]);

        $purchaseNotification = $this->em->getRepository("AppBundle:PurchaseNotification")->findAll()[0];
        $purchaseNotification->setAttempts($purchaseNotification->getApp()->getNotificationRetriesOnFailure()-1);

        $request = $this->mockToNotificationResponse();
        $request
            ->expects($this->any())
            ->method('send')
            ->will($this->throwException(new CurlException('fail', 408)))
        ;

        $this->serviceNotification->sendNotifications([$purchaseNotification]);

        $this->assertEquals(false, $purchaseNotification->getWasReceived());

        $this->assertGreaterThan(0, count($this->em->getRepository("AppBundle:ClientUserNotification")->findAll()));
    }

    /**
     * @param $isSubscription
     * @param $amount
     * @param $transSuffix
     * @param $urlNoti
     * @param string $urlSubNoti
     * @return PurchaseNotification
     */
    private function prepareNotification($isSubscription, $amount, $transSuffix, $urlNoti, $urlSubNoti='')
    {
        $app = new App();
        $app
            ->setUrlNotificationPayment($urlNoti)
            ->setUrlNotificationSubscription($urlSubNoti)
            ->setAppApiHasCredential(new AppApiCredentials($app))
        ;

        $article = new Article();
        $item = $this->getMockBuilder('\\AppBundle\\Entity\\Item')
            ->disableOriginalConstructor()
            ->getMock();

        $item->setName('yolo');

        $item
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('itemId'))
        ;

        $article->setItem($item);

        $transaction = $this->getMockBuilder('\\AppBundle\\Entity\\Transaction')
            ->disableOriginalConstructor()
            ->getMock();

        $transaction
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('123456789'))
        ;

        $transaction
            ->expects($this->any())
            ->method('getCountryDetected')
            ->will($this->returnValue(new Country('ES')))
        ;

        $gamer = $this->getMockBuilder('\\AppBundle\\Entity\\Gamer')
            ->disableOriginalConstructor()
            ->getMock();

        $gamer
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('555'));

        $payment = new Payment();
        $paymentDetail = new PaymentDetail();
        $paymentDetail->setPayMethod(new PayMethod());

        $purchase = new Purchase();
        $pC=new PayCategory(1);
        $pC->setName('Paycategory');

        $pm = new PayMethod();
        $pm
            ->setPayCategory($pC)
        ;

        $purchase
            ->setApp($app)
            ->setTransaction($transaction)
            ->setGamer($gamer)
            ->setPayMethod($pm)
            ->setCurrency(new Currency(1))
            ->setPayment($payment)
            ->setCountry(new \AppBundle\Entity\Country(CountryEnum::NORWAY))
            ->setProvider(new Provider())
        ;


        $payment->setPaymentDetail($paymentDetail);
        $pdha = new PaymentDetailHasArticles();
        $pdha->setArticle($article);

        $notification = new PurchaseNotification();
        $notification
            ->setApp($app)
            ->setIsSubscription($isSubscription)
            ->setAmount($amount)
            ->setAttempts(0)
            ->setIsReadyToNotify(true)
            ->setPaymentDetailHasArticle($pdha)
            ->setTransactionSuffix($transSuffix)
            ->addPurchase($purchase)
        ;

        $paymentDetail
            ->setTransaction($transaction)
            ->addPaymentDetailHasArticle($pdha);

        return $notification;
    }

    private function mockToNotificationResponse($return=200)
    {
        $client = $this->getMockBuilder('\Guzzle\Service\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $request = $this->getMockBuilder('\Guzzle\Http\Message\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $request
            ->expects($this->any())
            ->method('send')
            ->will($this->returnValue(new \Guzzle\Http\Message\Response($return)));

        $client
            ->expects($this->any())
            ->method('post')
            ->will($this->returnValue($request))
        ;

        $this->serviceNotification->guzzle = $client;
        return $request;
    }

} 