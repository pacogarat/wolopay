<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class ArticleControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    //todo Future test verify purchase nPerclient, dont show article with offer

    public function testGetArticlesByCountryOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_article_get_articles_by_country', ['country'=> CountryEnum::USA]),
            [
                '_format' => 'json'
            ]
        );

//        echo $this->client->getResponse()->getContent();die;
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->article->id);
    }

    public function testGetArticlesByCountryOKAllFilter()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByAppIdAndCountryAndLevelCategoryAndStatus(
            $user->getApp()->getId(),
            [CountryEnum::USA],
            null,
            [LevelCategoryEnum::ROOKIE_ID]
        );

        $item = $appShopHasArticle[0]->getArticle()->getItem();

        $this->client->request('GET', $this->router->generate('api_article_get_articles_by_country',
                [
                    'country' => CountryEnum::USA,
                    'item_id' => $item->getId()
                ]
            ),
            [
                '_format' => 'json'
            ]
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->article->id);

        foreach ($response as $appShopHasArticle )
        {
            $article = $this->em->getRepository("AppBundle:Article")->find($appShopHasArticle->article->id);
            $this->assertEquals($item->getId(), $article->getItem()->getId());
        }


    }

    public function testGetArticlesByCountryXMLTranslationsOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_article_get_articles_by_country', [
                'country'=> CountryEnum::USA,
                '_format' => 'xml',
            ]
        ));

        $xml = simplexml_load_string($this->client->getResponse()->getContent());
//        echo $this->client->getResponse()->getContent();die;

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty(count($xml->entry->article[0]->name_label), count($this->container->getParameter('locale_available')));
    }

    public function testGetArticlesOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_article_get_articles'),
            [
                'transaction_id'  => $transacion->getId(),
                'country'         => CountryEnum::USA,
                'tab_category_id' => 'subscription',
                '_format'         => 'json'
            ]
        );
//        echo $this->client->getResponse()->getContent();die;
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->article->id);
    }

    public function testGetArticlesOKXml()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_article_get_articles', ['_format' => 'xml']),
            [
                'transaction_id' => $transacion->getId(),
                'country'        => CountryEnum::USA,
                'article_type'   => 'simple_payment',
            ]
        );

//        die($this->client->getResponse()->getContent());

        $response = simplexml_load_string($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->entry->article->id);
        $this->assertNotEmpty($response->entry->img);
    }

} 