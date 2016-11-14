<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class AdyenPaymentPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->waitElementsVisible(\WebDriverBy::id('card.cardNumber'));
        sleep(1);
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr($this->driver->findElement(\WebDriverBy::id('displayAmount'))->getText(), 1);

        if (strpos($postSend, $moneyPreSent) === null)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function fillCreditCardAccount($creditCard='5100 0811 1222 3332', $holder='Bijenkorf', $cardExpiryDateMonth='06', $cardExpiryDateYear='2016',$CVC=737)
    {
        $this->driver->findElement(\WebDriverBy::id('card.cardNumber'))->sendKeys($creditCard);
        $this->driver->findElement(\WebDriverBy::id('card.cardHolderName'))->sendKeys($holder);
        $this->driver->findElement(\WebDriverBy::id('card.expiryMonth'))->findElement(\WebDriverBy::cssSelector("option[value='$cardExpiryDateMonth']") )->click();
        $this->driver->findElement(\WebDriverBy::id('card.expiryYear'))->findElement(\WebDriverBy::cssSelector("option[value='$cardExpiryDateYear']") )->click();
        $this->driver->findElement(\WebDriverBy::id('card.cvcCode'))->sendKeys($CVC);
        sleep(1);

        return $this;
    }

    public function clickConfirm()
    {
        $this->driver->findElement(\WebDriverBy::cssSelector('.paySubmit'))->click();
//        $this->driver->findElement(\WebDriverBy::cssSelector('.paySubmit'))->click();
//        $this->driver->findElement(\WebDriverBy::cssSelector('.paySubmit'))->click();

        return $this;
    }

}
