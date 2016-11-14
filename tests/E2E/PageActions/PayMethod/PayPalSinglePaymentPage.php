<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class PayPalSinglePaymentPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->waitElementsVisible(\WebDriverBy::id('loadLogin'));
        sleep(1);
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr($this->driver->findElement(\WebDriverBy::cssSelector('.totals .amount'))->getText(), 1);

        $postSend = str_replace(',', '.', $postSend);
        $postSend = floatval($postSend );

        if ($postSend != $moneyPreSent)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function clickPayWithMyAccount()
    {
        $this->driver->findElement(\WebDriverBy::id('loadLogin'))->click();

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

        $this->driver->findElement(\WebDriverBy::id('submitLogin'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('continue_abovefold'));
            }
        );

        return $this;
    }

    public function clickConfirm()
    {
        $this->driver->findElement(\WebDriverBy::id('continue_abovefold'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::cssSelector('#doneInfo .doneIcon'));
            }
        );

        return $this;
    }

    public function clickReturnOk()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#doneInfo .confidential .buttonAsLink input'))->click();
        $this->waitToLoadNewPage();

        return $this;
    }

    public function closeAlert()
    {
        $this->driver->switchTo()->alert()->accept();
    }
} 