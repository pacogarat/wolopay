<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class TransactionVirtualCurrencyControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }


    public function testVirtualCurrencyExchangeOk()
    {
        $this->setHeaderWSSEValidToClientRequest();
        $article = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($this->getApp()->getId())[0];
        $countryId = CountryEnum::SPAIN;
        $externalGamerId = 'user';

        $this->client->request('POST', $this->router->generate('api_transaction_post_virtual_currency_exchange'),
            array(
                'gamer_id'   => $externalGamerId,
                'gamer_level'=> 5,
                'article_id' => $article->getId(),
                'country'    => $countryId
            )
        );

//                die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $this->assertEquals($purchase->getGamer()->getGamerExternalId(), $externalGamerId);
        $this->assertEquals($purchase->getCountry()->getId(), $countryId);
        $this->assertGreaterThan(0, $purchase->getAmountTotal());
        $this->assertNotNull($response->id);
    }

    public function testVirtualCurrencyExchangeWithCountryOtherOk()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $article = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($this->getApp()->getId())[0];
        $countryId = CountryEnum::POLAND;
        $externalGamerId = 'user';

        $this->client->request('POST', $this->router->generate('api_transaction_post_virtual_currency_exchange'),
            array(
                'gamer_id'   => $externalGamerId,
                'gamer_level'=> 5,
                'article_id' => $article->getId(),
                'country'    => $countryId
            )
        );

//                        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $purchase = $this->em->getRepository("AppBundle:Purchase")->findAll()[0];

        $this->assertEquals($purchase->getGamer()->getGamerExternalId(), $externalGamerId);
        $this->assertEquals($purchase->getCountryConfigured()->getId(), CountryEnum::OTHER);
        $this->assertGreaterThan(0, $purchase->getAmountTotal());
        $this->assertNotNull($response->id);
    }

    public function virtualCurrencyTestParameterOkProvider()
    {
        return array(
            array(null, false),
            array(0, false),
            array(1, true),
        );
    }

    /**
     * @dataProvider virtualCurrencyTestParameterOkProvider
     */
    public function testVirtualCurrencyTestParameterOk($testValue, $result)
    {
        $this->setHeaderWSSEValidToClientRequest();
        $article = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($this->getApp()->getId())[0];
        $countryId = CountryEnum::SPAIN;
        $externalGamerId = 'user';

        $this->client->request('POST', $this->router->generate('api_transaction_post_virtual_currency_exchange'),
            array(
                'gamer_id'   => $externalGamerId,
                'gamer_level'=> 5,
                'article_id' => $article->getId(),
                'country'    => $countryId,
                'test'       => $testValue
            )
        );

//        if ($testValue === null)
//            die($this->client->getResponse()->getContent());
//        echo $this->client->getResponse()->getContent();

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $transaction = $this->em->getRepository("AppBundle:Transaction")->findAll()[0];

        $this->assertEquals($transaction->getTest(), $result);
    }


} 