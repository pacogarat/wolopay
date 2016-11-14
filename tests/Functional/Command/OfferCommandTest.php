<?php

namespace AppBundle\Tests\Functional\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Tests\Lib\FunctionalTestCase;

/**
 * Because need a environment to notify
 *
 */
class OfferCommandTest extends FunctionalTestCase
{
    /** @var  \AppBundle\Command\OfferCommand */
    private $offerCommand;

    public function setUp()
    {
        parent::setUp();
        $this->offerCommand = $this->container->get('command.shop.offer.sync');
        $this->loadAllFixtures();
    }

    public function testSimpleOK()
    {
        $demo = $this->getApp();
        $offerProgrammer = new OfferProgrammer();

        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $demo->getId(), 'itemsQuantity' => 100,
                                                                           'articleCategory' => ArticleCategoryEnum::SINGLE_PAYMENT_ID]);

        $price = $articles[0]->getAppShopHasArticles()[0]->getAmount();
        $itemsNumber = $articles[0]->getAppShopHasArticles()[0]->getCurrentItemsQuantity();

        $appShops = [];
        foreach ($articles[0]->getAppShopHasArticles() as $appShopHasArticles)
        {
            if ($appShopHasArticles->getCountry()->getId() == CountryEnum::SPAIN)
                $appShops[]= $appShopHasArticles->getAppShop();
        }

        $offerProgrammer
            ->setApp($demo)
            ->setAmountPercentDiscount($percentDiscount=5)
            ->setQuantityExtraPercent($extraPercent=10)
            ->setName('test')
            ->setArticles($articles)
            ->setAppShops($appShops)
            ->setCountries($countries=[$articles[0]->getAppShopHasArticles()[0]->getCountry()])
            ->setOfferFrom(new \DateTime())
            ->setOfferTo(new \DateTime("+6 months"))
        ;

        $this->em->persist($offerProgrammer);
        $this->em->flush();

        $this->offerCommand->reconfigureAllOffers($offerProgrammer->getId());

        foreach ($articles as $article)
            $this->em->detach($article);

        $appShops = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByArticlesIdsAndAppShopIdsAndCountriesIds(
            $articles,
            $appShops,
            $countries
        );

        $iTest = 0;
        foreach ($appShops as $appShop)
        {
            if ($appShop->getCountry()->getId() === CountryEnum::SPAIN)
            {
                $this->assertNotNull($appShop->getOffer());
                $this->assertEquals($appShop->getOffer()->getAmount(), 50.35);

                $iTest++; // x each shop

/*   Not inside
            }else if($appShop->getCountry()->getId() === CountryEnum::USA){

                $this->assertNull($appShop->getOffer());
                $iTest++;

            }else if($appShop->getCountry()->getId() === CountryEnum::TURKEY){

                $this->assertNull($appShop->getOffer());
                $iTest++;
*/
            }

            $this->assertNotNull($appShop->getOffer()->getItemsQuantity(), $itemsNumber+($itemsNumber*10/100));
        }


    }

} 