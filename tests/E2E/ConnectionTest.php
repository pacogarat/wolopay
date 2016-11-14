<?php

namespace AppBundle\Tests\E2E;

class ConnectionTest extends AbstractE2EShop
{
    /**
     * @group E2E
     * @group Selenium
     */
    public function testOK()
    {

        $this->go('http://google.es', true);
        $this->takeScreen();
    }

//    public function testPrueba()
//    {
//        $this->go('/');
//
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_name'))->sendKeys('Prueba');
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_email'))->sendKeys('Prueba@prueba.com');
//        $this->driver->findElement(\WebDriverBy::id('mgd_basicbundle_contactsimpletype_message'))->sendKeys('El texto de donquijote y su cogote');
//
//        $this->driver->findElement(\WebDriverBy::id('contact-simple-submit'))->click();
//
//        $this->assertNotEmpty($this->driver->findElement(\WebDriverBy::xpath("//*[contains(text(), 'enviado')]")));
//    }
} 