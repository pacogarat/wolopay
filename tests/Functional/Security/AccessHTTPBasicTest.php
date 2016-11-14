<?php

namespace AppBundle\Tests\Functional\Security;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;

class AccessHTTPBasicTest extends FunctionalTestCase
{
    private $url;

    public function setUp()
    {
        parent::setUp();
        $this->url = $this->router->generate('api_default_get_test').'.json';
        $this->loadAllFixtures();
    }

    public function testUnAuthorized()
    {
        $this->client->request('GET', $this->url, [], [], [
                'PHP_AUTH_USER' => 'username',
                'PHP_AUTH_PW'   => 'pa$$word',
            ] );

        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
        $this->assertEmpty($this->client->getResponse()->getContent());
    }

    public function testAuthorizedOK()
    {
        $appC = $this->getApp()->getAppApiHasCredential();
        $this->client->request('GET', $this->url, [], [], [
                'HTTP_PHP_AUTH_USER' => $appC->getCodeKey(),
                'HTTP_PHP_AUTH_PW'   => $appC->getSecretKey(),
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//        die($this->client->getResponse()->getContent());
        $this->assertEquals('ok', json_decode($this->client->getResponse()->getContent())->test);
    }

} 