<?php

namespace AppBundle\Tests\Functional\Controller\ClientAdmin;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Helper\UtilHelper;
use AppBundle\Tests\Lib\FunctionalTestCase;

class OfferControllerTest extends FunctionalTestCase
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

        $dateFrom= new \DateTime();
        $dateTo= new \DateTime("+6 months");

        $appShops  = $this->em->getRepository("AppBundle:AppShop")->findByApp($app->getId());
        $countries = $this->em->getRepository("AppBundle:Country")->findAll();
        $articles  = $this->em->getRepository("AppBundle:Article")->findByApp($app->getId());

        $this->client->request(
            'POST',
            $this->router->generate('admin_offer_create', ['app' => $app->getId()]),
            [
                'name'            => $name='test',
                'shops_ids'       => UtilHelper::parseIdEntitiesToCSV($appShops),
                'countries'       => UtilHelper::parseIdEntitiesToCSV($countries),
                'articles_ids'    => UtilHelper::parseIdEntitiesToCSV($articles),
                'date_from'       => $dateFrom->format(DATE_ATOM),
                'date_to'         => $dateTo->format(DATE_ATOM),
                'local_time'      => $localTime=true,
                'price'           => $price=6,
                'quantity_extra'  => $quantity_extra = 2,
                'limit_purchases' => $limitPurchases = 9,
                'limit_per_user'  => $limitPerUser = 1,
                'pretty_price'    => $prettyPrice=true,
            ]
        );

//        die($this->client->getResponse()->getContent());

        /** @var OfferProgrammer $offerProgrammer */
        $offerProgrammer = $this->em->getRepository("AppBundle:OfferProgrammer")->findBy(['name'=>$name])[0];

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertNotNull($offerProgrammer);
        $this->assertEquals($quantity_extra, $offerProgrammer->getQuantityExtraPercent());
        $this->assertEquals($price, $offerProgrammer->getAmountPercentDiscount());
        $this->assertEquals($limitPerUser, $offerProgrammer->getLimitPerUser());
        $this->assertEquals($limitPurchases, $offerProgrammer->getLimitPurchases());
        $this->assertEquals($prettyPrice, $offerProgrammer->getPrettyPrice());
    }

} 