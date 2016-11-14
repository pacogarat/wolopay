<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use AppBundle\Entity\App;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Payment\Event\NotificationFailedEvent;
use AppBundle\Service\EmailService;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Request;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;


class EmailServiceTest  extends \PHPUnit_Framework_TestCase
{

    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $mailer;
    /** @var EmailService  */
    private $emailService;


    public function setUp()
    {
        parent::setUp();
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->mailer= $this->getMockBuilder(\Swift_Mailer::class)->disableOriginalConstructor()->getMock();

        $this->emailService = new EmailService();
        $this->emailService->logger = $loggerMock;
        $this->emailService->em = $em;
        $this->emailService->emailApp = 'yolo@yolo.com';
        $this->emailService->mailer = $this->mailer;
    }

    public function testOnPaymentNotificationFailedCalledOnFirstError()
    {
        $this->mailer->expects($this->atLeastOnce())->method('send');

        $this->emailService->onPaymentNotificationFailed($this->getNotificationFailedEvent(1, 50));
    }

    public function testOnPaymentNotificationFailedCalledOnLastError()
    {
        $this->mailer->expects($this->atLeastOnce())->method('send');

        $this->emailService->onPaymentNotificationFailed($this->getNotificationFailedEvent(1, 50));
    }

    private function getNotificationFailedEvent($attempt, $maxAttempts)
    {
        $not = new PurchaseNotification();
        $not->setAttempts($attempt);

        $app = new App();
        $app
            ->setTechnicalEmail('client@yolo.com')
            ->setNotificationRetriesOnFailure($maxAttempts)
        ;

        $not->setApp($app);

        return new NotificationFailedEvent($not, new Request('GET', 'https://wo.com'), null, null, $attempt == $maxAttempts);
    }

} 