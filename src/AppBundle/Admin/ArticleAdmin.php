<?php

namespace AppBundle\Admin;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\Article;
use AppBundle\Entity\Repository\ItemRepository;
use AppBundle\Entity\Repository\TransUnitRepositoryStatic;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Translation\Translator;

class ArticleAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Article';
    protected $baseRoutePattern = 'ArticleAdmin';

    use ContainerAwareTrait;

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('app')
            ->add('articleCategory')
            ->add('nPurchasesPerClient')
            ->add('itemsQuantity')
            ->add('image')
            ->add('periodicity')
            ->add('active')
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
            ->add('app')
            ->add('articleCategory')
            ->add('itemsQuantity')
            ->add('item.name')
            ->add('image')
            ->add('nPurchasesPerClient')
            ->add('periodicity')
            ->add('active')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
//                    'edit' => array(),
                    'copy' => array(
                        'template' => '@App/Sonata/Article/new_article__action_copy.html.twig'
                    ),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Article $subject */
        $subject = $this->getSubject();

        $om = $this->getEntityManager();

        if ($subject && !$subject->getApp())
        {
            $formMapper->add('app');
        }else{
            $formMapper->add('app', null, array( 'disabled'  => true));
        }

        $appId=null;

        if (!$subject && !$subject->getApp())
            $appId = (isset($_SESSION['app_id']) ? $_SESSION['app_id'] : '');
        else if ($subject->getApp())
            $appId = $subject->getApp()->getId();
        // commented because it is also called from ajax
        //        else
        //            die("create article from app option!");

        if ($appId)
            $_SESSION['app_id'] = $appId;

        if ($appId)
            $queryItem = $om->createQuery(ItemRepository::sqlFindByApp())->setParameter('appId', $appId);
        else
            $queryItem = null;

        $formMapper
            ->add('articleCategory')
            ->add('itemsQuantity')
            ->add('periodicity', null, ['help' => 'Periodicity to subscription items'])
            ->add('item', 'sonata_type_model', array('query' => $queryItem))

        ;

        $queryLabel=null;

        $requestParameters = $this->request->request->get($this->request->query->get('uniqid'));

        // todo

        if (!$subject->getId() && !$subject->getArticleHasPMPCs() && isset($requestParameters['articleHasPMPCs'])
        )
        {

        }else{

            $queryLabel = null;
            if ($subject->getApp())
                $queryLabel = $om->createQuery(TransUnitRepositoryStatic::sqlFindByDomain())->setParameter('domain', $subject->getApp()->getTranslationDomain());

//            $queryArticleHasPMPC = $om->createQuery(ArticleHasPMPCRepository::sqlFindByApp())->setParameter('appId', $appId);

            $formMapper


//                ->with('Amounts')
                    ->add('articleAmounts', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
//                ->end()
//                ->with('Select shop')
                    ->add('appShopHasArticles', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
//                ->end()
//                ->with('Pay Methods and his Order')
                    ->add('articleHasPMPCs', 'sonata_type_collection', array('by_reference' => false), array('help'=> 'Drag and drop items to set order', 'edit' => 'inline', 'inline' => 'table', 'sortable' => 'order'))
//                ->end()
//                ->with('Offers')
                    ->add('offerProgrammers', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
//                ->end()
            ;
        }

        $formMapper
            ->add('image', 'sonata_media_type', [
                    'required' => false,
                    'provider' => 'sonata.media.provider.image',
                    'context'  => Article::SONATA_CONTEXT,
                    'new_on_update' => false,
                    'help' => 'overwrite image to item'
                ])
            ->add('nameLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' => false,
                    'help' => 'overwrite name of item now is: '.
                        ($subject->getItem() ? $subject->getNameCurrentKeyLabel() : 'unset')
                ])
            ->add('descriptionLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' => false,
                    'help' => 'overwrite name of item now is: '.
                        ($subject->getItem() ? $subject->getDescriptionCurrentKeyLabel() : 'unset')
                ])
            ->add('nPurchasesPerClient', null, ['help' => 'To Subscriptions → N active subscriptions, To Other → N purchases. If value is empty = null = ∞ purchases/subscriptions'])
            ->add('active', null, array('required' => false))
        ;
    }



    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('number')
            ->add('articleCategory')
            ->add('image')
            ->add('periodicity')

            ->add('item')
            ->add('articleAmounts')
            ->add('appShopHasArticles')
            ->add('articleHasPMPCs')
            ->add('offerProgrammers')

            ->add('nPurchasesPerClient')
            ->add('active')
            ->add('createdAt')
        ;
    }

    public function getNewInstance()
    {
        /** @var Article $article */
        $article = parent::getNewInstance();

        $em = $this->modelManager->getEntityManager('AppBundle\Entity\App');

        if ($articleId = $this->request->get('copy'))
        {
            $article       = $em->getRepository('AppBundle:Article')->find($articleId);
            $articleCloned = clone $article;

            return $articleCloned;
        }

        if (!$appId = $this->request->get('appId'))
        {
            return $article;
        }

        $_SESSION['app_id']=$appId;


        $app = $em->getRepository('AppBundle:App')->find($appId);
        $article->setApp($app);

        return $article;
    }

    /**
     * @param Article $object
     * @return mixed|void
     */
    public function postPersist($object)
    {
        $em = $this->getEntityManager();

        if ($object->getArticleHasPMPCs()->isEmpty())
        {
            $pmpcs = $em->getRepository("AppBundle:PayMethodProviderHasCountry")
                ->findByAppAndArticleCategoryId($object->getApp()->getId(), $object->getArticleCategory()->getId());

            foreach ($pmpcs as $pmpc)
                $object->addArticleHasPMPC(new ArticleHasPMPC($pmpc));

            if ($object->getArticleAmounts()->isEmpty())
            {
                $countries = $object->getApp()->getCountries();
                $appShops = $em->getRepository("AppBundle:AppShop")->findByApp($object->getApp()->getId());

                foreach ($countries as $country)
                {
                    $object->addArticleAmount(new ArticleAmount($object, $country, 0));

                    foreach ($appShops as $appShop)
                        $object->addAppShopHasArticle( new AppShopHasArticles($country, null, $appShop));
                }
            }

            $em->persist($object);
            $em->flush();
        }

    }

    /**
     * @param Article $object
     */
    public function postUpdate($object)
    {
        $this->reconfigureAllOffers($object);
    }



    /**
     * @param Article $object
     */
    private function reconfigureAllOffers($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        /** @var OfferCommand $offerCommand */
        $offerCommand = $container->get('command.shop.offer.sync');
        $offerCommand->reconfigureAllOfferProgrammersRelatedByArticleId($object->getId());
    }

    /**
     * @param Article $object
     * @return Metadata|\Sonata\CoreBundle\Model\Metadata
     */
    public function getObjectMetadata($object)
    {
        $image = $object->getImageCurrent();
        $provider = $this->container->get($image->getProviderName());
        /** @var Translator $trans */
        $trans = $this->container->get('translator');

        $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'admin'));

        return new Metadata(
            $object->getNameCurrentKeyLabel(), // $trans->trans($object->getNameCurrentLabel()->getKey(),[], $object->getNameCurrentLabel()->getDomain()),
            $object->getDescriptionCurrentKeyLabel(), // $trans->trans($object->getDescriptionCurrentLabel()->getKey(),[], $object->getDescriptionCurrentLabel()->getDomain()),
            $url
        );
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('import_csv', '{appId}/importcsv');
    }
}
