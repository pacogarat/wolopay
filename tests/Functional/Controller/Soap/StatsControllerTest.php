<?php


namespace AppBundle\Tests\Functional\Controller\Soap;


use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\Tests\Lib\FunctionalTestCase;

class StatsControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
    }

    public function testOK()
    {

        // loading from dev because DATE_FORMAT in sql lite doesn't exist
        $client = new \SoapClient($this->container->getParameter('domain_main').'/ws/StatsApi?WSDL', array('cache_wsdl' => WSDL_CACHE_NONE));
        $headers = [
            new \SoapHeader($this->container->getParameter('domain_main').'/ws/StatsApi', 'apiUser', 'demo'),
            new \SoapHeader($this->container->getParameter('domain_main').'/ws/StatsApi', 'apiSecret', 'demo'),
        ];
        $client->__setSoapHeaders($headers);

        $client->purchases("2002-05-30T09:00:00","2022-05-30T09:00:00", 'months');
        $client->purchasesByCountry("2002-05-30T09:00:00","2022-05-30T09:00:00", 'months');
        $client->transactions("2002-05-30T09:00:00","2022-05-30T09:00:00", 'months');
        $client->uniqueUsers("2002-05-30T09:00:00","2022-05-30T09:00:00", 'months');
        $client->providers("2002-05-30T09:00:00","2022-05-30T09:00:00");
        $client->articles("2002-05-30T09:00:00","2022-05-30T09:00:00");

    }

} 