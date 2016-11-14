<?php


namespace AppBundle\Tests\Functional\Controller\NviaPayMethods;


use AppBundle\Controller\PaymentHosted\NviaPayMethods\FortunoSMSController;
use AppBundle\DataFixtures\ORM\LoadSMS;
use AppBundle\Tests\Lib\FunctionalTestCase;

class FortunoSMSControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testIpnOK()
    {
        $params = [
            'message' => 'WOLOPAY ASD asd asd ',
            'sender'    => '915426688',
            'country'   => 'ES',
            'price'     => 2,
            'price_wo_vat' => 1.5,
            'currency'  => 'EUR',
            'service_id' => 'f7fa12b381d290e268f99e382578d64a',
            'message_id' => '333', // unique
            'keyword' => 'WOLOPAY',
            'shortcode' => LoadSMS::SHORT_NUMBER_3,
            'operator' => 'Movistar',
            'billing_type' => 'MO',
            'status' => 'OK'
        ];

        ksort($params);

        $str='';

        foreach ($params as $k=>$v)
            $str.="$k=$v";

        $str.=FortunoSMSController::SECRET;

        $params['sig']=md5($str);

        $this->exeCacheWarmup();
        $this->client->request('GET', $this->router->generate('fortuno_sms_ipn', $params));

        $content = $this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($content);
    }

} 