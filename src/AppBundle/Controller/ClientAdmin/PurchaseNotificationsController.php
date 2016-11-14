<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\PurchaseNotification;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api")
 */
class PurchaseNotificationsController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Route("/app/{app}/notifications/{date_from}/{date_to}/{currency}", name="admin_purchase_notifications")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function notificationsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($date_from->getTimestamp() > $date_to->getTimestamp())
            throw new BadRequestHttpException("date from is higher than date to");

        if (!in_array(RoleEnum::ADMIN_NOTIFICATIONS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $page = $request->get('page') ?: 0;
        $rows = $this->getRows($request);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $serializer = $this->get('jms_serializer');

        $purchaseNotifications = $em->getRepository("AppBundle:PurchaseNotification")->findByAppIdAndDateRangeAndGroupByMonths(
            $app->getId(), $date_from, $date_to, false, $page*$rows, $rows,
            [
                'n.id' => $request->get('purchase_notification_id'),
                'g.gamerExternalId' => $request->get('gamer_external_id'),
                'p.id' => $request->get('purchase_id'),
                'IDENTITY(p.transaction)' => $request->get('transaction_id'),
                'n.wasReceived' => $request->get('was_received'),
                'SQLINJECT' =>  ! $request->get('subscription_id') ? '' :
                    [
                        'sql'=>'AND p.id in (
                            Select puu.id
                            FROM AppBundle:Subscription sub
                            JOIN sub.subscriptionEventualities subEve
                            JOIN subEve.subscriptionEventualityPayments subEvePay
                            JOIN subEvePay.purchase puu
                            WHERE sub.id = :subscriptionIDD
                        )',
                        'parameters' => ['subscriptionIDD' => $request->get('subscription_id')]
                    ]
            ]
        );

        foreach ($purchaseNotifications as $not)
        {
            $purchase = $not->getPurchases()[0];

            if ($currency->getId() === $purchase->getCurrency()->getId())
                continue;

            if ($currency->getId() === CurrencyEnum::DOLLAR)
                $multiply= $purchase->getExchangeRateUsd();
            else if ($currency->getId() === CurrencyEnum::POUND_STERLING)
                $multiply= $purchase->getExchangeRateGbp();
            else
                $multiply= $purchase->getExchangeRateEur();

            $not->setAmount($not->getAmount()*$multiply);
        }

        $context = SerializationContext::create()->setGroups(array('Default','allTranslations'))->enableMaxDepthChecks();
        $json = $this->parseRequestsToArraySimple($serializer->serialize($purchaseNotifications, 'json', $context));

        return new Response($json, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * To resolve bug https://github.com/schmittjoh/JMSSerializerBundle/issues/373
     * @param $json
     * @return mixed
     */
    private function parseRequestsToArraySimple($json)
    {
        $parsedToArray = json_decode($json);
        foreach ($parsedToArray as &$noti)
        {
            $temp = [];
            foreach($noti->requests as $request)
                $temp[] = $request;

            $noti->requests = $temp;
        }
        return json_encode($parsedToArray);
    }

    /**
     * @Route("/app/{app}/notifications/{notificationId}/force_resend/", name="admin_purchase_notifications_force_resend", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("purchaseNotification", class="AppBundle:PurchaseNotification", options={"id" = "notificationId"})
     */
    public function resendPurchaseNotificationAction(App $app,PurchaseNotification $purchaseNotification, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_NOTIFICATIONS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($purchaseNotification->getApp()->getId() != $app->getId() )
            throw new BadRequestHttpException('Invalid purchaseNotificiation from this app');

        $purchaseNotification
            ->setWasReceived(false)
            ->setForceToNotify(true)
        ;

        $this->em->flush();
        $appNotificationCommand = $this->get('command.shop.app_notification.send');
        $appNotificationCommand->sendNotifications([$purchaseNotification]);

        return new JsonResponse($purchaseNotification->getRequestExact());
    }
}
