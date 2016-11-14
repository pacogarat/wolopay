<?php

namespace AppBundle\Tests\E2E;

use AppBundle\Command\SimulateSendIpnSMSProcessCommand;
use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Tests\E2E\PageActions\AppShop\ShopPage;
use AppBundle\Tests\E2E\PageActions\PayMethod\SMSAndVoicePage;

class SMSPaymentTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOK()
    {
        $app = $this->getApp();
        $articles = $this->em->getRepository("AppBundle:Article")->findBy(['app' => $app, 'itemsQuantity' => 122,
                                                           'articleCategory' => ArticleCategoryEnum::SINGLE_PAYMENT_ID]);

        /** @var Article $article */
        $article  = $articles[0];

        $apmpcs = $this->em->getRepository("AppBundle:AppHasPayMethodProviderCountry")->findByAppIdAndCountryEnabled(
            $app->getId(), CountryEnum::SPAIN, null, ProviderEnum::NVIA_NAME
        );


        $apmpc = $apmpcs[0];

        $this->go($this->getUrlOfNewTransaction());

        $shopPage = new ShopPage($this->driver);
        $shopPage
            ->switchCountry($apmpc->getPayMethodProviderHasCountry()->getCountry()->getName())
            ->clickCategorySinglePayment()
            ->clickArticle($article->getId())
            ->verifyButtonIsDisabled()
        ;

        $shopPage
            ->clickPayMethod($apmpc->getPayMethodProviderHasCountry()->getId())
            ->verifySMSOperatorIsVisible()
            ->clickSMSOperator('YO') // yoigo
            ->verifyButtonIsEnabled()
        ;

        $this->setMovilResolution();

        $shopPage
            ->clickBuy($apmpc)
        ;

        $this->setMaximize();

        /** @var SimulateSendIpnSMSProcessCommand $SMSSimulate */
        $SMSSimulate = $this->container->get('command.shop.simulate_send_ipn_sms');
        $smsCode = $SMSSimulate->executeProcess();

        $sms = new SMSAndVoicePage($this->driver);
        $sms
            ->writeCode($smsCode->getCode())
            ->sendCode()
//            ->verifyUrlOkByText()
        ;

        $this
            ->verifySinglePaymentPurchase();

    }

} 