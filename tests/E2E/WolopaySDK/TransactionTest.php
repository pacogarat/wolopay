<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


class TransactionTest extends AbstractWolopaySDK
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
        $trans = $wolopayApi->createTransaction($gamerId='user13', $level=3, $extraOptions=array('fixed_country'=>'1'), $autoRedirect=false);

        if (!$trans){
            throw new \Exception("Error result are incorrect");
        }

    }

} 