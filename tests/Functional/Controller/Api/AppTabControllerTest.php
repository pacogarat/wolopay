<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class AppTabControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testGetArticlesOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_article_tab_get_tabs'),
            [
                'transaction_id' => $transacion->getId(),
                'country' => CountryEnum::SPAIN,
            ]
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->app_tab->name_unique);
        $this->assertCount(2, $response);
    }

    public function testGetArticlesOWithFreeK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodNameAndProviderNameAndCountryId(
            PayMethodEnum::PROMO_NAME, ProviderEnum::NVIA_NAME, CountryEnum::SPAIN
        );

        $pmpc->setActive(true);
        $this->em->flush();

        $this->client->request('GET', $this->router->generate('api_article_tab_get_tabs'),
            [
                'transaction_id' => $transacion->getId(),
                'country' => CountryEnum::SPAIN,
            ]
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->app_tab->name_unique);
        $this->assertCount(3, $response);
    }

    public function testGetArticlesRemove1TabOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $appDemo = $this->getApp();
        $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory(
            $transacion->getApp()->getId(), $transacion->getLevelCategory()->getId()
        );
        $appTabSubscription = $this->em->getRepository("AppBundle:AppShopHasAppTab")->findOneByAppShopIdAndNameUnique($appShop->getId(), 'subscription');
        $appTabSubscription->getAppTab()->addPayCategory($this->em->getRepository("AppBundle:PayCategory")->find(PayCategoryEnum::BANK_TRANSFER_ID));
        $this->em->flush();

        $this->client->request('GET', $this->router->generate('api_article_tab_get_tabs'),
            [
                'transaction_id' => $transacion->getId(),
                'country' => CountryEnum::SPAIN,
            ]
        );

//        die($this->client->getResponse()->getContent() . "fin");

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response[0]->id);
        $this->assertCount(1, $response);
    }

} 