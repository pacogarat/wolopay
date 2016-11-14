<?php

namespace AppBundle\Tests\Functional\Controller;


use AppBundle\Command\FortunoSyncCommand;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;

/**
 * Because need a environment to notify
 */
class FortunoSyncCommandTest extends FunctionalTestCase
{
    /** @var  FortunoSyncCommand */
    private $fortunoService;

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
        $this->fortunoService = $this->container->get('command.fortuno_sync');
    }

    public function testMessagesSimpleOK()
    {
        $html = <<<HTML
<html>
    <body>
        <div class="pf-content">
            <table cellspacing="0" cellpadding="4" dir="ltr" border="1" width="100%" style="border-color: #e0e0e0; font-size: 9pt;">
                <tbody>
                    <tr style="background-color: #f0f0f0; text-align: center;">
                        <td>
                            <strong>Country</strong>
                        </td>
                        <td>
                            <strong>Continent</strong>
                        </td>
                        <td>
                            <strong>Payment Flow Language</strong>
                        </td>
                        <td>
                            <strong>Web Disclaimer for API merchants</strong>
                        </td>
                        <td>
                            <strong>MT Option 1</strong>
                        </td>
                        <td>
                            <strong>MT Option 2</strong>
                        </td>
                        <td>
                            <strong>Price format</strong>
                        </td>
                        <td>
                            <strong>Rules &amp; Regulations</strong>
                        </td>
                        <td>
                            <strong>Code of Conduct</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Spain
                        </td>
                        <td>
                            Western Europe
                        </td>
                        <td>
                            español
                        </td>
                        <td>
                        </td>
                        <td>
                            Su codigo de confirmacion: (%{cc}).Muchas gracias, su pago se ha realizado correctamente.Soporte: %{support}
                        </td>
                        <td>
                            Usted adquirio %{item_name} por %{price}. Gracias! Soporte: %{support}
                        </td>
                        <td>
                            €x,xx
                        </td>
                        <td>
                            Multiple billing is not allowed. Customers have to confirm every purchase higher than 1.45 EUR. Fortumo will send an additional sms stating the
                            price of the service, which has to be answered S in order to complete the purchase.
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
HTML;


        $smss = $this->em->getRepository("AppBundle:SMS")->findByCountryId(CountryEnum::SPAIN);
        $this->fortunoService->smsInserted=['Spain' => $smss];

        $this->fortunoService->syncSingUpTextMessages($html);

        /** @var TransUnit $translation */
        $translation = $this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['key' => $smss[0]->getMobileTextSingUpLabel()->getKey()]);

        $msg = 'Su codigo de confirmacion: (#PIN#).Muchas gracias, su pago se ha realizado correctamente.Soporte: '.$this->container->getParameter('email_info_wolopay');

        $this->assertEquals($msg, $translation->getTranslation('en')->getContent());
        $this->assertEquals($msg, $translation->getTranslation('es')->getContent());
    }

    public function testSimpleOK()
    {
        $this->fortunoService->smsInserted=[]; // reset
        $this->fortunoService->SKIP_COUNTRIES = [];

        $xml=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<services_api_response version="2.0">
  <status>
    <code>0</code>
    <message>OK</message>
  </status>
  <service id="8bb78ced8ec7df8fca1addd0aa6a5659">
    <countries>
        <country code="ES" vat="21.00" approved="true" name="Spain">
        <prices>
          <price currency="EUR" amount="1.45" all_operators="true" vat_included="true">
            <message_profile shortcode="7753" keyword="WOLOPAY" all_operators="true">
              <operator default_billing_status="Failed" code="Movistar" billing_type="MT" revenue="0.65" name="Movistar">
                <codes>
                  <code mnc="22" mcc="214"/>
                  <code mnc="5" mcc="214"/>
                  <code mnc="7" mcc="214"/>
                  <code mnc="18" mcc="214"/>
                  <code mnc="25" mcc="214"/>
                </codes>
              </operator>
              <operator default_billing_status="Failed" code="Orange" billing_type="MT" revenue="0.65" name="Orange">
                <codes>
                  <code mnc="3" mcc="214"/>
                  <code mnc="9" mcc="214"/>
                  <code mnc="21" mcc="214"/>
                  <code mnc="19" mcc="214"/>
                </codes>
              </operator>
              <operator default_billing_status="Failed" code="Vodafone" billing_type="MT" revenue="0.65" name="Vodafone">
                <codes>
                  <code mnc="1" mcc="214"/>
                  <code mnc="6" mcc="214"/>
                  <code mnc="16" mcc="214"/>
                </codes>
              </operator>
              <operator default_billing_status="Failed" code="Yoigo" billing_type="MT" revenue="0.65" name="Yoigo">
                <codes>
                  <code mnc="4" mcc="214"/>
                </codes>
              </operator>
            </message_profile>
          </price>
        </prices>
        <promotional_text>
          <local>Precio: &#8364;1,45
Soporte: +34902354525 | info@wolopay.com Pago m&#243;vil por fortumo.es
</local>
          <english>Price: &#8364;1.45
Support: +34902354525 | info@wolopay.com
Mobile Payment by fortumo.com</english>
        </promotional_text>
      </country>
  </countries>
  </service>
</services_api_response>
XML;

        $this->fortunoService->syncPrices(simplexml_load_string($xml));

        $providerFortuno = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name' => 'Fortuno']);
        $pmpcs = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findByProviderId($providerFortuno->getId());

//        foreach ($pmpcs[0]->getSms() as $sms)
//            echo $sms->getOperator()->getName();

        $this->assertEquals(1, count($pmpcs));
        $this->assertEquals(4, count($pmpcs[0]->getSMSs()));
        $this->assertEquals(1.45, $pmpcs[0]->getSMSs()[0]->getAmount());
        $this->assertEquals(45, $pmpcs[0]->getFeeProviderPercent());
    }

} 