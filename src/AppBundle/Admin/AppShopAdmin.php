<?php

namespace AppBundle\Admin;

use AppBundle\Entity\AppShop;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AppShopAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_AppShop';
    protected $baseRoutePattern = 'AppShopAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('app')
            ->add('css')
            ->add('name')
            ->add('firstOffers')
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
            ->add('css')
            ->add('name')
            ->add('firstOffers')
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
        $formMapper
            ->add('css')
            ->add('name')
            ->add('levelCategory')
            ->add('valueLower')
            ->add('valueHigher')
            ->add('firstOffers')
            ->add('payMethodsDefaultOrder')
            //->add('appShopHasArticles', null, array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table', 'sortable' => 'order'))
        ;

        if($this -> getRoot() -> getSubject() instanceof AppShop)
        {
            /** @var AppShop $subject */
            $subject = $this->getSubject();
            $promoCodesOptions['query_builder'] = function(EntityRepository $er ) use ($subject) {
                return $er->createQueryBuilder('c')
                    ->where('c.app = :appId')
                    ->setParameter('appId', $subject->getApp()->getId() );
            };

            $formMapper
                ->add('appShopHasArticles', 'sonata_type_collection', array('btn_add' => false), array(
                        'btn_add' => false,
                        'allow_delete' => false,
                        'multiple' => true,
                        'expanded' => false,
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'order',
                        'help' => 'Drag and drop to set order, To add new go to article'
                    ))
                ->add('tutorialEnabled')
                ->add('tutorialPromoCode', null, $promoCodesOptions)
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('cssUrl')
            ->add('name')
            ->add('orderPrices')
            ->add('appHasLevelCategory')
        ;
    }
}
