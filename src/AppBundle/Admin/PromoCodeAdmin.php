<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Promo;
use AppBundle\Entity\Repository\ArticleRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PromoCodeAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_PromoCode';
    protected $baseRoutePattern = 'PromoCodeAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('code')
            ->add('countNTimeUsed')
            ->add('value')
            ->add('isPercent')
            ->add('nUsesPerUser')
            ->add('nTotalUses')
            ->add('beginAt')
            ->add('endAt')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('code')
            ->add('countNTimeUsed')
            ->add('value')
            ->add('isPercent')
            ->add('nUsesPerUser')
            ->add('nTotalUses')
            ->add('beginAt')
            ->add('endAt')
            ->add('createdAt')
            ->add('updatedAt')
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
        $articleOpt=['btn_add'=>false];
        $promoAdmin = $this->getRoot();

        if ($promoAdmin instanceof PromoAdmin && $parent = $promoAdmin->getSubject())
        {
            /** @var Promo $parent */
            $om = $this->getEntityManager();

            $queryLabel = $om->createQuery(ArticleRepository::sqlFindByAppId())->setParameter('appId', $parent->getApp()->getId());

            $articleOpt = array_merge($articleOpt,[ 'query' => $queryLabel]);
        }


        $formMapper
            ->add('code')
            ->add('nUsesPerUser')
            ->add('article', 'sonata_type_model', $articleOpt)
            ->add('nTotalUses')
            ->add('beginAt', 'sonata_type_datetime_picker', array('required' => false))
            ->add('endAt', 'sonata_type_datetime_picker', array('required' => false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('code')
            ->add('countNTimeUsed')
            ->add('value')
            ->add('isPercent')
            ->add('nUsesPerUser')
            ->add('nTotalUses')
            ->add('beginAt')
            ->add('endAt')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

}
