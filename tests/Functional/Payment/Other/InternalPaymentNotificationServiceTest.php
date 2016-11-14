<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class InternalPaymentNotificationServiceTest extends FunctionalTestCase
{
    /** @var \AppBundle\Payment\Other\InternalPaymentNotificationService */
    private $internalPaymentNotificationService;

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
        $this->internalPaymentNotificationService = $this->container->get('app.internal_payment_notification');
    }

    public function testBasicOk()
    {
        $url = $this->container->getParameter('domain_main'). $this->router->generate('internal_payment_notification_test');
        $this->internalPaymentNotificationService->businessActive = true;
        $this->internalPaymentNotificationService->execute($url, 3, 'NviaSMS', 'WOT_3123', CurrencyEnum::DOLLAR, '1232','app213');
    }

} 