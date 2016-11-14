<?php

namespace AppBundle\Tests\Functional\Controller\ClientAdmin;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;


class DefaultControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    public function test200OK()
    {
        $this->logIn();
        $this->client->request('GET', $this->router->generate('admin_home'));

//        die($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

} 