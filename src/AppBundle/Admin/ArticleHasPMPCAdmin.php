<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Article;
use AppBundle\Entity\Repository\PayMethodProviderHasCountryRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleHasPMPCAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_ArticleHasPMPC';
    protected $baseRoutePattern = 'ArticleHasPMPCAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('order')
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
            ->add('order')
            ->add('active')
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
        /** @var ArticleHasPMPC $subject */
        $subject = $this->getSubject();
        if ($this->getRoot() instanceof ArticleAdmin )
        {
            /** @var Article $parent */
            $parent = $this->getRoot()->getSubject();

            if ($parent && $parent->getId())
            {

                /** @var \Doctrine\ORM\EntityManager $om */
                $om = $this->modelManager->getEntityManager($parent);
                $queryPMPC = $parent->getApp() ?  $om->createQuery(PayMethodProviderHasCountryRepository::sqlFindByApp())->setParameter('appId', $parent->getApp()->getId()) : null;
                $formMapper
                    ->add('payMethodProviderHasCountry', 'sonata_type_model', array('query' => $queryPMPC, 'btn_add'=> false))
                ;

            }else{

                $formMapper
                    ->add('payMethodProviderHasCountry', 'sonata_type_model', array('btn_add'=>false))
                ;
            }


        }else if ($subject && $subject->getArticle()){

            /** @var \Doctrine\ORM\EntityManager $om */
            $om = $this->modelManager->getEntityManager($subject);
            $queryPMPC = $om->createQuery(PayMethodProviderHasCountryRepository::sqlFindByApp())->setParameter('appId', $subject->getArticle()->getApp()->getId());
            $formMapper
                ->add('payMethodProviderHasCountry', 'sonata_type_model', array('query' => $queryPMPC))
            ;
        }else{

            $formMapper
                ->add('article')
                ->add('payMethodProviderHasCountry')
            ;
        }

        $formMapper
            ->add('sms')
            ->add('voice')
            ->add('order', 'hidden', array('attr'=>array("hidden" => true)))
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
            ->add('order')
            ->add('active')
            ->add('createdAt')
        ;
    }
}
