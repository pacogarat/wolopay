<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use Wolopay\WolopayApi;

require_once __DIR__.'/../../../doc/examples/lib/src/WolopayApi.php';

class WolopaySDKTest  extends \PHPUnit_Framework_TestCase
{

    public function testBlacklistedIP()
    {
        $this->assertEquals('turulato 3  coins', WolopayApi::replaceNumbersOfItems('turulato {[{ number }]}  coins', 3));
        $this->assertEquals('turulato 3  coins', WolopayApi::replaceNumbersOfItems('turulato {[{number }]}  coins', 3));
        $this->assertEquals('turulato 3  coins', WolopayApi::replaceNumbersOfItems('turulato {[{ number}]}  coins', 3));
        $this->assertEquals('turulato 3  coins', WolopayApi::replaceNumbersOfItems('turulato {[{number}]}  coins', 3));
    }

} 