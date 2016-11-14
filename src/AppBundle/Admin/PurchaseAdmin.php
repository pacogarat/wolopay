<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PurchaseAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Purchase';
    protected $baseRoutePattern = 'PurchaseAdmin';
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

            ->add('app')
            ->add('provider')
            ->add('payMethod')
            ->add('payMethod.payCategory')
            ->add('payMethod.articleCategory')
            ->add('country')
            ->add('currency')
            ->add('gamer.id')
            ->add('transaction.id')
            ->add('wasCanceled')
            ->add('cancelInProcess')
            ->add('partialPayment')
            ->add('usedAppProviderCredentials', null, ['label' => 'Gateway'])
            ->add('amountTotal')
            ->add('amountWolo')
            ->add('amountProvider')
            ->add('amountGame')
            ->add('amountTax')
            ->add('taxPercent')
            ->add('providerFeePercent')
            ->add('providerRealFeePercent')
            ->add('providerFixedFeeAmount')
            ->add('providerMinFeeAmount')
            ->add('exchangeRateEur')
            ->add('exchangeRateUsd')
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
            ->add('transaction')
            ->add('app')
            ->add('provider')
            ->add('payMethod.name', null, ['label'=>'PayMethod'])
            ->add('usedAppProviderCredentials', null, ['label' => 'Gateway'])
            ->add('wasCanceled')
            ->add('cancelInProcess')
            ->add('partialPayment')
            ->add('country')
            ->add('currency')
            ->add('amountTotal')
            ->add('amountWolo')
            ->add('amountProvider')
            ->add('amountGame')
            ->add('providerFeePercent')
            ->add('providerRealFeePercent')
            ->add('providerFixedFeeAmount')
            ->add('providerMinFeeAmount')
            ->add('exchangeRateEur')
            ->add('exchangeRateUsd')
            ->add('exchangeRateGbp')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'Purchases' => array(
                        'template' => '@App/Sonata/CRUD/list__action_purchases_notification.html.twig'
                    ),
                    'cancel' => array(
                        'template' => '@App/Sonata/Purchase/cancel_payment_action.html.twig'
                    ),
                )
            ))
        ;
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();
//        return $actions = [];
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE'))
        {
            $actions['cancel']=[
                'label'            => 'Cancel Payment',
                'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
            ];
        }

        return $actions;
    }



    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('app.id')
            ->add('provider')
            ->add('payMethod')
            ->add('country')
            ->add('currency')
            ->add('gamer.id')
            ->add('transaction')
            ->add('wasCanceled')
            ->add('cancelInProcess')
            ->add('partialPayment')
            ->add('amountTotal')
            ->add('amountWolo')
            ->add('amountProvider')
            ->add('amountGame')
            ->add('amountTax')
            ->add('taxPercent')
            ->add('providerFeePercent')
            ->add('providerRealFeePercent')
            ->add('providerFixedFeeAmount')
            ->add('providerMinFeeAmount')
            ->add('exchangeRateEur')
            ->add('exchangeRateUsd')
            ->add('createdAt')

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')

            ->add('app')
            ->add('provider')
            ->add('payMethod')
            ->add('payMethod.payCategory')
            ->add('payMethod.articleCategory')
            ->add('usedAppProviderCredentials', null, ['label' => 'Gateway'])
            ->add('country')
            ->add('currency')
            ->add('gamer')
            ->add('transaction')

            ->add('wasCanceled')
            ->add('cancelInProcess')
            ->add('partialPayment')
            ->add('amountTotal')
            ->add('amountWolo')
            ->add('amountProvider')
            ->add('amountGame')
            ->add('amountTax')
            ->add('taxPercent')
            ->add('providerFeePercent')
            ->add('providerRealFeePercent')
            ->add('providerFixedFeeAmount')
            ->add('providerMinFeeAmount')
            ->add('exchangeRateEur')
            ->add('exchangeRateUsd')
            ->add('createdAt')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('cancel', $this->getRouterIdParameter().'/cancel');
    }
}
