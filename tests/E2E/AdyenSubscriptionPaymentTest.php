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
use AppBundle\Tests\E2E\PageActions\PayMethod\AdyenPaymentPage;

class AdyenSubscriptionPaymentTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 100,
                                                               'articleCategory' => ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID]);
        /** @var Article $article */
        $article  = $articles[0];

        /** @var AppShopArticleHasPMPC[] $apmpcs */
        $apmpcs = $this->em->getRepository("AppBundle:AppShopArticleHasPMPC")->findByAppIdAndProviderNameAndCountryAndLevelCategoryandArticleIdAndStatus(
            $app->getId(), ProviderEnum::ADYEN_NAME, CountryEnum::USA, LevelCategoryEnum::ROOKIE_ID, $article->getId()
        );

        $apmpc = $apmpcs[0];

        $this->go($this->getUrlOfNewTransaction());

        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategorySubscription()
            ->clickArticle($article->getId())
            ->verifyButtonIsDisabled()
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifyButtonIsEnabled()
        ;
        $totalMoney = $shopPage->getTotalMoneyResult();

        $this->setMovilResolution();

        $shopPage->clickBuy($apmpc);

        $this->setMaximize();

        $paypal = new AdyenPaymentPage($this->driver);
        $paypal
            ->verifyAmount($totalMoney)
            ->fillCreditCardAccount()
            ->clickConfirm()
        ;

        $this->verifySinglePaymentPurchase();
        $subscription = $this->em->getRepository("AppBundle:Subscription")->findAll()[0];
        $subscription->getSubscriptionEventualities()[0]->setCreatedAt(new \DateTime("-2 days"));
        $this->em->flush();

        $this->container->get('command.need_make_payment_request')->renewSubscription($subscription);

        $this->verifyPurchasesNumbers(2, 2);

    }

} 