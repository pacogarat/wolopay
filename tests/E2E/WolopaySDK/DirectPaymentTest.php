<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;

class DirectPaymentTest extends AbstractWolopaySDK
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    /**
     * @group E2E
     */
    public function testSimpleOK()
    {
        $paypalPM = $this->em->getRepository("AppBundle:PayMethod")->findOneByPayCategoryIdAndArticleCategoryIdAndName(
            PayCategoryEnum::PROVIDER_METHOD_ID, ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::PAYPAL_SINGLE_NAME
        );

        $wolopayApi = $this->getApiWolopayObjectDemo();
        $trans = $wolopayApi->directPayment($gamerId='user13', 0.1, 'EUR', 'ES', $paypalPM->getId(), 'trofo');

        if (!$trans){
            throw new \Exception("Error result are incorrect");
        }
//        In a future fix it

//        $this->client->request('GET', $trans->url);
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

} 