<?php


namespace AppBundle\Tests\E2E\WolopaySDK;

use Wolopay\WolopayApi;

require_once __DIR__.'/../../../doc/examples/lib/src/WolopayApi.php';

class WolopayApiWrapper extends WolopayApi
{
    function __construct($clientId, $secret, $environmentUrl)
    {
        parent::__construct($clientId, $secret, false, true);
        $this->environmentUrl = $environmentUrl;
    }

} 