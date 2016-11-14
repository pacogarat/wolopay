<?php

namespace AppBundle\Tests\Functional\Controller\ClientAdmin;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class StatsControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }


    public function normalStatsOK()
    {
        $app=$this->getApp();
        $this->logIn();

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_stats_by_app', ['app'=>$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

    public function payMethodStatsOK()
    {
        $app=$this->getApp();
        $this->logIn();

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_stats_payment_methods_by_app', ['app'=>$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));
        //        die($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

    public function userLevelStatsOK()
    {
        $app=$this->getApp();
        $this->logIn();

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_stats_user_level_by_app', ['app'=>$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));
        //        die($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

    public function transactionsPurchasesStatsOK()
    {
        $app=$this->getApp();
        $this->logIn();

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_stats_transactions_purchases', ['app'=>$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));
        //        die($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }


    public function test200StatsOK()
    {
        $app=$this->getApp();
        $this->logIn();

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_stats_by_apps', ['apps'=> $app->getId().','.$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));

//                die($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

} 