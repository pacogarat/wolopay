<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Promo;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PromoAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Promo';
    protected $baseRoutePattern = 'PromoAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('app')
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
            ->add('app')
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
        /** @var Promo $subject */
        $subject = $this->getSubject();

        $formMapper
            ->add('name')
            ->add('app')
            ->add('nUsesPerUser')
            ->add('nTotalUses')
            ->add('beginAt')
            ->add('endAt')
            ->add('promoType')
        ;

        if ($subject && $subject->getId())
        {
            $formMapper->add('promoCodes', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'));
        }

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
        ;
    }
}
