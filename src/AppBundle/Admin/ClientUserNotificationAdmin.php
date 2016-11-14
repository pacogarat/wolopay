<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientUserNotificationAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_ClientUserNotification';
    protected $baseRoutePattern = 'ClientUserNotificationAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('clientUser')
            ->add('title')
            ->add('message')
            ->add('unread')
            ->add('deleted')
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
            ->add('clientUser')
            ->add('title')
            ->add('message')
            ->add('unread')
            ->add('deleted')
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
            ->add('clientUser')
            ->add('title')
            ->add('message')
            ->add('unread')
            ->add('deleted')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('message')
            ->add('unread')
            ->add('deleted')
            ->add('createdAt')
        ;
    }
}
