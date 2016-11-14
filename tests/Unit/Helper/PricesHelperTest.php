<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;


use AppBundle\Helper\PricesHelper;


class PricesHelperTest  extends \PHPUnit_Framework_TestCase
{

    public function testDontCrash()
    {
        PricesHelper::prettyPrice(999999999.66666666666666666666, PricesHelper::FORMAT_B);
        PricesHelper::prettyPrice(999999999.66666666666666666666, PricesHelper::FORMAT_B);
        PricesHelper::prettyPrice(555555555555555555555555555.6666666666666, PricesHelper::FORMAT_A);
        PricesHelper::prettyPrice(222222222222222222222222222.33, PricesHelper::FORMAT_INTEGER);
    }

    public function testVerifyCrash()
    {
        $this->assertEquals(4.95, PricesHelper::prettyPrice(5,PricesHelper::FORMAT_A, 2));
        $this->assertEquals(5.99, PricesHelper::prettyPrice(6, PricesHelper::FORMAT_B));
        $this->assertEquals(5, PricesHelper::prettyPrice(5.333333, PricesHelper::FORMAT_INTEGER));

    }

} 