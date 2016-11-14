<?php

namespace AppBundle\Tests\Functional\Controller\ClientAdmin;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;

class TransactionsControllerTest extends FunctionalTestCase
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

        $dateFrom= new \DateTime("-6 months");
        $dateTo= new \DateTime();

        $this->client->request('GET', $this->router->generate('admin_transactions', ['app'=>$app->getId()
                    , 'date_from'=> $dateFrom->format(DATE_ATOM), 'date_to'=> $dateTo->format(DATE_ATOM), 'currency' => CurrencyEnum::EURO ]));

//        die($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull(json_decode($this->client->getResponse()->getContent()));
    }

} 