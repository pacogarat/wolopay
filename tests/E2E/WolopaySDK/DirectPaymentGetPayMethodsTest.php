<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


class DirectPaymentGetPayMethodsTest extends AbstractWolopaySDK
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
        $data = $wolopayApi->getDirectPaymentPayMethodsAvailable('ES');

        $this->assertGreaterThan(1, count($data));
    }

} 