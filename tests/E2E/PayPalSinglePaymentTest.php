<?php

namespace AppBundle\Tests\E2E;

use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleHasPMPC;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;
use AppBundle\Tests\E2E\PageActions\PayMethod\PayPalSinglePaymentPage;

class PayPalSinglePaymentTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 100,
                                                               'articleCategory' => ArticleCategoryEnum::SINGLE_PAYMENT_ID]);
        /** @var Article $article */
        $article  = $articles[0];

        /** @var AppShopArticleHasPMPC[] $apmpcs */
        $apmpcs = $this->em->getRepository("AppBundle:AppShopArticleHasPMPC")->findByAppIdAndProviderNameAndCountryAndLevelCategoryandArticleIdAndStatus(
            $app->getId(), ProviderEnum::PAYPAL_NAME, CountryEnum::USA, LevelCategoryEnum::ROOKIE_ID, $article->getId()
        );

        // Paypal
        $apmpc = $apmpcs[0];

        $this->go($this->getUrlOfNewTransaction());

        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategorySinglePayment()
            ->clickArticle($article->getId())
            ->verifyButtonIsDisabled()
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifyButtonIsEnabled()
        ;
        $totalMoney = $shopPage->getTotalMoneyResult();
        $shopPage->clickBuy($apmpc);

        $paypal = new PayPalSinglePaymentPage($this->driver);
        $paypal
            ->verifyAmount($totalMoney)
            ->clickPayWithMyAccount()
            ->fillLoginAccountAndSend(
                $this->container->getParameter('client_paypal_email'),
                $this->container->getParameter('client_paypal_password')
            )
            ->clickConfirm()
            ->clickReturnOk()
            ->verifyUrlOkByText()
        ;

        $this->verifySinglePaymentPurchase();

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