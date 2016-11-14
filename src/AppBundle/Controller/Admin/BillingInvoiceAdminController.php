<?php


namespace AppBundle\Controller\Admin;


use AppBundle\Command\Billing\BillingClientOwesCommand;
use AppBundle\Command\Billing\BillingClientOwesInjectConcept;
use AppBundle\Entity\Client;
use AppBundle\Entity\FinInvoice;
use AppBundle\Entity\NotPersisted\Money;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/billing")
 */
class BillingInvoiceAdminController extends AbstractSonataController
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var BillingClientOwesCommand
     * @Inject("app.billing.client.owes_command")
     */
    public $billingClientOwesCommand;

    /**
     * @Security("has_role('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL')")
     *
     * @Route("/pending/list", name="billing_invoices_pending_list")
     * @Template()
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $invoices = $this->em->getRepository("AppBundle:FinInvoice")->findRequireApprove();

        return [
            'base_template' => $this->getBaseTemplate(),
            'admin_pool'    => $this->container->get('sonata.admin.pool'),
            'invoices'      => $invoices,
            'currencies'    => $this->em->getRepository('AppBundle:Currency')->findAll()
            //            'query'         => $request->get('q'),
            //            'groups'        => $this->getAdminPool()->getDashboardGroups()
        ];
    }

    /**
     * @Security("has_role('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL')")
     * @Route("/pending/count", name="billing_invoices_pending_count")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function countAction(Request $request)
    {
        return new Response($this->em->getRepository("AppBundle:FinInvoice")->findRequireApprove(true, true, true) / 2);
    }

    /**
     * @Security("has_role('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL')")
     * @Route("/pending/approve/{client_id}/{date_reference}", name="billing_invoices_pending_approve")
     * @ParamConverter("client", class="AppBundle:Client", options={"id" = "client_id"})
     * @param \AppBundle\Entity\Client $client
     * @param \DateTime $date_reference
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function approveAction(Client $client, \DateTime $date_reference)
    {
        $invoices = $this->em->getRepository("AppBundle:FinInvoice")->findInvoicesGeneratedInSameProcess($client->getId(), $date_reference);

        foreach ($invoices as $invoice)
        {
            $this->verifyInvoiceRestrictions($invoice);
            $invoice
                ->setApprovedAt(new \DateTime())
                ->setDeclinedAt(null)
                ->setForwardForClientToAt(new \DateTime('+1 day'))
            ;
        }

        $this->addFlash('success', 'Invoice was approved');
        $this->em->flush();

        return $this->redirectToRoute('billing_invoices_pending_list');
    }

    /**
     * @Security("has_role('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL')")
     * @Route("/pending/decline/{client_id}/{date_reference}", name="billing_invoices_pending_decline")
     * @ParamConverter("client", class="AppBundle:Client", options={"id" = "client_id"})
     * @param \AppBundle\Entity\Client $client
     * @param \DateTime $date_reference
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function declineAction(Client $client, \DateTime $date_reference)
    {
        $invoices = $this->em->getRepository("AppBundle:FinInvoice")->findInvoicesGeneratedInSameProcess($client->getId(), $date_reference);

        foreach ($invoices as $invoice)
        {
            $this->verifyInvoiceRestrictions($invoice);
            $invoice
                ->setApprovedAt(null)
                ->setDeclinedAt(new \DateTime())
                ->setForwardForClientToAt(null)
            ;
        }

        $this->addFlash('success', 'Invoice was declined');
        $this->em->flush();

        return $this->redirectToRoute('billing_invoices_pending_list');
    }

    /**
     * @Security("has_role('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL')")
     * @Route("/regenerate/{client_id}/{date_reference}", name="billing_invoices_regenerate")
     * @ParamConverter("client", class="AppBundle:Client", options={"id" = "client_id"})
     * @param \AppBundle\Entity\Client $client
     * @param \DateTime $date_reference
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function regenerateAction(Client $client, \DateTime $date_reference, Request $request)
    {
        $wolopayOwesClientExtraConcepts = $clientOwesWolopayExtraConcepts = [];

        if ($wolopayOwesClientExtraConceptsRaw = $request->get('wolopayOwesClientExtraConcepts'))
            $wolopayOwesClientExtraConcepts = $this->extraDataFromExtraCosts($wolopayOwesClientExtraConceptsRaw);

        if ($clientOwesWolopayExtraConceptsRaw = $request->get('clientOwesWolopayExtraConcepts'))
            $clientOwesWolopayExtraConcepts = $this->extraDataFromExtraCosts($clientOwesWolopayExtraConceptsRaw);

        $finInvoices = $this->em->getRepository("AppBundle:FinInvoice")->findInvoicesGeneratedInSameProcess($client->getId(), $date_reference);

        foreach ($finInvoices as $finInvoice)
        {
            $finInvoice
                ->setApprovedAt(null)
                ->setDeclinedAt(new \DateTime())
            ;
        }

        $this->em->flush();

        $res = $this->billingClientOwesCommand->executeForClient(
            $client,
            $date_reference,
            1,
            false,
            $clientOwesWolopayExtraConcepts,
            $wolopayOwesClientExtraConcepts
        );

        if ($res)
            $this->addFlash('success', 'Invoice was regenerated');
        else
            $this->addFlash('error', 'An error has ocurred :/');

        return $this->redirectToRoute('billing_invoices_pending_list');
    }

    private function extraDataFromExtraCosts($json)
    {
        $result = [];

        $json = json_decode(urldecode($json));

        foreach ($json as $row)
        {
            $result[] = new BillingClientOwesInjectConcept(
                $row->name,
                new Money($row->money->amount, $this->em->getRepository('AppBundle:Currency')->find($row->money->currency->id)),
                isset($row->description) ? $row->description : null
            );
        }

        return $result;
    }


    /**
     * @param \AppBundle\Entity\FinInvoice $finInvoice
     * @throws \Exception
     * @return FinInvoice
     */
    private function verifyInvoiceRestrictions(FinInvoice $finInvoice)
    {
        if (!$finInvoice->getRequireApproval())
            throw new \Exception('Only approve o decline with require approval');

        if ($finInvoice->getForwardedForClientToAt())
            throw new \Exception('Email to user was sent...');

        return $finInvoice;
    }

}