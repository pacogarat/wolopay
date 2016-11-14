<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Client;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Client';
    protected $baseRoutePattern = 'ClientAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nameCompany')
            ->add('country')
            ->add('description')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nameCompany')
            ->add('woloPack')
            ->add('country')
            ->add('description')
            ->add('onCreateAppActiveByDefault')
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
        /** @var Client $subject */
        $subject = $this->getSubject();

        $formMapper
            ->with('General', array('description' => 'This section contains general settings for the web page'))
                ->add('nameCompany', null, array('help'=>'Set the name of company'))
                ->add('cif')

                ->add('woloPack')
                ->add('logo', 'sonata_media_type', [
                    'required' => ($subject && $subject->getLogo() ? false : true ),
                    'provider' => 'sonata.media.provider.image',
                    'context'  => Client::SONATA_CONTEXT,
                    'new_on_update' => false,
                ])
                ->add('financeEmail')
                ->add('country')
                ->add('vatNumber')
                ->add('currencyEarnings')
                ->add('address')
                ->add('postalCode')
                ->add('description')
                ->add('onCreateAppActiveByDefault')

            ->end()
        ;



    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nameCompany')
            ->add('cif')
            ->add('country')
            ->add('description')
            ->add('woloPack')
            ->add('logo')
            ->add('financeEmail')

            ->add('vatNumber')
            ->add('currencyEarnings')
            ->add('address')
            ->add('postalCode')
        ;
    }

    public function  getNewInstance()
    {
        /** @var Client $object */
        $object = parent::getNewInstance();

//        $object->addClientUser(new ClientUser());

        return $object;
    }

}
