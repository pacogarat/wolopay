<?php

namespace AppBundle\Tests\Functional\Controller\ClientAdmin;


use AppBundle\Tests\Lib\FunctionalTestCase;


class CredentialsControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    public function test200OK()
    {
        $app=$this->getApp();
        $this->logIn();
        $this->client->request('GET', $this->router->generate('admin_credentials', ['app'=>$app->getId()]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

} 