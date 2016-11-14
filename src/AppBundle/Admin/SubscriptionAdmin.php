<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SubscriptionAdmin extends Admin
{
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
            ->add('statusCategory')
            ->add('paymentDetail.transaction.id')
            ->add('periodicity')
            ->add('transactionExternalId')
            ->add('amountForEachPayment')
            ->add('amountForEachPaymentToComplete')
            ->add('nCompletedPayments')
            ->add('needMakeRequestPayment')
            ->add('ip')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('endAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Transaction/list/category.html.twig'])
            ->add('paymentDetail.transaction.id')
            ->add('periodicity')
            ->add('transactionExternalId')
            ->add('amountForEachPayment')
            ->add('amountForEachPaymentToComplete')
            ->add('nCompletedPayments')
            ->add('totalAmount')
            ->add('totalAmountGame')
            ->add('needMakeRequestPayment')
            ->add('paymentDetail.transaction.test', null, ['label' => 'test'])
            ->add('ip')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('endAt')
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
            ->add('statusCategory')
            ->add('periodicity')
            ->add('transactionExternalId')
            ->add('amountForEachPayment')
            ->add('amountForEachPaymentToComplete')
            ->add('nCompletedPayments')
            ->add('needMakeRequestPayment')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Transaction/list/category.html.twig'])
            ->add('periodicity')
            ->add('transactionExternalId')
            ->add('request', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ->add('responses', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ->add('amountForEachPayment')
            ->add('amountForEachPaymentToComplete')
            ->add('nCompletedPayments')
            ->add('totalAmount')
            ->add('totalAmountGame')
            ->add('needMakeRequestPayment')
            ->add('ip')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('endAt')
        ;
    }
}
