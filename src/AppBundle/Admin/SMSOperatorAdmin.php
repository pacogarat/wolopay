<?php

namespace AppBundle\Admin;

use AppBundle\Entity\SMSOperator;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SMSOperatorAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_SMSOperator';
    protected $baseRoutePattern = 'SMSOperatorAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('country')
            ->add('shortName')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('country')
            ->add('shortName')
            ->add('imgIcon')
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
        $subject = $this->getSubject();

        $formMapper
            ->add('name')
            ->add('shortName')
            ->add('country')
            ->add('imgIcon', 'sonata_media_type', [
                    'required' => ($subject && $subject->getId() ? false : true ),
                    'provider' => 'sonata.media.provider.image',
                    'context'  => SMSOperator::SONATA_CONTEXT,
                    'new_on_update' => false,
                ]);
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('country')
            ->add('shortName')
        ;
    }
}
