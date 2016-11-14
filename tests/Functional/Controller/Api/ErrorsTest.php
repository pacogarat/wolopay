<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;


class ErrorsTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function test404KO()
    {
        $this->client->request('GET', '/api/v1/route/doesnt/exist');

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    public function testParamConverter404KO()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('GET',
            $this->router->generate('api_default_get_test_param_converter', array('country' => 'NOT EXIST'))
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

} 