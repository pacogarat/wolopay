<?php


namespace AppBundle\Service;

use AppBundle\Entity\ClientUser;
use AppBundle\Entity\ClientUserNotification;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Payment\Event\NotificationFailedEvent;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Service("app.client_user_notifications")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.cancelled"})
 * @Tag("kernel.event_listener", attributes = {"event" = "payment.notification.failed"})
 */
class ClientUserNotificationService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var TranslatorInterface
     * @Inject("translator")
     */
    public $translator;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    public function onPaymentNotificationFailed(NotificationFailedEvent $notificationFailedEvent)
    {
        if (!$notificationFailedEvent->getWasLastAttemptAndNoMore())
            return;

        $purchaseNotification = $notificationFailedEvent->getPurchaseNotification();
        $clientUsers = $purchaseNotification->getApp()->getClientUsersHasApps();

        foreach ($clientUsers as $clientUserHasApp)
        {
            if (!in_array(RoleEnum::ADMIN_NOTIFICATIONS, $clientUserHasApp->getRolesAdmin()))
                continue;

            $clientUser = $clientUserHasApp->getClientUser();

            $locale = $clientUser->getLanguage()->getId();

            $replaces = [
                '%notification_id%' => $purchaseNotification->getId(),
                '%article_string%' => $purchaseNotification->getArticlesString(),
                '%app_name%' => $purchaseNotification->getApp()->getName(),
                '%transaction_id%' => $purchaseNotification->getPurchases()[0]->getTransactionId(),
            ];

            $message = $this->translator->trans('purchase_notification_was_failed.desc', $replaces, 'user_notifications', $locale);
            $title = $this->translator->trans('purchase_notification_was_failed.title', $replaces, 'user_notifications', $locale);

            $this->createClientUserNotification($clientUser, $message, $title, ClientUserNotification::TYPE_ERROR);
        }

        $this->em->flush();
    }

    public function onShopPaymentCancelled(PaymentCancelledEvent $e)
    {
        if (!$e->getWasCompletedBeforeCancelled() || $e->getCalledByMerchantNow())
            return;

        $payment = $e->getPayment();
        $purchase = $payment->getPurchase();
        $clientUsers = $payment->getApp()->getClientUsersHasApps();

        foreach ($clientUsers as $clientUserHasApp)
        {
            if (!in_array(RoleEnum::ADMIN_PURCHASES, $clientUserHasApp->getRolesAdmin()))
                continue;

            $clientUser = $clientUserHasApp->getClientUser();

            $locale = $clientUser->getLanguage()->getId();

            $replaces = [
                '%purchase_id%' => $purchase->getId(),
                '%article_string%' => $purchase->getArticlesString( $locale ),
                '%app_name%' => $purchase->getApp()->getName(),
                '%amount%' => $purchase->getAmountTotal(),
                '%currency_symbol%' => $purchase->getCurrency()->getSymbol(),
                '%transaction_id%' => $purchase->getTransactionId(),
            ];

            $message = $this->translator->trans('payment_was_canceled.desc', $replaces, 'user_notifications', $locale);
            $title = $this->translator->trans('payment_was_canceled.title', $replaces, 'user_notifications', $locale);

            $this->createClientUserNotification($clientUser, $message, $title, ClientUserNotification::TYPE_WARNING);
        }

        $this->em->flush();
    }

    public function createClientUserNotification(ClientUser $clientUser, $message, $title, $type = ClientUserNotification::TYPE_INFO)
    {
        $clientUserNotification = new ClientUserNotification($clientUser, $message, $title, $type );
        echo "CREATED";
        $this->em->persist($clientUserNotification);
        $this->em->flush();
    }
} 