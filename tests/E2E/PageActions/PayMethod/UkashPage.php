<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class UkashPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_tbxVoucherAmount'));
            }
        );
        sleep(1);
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = (float) $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_lblTransactionAmount'))->getText();

        if ($postSend != $moneyPreSent)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function fillData($code, $codeValue, $emailAdress)
    {
        $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_tbxVoucherNumber'))->sendKeys($code);
        $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_tbxVoucherAmount'))->sendKeys($codeValue);
        $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_tbxEmailAddress'))->sendKeys($emailAdress);
        $this->driver->findElement(\WebDriverBy::id('_ctl0_cphPageFrame_cbxTerms'))->click();



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