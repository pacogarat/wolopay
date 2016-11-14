<?php


namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Payment;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\SubscriptionEventualityPayment;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PurchaseAdminController extends CRUDController
{
    public function cancelAction($id)
    {
        $this->cancelPaymentEasy($id);
        $this->addFlash('success', 'Payment was canceled');
        return $this->redirectToRoute('admin_app_bundle_Purchase_list');
    }

    public function batchActionCancel(ProxyQueryInterface $selectedModelQuery)
    {
        $selectedModels = $selectedModelQuery->execute();
        /** @var Purchase[] $selectedModels */
        foreach ($selectedModels as $purchase)
        {
            $this->cancelPayment($purchase->getPayment());
        }
        $this->addFlash('success', 'Payment/s was canceled');
        return $this->redirectToRoute('admin_app_bundle_Purchase_list');
    }

    public function cancelPaymentEasy($idPayment)
    {
        if (!$purchase = $this->getDoctrine()->getRepository("AppBundle:Purchase")->find($idPayment))
            throw new BadRequestHttpException("purchase is invalid");

        $this->cancelPayment($purchase->getPayment());
    }

    public function cancelPayment(Payment $payment)
    {
        $this->container->get('shop.payment.cancelled')->execute($payment);

        if ($payment instanceof SubscriptionEventualityPayment)
            $this->container->get('shop.subscription.canceled')->execute($payment->getSubscriptionEventuality()->getSubscription());
    }
} 