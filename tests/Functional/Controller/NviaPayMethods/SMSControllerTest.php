<?php


namespace AppBundle\Tests\Functional\Controller\NviaPayMethods;


use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class SMSControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testIpnOK()
    {
        $this->client->request('POST', $this->router->generate('sms_ipn'),
            [
                'operadora'  => 'YO',
                'texto'      => 'WOLOPAY',
                'movil'      => '1337',
                'country'    => CountryEnum::SPAIN,
                'host'       => '7755',
                'id_mensaje' => '123'
            ]
        );

//        die($this->client->getResponse()->getContent());
        $this->exeCacheWarmup();
        $content = $this->client->getResponse()->getContent();

        $this->assertEquals('OK', substr($content, 0, 2));
    }

    public function testIpnSkipBlankSpacesOK()
    {
        $this->client->request('POST', $this->router->generate('sms_ipn'),
            [
                'operadora'  => 'YO',
                'texto'      => 'WOLOPAY ASDASDASDAS ASD AS D',
                'movil'      => '1337',
                'country'    => CountryEnum::SPAIN,
                'host'       => '7755',
                'id_mensaje' => '123'
            ]
        );

        //        die($this->client->getResponse()->getContent());
        $this->exeCacheWarmup();
        $content = $this->client->getResponse()->getContent();

        $this->assertEquals('OK', substr($content, 0, 2));
    }

} 