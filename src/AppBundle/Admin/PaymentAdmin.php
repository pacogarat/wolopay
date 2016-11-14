<?php

namespace AppBundle\Admin;

use AppBundle\Entity\SubscriptionEventualityPayment;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PaymentAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Payment';
    protected $baseRoutePattern = 'PaymentAdmin';
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
            ->add('paymentDetail.payMethod', null, ['label' => 'PayMethod'])
            ->add('paymentDetail.usedAppProviderCredentials', null, ['label' => 'Gateway'])
            ->add('app')
            ->add('amount')
            ->add('paymentDetail.transaction.id')
            ->add('transactionExternalId')
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
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Payment/list/category.html.twig'])
            ->add('app')
            ->add('gamer')
            ->add('paymentDetail.payMethod', null, ['label' => 'PayMethod'])
            ->add('paymentDetail.provider', null, ['label' => 'Provider'])
            ->add('paymentDetail.country', null, ['label' => 'Country'])
            ->add('paymentDetail.currency', null, ['label' => 'Currency'])
            ->add('paymentDetail.usedAppProviderCredentials', null, ['label' => 'Gateway'])
            ->add('amount')
            ->add('transactionExternalId')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
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
            ->add('app')
            ->add('gamer')
            ->add('paymentDetail.payMethod', null, ['label' => 'PayMethod'])
            ->add('paymentDetail.provider', null, ['label' => 'Provider'])
            ->add('paymentDetail.country', null, ['label' => 'Country'])
            ->add('paymentDetail.currency', null, ['label' => 'Currency'])
            ->add('amount')
            ->add('transactionExternalId')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $subject = $this->getRoot()->getSubject();

        $showMapper
            ->add('id')
            ->add('app')
            ->add('gamer')
            ->add('paymentDetail.transaction', null, ['label' => 'transaction'])
            ->add('paymentDetail.payMethod', null, ['label' => 'PayMethod'])
            ->add('paymentDetail.provider', null, ['label' => 'Provider'])
            ->add('paymentDetail.country', null, ['label' => 'Country'])
            ->add('paymentDetail.currency', null, ['label' => 'Currency'])
            ->add('paymentDetail.usedAppProviderCredentials', null, ['label' => 'Gateway'])
        ;

        if (!$subject instanceof SubscriptionEventualityPayment)
        {
            $showMapper
                ->add('request', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
                ->add('responses', null, ['template' => '@App/Sonata/type_array_json.html.twig'])
            ;

        }else{

            $showMapper
                ->add('subscriptionEventuality')
                ->add('subscriptionEventuality.subscription', null, ['label' => 'Subscription'])
            ;
        }

        $showMapper
            ->add('amount')
            ->add('transactionExternalId')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
