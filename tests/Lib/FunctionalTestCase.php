<?php

namespace AppBundle\Tests\Lib;

use AppBundle\DataFixtures\ORM\LoadApp;
use AppBundle\DataFixtures\ORM\LoadAppApiCredentials;
use AppBundle\DataFixtures\ORM\LoadArticle;
use AppBundle\DataFixtures\ORM\LoadArticleCategory;
use AppBundle\DataFixtures\ORM\LoadClient;
use AppBundle\DataFixtures\ORM\LoadCountry;
use AppBundle\DataFixtures\ORM\LoadCurrency;
use AppBundle\DataFixtures\ORM\LoadLanguage;
use AppBundle\DataFixtures\ORM\LoadProvider;
use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Util\WSSEUtil;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Router;


umask(0000);

/**
 * Test case class helpful with Entity tests requiring the database interaction.
 * For regular entity tests it's better to extend standard \PHPUnit_Framework_TestCase instead.
 */
abstract class FunctionalTestCase extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Router
     */
    protected $router;

    private static $schemaGeneratedLite = false;
    private static $schemaGeneratedMemo = false;

    /**
     * @param string $env test|test_dev
     * @return null
     */
    public function setUp($env='test')
    {
//        echo "INI - INI ";
//        $this->printMemoryUsage();
        if ($env=='test')
        {
            static::bootKernel(['environment' => $env]);

            $this->client  = static::$kernel->getContainer()->get('test.client_without_shutdown');
            $this->client->setServerParameters([]);

        }else{
            $this->client = $this->createClient(['environment' => $env]);
        }


        $this->client->followRedirects();
        $this->container = self::$kernel->getContainer();
        $this->container->get('translator');

        $this->em = $this->container->get('doctrine')->getManager();
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

        $this->router = $this->container->get('router');

        if ($this->em->getConnection()->getDatabase() && $this->em->getConnection()->getDatabasePlatform()->getName() == 'sqlite' )
        {
            // sqlite with file
            $temp_file = sys_get_temp_dir().'/schema_lite_created.tmp';
            $time = null;
            if (file_exists($temp_file))
            {
                $time = file_get_contents($temp_file);
            }

            if (!$time || ($time + (30 * 60)) < time())
            {
                $this->generateSchema();
            }

            file_put_contents($temp_file, time());

            self::$schemaGeneratedLite= true;
        }else{
            $this->generateSchema();
        }

//        echo "INI - FIN ";
//        $this->printMemoryUsage();
    }



    protected function generateSchema()
    {
        $metadatas = $this->getMetadatas();

        if (!empty($metadatas)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
            $tool->dropSchema($metadatas);
            $tool->createSchema($metadatas);
        }
    }

    protected function getSchemaSQL()
    {
        $metadatas = $this->getMetadatas();

        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
        return $tool->getCreateSchemaSql($metadatas);

    }

    /**
     * @return array
     */
    protected function getMetadatas()
    {
        return $this->em->getMetadataFactory()->getAllMetadata();
    }

    /**
     * One Fixture
     *
     * @param FixtureInterface $fix
     */
    protected function loadFixture(FixtureInterface $fix)
    {
        $loader = new Loader();
        $loader->addFixture($fix);
        $this->executeFixtures($loader);
    }

    /**
     * Fixtures
     *
     * @param FixtureInterface[] $fixtures
     */
    protected function loadFixtures(array $fixtures)
    {
        $loader = new Loader();

        $fixtures[]= new LoadLanguage();
        $fixtures[]= new LoadCurrency();
        $fixtures[]= new LoadCountry();
        $fixtures[]= new LoadClient();
        $fixtures[]= new LoadProvider();
        $fixtures[]= new LoadApp();
        $fixtures[]= new LoadAppApiCredentials();
        $fixtures[]= new LoadArticleCategory();
        $fixtures[]= new LoadArticle();

        foreach ($fixtures as $fix)
            $loader->addFixture($fix);

        $this->executeFixtures($loader);
    }

    protected function loadAllFixtures($extraFixtures=[])
    {
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__.'/../../src/AppBundle/DataFixtures/ORM');

        foreach ($extraFixtures as $fix)
            $loader->addFixture($fix);

        $this->executeFixtures($loader);

    }

    /**
     * Load and execute fixtures from a directory
     *
     * @param string $directory
     *
     */
    protected function loadFixturesFromDirectory($directory)
    {
        $loader = new Loader();
        $loader->loadFromDirectory($directory);
        $this->executeFixtures($loader);
    }

    /**
     * Executes fixtures
     *
     * @param \Doctrine\Common\DataFixtures\Loader $loader
     */
    protected function executeFixtures(Loader $loader)
    {
        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);

        foreach ($loader->getFixtures() as $fixture)
        {
            if (method_exists($fixture, 'setContainer'))
            {
                $fixture->setContainer($this->container);
            }
        }

        $executor->execute($loader->getFixtures());

        $purger=null;
        $executor=null;
        $loader=null;
    }

    /**
     * @param $command
     * @param string $env
     * @return Process
     */
    protected function executeCommand($command, $env='test')
    {
        $process = new Process("php ".$this->container->getParameter('kernel.root_dir') ."/../bin/console $command --env=$env ");

        return $process;
    }

    protected function showHtml($crawler)
    {
        $html = '';

        foreach ($crawler as $domElement) {
            $html.= $domElement->ownerDocument->saveHTML();
        }

        echo $html;
    }

    /**
     * @param string $appName
     * @return AppApiCredentials
     */
    protected function setJWTokenValidToClientRequest($appName='Demo')
    {
        $credential = $this->getCredentialsValidApiUser($appName);
        $this->assertNotEmpty($credential);
        $this->client->setServerParameter('HTTP_Authorization', $this->getJWToken($credential->getCodeKey()));
        $this->client->setServerParameter('HTTP_Accept', 'application/json');

        return $credential;
    }

    protected function setJWTokenInvalidToClientRequest()
    {
        /** @var AppApiCredentials $credential */
        $this->client->setServerParameter('HTTP_Authorization', $this->getJWToken('no soy nadie'));
    }

    /**
     * @return null
     */
    protected function setHeaderWSSEInvalidToClientRequest()
    {
        $this->setHeaderWSSE('No Existo', 'No exisitooo');

        return null;
    }

    /**
     * @param string $appName
     * @return AppApiCredentials
     */
    protected function setHeaderWSSEValidToClientRequest($appName='Demo')
    {
        $credential = $this->getCredentialsValidApiUser($appName);
        $this->setHeaderWSSE($credential->getCodeKey(), $credential->getSecretKey());

        return $credential;
    }

    /**
     * @param $appName
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     * @return AppApiCredentials
     */
    protected function getCredentialsValidApiUser($appName='Demo')
    {
        $app = $this->getApp($appName);

        if( !$credentials = $this->em->getRepository("AppBundle:AppApiCredentials")->findOneByApp($app->getId()))
        {
            throw new Exception("App: $appName haven't credentials");
        }

        return $credentials;
    }

    /**
     * @param string $appName
     * @return App
     */
    protected function getApp($appName='Demo')
    {
        return $this->em->getRepository("AppBundle:App")->findOneByName($appName);
    }

    private function setHeaderWSSE($username, $password)
    {
        $header = $this->generateHeaderWSSE($username, $password);
        // WebTestCase require HTTP_ prefix without it he won't send the header....
        $this->client->setServerParameter('HTTP_X-WSSE', $header);
        $this->client->setServerParameter('HTTP_Accept', 'application/json');
    }

    private function generateHeaderWSSE($username, $secret)
    {
        return WSSEUtil::generateHeaderWSSE($username, $secret);
    }

    private function getJWToken($username)
    {
        /** @var \Namshi\JOSE\JWS $val */
        $jwtLib = $this->client->getContainer()->get('lexik_jwt_authentication.jwt_encoder');
        $tokenString = $jwtLib->encode([
            'username' => $username,
        ]);

        return sprintf('Bearer %s', $tokenString);
    }

    public function tearDown()
    {
//        echo "FIN - INI ";
//        $this->printMemoryUsage();

        if ($this->em)
        {
            $this->em->clear();
        }

//        if ($this->container)
//        {
//            $refl = new \ReflectionObject($this->container);
//            foreach ($refl->getProperties() as $prop) {
//                $prop->setAccessible(true);
//                $prop->setValue($this->container, null);
//            }
//        }

        parent::tearDown();
        static::$kernel = null;

        gc_collect_cycles();

//        $refl = new \ReflectionObject($this);
//        foreach ($refl->getProperties() as $prop)
//        {
//            if (! 'PHPUnit_Framework_TestCase' === $prop->class)
//            {
//                $prop->setAccessible(true);
//                $prop->setValue($this, null);
//            }
//        }

//        echo "FIN - FIN ";
//        $this->printMemoryUsage();
    }


    /**
     * @param AppApiCredentials $userApi
     * @param int $gamerLevel
     * @param null $gamerExternalId
     * @return \AppBundle\Entity\Transaction
     */
    public function createTransaction(AppApiCredentials $userApi, $gamerLevel=LevelCategoryEnum::ROOKIE_ID, $gamerExternalId=null)
    {
        $gamerExternalId = $gamerExternalId ? $gamerExternalId : time();

        $transactionCreate = $this->container->get('shop.command.transaction.create');
        $transaction = $transactionCreate->createTransactionParams(
            $userApi->getCodeKey(),
            $gamerExternalId,
            $gamerLevel
        );

        $transaction->getGamer()->setEmail('mgarcia@nviasms.com');
        $transaction->setTutorialEnabled(false);
        $this->em->flush();

        return $transaction;
    }

    protected function getDomaintoTest()
    {
        return $this->container->getParameter('domain_main');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockDoctrineCreate()
    {
        $mockEM=$this->getMock('\Doctrine\ORM\EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush'), array(), '', false);

        $mockEM->expects($this->any())
            ->method('getClassMetadata')
            ->will($this->returnValue((object)array('name' => 'aClass')));
        $mockEM->expects($this->any())
            ->method('persist')
            ->will($this->returnValue(null));
        $mockEM->expects($this->any())
            ->method('flush')
            ->will($this->returnValue(null));

        return $mockEM;
    }

    protected function mockedLoadDoctrineRepository(\PHPUnit_Framework_MockObject_MockObject $mockEM, $repository, $repositoryName, $repositoryMethod,$repositoryMethodReturnVal, $parameter=null) {

        $mockSVRepo=$this->getMock($repository,array($repositoryMethod),array(),'',false);

        $mockSVRepo
            ->expects($this->any())
            ->method($repositoryMethod)
            ->with(($parameter? $parameter : $this->any()))
            ->will($this->returnValue($repositoryMethodReturnVal));
        ;

        $mockEM->expects($this->any())
            ->method('getRepository')
            ->with($repositoryName)
            ->will($this->returnValue($mockSVRepo));

        return $mockEM;
    }

    protected function logIn($user='mgarcia', $password=123)
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->filterXPath('//button')->form();

        $form['_username']=$user;
        $form['_password']=$password;

        $this->client->submit($form);

//        $user =$this->em->getRepository("AppBundle:ClientUser")->findOneBy(['username'=>$user]);
//
//        $session = $this->client->getContainer()->get('session');
//        $token = new UsernamePasswordToken($user, null, $firewall, $user->getRoles());
//
//        $session->set('_security_'.$firewall, serialize($token));
//        $session->save();
//
//        $cookie = new Cookie($session->getName(), $session->getId());
//        $this->client->getCookieJar()->set($cookie);
    }

    function printMemoryUsage($extra='')
    {
        echo sprintf($extra.' Memory usage (currently) %dKB/ (max) %dKB', round(memory_get_usage(true) / 1024), memory_get_peak_usage(true) / 1024). "\n";
    }

    protected function exeCacheWarmup($env='test')
    {
        $process = new Process('php '.$this->container->getParameter('kernel.root_dir').'/../bin/console cache:warmup --env='.$env);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }


}