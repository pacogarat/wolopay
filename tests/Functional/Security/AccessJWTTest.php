<?php

namespace AppBundle\Tests\Functional\Security;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;

class AccessJWTTest extends FunctionalTestCase
{
    private $url;

    public function setUp()
    {
        parent::setUp();
        $this->url = $this->router->generate('api_default_get_test');
        $this->loadAllFixtures();
    }

//    Deactivate login with JWT because WSSE is more secure
//
//    public function testGetTokenKO()
//    {
//        $this->requestToGetToken([ 'apiCode' => 'no', 'apiSecret' => 'trolo' ]);
//
//        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
//    }

//    public function testGetTokenOK()
//    {
//        $credential = $this->getCredentialsValidApiUser();
//
//        $this->requestToGetToken([ 'apiCode' => $credential->getCodeKey(), 'apiSecret' => $credential->getSecretKey()]);
//
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//
//        $this->assertNotEmpty(json_decode($this->client->getResponse()->getContent())->token);
//    }

    private function requestToGetToken(array $credentials)
    {
        return $this->client->request('POST', $this->router->generate('api_security_post_jwtoken'), $credentials);
    }

    public function testUnAuthorized()
    {
        $this->setJWTokenInvalidToClientRequest();
        $this->client->request('GET', $this->url );

        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedOK()
    {
        $this->setJWTokenValidToClientRequest();

        $this->client->request('GET', $this->url );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('ok', json_decode($this->client->getResponse()->getContent())->test);
    }

} 