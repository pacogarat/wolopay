<?php

namespace AppBundle\Tests\E2E;

use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleHasPMPC;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;

class ShopTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 100]);
        /** @var Article $article */
        $article  = $articles[0];

        $apmpcs = $this->em->getRepository("AppBundle:AppHasPayMethodProviderCountry")->findByAppIdAndCountryEnabled(
            $app->getId(), CountryEnum::USA, null, ProviderEnum::PAYSAFECARD_NAME
        );
        $apmpc = $apmpcs[0];

        $this->go($this->getUrlOfNewTransaction());
        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategorySubscription()
            ->clickCategorySinglePayment()
            ->clickArticle($article->getId())
            ->verifyButtonIsDisabled()
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifyButtonIsEnabled()
            ->clickBuy($apmpc, false)
            ->clickCloseIframe()
        ;

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