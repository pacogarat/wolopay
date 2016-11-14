<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;


use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Service\CurrencyService;


class CurrencyServiceTest  extends \PHPUnit_Framework_TestCase
{

    private $emMock;

    public function setUp()
    {
        $this->emMock = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testDummyOK()
    {
        $obj = new Currency(CurrencyEnum::EURO);

        $currencyService = new CurrencyService($this->emMock);
        $result = $currencyService->getExchange(39.9, $obj, CurrencyEnum::EURO);

        $this->assertEquals(39.9, $result);
    }

    public function testSimpleOK()
    {
        $obj = new Currency(CurrencyEnum::EURO);
        $obj->setExchangeRateUsd(0.9);

        $obj2 = new Currency(CurrencyEnum::DOLLAR);

        $mock = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($obj2));

        $this->emMock->expects($this->any())->method('getRepository')->will($this->returnValue($mock));

        $currencyService = new CurrencyService($this->emMock);
        $result = $currencyService->getExchange(39.9, $obj, CurrencyEnum::DOLLAR);

        $this->assertEquals(39.9*0.9, $result);
    }

    public function testHardOK()
    {
        $obj = new Currency(CurrencyEnum::ARGENTINE_PESO);
        $obj->setExchangeRateEur(0.9);

        $obj2 = new Currency(CurrencyEnum::BULGARIAN_LEV);
        $obj2->setExchangeRateEur(0.2);

        $mock = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())
            ->method('find')
            ->will($this->returnValue($obj2));

        $this->emMock->expects($this->any())->method('getRepository')->will($this->returnValue($mock));

        $currencyService = new CurrencyService($this->emMock);
        $result = $currencyService->getExchange(39.9, $obj, CurrencyEnum::BULGARIAN_LEV);

        $this->assertEquals(179.55, $result);
    }

} 