<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class RixtyPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('login-link'));
            }
        );
        sleep(1);
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr($this->driver->findElement(\WebDriverBy::cssSelector('.item-price .itemvalue'))->getText(), 1);
        if (substr($postSend, 1, 1)== '.')
            $postSend = '0'.$postSend;

        $postSend = floatval($postSend );

        if ($postSend != $moneyPreSent)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function clickLogin()
    {

        $this->driver->findElement(\WebDriverBy::cssSelector('#id21 #login-link'))->click();

        $this->waitElementVisible(\WebDriverBy::id('id2f'));
        sleep(1);

        return $this;
    }

    public function isLogged()
    {
        sleep(0.5);

        return $this->driver->findElement(\WebDriverBy::id('optionsWrap'))->isDisplayed();
    }


    public function fillLoginAccountAndSend($user, $password)
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#id2f .username_login'))->click();

        $this->driver->findElement(\WebDriverBy::cssSelector('#id2f .username_login'))->sendKeys($user);
        $this->driver->findElement(\WebDriverBy::id('id31'))->sendKeys($password);

        $this->driver->findElement(\WebDriverBy::id('id35'))->click();

        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('id48'));
            }
        );

        return $this;
    }

    public function clickConfirm()
    {
        $this->driver->findElement(\WebDriverBy::id('id48'))->click();
//      todo
//        $this->wait->until(
//            function (){
//                return $this->driver->findElement(\WebDriverBy::cssSelector('#doneInfo .doneIcon'));
//            }
//        );

        return $this;
    }

    public function clickReturnOk()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('#doneInfo .confidential .buttonAsLink input'))->click();
        $this->waitToLoadNewPage();

        return $this;
    }

} 