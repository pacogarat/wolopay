<?php

namespace AppBundle\Tests\E2E;

use AppBundle\DataFixtures\ORM\LoadPromoCode;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;

class PromoPaymentTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOldFormatOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 152,
                                                           'articleCategory' => ArticleCategoryEnum::FREE_PAYMENT_ID]);

        /** @var Article $article */
        $article  = $articles[0];

        $apmpcs = $this->em->getRepository("AppBundle:AppHasPayMethodProviderCountry")->findByAppIdAndCountryEnabled(
            $app->getId(), CountryEnum::SPAIN, null, ProviderEnum::NVIA_NAME, PayMethodEnum::PROMO_NAME
        );

        $apmpc = $apmpcs[0];

        // this is a old format and by default is disabled
        $apmpc->getPayMethodProviderHasCountry()->setActive(true);
        $this->em->flush();

        $this->go($this->getUrlOfNewTransaction());

        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategoryFreePayment()
            ->clickArticle($article->getId())
            ->verifyButtonIsDisabled()
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifyPromoWindowIsVisible()
            ->writeCode(LoadPromoCode::PROMO_1_CODE)
            ->sendCode()
            ->verifyButtonIsEnabled()
            ->clickBuy($apmpc)
        ;

        $this->verifySinglePaymentPurchase();

    }

    /**
     * @group E2E
     * @group Selenium
     */
    public function testSimpleButtonOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 152,
                                                                           'articleCategory' => ArticleCategoryEnum::FREE_PAYMENT_ID]);

        /** @var Article $article */
        $article  = $articles[0];

        $apmpcs = $this->em->getRepository("AppBundle:AppHasPayMethodProviderCountry")->findByAppIdAndCountryEnabled(
            $app->getId(), CountryEnum::SPAIN, null, ProviderEnum::NVIA_NAME
        );

        $apmpc = $apmpcs[0];

        $this->go($this->getUrlOfNewTransaction());

        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->clickCoupon()
            ->writeCode(LoadPromoCode::PROMO_1_CODE)
            ->sendCode()
            ->verifyButtonIsEnabled()
            ->clickBuy($apmpc)
        ;

        $this->verifySinglePaymentPurchase();

    }

} 