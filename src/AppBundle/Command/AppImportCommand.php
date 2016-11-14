<?php

namespace AppBundle\Command;


use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Client;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CommissionBaseEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Lexik\Bundle\TranslationBundle\Entity\Translation;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("app.import_temp")
 * @Tag("console.command")
 */
class AppImportCommand extends Command
{
    use SonataMedia;

    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;


    protected function configure()
    {
        $this
            ->setName('app:export:sandbox')
            ->setDescription('Import to sandbox environment')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (strpos(__DIR__, 'sandbox')===false)
            throw new \Exception("This command is only for sandbox");

        $txt = file_get_contents(sys_get_temp_dir().'/serialize.txt');
        if (!$txt)
            throw new \Exception("file doesn't exist");

        $vars = explode(";;", $txt);


//        $values = [
//            $object->getAppApiHasCredential()->getCodeKey(),
//            $object->getAppApiHasCredential()->getSecretKey(),
//            $object->getName(),
//            $object->getUrlNotificationPayment(),
//            $object->getUrlNotificationSubscription(),
//            $object->getUrlExtra(),
//            $object->getUrlHomeSite(),
//        ];

        $countryOther = $this->em->getRepository("AppBundle:Country")->find(CountryEnum::OTHER);

        $client = new Client();
        $client
            ->setName($vars[2].' test')
            ->setCif(rand(0,9999999))
            ->setCountry($countryOther)
            ->setNameCompany($vars[2].' test')
        ;

        $this->em->persist($client);
        $this->em->flush();

        $appApi = new AppApiCredentials();
        $appApi
            ->setCodeKey($vars[0])
            ->setSecretKey($vars[1])
        ;

        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/../DataFixtures/ORM/img/promo_code.png', App::SONATA_CONTEXT);

        $app = new App();
        $app
            ->setAppApiHasCredential($appApi)
            ->setName($vars[2].'- AUTO COPY')
            ->setUrlNotificationPayment($vars[3])
            ->setUrlNotificationSubscription($vars[4])
            ->setUrlNotificationExtra($vars[5])
            ->setUrlHomeSite($vars[6])
            ->setLogo($media)
            ->setTaxPercentApplicable(5)
            ->setClient($client)
            ->setCommissionBase(CommissionBaseEnum::WOLOPAYNET)
            ->setCommissionCurrency($this->em->getRepository('AppBundle:Currency')->find(CurrencyEnum::EURO))
        ;

        $countries = $this->em->getRepository("AppBundle:Country")->findAll();
        $app->addCountry($countryOther);

        $pmpcs = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findBy(['country' => $countryOther]);
        foreach ($pmpcs as $pmpc)
        {
            $app->addAppHasPayMethodProviderCountry(new AppHasPayMethodProviderCountry($pmpc, $app));
        }

        $appApi->setApp($app);

        $pms=$this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findAll();
        foreach ($pms as $pm)
        {
            $app->addAppHasPayMethodProviderCountry(new AppHasPayMethodProviderCountry($pm, $app));
        }

        $this->em->persist($app);
        $this->em->flush();

        $appShop = new AppShop();
        $appShop
            ->setCss($this->em->getRepository("AppBundle:ShopCss")->findOneBy(['cssUrl'=>'theme_default.less']))
            ->setName('test')
            ->setLevelCategory($this->em->getRepository("AppBundle:LevelCategory")->find(LevelCategoryEnum::ROOKIE_ID))
            ->setApp($app)
        ;
        $this->em->persist($appShop);
        $this->em->flush();

        $test = new TransUnit();

        $test->setDomain($app->getTranslationDomain());
        $test->setKey('test');

        $transEn = new Translation();
        $transEn->setLocale('en');

        $transEn->setContent('Sandbox article, {[{number}]}');
        $test->addTranslation($transEn);

        $this->em->persist($test);

        $testDesc = new TransUnit();

        $testDesc->setDomain($app->getTranslationDomain());
        $testDesc->setKey('test_desc');

        $transEn = new Translation();
        $transEn->setLocale('en');

        $transEn->setContent('Sandbox article, {[{number}]}');
        $testDesc->addTranslation($transEn);

        $this->em->persist($testDesc);

        $this->em->flush();

        $itemExample = $this->em->getRepository("AppBundle:Item")->findOneBy([]);
        $item = clone($itemExample);
        $item
            ->setApp($app)
            ->setNameLabel($test)
            ->setDescriptionLabel($testDesc)
        ;

        $this->em->persist($item);
        $this->em->flush();

        $article = new Article();

        $article
            ->setApp($app)
            ->setItem($item)
            ->setItemsQuantity(7)
            ->setArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID))
            ->setAmountStandard(2)
        ;

        $this->em->persist($article);
        $this->em->flush();

        $asha = new AppShopHasArticle($countryOther,$article, $appShop, 2);

        foreach ($pms as $pm)
        {
            if ($pm->getCountry()->getId() == $countryOther->getId() && $pm->getProvider()->getName() == 'PayPal' && $pm->getPayMethod()->getArticleCategory()->getId() == ArticleCategoryEnum::SINGLE_PAYMENT_ID)
            {
                $asha->addAppShopArticleHasPMPC(new AppShopArticleHasPMPC($pm, $asha));
                break;
            }
        }

//        $this->em->persist($aM);
//        $this->em->flush();
        $this->em->persist($asha);
        $this->em->flush();

        $articleSub = new Article();

        $articleSub
            ->setApp($app)
            ->setItem($item)
            ->setArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID))
            ->setItemsQuantity(50)
            ->setAmountStandard(8)
            ->setPeriodicity(1)
        ;

        $this->em->persist($articleSub);
        $this->em->flush();

        $asha=new AppShopHasArticle($countryOther,$articleSub,$appShop, 8);

        foreach ($pms as $pm)
        {
            if ($pm->getCountry()->getId() == $countryOther->getId() && $pm->getProvider()->getName() == 'PayPal' && $pm->getPayMethod()->getArticleCategory()->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
            {
                $asha->addAppShopArticleHasPMPC(new AppShopArticleHasPMPC($pm, $asha));
                break;
            }
        }

        $this->em->persist($asha);
        $this->em->flush();
    }


} 