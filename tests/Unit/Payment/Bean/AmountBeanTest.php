<?php


namespace AppBundle\Tests\Unit\Payment\Bean;


use AppBundle\Entity\Currency;
use AppBundle\Payment\Bean\AmountBean;

class AmountBeanTest extends \PHPUnit_Framework_TestCase
{
    public function testNothing()
    {
        $amountBean= new AmountBean();
    }

    public function testCalculate0()
    {
        $amountBean= new AmountBean(0, new Currency('EUR'), true, 0, 0, 0);

        $this->assertEquals(0, $amountBean->amount);
        $this->assertEquals(0, $amountBean->exchangeEUR);
        $this->assertEquals(0, $amountBean->exchangeGBP);
        $this->assertEquals(0, $amountBean->exchangeUSD);
    }

    public function testCalculateOk()
    {
        $amountBean= new AmountBean(2, new Currency('EUR'), true, 2, 4, 1);

        $this->assertEquals(2, $amountBean->amount);
        $this->assertEquals(1, $amountBean->exchangeEUR);
        $this->assertEquals(2, $amountBean->exchangeUSD);
        $this->assertEquals(0.5, $amountBean->exchangeGBP);
    }


    public function testCalculateOkOpt()
    {
        $amountBean= new AmountBean(2, new Currency('EUR'), false, 2, 4, 1);

        $this->assertEquals(2, $amountBean->amount);
        $this->assertEquals(2, $amountBean->exchangeEUR);
        $this->assertEquals(4, $amountBean->exchangeUSD);
        $this->assertEquals(1, $amountBean->exchangeGBP);
    }

} 