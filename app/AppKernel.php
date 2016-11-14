<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    // To fix issue https://github.com/symfony/symfony/issues/12893
    protected $varDir;

    /**
     * {@inheritdoc}
     */
    public function __construct($environment, $debug)
    {
        $this->rootDir = __DIR__;

        $this->varDir  = dirname($this->rootDir) . '/var';

        date_default_timezone_set('UTC');

        parent::__construct($environment, $debug);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return $this->varDir . '/cache/' . $this->environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return $this->varDir . '/logs';
    }
    // end fix

    public function registerBundles()
    {
        $bundles = array(

            // Framework
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // Ours
            new \AppBundle\AppBundle(),

            /** extra third vendors  */
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Misd\GuzzleBundle\MisdGuzzleBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            // Api or related
            new Gfreeau\Bundle\GetJWTBundle\GfreeauGetJWTBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
            new Escape\WSSEAuthenticationBundle\EscapeWSSEAuthenticationBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),

            new FOS\UserBundle\FOSUserBundle(),

            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),

            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\AopBundle\JMSAopBundle(),

            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),

            new Sonata\AdminBundle\SonataAdminBundle(),

            new \Pix\SortableBehaviorBundle\PixSortableBehaviorBundle(),


            // If you haven't already, add the storage bundle
            // This example uses SonataDoctrineORMAdmin but
            // it works the same with the alternatives
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Ibrows\SonataTranslationBundle\IbrowsSonataTranslationBundle(),

            new BeSimple\SoapBundle\BeSimpleSoapBundle(),

            //Faker to load fake data, for demos
            new Bazinga\Bundle\FakerBundle\BazingaFakerBundle(),

            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Matthias\SymfonyConsoleForm\Bundle\SymfonyConsoleFormBundle(),
            new \EightPoints\Bundle\GuzzleBundle\GuzzleBundle()

        );


        if (in_array($this->getEnvironment(), array('dev', 'test', 'test_dev' ))) {

            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        if (in_array($this->getEnvironment(), array('prod_benchmark' ))) {

            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

}
