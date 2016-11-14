<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class PayPalSubscriptionPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('login_email'));
            }
        );
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr($this->driver->findElement(\WebDriverBy::cssSelector('.dataTable td.moneyColumn'))->getText(), 1, -3);

        $postSend = str_replace(',', '.', $postSend);
        $postSend = floatval($postSend );

        if ($postSend != $moneyPreSent)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function clickPayWithMyAccount()
    {
        $this->driver->findElement(\WebDriverBy::id('payment_type_paypal'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('login_email'));
            }
        );

        return $this;
    }


    public function fillLoginAccountAndSend($user, $password)
    {
        $this->driver->findElement(\WebDriverBy::id('login_email'))->sendKeys($user);
        $this->driver->findElement(\WebDriverBy::id('login_password'))->sendKeys($password);

        $this->driver->findElement(\WebDriverBy::id('login.x'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::cssSelector('.globalButtons input[name=\'submit.x\']'));
            }
        );

        return $this;
    }

    public function clickConfirm()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('.globalButtons input[name=\'submit.x\']'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::cssSelector('.globalButtons input[name=\'accountview.x\']'));
            }
        );

        return $this;
    }

} 