<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class NetellerPaymentPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->waitElementsVisible(\WebDriverBy::id('fn-payment-options'));
        sleep(1);
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr($this->driver->findElement(\WebDriverBy::cssSelector('.product-price'))->getText(), 1);

        if (strpos($postSend, $moneyPreSent) === null)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function clickOnNetellerPayMethod()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#fn-payment-options li a'))->click();
        $this->waitElementsVisible(\WebDriverBy::id('login_identity'));

        return $this;
    }

    public function fillAccount($email='netellertest_AUD@neteller.com', $password='NTt3st1!')
    {
        $this->driver->findElement(\WebDriverBy::id('login_identity'))->sendKeys($email);
        $this->driver->findElement(\WebDriverBy::id('password'))->sendKeys($password);

        sleep(1);

        return $this;
    }

    public function clickConfirm()
    {
        $this->driver->findElement(\WebDriverBy::id('checkout_continue_btn'))->click();

        return $this;
    }

}
