<?php


namespace AppBundle\Service;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\AppTab;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\SinglePayment;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\SubscriptionEventualityPayment;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("app.purchase_notification")
 */
class PurchaseNotificationService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var \AppBundle\Service\CurrencyService
     * @Inject("common.currency")
     */
    public $currencyExchange;

    public function generateNotificationsToEvent(Purchase $purchase, $purchaseNotificationType = PurchaseNotificationEventEnum::PAYMENT_COMPLETED)
    {
        $notifications = $this->generateNotifications($purchase);
        $notifications = $this->changeState4AllNotifications($notifications, $purchaseNotificationType);

        return $notifications;
    }

    /**
     * @param Purchase $purchase
     * @return PurchaseNotification[]
     */
    private function generateNotifications(Purchase $purchase)
    {
        $paymentProcess = $purchase->getPayment()->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        if ($paymentProcess instanceof SingleCustomPayment)
            $notifications = $this->generateNotificationWithoutArticles($paymentDetails, $purchase);
        else
            $notifications = $this->generateNotificationsWithArticles($paymentDetails, $purchase);

        foreach ($notifications as $notification)
        {
            $this->em->persist($notification);
        }

        return $notifications;
    }

    /**
     * @param PurchaseNotification[] $notifications
     * @param $newState
     * @return \AppBundle\Entity\PurchaseNotification[] is not mandatory but is more explicit
     */
    private function changeState4AllNotifications($notifications, $newState)
    {
        foreach ($notifications as $notification)
            $notification->setEvent($newState);

        return $notifications;
    }

    /**
     * @param PaymentDetail $paymentDetails
     * @param Purchase $purchase
     * @return PurchaseNotification[]
     */
    private function generateNotificationWithoutArticles(PaymentDetail $paymentDetails, Purchase $purchase)
    {
        $purchaseNotifications = [];

        $purchaseNotification = new PurchaseNotification();
        $purchaseNotification
            ->setIsReadyToNotify(true)
            ->setAmount($paymentDetails->getAmount())
            ->addPurchase($purchase)
            ->setApp($purchase->getApp())
        ;

        $this->em->persist($purchaseNotification);

        $purchaseNotifications[] = $purchaseNotification;

        if ($extraPN = $this->createUpdateExtraPurchaseNotification($purchase->getApp(), $purchaseNotification))
            $purchaseNotifications[]= $extraPN;

        return $purchaseNotifications;
    }

    private function createUpdateExtraPurchaseNotification(App $app, PurchaseNotification $purchaseNotification)
    {
        $purchaseNotificationExtra = null;

        if ($app->getUrlNotificationExtra())
        {
            $purchaseNotificationExtra = clone($purchaseNotification);

            if ($oldExtra = $this->em->getRepository("AppBundle:PurchaseNotification")->find($purchaseNotificationExtra->getId()))
            {
                $purchaseNotificationExtra = $oldExtra;
                $purchaseNotificationExtra
                    ->setIsReadyToNotify($purchaseNotification->getIsReadyToNotify())
                    ->setAmount($purchaseNotification->getAmount())
                    ->setPaymentDetailHasArticle($purchaseNotification->getPaymentDetailHasArticle())
                    ->setPurchases($purchaseNotification->getPurchases())
                    ->setApp($purchaseNotification->getApp())
                ;
            }

            $purchaseNotificationExtra->setIsExtra(true);
        }

        return $purchaseNotificationExtra;
    }

    /**
     * @param PaymentDetail $paymentDetails
     * @param Purchase $purchase
     * @return PurchaseNotification[]
     */
    private function generateNotificationsWithArticles(PaymentDetail $paymentDetails, Purchase $purchase)
    {
        $purchaseNotificationR = [];

        $partialPayment = $purchase->getPartialPayment();
        $notificationIsReady = $this->purchaseNotificationIsReadyToNotifyByPurchase($purchase);

        foreach ($paymentDetails->getPaymentDetailHasArticles() as $pda)
        {
            $purchaseNotification = new PurchaseNotification();

            if ($partialPayment)
            {
                if ($tmp = $this->em->getRepository("AppBundle:PurchaseNotification")->findOneByPartialPayment($partialPayment))
                {
                    $purchaseNotification = $tmp;
                }
            }

            if ($partialPayment)
            {
                $articleAmount = $purchase->getAmountGame();
                /** @var SubscriptionEventualityPayment $paymentProcess */
                $paymentProcess = $purchase->getPayment();
                $idEventuality = $paymentProcess->getSubscriptionEventuality()->getId();

                $purchases = $this->em->getRepository("AppBundle:Purchase")->findByPartial($idEventuality);

                // sum each partial purchase
                foreach ($purchases as $purchase)
                {
                    $articleAmount+= $purchase->getAmountGame();
                }

            }else{

                // we need to share the total money for each article of the shopping cart, and we will do the rule of three
                if ($pda->getAmount() != 0 && $paymentDetails->getAmount() != 0)
                    $articleAmount = ($purchase->getAmountGame() * $pda->getAmount()) / $paymentDetails->getAmount();
                else
                    $articleAmount = 0;

            }

            $total = $this->currencyExchange->getExchange($articleAmount, $paymentDetails->getCurrency(), CurrencyEnum::EURO);

            $purchaseNotification
                ->setIsReadyToNotify($notificationIsReady)
                ->setAmount($total)
                ->setPaymentDetailHasArticle($pda)
                ->setApp($purchase->getApp())
            ;

            if (count($pda->getPaymentDetailArticlesHasGivenArticles()) > 0)
            {
                $purchaseNotification->setMinDelay(new \DateTime('+7 minutes'));

                foreach ($pda->getPaymentDetailArticlesHasGivenArticles() as $index => $pdahga)
                {

                    $new = clone($purchaseNotification);

                    $new
                        ->setNumberOfPaymentDetailHasArticle($index+1)
                        ->setId((new PurchaseNotification())->getId()) // refresh new id
                        ->addPurchase($purchase)
                        ->setPaymentDetailArticlesHasGivenArticle($pdahga)
                    ;

                    $purchaseNotificationR[] = $new;

                    $purchaseNotificationR = $this->createOrUpdateExtraPurchaseNotificationAndAvoidDuplicates($purchaseNotificationR, $new);
                }

            }else{

                $purchaseNotification->addPurchase($purchase);
                $purchaseNotificationR[] = $purchaseNotification;

                $purchaseNotificationR = $this->createOrUpdateExtraPurchaseNotificationAndAvoidDuplicates($purchaseNotificationR, $purchaseNotification);
            }


        }

        return $purchaseNotificationR;
    }

    private function createOrUpdateExtraPurchaseNotificationAndAvoidDuplicates(array $purchaseNotificationR, PurchaseNotification $purchaseNotification)
    {
        if ($extraPN = $this->createUpdateExtraPurchaseNotification($purchaseNotification->getApp(), $purchaseNotification))
        {
            // remove old
            foreach ($purchaseNotificationR as $key=>$pn)
            {
                if ($pn->getId() == $extraPN->getId())
                {
                    unset($purchaseNotificationR[$key]);
                }
            }

            $purchaseNotificationR[]= $extraPN;
        }

        return $purchaseNotificationR;
    }

    private function purchaseNotificationIsReadyToNotifyByPurchase(Purchase $purchase)
    {
        $paymentProcess = $purchase->getPayment()->getPaymentProcess();


        $notificationIsReady = true;

        if ($paymentProcess instanceof Subscription)
        {
            /** @var SubscriptionEventualityPayment $payment */
            $payment = $purchase->getPayment();
            $subscription = $payment->getPaymentProcess();
            $subscriptionEventuality = $payment->getSubscriptionEventuality();

            if ($subscriptionEventuality->getTotalAmount() < $subscription->getAmountForEachPaymentToComplete())
            {
                $notificationIsReady = false;
            }
        }

        return $notificationIsReady;
    }

} 