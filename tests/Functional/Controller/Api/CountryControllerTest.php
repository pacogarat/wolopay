<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Tests\Lib\FunctionalTestCase;

class CountryControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testGetCountriesOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);
        $this->client->request('GET', $this->router->generate('api_country_get_countries'),
            array(
                'transaction_id' => $transacion->getId(),
            )
        );

//        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertGreaterThan(1, count($response));
    }

    public function testGetOnlyOneCountryAvailableOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest('GalleGame');
        $transaction = $this->createTransaction($user);
        $this->client->request('GET', $this->router->generate('api_country_get_countries'),
            array(
                'transaction_id' => $transaction->getId(),
            )
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(1,$response);
        $this->assertEquals("España", $response[0]->name);
    }

} 