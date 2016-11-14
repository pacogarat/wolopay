<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use AppBundle\Entity\Payment;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Service\PurchaseManager;
use AppBundle\Service\PurchaseNotificationService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.payment.cancelled")
 */
class PaymentCancelled
{
    private $logger;
    private $em;

    /** @var ContainerInterface */
    private $container;

    /** @var PurchaseManager */
    private $purchaseManager;

    /** @var PurchaseNotificationService */
    private $purchaseNotificationService;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "container" = @Inject("service_container"),
     *    "purchaseManager" = @Inject("app.purchase_manager"),
     *    "purchaseNotificationService" = @Inject("app.purchase_notification"),
     * })
     */
    function __construct(Logger $logger, EntityManager $em, ContainerInterface $container, PurchaseManager $purchaseManager, PurchaseNotificationService $purchaseNotificationService)
    {
        $this->logger                      = $logger;
        $this->em                          = $em;
        $this->container                   = $container;
        $this->purchaseManager             = $purchaseManager;
        $this->purchaseNotificationService = $purchaseNotificationService;
    }

    public function execute(Payment $payment, $reason='', $calledByMerchantNow=false)
    {
        $wasCompletedBeforeCancelled = false;
        $newPurchaseExtraCost = null;

        if ($payment->getStatusCategory()->getId() === PaymentStatusCategoryEnum::COMPLETED_ID )
        {
            $fh = new \DateTime('now');
            $fhts = $fh->getTimestamp();

            $wasCompletedBeforeCancelled = true;
            $purchase = $payment->getPurchase();
            $purchase
                ->setWasCanceled(true)
                ->setCancelInProcess(false)
                ->setReason($reason)
                ->setLastUpdateAt($fh)
                ->setLastUpdatedAtUnix($fhts)
            ;

            $newPurchaseExtraCost = $this->purchaseManager->savePurchaseWithNegativeValues($purchase, $reason);
            $this->purchaseNotificationService->generateNotificationsToEvent($purchase, PurchaseNotificationEventEnum::PAYMENT_CANCELLED);
        }

        $payment
            ->setStatusCategory(
                $this->em->getRepository("AppBundle:PaymentStatusCategory")->find(PaymentStatusCategoryEnum::CANCELED_ID)
            );

        $this->em->flush();

        $this->container->get('event_dispatcher')
            ->dispatch(PaymentCancelledEvent::EVENT,
                new PaymentCancelledEvent(
                    $payment,
                    $payment->getTransactionExternalId(),
                    $wasCompletedBeforeCancelled,
                    $reason,
                    $calledByMerchantNow,
                    $newPurchaseExtraCost
                )
            )
        ;

        $this->logger->addInfo('Payment was Canceled, Payment ID: '.$payment->getId());
    }

} 