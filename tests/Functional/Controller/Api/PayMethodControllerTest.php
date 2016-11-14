<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class PayMethodControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testGetPayMethodsOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $article = $this->em->getRepository("AppBundle:Article")->findOneBy(array('itemsQuantity' => 100));

        $this->client->request('GET', $this->router->generate('api_pay_method_get_pay_methods'),
            [
                'transaction_id' => $transacion->getId(),
                'country' => CountryEnum::USA,
                'article_id' => $article->getId()
            ]
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0,$response);
    }

    public function testGetPayMethodsAllParamsOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $article = $this->em->getRepository("AppBundle:Article")->findOneBy(array('itemsQuantity' => 100));

        $this->client->request('GET', $this->router->generate('api_pay_method_get_pay_methods'),
            [
                'transaction_id' => $transacion->getId(),
                'country' => CountryEnum::USA,
                'tab_category_id' => 'subscription',
            ]
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

} 