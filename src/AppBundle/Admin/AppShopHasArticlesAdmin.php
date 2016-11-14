<?php

namespace AppBundle\Admin;

use AppBundle\Entity\AppShop;
use AppBundle\Entity\AppShopHasArticles;
use AppBundle\Entity\Article;
use AppBundle\Entity\Repository\AppShopRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AppShopHasArticlesAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_AppShopHasArticles';
    protected $baseRoutePattern = 'AppShopHasArticlesAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('article')
            ->add('country')
            ->add('offer')
            ->add('smsAlias')
            ->add('order')
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
            ->add('article')
            ->add('country')
            ->add('offer')
            ->add('smsAlias')
            ->add('order')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
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
        /** @var AppShopHasArticles $subject */
        $subject = $this->getSubject();

        if($this->hasParentFieldDescription()) {
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();

            if ($parent instanceof AppShop)
            {
                $formMapper
                    ->add('article', null, array('read_only' => true, 'disabled'  => true))
                    ->add('country', null, array('read_only' => true, 'disabled'  => true))
                    ->add('order', 'hidden',array('attr'=>array("hidden" => true)))
                ;
                return;
            }
        }

        /** @var \Doctrine\ORM\EntityManager $om */
        $om = $this->modelManager->getEntityManager('AppBundle\Entity\Article');

        $app = null;
        /** @var Article $parent  */
        if (($parent =$this->getRoot()->getSubject()) instanceof Article)
        {
            $app = $parent->getApp();
        }elseif ($subject && $subject->getArticle() && $subject->getArticle()->getApp()){
            $app = $subject->getArticle()->getApp();
        }

        if ($app)
        {
            $queryShop = $om->createQuery(AppShopRepository::sqlFindByApp())->setParameter('appId', $app->getId());

            $formMapper
                ->add('appShop', 'sonata_type_model', array('query' => $queryShop, 'btn_add' => false))
            ;
        }else{

            $formMapper
                ->add('appShop')
            ;
        }

        $formMapper
            ->add('article', 'sonata_type_model_hidden', array('attr'=>array("hidden" => true)))
            ->add('country')
            ->add('smsAlias')
            ->add('nameLabel', null, ['read_only' => true, 'disabled'  => true, 'property' => 'key'])
            ->add('descriptionLabel', null, ['read_only' => true, 'disabled'  => true, 'property' => 'key'])
            ->add('offer', null, array('read_only' => true, 'disabled'  => true, 'help' => 'To modify ofer go to offer Programer Section'))

        ;


//
//        $articleAmountToStringTransformer = new ArticleAmountToStringTransformer($om);

        $formMapper
//            ->add(
//                $formMapper->create('articleAmount', 'text')
//                    ->addModelTransformer($articleAmountToStringTransformer)
//            )

            ->add('order', 'hidden', array('attr'=>array("hidden" => true)))
        ;

//        $builder = $formMapper->getFormBuilder();
//
//        // throw event to add Country and Article to add Transformer
//        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) use ($articleAmountToStringTransformer, $builder) {
//
//                $data = $event->getData();
//
//                if (null === $data) {
//                    return;
//                }
//
//                $accessor    = PropertyAccess::createPropertyAccessor();
//                $country        = $accessor->getValue($data, '[country]');
//                $article         = $accessor->getValue($data, '[article]');
//
//                $articleAmountToStringTransformer->setCountry($country);
//                $articleAmountToStringTransformer->setArticle($article);
//
//        });

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('article')
            ->add('appShopArticleHasPMPCs')
            ->add('country')
            ->add('offer')
            ->add('smsAlias')
            ->add('order')
            ->add('createdAt')
        ;
    }
}
