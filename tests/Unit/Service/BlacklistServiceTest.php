<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use AppBundle\Entity\App;
use AppBundle\Service\BlacklistService;
use AppBundle\Service\IPInfoService;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;


class BlacklistServiceTest  extends \PHPUnit_Framework_TestCase
{

    private $emMock;
    private $loggerMock;
    private $ipInfoServiceMock;


    public function setUp()
    {
        parent::setUp();
        $this->emMock = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->ipInfoServiceMock= $this->getMockBuilder(IPInfoService::class)->disableOriginalConstructor()->getMock();
    }

    public function testBlacklistedIP()
    {
        $this->setUp();
        $app = new App();
        $date = new \DateTime('now');
        $blIPs = array( '193.219.96.100'=>array("ip"=>'193.219.96.100',"createdAt"=>$date,"isRange"=>false, "isIPv6"=>false),
            '193.219.96.0/24'=>array("ip"=>'193.219.96.0/24',"createdAt"=>$date,"isRange"=>true, "isIPv6"=>false),
            '195.78.0.0/16'=>array("ip"=>'195.78.228.0/24',"createdAt"=>$date,"isRange"=>true, "isIPv6"=>false),
            '0:0:0:0:0:ffff:c1db:6064'=>array("ip"=>'0:0:0:0:0:ffff:c1db:6064',"createdAt"=>$date,"isRange"=>false, "isIPv6"=>true),
            '0:0:0:0:0:ffff:c1db:6064/24'=>array("ip"=>'0:0:0:0:0:ffff:c1db:6064/24',"createdAt"=>$date,"isRange"=>true, "isIPv6"=>true));

        $app->addBlacklistedIPsArray($blIPs);

        $blacklistService = new BlacklistService($this->emMock, $this->loggerMock, $this->ipInfoServiceMock, false, new Container());

        $this->assertTrue($blacklistService->isIPBlacklistedForApp("193.219.96.100", $app));
        $this->assertTrue($blacklistService->isIPBlacklistedForApp("193.219.96.1", $app));
        $this->assertTrue($blacklistService->isIPBlacklistedForApp("195.78.228.1", $app));
        $this->assertTrue($blacklistService->isIPBlacklistedForApp("195.78.8.2", $app));

        $this->assertFalse($blacklistService->isIPBlacklistedForApp("1.1.6.1", $app));
        $this->assertFalse($blacklistService->isIPBlacklistedForApp("193.219.95.100", $app));
        $this->assertFalse($blacklistService->isIPBlacklistedForApp("195.77.1.1", $app));
        $this->assertFalse($blacklistService->isIPBlacklistedForApp("195.0.0.0", $app));


    }



} 