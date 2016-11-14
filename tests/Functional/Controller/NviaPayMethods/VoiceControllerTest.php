<?php


namespace AppBundle\Tests\Functional\Controller\NviaPayMethods;


use AppBundle\DataFixtures\ORM\LoadVoice;
use AppBundle\Tests\Lib\FunctionalTestCase;

class VoiceControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testIpnOK()
    {

        $this->client->request('POST', $this->router->generate('voice_ipn'),
            [
                'action'  => 'start',
                'llamado' => LoadVoice::NUMBER_1,
            ]
        );

        $code = $this->client->getResponse()->getContent();


        $this->client->request('POST', $this->router->generate('voice_ipn'),
            [
                'action'  => 'end',
                'llamado' => LoadVoice::NUMBER_1,
                'numero'  => $code,
            ]
        );

        $content = $this->client->getResponse()->getContent();

        $this->assertEquals('OK', substr($content, 0, 2));
    }

} 