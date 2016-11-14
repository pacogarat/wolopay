<?php

namespace AppBundle\Tests\E2E;

use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleHasPMPC;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;

class ShopCartTest extends AbstractE2EShop
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

        $url = $this->getUrlOfNewTransaction();
        $transaction = $this->em->getRepository("AppBundle:Transaction")->findAll()[0];
        $transaction->setCss($this->em->getRepository("AppBundle:ShopCss")->findOneBy(['cssUrl' => 'theme_berserk_modular.less']));
        $this->em->flush();

        $this->go($url);
        $shopPage = new ShopPage($this->driver);

        $shopPage
            ->waitForQueryExecute('count( $em->getRepository("AppBundle:SinglePayment")->findAll() ) == 0', $this->em)
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategorySinglePayment()
            ->verifyButtonIsDisabled()
            ->clickArticleAddCart($article->getId())
            ->verifyNArticlesInCart(1)
            ->clickArticleAddCart($article->getId())
            ->verifyNArticlesInCart(2)
            ->clickArticleAddCart($article->getId())
            ->verifyNArticlesInCart(3)
            ->verifyButtonIsDisabled()
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifyButtonIsEnabled()
            ->verifyTotalAmountIs(4.95)
            ->clickBuy($apmpc, false)
            ->waitForQueryExecute('count( $em->getRepository("AppBundle:SinglePayment")->findAll() ) > 0', $this->em)
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