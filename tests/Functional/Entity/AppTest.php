<?php
/**
 * Created by MGDSoftware. 10/09/2015
 */

namespace AppBundle\Tests\Functional\Entity;

use AppBundle\DataFixtures\Specific\LoadGamer;
use AppBundle\Entity\Gamer;
use AppBundle\Tests\Lib\FunctionalTestCase;


class AppTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures([new LoadGamer()]);
    }

    public function testBlacklistedOK(){
        $app = $this->getApp();
        $bl = $app->getBlacklistedGamers();
        $this->assertEquals(3,$bl->count());
    }


    public function testHasBlacklistedOK(){
        $app = $this->getApp();

       $this->assertTrue(
           $app->hasBlacklistedGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'malo1')->getId())
       );
        $this->assertFalse(
            $app->hasBlacklistedGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd1')->getId())
        );
    }


    public function testUnBlacklistAllGamersOK(){
        $app = $this->getApp();
        $app->unBlacklistAllGamers();

        $this->em->flush();

        $this->assertEquals(0,$app->getBlacklistedGamers()->count());

        $this->assertFalse(
            $app->hasBlacklistedGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'malo1')->getId())
        );
        $this->assertFalse(
            $app->hasBlacklistedGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd1')->getId())
        );
    }


    public function testForTestingOK(){
        $app = $this->getApp();
        $bl = $app->getForTestingGamers();
        $this->assertEquals(2,$bl->count());
    }


    public function testHasTestingGamerOK(){
        $app = $this->getApp();

        $this->assertTrue($app->hasForTestingExternalGamerId('ttDvd7'));
        $this->assertFalse($app->hasForTestingExternalGamerId('ttDvd5'));

        $this->assertTrue(
            $app->hasForTestingGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd7'))
        );

        $this->assertFalse(
            $app->hasForTestingGamer($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd5'))
        );
    }

    public function testUnsetForTestingGamers(){
        $app = $this->getApp();
        $app->UnsetForTestingAllGamers();

        $this->em->flush();

        $this->assertEquals(0,$app->getForTestingGamers()->count());

        $this->assertFalse(
            $app->hasForTestingExternalGamerId($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd7')->getId())
        );
        $this->assertFalse(
            $app->hasForTestingExternalGamerId($this->em->getRepository('AppBundle:Gamer')->findOneByAppIdAndGamerExternalId($app->getId(), 'ttDvd5')->getId())
        );
    }


    public function testBlacklistedIPs(){
        $app = $this->getApp();
        $bl = $app->getBlacklistedIPs();
        $this->assertEquals(4,count($bl));
    }

    public function testHasBlacklistedIP(){
        $app = $this->getApp();

        $this->assertTrue($app->hasBlacklistedIP('193.219.96.100'));
        $this->assertFalse($app->hasBlacklistedIP('193.219.96.99'));
    }

    public function testRemoveBlacklistedIP(){
        $app = $this->getApp();

        $this->assertTrue($app->hasBlacklistedIP('193.219.96.100'));
        $app->removeBlacklistedIP('193.219.96.100');
        $this->em->flush();
        $this->assertFalse($app->hasBlacklistedIP('193.219.96.100'));
    }


}
