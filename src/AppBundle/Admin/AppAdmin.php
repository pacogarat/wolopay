<?php

namespace AppBundle\Admin;


use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\Enum\CommissionBaseEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\AppShopHasArticleService;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Process\Process;
use Symfony\Component\Validator\Constraints\Currency;

class AppAdmin extends AbstractParentAdmin
{
    use ContainerAwareTrait;

    protected $baseRouteName = 'admin_app_bundle_App';
    protected $baseRoutePattern = 'app';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('logo')
            ->add('urlHomeSite')
            ->add('urlNotificationPayment')
            ->add('urlNotificationSubscription')
            ->add('urlNotificationExtra')
            ->add('active')
            ->add('appApiHasCredential.codeKey')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('translationDomain')
            ->add('active')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'add_article' => array(
                        'template' => '@App/Sonata/Article/new_article__action_log.html.twig'
                    ),
                    'import' => array(
                        'template' => '@App/Sonata/Article/new_article__action_import.html.twig'
                    ),
                    'edit_pmpc_to_all_articles' => array(
                        'template' => '@App/Sonata/Article/new_edit_pmpc_to_all_articles_action.html.twig'
                    ),
//                    'import_to_sandbox' => array(
//                        'template' => '@App/Sonata/App/app_import_to_sandbox_action.html.twig'
//                    ),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var App $app */
        $app = $this->getSubject();
        if ($app && $app->getId())
        {
            $formMapper
                ->add('client', null , ['read_only' => true, 'disabled' => true])
                ->add('translationDomain', null , ['read_only' => true, 'disabled' => true, 'help' => 'when u insert a new translation for this game u must use this translation domain'])
//                ->add('appHasPayMethodProviderCountry', 'sonata_type_model', array('multiple' => true, 'by_reference' => false))
            ;
        }else{
            $formMapper
                ->add('client')
            ;
        }
        $formMapper
            ->add('name')
            ->add('countries', null, ['help' => 'Countries to auto add paymethod providers'])
            ->add('urlHomeSite')
            ->add('logo', 'sonata_media_type', [
                    'required' => ($app && $app->getLogo() ? false : true ),
                    'provider' => 'sonata.media.provider.image',
                    'context'  => App::SONATA_CONTEXT,
                    'new_on_update' => false,
                ]
            )
            ->add('ownerEmail')
            ->add('administrationEmail')
            ->add('technicalEmail')
            ->add('endUserSupportEmail')
            ->add('urlNotificationPayment')
            ->add('urlNotificationSubscription')
            ->add('urlNotificationExtra')
            ->add('internalPaymentNotificationUrl')
            ->add('notificationRetriesOnFailure','integer')
            ->add('commissionBase', ChoiceType::class,
                [
                    'choices' => [
                        CommissionBaseEnum::ENDUSERPRICE =>'End User Price',
                        CommissionBaseEnum::WOLOPAYNET => 'Wolopay Net Commission',
                    ]
                ]
            )
            ->add('commissionCurrency')
            ->add('commissionPercent')
            ->add('commissionMin')
            ->add('commissionMax')
            ->add('smsAlias')
//            ->with('Api Credentials')
                ->add('appApiHasCredential', 'sonata_type_admin',  array('btn_add' => false, 'btn_delete' => false))
//            ->end()
            ->add('appShops', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
            ->add('active')
        ;

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('translationDomain')
            ->add('ownerEmail')
            ->add('administrationEmail')
            ->add('technicalEmail')
            ->add('endUserSupportEmail')
            ->add('urlHomeSite')
            ->add('urlLogo')
            ->add('urlNotificationPayment')
            ->add('urlNotificationSubscription')
            ->add('urlNotificationExtra')
            ->add('internalPaymentNotificationUrl')
            ->add('pgTaxPercent')
            ->add('smsAlias')
            ->add('appApiHasCredential')
            ->add('appShops')
            ->add('payMethodProviderHasCountries')
            ->add('active')
            ->add('createdAt')
            ->add('appHasPayMethodProviderCountry')
        ;
    }

    public function getNewInstance()
    {
        /** @var App $app */
        $app= parent::getNewInstance();

        /** @var EntityManager $em */
        $em = $this->getEntityManager('AppBundle\Entity\LevelCategory');
        $repo= $em->getRepository('AppBundle:LevelCategory');

        $appShop = new AppShop();
        $appShop
            ->setLevelCategory($em->getRepository("AppBundle:LevelCategory")->find(LevelCategoryEnum::ROOKIE_ID))
            ->setName('Rookie')
        ;

        $app
            ->addAppShop($appShop)
            ->setTaxPercentApplicable(5)
            ->setCommissionBase(CommissionBaseEnum::WOLOPAYNET)
            ->setCommissionPercent(10)
            ->setCommissionFixedFee(null)
            ->setCommissionCurrency($em->getRepository('AppBundle:Currency')->find(CurrencyEnum::EURO))
            ->setCommissionMax(0.10)
            ->setCommissionMin(0.01)
        ;

        $app->setAppApiHasCredential(new AppApiCredentials($app));

        return $app;
    }

    /**
     * @return array|\AppBundle\Entity\PayMethodProviderHasCountry[]
     */
    private function getPayMethodProviderHasCountry($countries=null)
    {
        /** @var EntityManager $em */
        $em = $this->getEntityManager('AppBundle\Entity\PayMethodProviderHasCountry');

        return $em->getRepository("AppBundle:PayMethodProviderHasCountry")->findByDefault($countries);
    }

    /**
     * @param App $object
     * @return mixed|void
     */
    public function prePersist($object)
    {
        $this->addPayMethodsDefault($object);
    }

    public function preUpdate($object)
    {
        $this->addPayMethodsDefault($object);
    }

    /**
     * @param App $object
     */
    private function addPayMethodsDefault($object)
    {
        if ($object->getAppHasPayMethodProviderCountry()->isEmpty())
        {
            $pmpcs = $this->getPayMethodProviderHasCountry(UtilHelper::getIdsArrayFromObjects($object->getCountries()));
            foreach ($pmpcs as $pmpc)
            {
                $object->addAppHasPayMethodProviderCountry(new AppHasPayMethodProviderCountry($pmpc, $object));
            }
        }

    }

    /**
     * @param App $object
     * @throws \RuntimeException
     * @return mixed|void
     */
    public function postUpdate($object){
//        if (strpos(__DIR__, '/wolopay.com/')===false)
//            return;

       $appId = $object->getId();
       $countries = $object->getCountries();

        /** @var AppShopHasArticleService $appShopHasArticleService */
        $appShopHasArticleService = $this->container->get('app_shop_has_article');
        /** @var EntityManager $em */
        $em = $this->getEntityManager('AppBundle\Entity\AppHasPayMethodProviderHasCountry');

        $offersDeleted = $appShopHasArticleService->deleteOffers_OfNotExistingASHAs($object);
        $ashaDeleted = $appShopHasArticleService->deleteASHA_OfRemovedCountriesOfApp($object);

        $app_HasPMPCs_deleted = $em->getRepository("AppBundle:AppHasPayMethodProviderCountry")->deleteByAppIdAndCountries($appId, $countries);

        $appShopHasArticleService->syncAllAppShopHasArticlesWithAppTabIfEnabled($object);

        /** @var \Symfony\Component\HttpFoundation\Session\*/
        $session = $this->container->get('session');

        $obj = $session->getFlashBag();

        $obj->add("success", "Offers DELETED: " . $offersDeleted);
        $obj->add("success", "App_HasPMPCs DELETED: " . $app_HasPMPCs_deleted);
        $obj->add("success", "AppShopHasArticles DELETED: " . $ashaDeleted);
    }

    /**
     * @param App $object
     * @throws \RuntimeException
     * @return mixed|void
     */
    public function postPersist($object)
    {
        if (strpos(__DIR__, '/wolopay.com/')===false)
            return;

        $values = [
            $object->getAppApiHasCredential()->getCodeKey(),
            $object->getAppApiHasCredential()->getSecretKey(),
            $object->getName(),
            $object->getUrlNotificationPayment(),
            $object->getUrlNotificationSubscription(),
            $object->getUrlNotificationExtra(),
            $object->getUrlHomeSite(),
        ];

        file_put_contents(sys_get_temp_dir().'/serialize.txt', implode(";;", $values));
        $path = '/furanet/sites/sandbox.wolopay.com/web/htdocs/deploy/current';

        $process = new Process($this->container->getParameter('php_exe_path').' '.$path.'/bin/console app:export:sandbox --env=prod');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getOutput(). $process->getErrorOutput());
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('import_to_sandbox', '{appId}/import-to-sandbox');
        $collection->add('edit_apmpc', '{appId}/edit_apmpc');
    }
}
