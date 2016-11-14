<?php

namespace AppBundle\Tests\Unit;

use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;


abstract class AbstractUnit  extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $em;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $entityRepository;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $logger;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $currencyService;

    public function setUp()
    {
        parent::setUp();

        $this->em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyService = $this->getMockBuilder(CurrencyService::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

}