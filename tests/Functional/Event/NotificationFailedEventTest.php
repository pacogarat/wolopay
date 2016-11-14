<?php
/**
 * Created by dmorillo. 20/08/2015
 */

namespace AppBundle\Tests\Functional\Event;


use AppBundle\Command\AppNotificationCommand;
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
use AppBundle\Payment\Event\NotificationFailedEvent;
use AppBundle\Service\EmailService;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Guzzle\Common\Collection;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

class NotificationFailedEventTest extends FunctionalTestCase {

    private $routeToNotificate;

    /** @var  AppNotificationCommand */
    private $serviceNotification;

    /** @var  EmailService */
    private $serviceEmail;

    /** @var ContainerAwareEventDispatcher event_dispatcher */
    public $eventDispatcher;


    public function setUp()
    {
        parent::setUp();
        $this->routeToNotificate = $this->getDomaintoTest(). $this->router->generate('payment_pg_notification_test');
        $this->serviceNotification = $this->container->get('command.shop.app_notification.send');
        $this->serviceEmail = $this->container->get('app.emails');
        $this->eventDispatcher = $this->container->get('event_dispatcher');
    }

    public function testSimpleOK()
    {
        $notification = $this->prepareNotification(false, 5, '', "http://urlmala.com/path");
        $todoRequest = $this->mockToNotificationResponse();

        $this->eventDispatcher->dispatch(
            NotificationFailedEvent::EVENT,
            new NotificationFailedEvent($notification,$todoRequest)
        );

        return true;
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

        $request
            ->method('getUrl')
            ->willReturn("http://urlmala.com/path");
        $params = new Collection(array("a"=>1, "b"=>"b") );
        $request
            ->method('getParams')
            ->willReturn($params);


        $headers = "xsee auth, etc...=vlaues...";
        $request
            ->method('getRawHeaders')
            ->willReturn($headers);

        $client
            ->expects($this->any())
            ->method('post')
            ->will($this->returnValue($request))
        ;

        $this->serviceNotification->guzzle = $client;
        return $request;
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
            ->setTechnicalEmail('dmorillo@nviasms.com')
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



}