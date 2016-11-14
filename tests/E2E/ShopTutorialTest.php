<?php

namespace AppBundle\Tests\E2E;

use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleHasPMPC;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;

class ShopTutorialTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testTutorialStandardOK()
    {
        $app = $this->getApp();
        $this->em->flush();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 100]);
        /** @var Article $article */
        $article  = $articles[0];


        $country = $this->em->getRepository("AppBundle:Country")->find(CountryEnum::USA);

        $urlTransaction = $this->getUrlOfNewTransaction();
        $transaction = $this->em->getRepository("AppBundle:Transaction")->findAll()[0];
        $transaction->setTutorialEnabled(true);
        $this->em->flush();

        $this->go($urlTransaction);

        $shopPage = new ShopPage($this->driver);

        $shopPage
            ->switchCountry($country->getName())
            ->clickCategorySinglePayment()
            ->verifyTooltipContainsText('tutorial.standard.bar_tab')
            ->verifyTooltipContainsText('tutorial.standard.select_article')
            ->clickFirstArticle()
            ->verifyTooltipContainsText('tutorial.standard.select_paymethod')
            ->clickFirstPayMethod()
            ->verifyTooltipContainsText('tutorial.standard.buy')
        ;
        sleep(5);
        $shopPage->verifyTooltipContainsText('tutorial.standard.support');
        sleep(10);
        $shopPage->verifyTooltipIsHidden();
    }

//    public function testPrueba()
//    {
//        $this->go('/');
//
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_name'))->sendKeys('Prueba');
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_email'))->sendKeys('Prueba@prueba.com');
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_message'))->sendKeys('El texto de donquijote y su cogote');
//
//        $this->driver->findElement(\WebDriverBy::id('contact-simple-submit'))->click();
//
//        $this->assertNotEmpty($this->driver->findElement(\WebDriverBy::xpath("//*[contains(text(), 'enviado')]")));
//    }
} 