<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class PaySafeCardPage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('pinForm:rn01'));
            }
        );
    }

    public function verifyAmount($moneyPreSent)
    {
        $postSend = substr(
            $this->driver->findElement(\WebDriverBy::cssSelector('#dispositionAmount .value'))->getText(),
            0,
            -3
        );

        $postSend = str_replace(',', '.', $postSend);
        $postSend = floatval($postSend );
        echo $postSend;

        if ($postSend != $moneyPreSent)
            throw new \Exception("money doesn't match '$moneyPreSent' != '$postSend' ");

        return $this;
    }

    public function writePin($pin)
    {
        $this->driver->findElement(\WebDriverBy::id('pinForm:rn01'))->sendKeys(substr($pin,0,4));
        $this->driver->findElement(\WebDriverBy::id('pinForm:rn02'))->sendKeys(substr($pin,4,4));
        $this->driver->findElement(\WebDriverBy::id('pinForm:rn03'))->sendKeys(substr($pin,8,4));
        $this->driver->findElement(\WebDriverBy::id('pinForm:rn04'))->sendKeys(substr($pin,12,4));

        $this->driver->findElement(\WebDriverBy::cssSelector('#pinForm .checkbox span'))->click();

        $this->driver->findElement(\WebDriverBy::id('pinForm:pay'))->click();


        return $this;
    }

} 