<?php
/**
 * Created by MGDSoftware. 10/09/2015
 */

namespace AppBundle\Tests\Unit\Entity;


use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;

class AppTest extends \PHPUnit_Framework_TestCase{


    public function testBlacklisted()
    {
       $app = new App();

        $gamer1 = new Gamer($app,'1');
         
        $gamer2 = new Gamer($app,'2');
        $gamer2->setNotBlacklisted();

        $gamer3 = new Gamer($app,'3');
        $gamer3->setBlacklisted();

        $gamer4 = new Gamer($app,'4');
        $gamer4->setBlacklisted();
        $gamer2->setNotBlacklisted();

        $gamer5 = new Gamer($app,'5');
        $gamer6 = new Gamer($app,'6');
        $gamer6->setBlacklisted();

        $gamer7 = new Gamer($app,'7');
        $gamer8 = new Gamer($app,'8');
        $gamer9 = new Gamer($app,'9');
        $gamer10 = new Gamer($app,'10');
        $gamer11 = new Gamer($app,'11');
        $gamer11->setBlacklisted();

        $app->addGamer($gamer1)->addGamer($gamer2)->addGamer($gamer3)->addGamer($gamer4)
            ->addGamer($gamer5)->addGamer($gamer6)->addGamer($gamer7)->addGamer($gamer8)
            ->addGamer($gamer9)->addGamer($gamer10)->addGamer($gamer11);

        $blacklistedGamers = $app->getBlacklistedGamers();

        $this->assertEquals(4, $blacklistedGamers->count());
        $isBlacklisted = $app->hasBlacklistedGamer(5);
//        var_dump($isBlacklisted);
    }

    public function providerIps()
    {
        return [
            ['222.222.222.222'],
            ['0.0.0.0/3'],
            ['200.22.3.5/3123'],
            ['255.255.255.255/3'],
            ['13.2.3.*'],
            ['13.2.3.4/255.255.255.33'],
            ['13.2.3.0-1.2.3.255'],
            ['192.168.1.1'],
            ['192.168.1.1/123'],
            ['192.168.1.1/123.123.123.12'],
            ['13.2.3/24', false],
            ['13.2.3.23323/24', false],
            ['2323.2.3.23/24', false],
        ];
    }

    /**
     * @dataProvider providerIps
     */
    public function testIpValid($ip, $state = true)
    {
        $app = new App();

        $this->assertEquals($app->isBlacklistedIpValid($ip), $state);
    }

    public function testRemoveBlackListed()
    {
        $app = new App();
        $ip = '211.22.22.22';
        $app->addBlacklistedIP($ip);
        $app->removeBlacklistedIP($ip);

        $this->assertEquals($app->getBlacklistedIPs(), []);
    }


}