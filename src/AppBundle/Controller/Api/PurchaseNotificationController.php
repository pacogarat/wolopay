<?php

namespace AppBundle\Controller\Api;


use AppBundle\Command\AppNotificationCommand;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\PaymentDetailArticlesHasGivenArticle;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class PurchaseNotificationController extends AbstractAPI
{
    /**
     * @DI\Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @DI\Inject("command.shop.app_notification.send")
     * @var AppNotificationCommand
     */
    private $notificationCommand;

    /**
     * Get info about a notification
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/transaction/notification/{notification_id}")
     * @ParamConverter("notification", class="AppBundle:PurchaseNotification", options={"id" = "notification_id"})
     *
     * @param \AppBundle\Entity\PurchaseNotification $notification
     * @throws \Symfony\Component\Security\Core\Exception\BadCredentialsException
     * @return array
     */
    public function getNotificationAction(PurchaseNotification $notification)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();

        if ($notification->getApp()->getId() !== $appCredentials->getApp()->getId())
            throw new BadCredentialsException("u cant choose this notification, because is not from your app");

        $view = $this->view($notification, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Public')));

        return $this->handleView($view);
    }


    /**
     * @Patch("/trans3action/{transaction_id}/notification/pdahga/{pdahga_id}")
     * @ParamConverter("paymentDetailArticlesHasGivenArticle", class="AppBundle:PaymentDetailArticlesHasGivenArticle", options={"id" = "pdahga_id"})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     *
     * @param PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle
     * @return array
     */
    public function updateGachaNotificationAction(PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle, Transaction $transaction)
    {
        if ($paymentDetailArticlesHasGivenArticle->getPaymentDetailHasArticle()->getPaymentDetail()->getTransaction()->getId() !== $transaction->getId())
            throw new BadRequestHttpException("invalid transaction");

        foreach ($paymentDetailArticlesHasGivenArticle->getPurchaseNotifications() as $pn)
        {
            $pn->setMinDelay(null);
        }

        $this->em->flush();

        $this->notificationCommand->sendNotifications($paymentDetailArticlesHasGivenArticle->getPurchaseNotifications()->toArray());

        $view = $this->view([], 200);

        return $this->handleView($view);
    }
}
