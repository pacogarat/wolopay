<?php

namespace AppBundle\Tests\Lib;

//
//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\DataFixtures\Loader;
//use Doctrine\ORM\EntityManager;
//use AppBundle\DataFixtures\ORM\LoadAppApiCredentials;
//use AppBundle\Entity\AppApiCredentials;
//use AppBundle\DataFixtures\ORM\LoadClient;
//use AppBundle\DataFixtures\ORM\LoadCompany;
//use AppBundle\DataFixtures\ORM\LoadCountry;
//use AppBundle\DataFixtures\ORM\LoadCurrency;
//use AppBundle\DataFixtures\ORM\LoadLanguage;
//use AppBundle\DataFixtures\ORM\LoadApp;
//use PHPUnit_Extensions_SeleniumTestCase;
//use Symfony\Component\DependencyInjection\Container;
//use Symfony\Component\Process\Process;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Bundle\FrameworkBundle\Client;
//use Symfony\Component\Routing\Router;
//use Doctrine\Common\DataFixtures\Purger\ORMPurger;
//use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
//
//
//abstract class SeleniumTestCase extends PHPUnit_Extensions_SeleniumTestCase
//{
//    public static $browsers = array(
//
//        array(
//            'name'    => 'Chrome on Windows',
//            'browser' => '*chrome',
//            'host'    => 'localhost',
//            'port'    => 4444,
//            'timeout' => 30000,
//        ),
////        array(
////            'name'    => 'Firefox on Windows',
////            'browser' => '*firefox',
////            'host'    => 'localhost',
////            'port'    => 4444,
////            'timeout' => 30000,
////        ),
////        array(
////            'name'    => 'Internet Explorer on Windows',
////            'browser' => '*iexplore',
////            'host'    => 'localhost',
////            'port'    => 4444,
////            'timeout' => 30000,
////        )
//    );
//
//    /**
//     * @var EntityManager
//     */
//    protected $em;
//
//    /**
//     * @var Container
//     */
//    protected $container;
//
//    /**
//     * @var Client
//     */
//    protected $client;
//
//    /**
//     * @var Router
//     */
//    protected $router;
//
//    /**
//     * @var FunctionalTestCase
//     */
//    protected $functionalTestCase;
//
//
//    protected function setUp()
//    {
//        $this->functionalTestCase = new FunctionalTestCase();
//        $this->functionalTestCase->setUp();
//
//        $this->container = $this->functionalTestCase->container;
//        $this->em        = $this->functionalTestCase->em;
//        $this->om        = $this->functionalTestCase->om;
//        $this->router    = $this->functionalTestCase->router;
//
//        $this->setBrowserUrl($this->container->getParameter('domain_main'));
//    }
//
//
//    protected function tearDown()
//    {
//        $this->functionalTestCase->tearDown();
//    }
//}