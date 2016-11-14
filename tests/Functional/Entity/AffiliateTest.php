<?php
/**
 * Created by MGDSoftware. 10/09/2015
 */

namespace AppBundle\Tests\Functional\Entity;

use AppBundle\DataFixtures\Specific\LoadAffiliate;
use AppBundle\Tests\Lib\FunctionalTestCase;


class AffiliateTest extends FunctionalTestCase{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures([new LoadAffiliate()]);
    }

    public function testAffiliateOK(){
        $app = $this->getApp();
        $client = $app->getClient();
        $affiliates = $client->getAffiliates();

        $this->assertEquals(6,$affiliates->count());
    }


//    public function testHasPMPOK(){
//        $aff = $this->getApp()->getClient()->getAffiliates();
//    }


}
