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
use AppBundle\Tests\E2E\PageActions\PayMethod\NetellerPaymentPage;

class NetellerPaymentTest extends AbstractE2EShop
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
            $app->getId(), ProviderEnum::NETELLER_NAME, CountryEnum::SPAIN, LevelCategoryEnum::ROOKIE_ID, $article->getId()
        );

        $apmpc = $apmpcs[0];

        // cant test because sandbox is broken
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

        $this->setMovilResolution();

        $shopPage->clickBuy($apmpc);

        $this->setMaximize();

        //todo test it

        $paypal = new NetellerPaymentPage($this->driver);
        $paypal
            ->verifyAmount($totalMoney)
            ->clickOnNetellerPayMethod()
            ->fillAccount()
            ->clickConfirm()
        ;

        $this->verifySinglePaymentPurchase();

    }

} 