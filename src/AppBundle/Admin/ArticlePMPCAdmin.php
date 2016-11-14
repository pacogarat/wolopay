<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ArticlePMPC;
use AppBundle\Entity\Repository\PayMethodProviderHasCountryRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticlePMPCAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_ArticlePMPC';
    protected $baseRoutePattern = 'ArticlePMPCAdmin';
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
        /** @var ArticlePMPC $subject */
        $subject = $this->getSubject();

        if ($subject && $subject->getArticle())
        {
            /** @var \Doctrine\ORM\EntityManager $om */
            $om = $this->modelManager->getEntityManager($subject);
            $queryPMPC = $om->createQuery(PayMethodProviderHasCountryRepository::sqlFindByApp())->setParameter('appId', $subject->getArticle()->getApp()->getId());
            $formMapper
                ->add('article')
                ->add('payMethodProviderHasCountry')
            ;
        }else{

            $formMapper
                ->add('article')
                ->add('payMethodProviderHasCountry')
            ;
        }


        $formMapper

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
