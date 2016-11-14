<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PurchaseNotificationAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_PurchaseNotification';
    protected $baseRoutePattern = 'PurchaseNotificationAdmin';
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'createdAt'  // name of the ordered field
    );
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('amount')
            ->add('purchases.id')
            ->add('attempts')
            ->add('wasReceived')
            ->add('isReadyToNotify')
            ->add('isSubscription')
            ->add('isExtra')
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
            ->add('id')
            ->add('purchases')
            ->add('amount')
            ->add('attempts')
            ->add('transactionSuffix')
            ->add('wasReceived')
            ->add('isReadyToNotify')
            ->add('isSubscription')
            ->add('isExtra')
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
        $formMapper
            ->add('id')
            ->add('amount')
            ->add('attempts')
            ->add('transactionSuffix')
            ->add('wasReceived')
            ->add('isReadyToNotify')
            ->add('isSubscription')
            ->add('isExtra')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('purchases')
            ->add('amount')
            ->add('attempts')
            ->add('transactionSuffix')
            ->add('requests', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ->add('wasReceived')
            ->add('isReadyToNotify')
            ->add('isSubscription')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
