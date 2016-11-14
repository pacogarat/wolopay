<?php


namespace AppBundle\Tests\E2E\WolopaySDK;

class GamerTest extends AbstractWolopaySDK
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
        if (!$wolopayApi->createGamer( $gamerId='3123' )){

            throw new \Exception("Error");
        }
    }

} 