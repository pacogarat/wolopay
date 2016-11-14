<?php

namespace AppBundle\Tests\Lib;


use DesiredCapabilities;
use RemoteWebDriver;
use Symfony\Component\DependencyInjection\Container;

ini_set("memory_limit","512M");
umask(0000);

abstract class E2ETestCase extends FunctionalTestCase
{
    /** @var RemoteWebDriver */
    protected $driver;

    /** @var String */
    protected $domain;

    public function setUp($env='test_dev')
    {
        parent::setUp($env);

        $host = $this->container->getParameter('selenium_server');

        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome(), 600000);
        $this->domain = $this->container->getParameter('domain_main');
        $this->driver->manage()->window()->maximize();

    }

    public function go($relativePathUrl, $absolute = false)
    {
        $this->driver->get(($absolute ? '' : $this->domain  ). $relativePathUrl);
    }

    public function takeScreen()
    {
        if ($this->driver)
        {
            $imagePath = $this->getFolderToScreenshots();
            $this->driver->takeScreenshot($imagePath);

            echo "\nImage created $imagePath\n";
        }
    }

    private function getFolderToScreenshots()
    {
        $folder = $this->container->getParameter('kernel.cache_dir'). '/../../screenshots_test';
        if (!file_exists($folder))
            mkdir($folder);

        return $folder . '/'.time() . '.png';
    }

    public function tearDown()
    {
        $status = $this->getStatus();
        if ($status == \PHPUnit_Runner_BaseTestRunner::STATUS_ERROR || $status == \PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE) {
            $this->takeScreen();
        }

        if ($this->driver)
        {
            $this->driver->quit();
            $this->driver=null;
        }

        parent::tearDown();
    }

    public function setMovilResolution()
    {
        $this->driver->manage()->window()->setSize(new \WebDriverDimension(400, 500));
    }

    public function setMaximize()
    {
        $this->driver->manage()->window()->maximize();
    }
}