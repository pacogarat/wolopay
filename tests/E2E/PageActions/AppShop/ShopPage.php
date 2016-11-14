<?php


namespace AppBundle\Tests\E2E\PageActions\AppShop;


use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Tests\E2E\PageActions\AbstractPage;

class ShopPage extends AbstractPage
{

    function __construct($driver)
    {
        parent::__construct($driver);
        $this->waitToCategoryVisible();
        $this->sleepAnimation();
    }

    /**
     *
     */
    function waitToCategoryVisible()
    {
        $this->waitElementVisible(\WebDriverBy::id('cat-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID));
        $this->sleepAnimation();
    }

    /**
     *
     */
    function waitToArticlesVisible()
    {
        $this->waitElementsVisible(\WebDriverBy::cssSelector('.products .product'));
    }

    /**
     * @return ShopPage
     */
    public function clickCategorySinglePayment()
    {
        $this->clickCategoryById(ArticleCategoryEnum::SINGLE_PAYMENT_ID);

        return $this;
    }

    /**
     * @param $text
     * @return ShopPage
     */
    public function verifyTooltipContainsText($text)
    {
        $this->waitElementVisible(\WebDriverBy::xpath("//div[@id='arrow-box']/div[contains(text(),'$text')]"));

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifyTooltipIsHidden()
    {
        $this->waitElementHidden(\WebDriverBy::xpath("//div[@id='arrow-box']]"));

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function clickCategorySubscription()
    {
        $this->clickCategoryById(ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID);

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function clickCategoryFreePayment()
    {
        $this->clickCategoryById(ArticleCategoryEnum::FREE_PAYMENT_ID);

        return $this;
    }

    /**
     * @return ShopPage
     * @deprecated
     */
    public function clickCategoryPhone()
    {
//        $this->clickCategoryById(TabCategoryEnum::PHONE_ID);

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function switchCountry($name)
    {
        $this->driver->findElement(\WebDriverBy::id('input_country_chosen'))->click();
        $this->driver->findElement(\WebDriverBy::xpath("//div[@id='input_country_chosen']/div/ul/li[contains(text(),'$name')]"))->click();
        usleep(100000);
        $this->waitToCategoryVisible();

        return $this;
    }

    /**
     * @return $this
     */
    public function clickCoupon()
    {
        $this->driver->findElement(\WebDriverBy::id('coupon_code'))->click();

        return $this;
    }


    /**
     * @param $id
     */
    private function clickCategoryById($id)
    {
        $this->driver->findElement(\WebDriverBy::id('cat-'.$id))->click();
        $this->waitToArticlesVisible();
        $this->sleepAnimation();

    }


    /**
     * @param $id
     * @return ShopPage
     */
    public function clickArticle($id)
    {
        $this->driver->findElement(\WebDriverBy::id('article-'.$id))->click();
        $this->sleepAnimation();

        return $this;
    }

    /**
     * @param $id
     * @return ShopPage
     */
    public function clickArticleAddCart($id)
    {
        $this->driver->findElement(\WebDriverBy::cssSelector("#article-$id .add-cart"))->click();
        $this->sleepAnimation();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function clickFirstArticle()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('.product'))->click();
        $this->sleepAnimation();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifyButtonIsDisabled()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#button-actions .disabled'));

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifyButtonIsEnabled()
    {
        $this->waitElementsVisible(\WebDriverBy::cssSelector('#button-actions'));

        return $this;
    }

    /**
     * @param $totalAmount
     * @throws \Exception
     * @return ShopPage
     */
    public function verifyTotalAmountIs($totalAmount)
    {
        if ($this->getTotalMoneyResult() != $totalAmount)
            throw new \Exception("Amount Is incorrect");

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifySMSOperatorIsVisible()
    {
        $this->waitElementVisible(\WebDriverBy::id('sms-operator'));
        $this->sleepAnimation();

        return $this;
    }


    /**
     * @param $shortName
     * @return ShopPage
     */
    public function clickSMSOperator($shortName)
    {
        $this->driver->findElement(\WebDriverBy::id('sms-operator-'.$shortName))->click();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function clickCloseSMSOperatorWindow()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#sms-operator .close'))->click();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifyPromoWindowIsVisible()
    {
        $this->waitElementVisible(\WebDriverBy::id('promo-code'));
        $this->sleepAnimation();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function verifyNArticlesInCart($nArticles)
    {

        $this->waitTextInElement('//*[@id="button-actions"]/div[1]/div/span', $nArticles);
        $this->sleepAnimation();

        return $this;
    }

    /**
     * @param $code
     * @return $this
     */
    public function writeCode($code)
    {
        $this->driver->findElement(\WebDriverBy::id('promo-code-input'))->sendKeys($code);

        return $this;
    }

    /**
     * @return $this
     */
    public function sendCode()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#promo-code input[type=submit]'))->click();
        $this->waitToAlertInfoShow();

        return $this;
    }

    /**
     * @return ShopPage
     */
    public function clickClosePromoWindow()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#promo-code .close'))->click();
        usleep(100000);

        return $this;
    }
    /**
     * @param $id
     * @return $this
     */
    public function clickPayMethod($id)
    {
        $this->driver->findElement(\WebDriverBy::id('paymethod-'.$id))->click();

        return $this;
    }

    /**
     * @return $this
     */
    public function clickFirstPayMethod()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('.pay-box'))->click();

        return $this;
    }

    /**
     *
     */
    private function waitToPayMethodVisible()
    {
        $this->waitElementVisible(\WebDriverBy::cssSelector('.pay-methods .pay-box'));
    }

    private function waitToAlertInfoShow()
    {
        $this->wait->until(
            function (){
                return $this->driver->findElements(\WebDriverBy::cssSelector('#msg-container .info'));
            }
        );
    }

    /**
     * @param AppShopArticleHasPMPC $apmpc
     * @param bool $changeFocus
     * @return $this
     */
    public function clickBuy(AppHasPayMethodProviderCountry $apmpc, $changeFocus=true)
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#button-actions .pay-button'))->click();
        $this->sleepAnimation();

        if ($changeFocus == false)
            return $this;

        /** @var \WebDriverDimension $obj */
        $obj = $this->driver->manage()->window()->getSize();

        if ($apmpc->getPayMethodProviderHasCountry()->getPayMethodHasProvider()->getIsAjax())
        {
            // N0th1ng

        }else if (false == $apmpc->getPayMethodProviderHasCountry()->getPayMethodHasProvider()->getIsIframe() || $obj->getWidth() < 600){


            $this->switchFocusToNewWindow();
            $this->waitToLoadNewPage();
        }else{
            $this->driver->switchTo()->frame('iframe');
        }

        return $this;
    }

    public function getTotalMoneyResult()
    {
        return floatval(str_replace(',','.', $this->driver->findElement(\WebDriverBy::id('total_amount'))->getText()));
    }

    /**
     * @return ShopPage
     */
    public function clickCloseIframe()
    {
        $this->waitElementsVisible(\WebDriverBy::cssSelector('#iframe-box .close img'));
        $this->driver->findElement(\WebDriverBy::cssSelector('#iframe-box .close img'))->click();
        return $this;
    }

    private function sleepAnimation()
    {
        // css animation
        usleep(900000); // 0.5 secs
        sleep(1);
    }
} 