<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePaymentBasic;
use AppBundle\Entity\SinglePayment;
use AppBundle\Payment\Actions\PaymentDisputed;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PaymentDisputedTest extends FunctionalTestCase
{
    /** @var PaymentDisputed */
    private $postPayment;

    public function setUp()
    {
        parent::setUp();
        $this->postPayment = $this->container->get('shop.payment.dispute');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePaymentBasic()]);
        $singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->findAll()[0];
        $this->postPayment->execute($singlePayment);
    }

} 