<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\Tests\Lib\FunctionalTestCase;


class TransactionInfoControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testGetPayMethodsOK()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);

        $this->setHeaderWSSEValidToClientRequest();

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $this->client->request('GET', $this->router->generate('api_transaction_get_transaction_info',
            [
                'transaction_id' => $purchase->getTransaction()->getId(),
            ])
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull($response->transaction);
        $this->assertCount(1, $response->payments);
    }

} 