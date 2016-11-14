<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\ClientUser;
use AppBundle\Entity\ClientUserNotification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/notify")
 */
class NotifyController extends Controller
{
    /**
     * @Route("/notifications")
     */
    public function notificationsAction()
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $notifications = $em->getRepository("AppBundle:ClientUserNotification")->findByClientUserIdAndDelete($clientUser->getId());

        $serializer = $this->get('jms_serializer');

        return new Response($serializer->serialize($notifications, 'json'), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/notifications/read/{client_user_notification_id}")
     * @ParamConverter("clientUserNotification", class="AppBundle:ClientUserNotification", options={"id" = "client_user_notification_id"})
     */
    public function notificationMarkAsReadAction(ClientUserNotification $clientUserNotification)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($clientUserNotification->getClientUser()->getId() != $clientUser->getId())
            throw $this->createAccessDeniedException();

        $clientUserNotification->setUnread(false);

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/notifications/{date}", methods={"DELETE"})
     * @ParamConverter("date")
     */
    public function deleteAllAction(\DateTime $date)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $notifications = $em->getRepository("AppBundle:ClientUserNotification")->findByClientUserIdAndDateAndDelete($date, $clientUser->getId());

        foreach ($notifications as $n)
            $n->setDeleted(true);

        $em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/tasks.html")
     */
    public function tasksAction()
    {
        return new Response("");
    }
}
