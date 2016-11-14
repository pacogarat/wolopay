<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPurchaseBasic;
use AppBundle\Service\EmailService;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Request;

class EmailServiceTest extends FunctionalTestCase
{
    /** @var EmailService */
    private $emailService;

    public function setUp()
    {
        parent::setUp();
        $this->emailService = $this->container->get('app.emails');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $this->emailService->sendEmailGamerPaymentCompleted($purchase);
    }

    public function testBasicSubscriptionOk()
    {
        $this->loadAllFixtures([new LoadSubscriptionPurchaseBasic()]);
        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $this->emailService->sendEmailGamerPaymentCompleted($purchase);
    }

}