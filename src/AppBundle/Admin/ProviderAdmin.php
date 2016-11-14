<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Provider;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProviderAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Provider';
    protected $baseRoutePattern = 'ProviderAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nameCompany')
            ->add('name')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nameCompany')
            ->add('name')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'insert_to_apps_all' => array(
                        'template' => '@App/Sonata/Provider/insert_all_pmpc_to_apps.html.twig'
                    ),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Provider $subject */
        $subject = $this->getSubject();

        $formMapper
            ->add('nameCompany', null, array('help'=>'Set the name of company'))
            ->add('cif')
            ->add('name', null, array('help'=>'Name provider'))
            ->add('country')
            ->add('currenciesAvailable')
            ->add('freeVat', null, array('help'=>'This provider pay all necessary vat'))
            ->add('refundEnabled')
            ->add('virtualCurrencyExchangeCurrency')
            ->add('virtualCurrencyExchangeAmount')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('company')
            ->add('name')
            ->add('createdAt')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('insert_all_pmpc_to_apps', '{providerId}/insert-all-pmpcs-to-apps');
    }
}
