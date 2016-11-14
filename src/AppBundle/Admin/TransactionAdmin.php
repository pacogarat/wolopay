<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class TransactionAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Transaction';
    protected $baseRoutePattern = 'TransactionAdmin';
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'beginAt'  // name of the ordered field
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('statusCategory')
            ->add('valueCurrent')
            ->add('beginAt')
            ->add('endAt')
            ->add('valueLower')
            ->add('valueHigher')
            ->add('gamer.gamerExternalId')
            ->add('firstOffers')
            ->add('purchases.id')
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
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Transaction/list/category.html.twig'])
            ->add('valueCurrent')
            ->add('gamer.gamerExternalId')
            ->add('beginAt')
            ->add('endAt')
            ->add('valueLower')
            ->add('valueHigher')
            ->add('test')
            ->add('cli')
            ->add('firstOffers')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'Log' => array(
                        'template' => '@App/Sonata/CRUD/list__action_log.html.twig'
                    ),
                    'Payments' => array(
                        'template' => '@App/Sonata/CRUD/list__action_payments.html.twig'
                    ),
                    'Purchases' => array(
                        'template' => '@App/Sonata/CRUD/list__action_purchases.html.twig'
                    )
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

            ->add('valueCurrent')
            ->add('beginAt')
            ->add('endAt')
            ->add('valueLower')
            ->add('valueHigher')
            ->add('firstOffers')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('gamer')
            ->add('gamer.gamerExternalId')
            ->add('gamer.email')
            ->add('valueCurrent')
            ->add('valueLower')
            ->add('valueHigher')
            ->add('languageDefault')
            ->add('purchases')
            ->add('statusCategory', 'string', ['template' => '@App/Sonata/Transaction/list/category.html.twig'])
            ->add('countriesAvailable')
            ->add('articlesAvailable')
            ->add('selectedArticle')
            ->add('selectedAppTab')
            ->add('customParam')
            ->add('return')

            ->add('customAmount')
            ->add('customCurrency')
            ->add('customPayMethod')
            ->add('customCountry')
            ->add('customArticleTitle')
            ->add('customArticleDescription')
            ->add('test')
            ->add('cli')
            ->add('expireAt')
            ->add('expiredAt')
            ->add('beginAt')
            ->add('endAt')


            ->add('countryDetected')
            ->add('fixedCountry')
            ->add('AppTabsAvailable')
            ->add('reason')


            ->add('firstOffers')

        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('log', $this->getRouterIdParameter().'/log');
    }
}
