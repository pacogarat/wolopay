<?php

namespace AppBundle\Admin;

use AppBundle\Command\Billing\BillingClientOwesCommand;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\FinMovement;
use AppBundle\Exception\NviaShowCustomResponseErrorException;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\CoreBundle\Form\Type\EqualType;

class FinMovementAdmin extends Admin
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
            ->add('companyFrom')
            ->add('companyTo')
            ->add('description')
            ->add('rememberUntilOrderDone')
            ->add('orderAt')
            ->add('orderedAt')
            ->add('createdAt')
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
            ->add('companyFrom')
            ->add('companyTo')
            ->add('description')
            ->add('amountTotal')
            ->add('currency')
            ->add('exchangeToEur')
            ->add('rememberUntilOrderDone')
            ->add('orderAt')
            ->add('orderedAt')

            ->add('createdAt')
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
            ->with("Financial Movement", ['class' => 'col-md-6'])
                ->add('companyFrom')
                ->add('companyTo')
                ->add('title')
                ->add('description')
                ->add('amountTotal')
                ->add('currency')
                ->add('rememberUntilOrderDone')
                ->add('orderedAt', null, ['help' => 'You only set, when transaction (bank) is finished'])
            ->end()
            ->with('Invoice', ['class' => 'col-md-6'])
                ->add('finInvoice', 'sonata_type_admin', ['btn_delete'=> false, 'btn_add' => false, 'label'=>false])
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('companyFrom')
            ->add('companyTo')
            ->add('amountTotal')
            ->add('currency')
            ->add('title')
            ->add('description')

            ->add('finInvoice.referenceDate')
            ->add('finInvoice.document', null, ['template'=> 'AppBundle:Sonata:media_widgets_show.html.twig'])
            ->add('finInvoice.watch')
            ->add('finInvoice.approvedAt')
            ->add('finInvoice.declinedAt')
            ->add('finInvoice.forwardForClientToAt')
            ->add('finInvoice.forwardedForClientToAt')


            ->add('rememberUntilOrderDone')
            ->add('orderAt')
            ->add('orderedAt')
            ->add('createdAt')
        ;
    }


    /**
     * @param FinMovement $object
     */
    public function preRemove($object)
    {
        if ($object->getFinInvoice() )
        {
            throw new NviaShowCustomResponseErrorException(
                null,
                null,
                "This movement have a invoice, If you want delete remove the invoice: ".$object->getFinInvoice()->getId().
                "with Invoice number: ".$object->getFinInvoice()->getInvoiceNumber()
            );
        }


    }

    /**
     * @param FinMovement $object
     */
    public function prePersist($object)
    {
        $this->fillInvoice($object);
    }

    /**
     * @param FinMovement $object
     */
    public function preUpdate($object)
    {
        $this->fillInvoice($object);
    }

    /**
     * @param FinMovement $finInvoice
     */
    private function fillInvoice($finInvoice)
    {
        $invoice = $finInvoice->getFinInvoice();
        $invoice
            ->setTitle($finInvoice->getTitle())
            ->setCompanyTo($finInvoice->getCompanyTo())
            ->setCompanyFrom($finInvoice->getCompanyFrom())
            ->setDescription($finInvoice->getDescription())
            ->setAmountTotal($finInvoice->getAmountTotal())
            ->setCurrency($finInvoice->getCurrency())
        ;

    }

    public function getNewInstance()
    {
        /** @var FinMovement $movement */
        $movement= parent::getNewInstance();

        /** @var EntityManager $em */
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\FinInvoice');

        $movement->setCompanyFrom(
                $em->getRepository("AppBundle:Client")->findOneBy(['nameCompany'=> BillingClientOwesCommand::FROM_CLIENT])
            )->setCurrency(
                $em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO)
            )
        ;

        return $movement;
    }
}
