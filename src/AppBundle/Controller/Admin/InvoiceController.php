<?php


namespace AppBundle\Controller\Admin;


use Sonata\AdminBundle\Controller\CRUDController;

class InvoiceController extends CRUDController
{


    public function approveAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $invoice = $this->restrictions($id);

        $invoice
            ->setApprovedAt(new \DateTime())
            ->setDeclinedAt(null)
            ->setForwardForClientToAt(new \DateTime('+1 day'))
        ;

        $this->addFlash('success', 'Invoice was approved');
        $em->flush();

        return $this->redirectToRoute('admin_app_fininvoice_list', array());
    }

    public function declineAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $invoice = $this->restrictions($id);

        $invoice
            ->setApprovedAt(null)
            ->setDeclinedAt(new \DateTime())
            ->setForwardForClientToAt(null)
        ;

        $this->addFlash('success', 'Invoice was declined');
        $em->flush();

        return $this->redirectToRoute('admin_app_fininvoice_list', array());
    }

} 