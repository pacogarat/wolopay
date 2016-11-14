<?php

namespace AppBundle\Tests\Functional\Security;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;

class AccessWSSETest extends FunctionalTestCase
{
    private $url;

    public function setUp()
    {
        parent::setUp();
        $this->url = $this->router->generate('api_default_get_test');
        $this->loadAllFixtures();
    }

    public function testUnAuthorized()
    {
        $this->setHeaderWSSEInvalidToClientRequest();
        $this->client->request('GET', $this->url );

        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
        $this->assertEmpty($this->client->getResponse()->getContent());
    }

    public function testAuthorizedOK()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('GET', $this->url );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('ok', json_decode($this->client->getResponse()->getContent())->test);
    }

} 