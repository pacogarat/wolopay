<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


class DirectPaymentWidgetTest extends AbstractWolopaySDK
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
        $wolopayApi = $this->getApiWolopayObjectDemo();
        $trans = $wolopayApi->directPaymentWidget($gamerId='user13', 0.1, 'EUR', 'woho', '', ['country'=>'ES']);

        if (!$trans){
            throw new \Exception("Error result are incorrect");
        }

        $this->client->request('GET', $trans->url);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(1, $this->em->getRepository("AppBundle:TransactionTemp")->findAll());
    }

} 