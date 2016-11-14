<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AppApiCredentialsAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_AppApiCredentials';
    protected $baseRoutePattern = 'AppApiCredentialsAdmin';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('codeKey')
            ->add('secretKey')
            ->add('serverKey')
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

            ->add('codeKey')
            ->add('secretKey')
            ->add('serverKey')
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
        $formMapper
            ->add('codeKey')
            ->add('secretKey')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->add('codeKey')
            ->add('secretKey')
            ->add('serverKey')
            ->add('active')
            ->add('createdAt')
        ;
    }
}
