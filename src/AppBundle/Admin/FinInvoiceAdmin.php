<?php

namespace AppBundle\Admin;


use AppBundle\Command\BillingClientOwesCommand;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\FinInvoice;
use AppBundle\Entity\FinMovement;
use AppBundle\Exception\NviaShowCustomResponseErrorException;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\CoreBundle\Form\Type\EqualType;

class FinInvoiceAdmin extends Admin
{
    use SonataMedia;

    protected $datagridValues = array(
        'requireApproval' => array(
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
            ->add('invoiceNumber')
            ->add('finInvoiceCategory')
            ->add('externalCompanyNotWolopay')
            ->add('companyFrom')
            ->add('companyTo')
            ->add('title')
            ->add('description')
            ->add('amountTotal')
            ->add('watch')
            ->add('requireApproval')
            ->add('approvedAt')
            ->add('declinedAt')
            ->add('referenceDate')
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
            ->add('finInvoiceCategory')
            ->add('companyFrom')
            ->add('companyTo')
            ->add('invoiceNumber')
            ->add('title')
            ->add('amountTotal')
            ->add('currency')
            ->add('watch')
            ->add('requireApproval')
            ->add('approvedAt')
            ->add('declinedAt')
            ->add('referenceDate')
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
        $rootSubject = $this->getRoot()->getSubject();

        if (!$rootSubject instanceof FinMovement)
        {
            $formMapper
                ->add('companyFrom')
                ->add('companyTo')
                ->add('amountTotal')
                ->add('currency')
                ->add('title')
                ->add('description')
            ;
        }

        $formMapper
            ->add('finInvoiceCategory')
            ->add('invoiceNumber')
            ->add('referenceDate')
            ->add('document', 'sonata_media_type', [
                    'required' => ($rootSubject && $rootSubject->getId() ? false : true ),
                    'provider' => 'sonata.media.provider.file',
                    'context'  => FinInvoice::SONATA_CONTEXT,
                    'new_on_update' => false,
                ])
            ->add('watch')
//            ->add('requireApproval')
            ->add('referenceDate')
        ;
        $obj = $this->getSubject();

//        if ($obj && $obj->getId())
//        {
//            $formMapper
//                ->add('approvedAt')
//                ->add('declinedAt')
//            ;
//        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('companyTo')
            ->add('invoiceNumber')
            ->add('title')
            ->add('description')
            ->add('amountTotal')
            ->add('currency')
            ->add('document', null, ['template'=> 'AppBundle:Sonata:media_widgets_show.html.twig'])
            ->add('watch')
            ->add('requireApproval')
            ->add('approvedAt')
            ->add('declinedAt')
            ->add('forwardForClientToAt')
            ->add('forwardedForClientToAt')

            ->add('referenceDate')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }


    public function getNewInstance()
    {
        /** @var FinInvoice $invoice */
        $invoice= parent::getNewInstance();

        /** @var EntityManager $em */
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\FinInvoice');

        $invoice->setCompanyFrom(
                $em->getRepository("AppBundle:Client")->findOneBy(['nameCompany'=> BillingClientOwesCommand::FROM_CLIENT])
            )->setCurrency(
                $em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO)
            )
        ;

        return $invoice;
    }

    /**
     * @param FinInvoice $object
     */
    public function preRemove($object)
    {
        if ($object->getForwardedForClientToAt() && $object->getForwardedForClientToAt()->getTimestamp() < (new \DateTime())->getTimestamp() )
        {
            throw new NviaShowCustomResponseErrorException(null, null, "You can't delete this item, because it was sent to client");
        }
    }

    /**
     * @param FinInvoice $object
     */
    public function postRemove($object)
    {
        /** @var EntityManager $em */
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\FinInvoice');

        if ($object->getCompanyTo()->getNameCompany() === BillingClientOwesCommand::FROM_CLIENT)
            $client = $object->getCompanyFrom();
        else
            $client = $object->getCompanyTo();

        if ($lastDeposit = $em->getRepository("AppBundle:ClientDeposit")->findLast($client->getId()))
        {
            $lastDeposit->setUsedUntilAt(null);
            $em->flush();
        }

        $this->sonataRemoveImage($object->getDocument(), $this->getConfigurationPool()->getContainer());
    }

}
