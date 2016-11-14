<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AffiliateAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('client.nameCompany')
            ->add('affiliateId')
            ->add('name')
            ->add('hasPaymethod')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('client.nameCompany')
            ->add('affiliateId')
            ->add('name')
            ->add('hasPaymethod')
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
        /** @var ClientUser $subject */
        $subject = $this->getSubject();

        if(!$this -> getRoot() -> getSubject() instanceof Client)
        {
            if ( !$subject || !$subject->getId())
                $formMapper
                    ->add('client');
            else
                $formMapper
                    ->add('client', null, ['read_only' => true, 'disabled' => true]);
        }
        $formMapper
            ->add('affiliateId')
            ->add('name')
            ->add('hasPaymethod')
            ->add('payMethodProviders')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('client.nameCompany')
            ->add('affiliateId')
            ->add('name')
            ->add('hasPaymethod')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
