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
use AppBundle\Tests\E2E\PageActions\PayMethod\UkashPage;

class UkashPaymentTest extends AbstractE2EShop
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
            $app->getId(), ProviderEnum::UKASH_NAME, CountryEnum::USA, LevelCategoryEnum::ROOKIE_ID, $article->getId()
        );

        // Ukash
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

        // Because chrome doesn't work correctly with iframe
        $this->setMovilResolution();

        $shopPage->clickBuy($apmpc);
        sleep(1);
        $this->setMaximize();

        list($null, $code, $codeValue) = $this->getDynamicPageOptions(__DIR__.'/PageActions/PayMethod/codes/ukash.txt');

        $page = new UkashPage($this->driver);
        $page
            ->verifyAmount($totalMoney)
            ->fillData($code, $codeValue, 'mgarcia@nviasms.com')
        ;

        // It has a captcha l0l need manual, this last lines can't be uncommented
//        sleep(100); // Write captcha u have 30 secs RUN!!!!!!!!
//        $this->verifySinglePaymentPurchase();

    }


} 