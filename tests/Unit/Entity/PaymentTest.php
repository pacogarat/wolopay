<?php


namespace AppBundle\Tests\Unit\Entity;


use AppBundle\Entity\SinglePayment;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\SubscriptionEventuality;
use AppBundle\Entity\SubscriptionEventualityPayment;

class PaymentTest extends \PHPUnit_Framework_TestCase
{

    public function testGetPaymentProcessFromSingle()
    {
        $single = new SinglePayment();

        $this->assertTrue($single->getPaymentProcess() === $single);
    }

    public function testGetPaymentProcessFromEventualityPayment()
    {
        $sub = new Subscription();
        $ev  = new SubscriptionEventuality($sub);
        $evp = new SubscriptionEventualityPayment($ev);

        $this->assertTrue($evp->getPaymentProcess() === $sub);
    }

} 