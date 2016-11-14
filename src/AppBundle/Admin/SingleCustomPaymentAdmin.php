<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SingleCustomPaymentAdmin extends Admin
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
            ->add('amount')
            ->add('transactionExternalId')
            ->add('ip')
            ->add('articleTitle')
            ->add('articleDescription')
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
            ->add('amount')
            ->add('transactionExternalId')
            ->add('paymentDetail.transaction.test', null, ['label' => 'test'])
            ->add('articleTitle')
            ->add('articleDescription')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->add('ip')
            ->add('createdAt')
            ->add('updatedAt')
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
            ->add('amount')
            ->add('transactionExternalId')
            ->add('ip')
            ->add('articleTitle')
            ->add('articleDescription')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('amount')
            ->add('articleTitle')
            ->add('articleDescription')
            ->add('transactionExternalId')
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Transaction/list/category.html.twig'])
            ->add('request', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ->add('responses', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ->add('ip')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
