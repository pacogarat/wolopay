<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Helper\UtilHelper;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Sluggable\Fixture\Article;

class TransactionControllerTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testGetTransactionOK()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction'),
            array('gamer_id' => 'DEMO_54292ddf7a7bf', 'gamer_level' => 1)
        );

//        die($this->client->getResponse()->getContent()." ".$this->client->getResponse()->getStatusCode());

        $response = json_decode($this->client->getResponse()->getContent());

        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('GET',
            $this->router->generate('api_transaction_get_transaction', ['transaction_id'=>$response->id])
        );

//        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->url);

        $this->client->request('GET', $this->router->generate('shop_index', ['transaction_id'=>$response->id]));
//                die($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());


    }

    public function testHaventArticlesForThisTransactionKO()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        // remove other
        $credentials->getApp()->getCountries()->removeElement($this->em->getRepository("AppBundle:Country")->find(CountryEnum::OTHER));
        $this->em->flush();

        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction', []),
            array('gamer_id' => 'DEMO_54292ddf7a7bf', 'gamer_level' => 1, 'countries' => CountryEnum::ZIMBABWE)
        );

//        die($this->client->getResponse()->getContent()." ".$this->client->getResponse()->getStatusCode());

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testGetUrlIframeAndWorkOKAllParams()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        $countries  = $this->em->getRepository("AppBundle:Country")->findAll();
        $payMethods = $this->em->getRepository("AppBundle:PayMethod")->findAll();
        $appTabs    = $this->em->getRepository("AppBundle:AppTab")->findAll();
        $theme      = $this->em->getRepository("AppBundle:ShopCss")->findAll()[0];
        $articles = $this->em->getRepository("AppBundle:Article")->findByApp($credentials->getApp()->getId());
        /** @var Article $selectedArticleId */
        $selectedArticleId = $articles[0];
        $return = 'http://asdasdas/da/sd/asd';
        $custom_param = urlencode('return&ADS=3value&a=sd&as=d');
        $fixedCountry= 1;
        $defaultLanguage = LanguageEnum::SPANISH;
        $tutorialEnabled = 0;
        $test = 1;
        $urlNotification = 'http://localhost/wihi';

        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction', []),
            array(
                'gamer_id'            => 'DEMO_54292ddf7a7bf',
                'gamer_level'         => 1,
                'return'              => $return,
                'custom_param'        => $custom_param,
                'pay_methods'         => UtilHelper::parseIdEntitiesToCSV($payMethods),
                'selected_article_id' => $selectedArticleId->getId(),
                'articles'            => UtilHelper::parseIdEntitiesToCSV($articles),
                'theme'               => $theme->getName(),
                'tab_categories'      => UtilHelper::parseIdEntitiesToCSV($appTabs, '', 'name_unique'),
                'fixed_country'       => $fixedCountry,
                'countries'           => UtilHelper::parseIdEntitiesToCSV($countries),
                'default_language'    => $defaultLanguage,
                'tutorial_enabled'    => $tutorialEnabled,
                'gamer_email'         => $email = 'itsme@mario.com',
                'test'                => $test,
                'url_notification'    => $urlNotification
            )
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $transaction = $this->em->getRepository("AppBundle:Transaction")->find($response->id);
        $this->em->refresh($transaction);

        $this->assertEquals($selectedArticleId->getId(), $transaction->getSelectedArticle()->getId());
        $this->assertEquals($transaction->getReturn(), $return);
        $this->assertEquals($transaction->getCustomParam(), $custom_param);
        $this->assertTrue($transaction->getFixedCountry() == 1);
        $this->assertEquals($transaction->getLanguageDefault()->getId(), $defaultLanguage);
        $this->assertEquals($transaction->getCss()->getId(), $theme->getId());

        $this->assertEquals($transaction->getTutorialEnabled(), $tutorialEnabled==1);
        $this->assertEmpty(array_diff( UtilHelper::getIdsArrayFromObjects($transaction->getCountriesAvailable()), UtilHelper::getIdsArrayFromObjects($countries)));
        $this->assertEmpty(array_diff( UtilHelper::getIdsArrayFromObjects($transaction->getPayMethodsAvailable()), UtilHelper::getIdsArrayFromObjects($payMethods)));
        $this->assertEmpty(array_diff( UtilHelper::getIdsArrayFromObjects($transaction->getAppTabsAvailable()), UtilHelper::getIdsArrayFromObjects($appTabs)));
        $this->assertEmpty(array_diff( UtilHelper::getIdsArrayFromObjects($transaction->getArticlesAvailable()), UtilHelper::getIdsArrayFromObjects($articles)));
        $this->assertEquals($transaction->getGamer()->getEmail(), $email);
        $this->assertEquals($transaction->getUrlNotification(), $urlNotification);
        $this->assertTrue($transaction->getTest(), $test);

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->url);
//        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->client->request('GET', $this->router->generate('shop_index', ['transaction_id' => $response->id]));
//        die($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testGetUrlIframeAndWorkOK()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction', []),
            array('gamer_id' => 'DEMO_54292ddf7a7bf', 'gamer_level' => 1)
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->url);

        $this->client->request('GET', $this->router->generate('shop_index', ['transaction_id'=>$response->id]));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

    public function testGetUrlIframeHaventShopForLevelKO()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction'),
            array('gamer_id' => '3', 'gamer_level' => 99999999999999)
        );
//        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testGetUrlIframeWorkTestXMLOK()
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction', array('_format' => 'xml')),
            array('gamer_id' => '3', 'gamer_level' => 4)
        );

//        die($this->client->getResponse()->getContent());

        $response = simplexml_load_string($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->url);

        $this->client->request('GET', $this->router->generate('shop_index', ['transaction_id'=>$response->id]));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }


    public function providerTestParameterOk()
    {
        return array(
            array(0, false),
            array(1, true),
            array(null, false),
        );
    }
    /**
     * @dataProvider providerTestParameterOk
     */
    public function testTestParameterOk($testValue, $result)
    {
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('POST',
            $this->router->generate('api_transaction_create_transaction'),
            array('gamer_id' => 'DEMO_54292ddf7a7bf', 'gamer_level' => 1, 'test'=>$testValue)
        );

//        die($this->client->getResponse()->getContent()." ".$this->client->getResponse()->getStatusCode());

        $response = json_decode($this->client->getResponse()->getContent());

        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('GET',
            $this->router->generate('api_transaction_get_transaction', ['transaction_id'=>$response->id])
        );

        //        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response->url);
        $transaction = $this->em->getRepository("AppBundle:Transaction")->findAll()[0];
        $this->assertEquals($transaction->getTest(), $result);

    }

//    Yml Deactivated

//    public function testGetUrlIframeAndWorkTestYmlOK()
//    {
//        $credentials = $this->setHeaderWSSEValidToClientRequest();
//        $this->client->request('POST',
//            $this->router->generate('api_transaction_create_transaction', array('_format' => 'yml', 'app_id' => $credentials->getApp()->getId())),
//            array('gamer_id' => '3', 'gamer_level' => 4)
//        );
//
//        $yamlParser = new Parser();
//
//        die($this->client->getResponse()->getContent());
//
//        $response = $yamlParser->parse($this->client->getResponse()->getContent());
//
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//
//        $this->assertNotEmpty($response['url']);
//
//        $this->client->request('GET', $response['url']);
//
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//    }



} 