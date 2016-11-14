<?php


namespace AppBundle\Tests\E2E\PageActions\PayMethod;


use AppBundle\Tests\E2E\PageActions\AbstractPage;

class SMSAndVoicePage extends AbstractPage
{
    function __construct($driver)
    {
        parent::__construct($driver);
        $this->wait->until(
            function (){
                return $this->driver->findElement(\WebDriverBy::id('app_shop_form_type_sms_code_code'));
            }
        );
        sleep(1);
    }

    public function writeCode($code)
    {
        $this->driver->findElement(\WebDriverBy::id('code_purchase_code'))->sendKeys($code);

        return $this;
    }

    public function sendCode()
    {
        $this->driver->findElement(\WebDriverBy::xpath('//input[@type="submit"]'))->click();

        return $this;
    }

} 