<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ClientDocument;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\CoreBundle\Form\Type\EqualType;

class ClientDocumentAdmin extends Admin
{
    protected $datagridValues = array(
        'finInvoice__requireApproval' => array(
            'type' => EqualType::TYPE_IS_EQUAL,
            'value' => BooleanType::TYPE_NO
        ),
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
            ->add('title')
            ->add('description')
            ->add('client')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('finInvoice.requireApproval')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('client')
            ->add('description')
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
        $subject = $this->getSubject();

        $formMapper
            ->add('title')
            ->add('description')
            ->add('client')
            ->add('document', 'sonata_media_type', [
                    'required' => ($subject && $subject->getId() ? false : true ),
                    'provider' => 'sonata.media.provider.file',
                    'context'  => ClientDocument::SONATA_CONTEXT,
                    'new_on_update' => false,
                ])

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
            ->add('description')
            ->add('client')
            ->add('document', null, ['template'=> 'AppBundle:Sonata:media_widgets_show.html.twig'])

        ;
    }
}
