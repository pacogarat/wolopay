<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\SubscriptionEventualityPayment;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.payment.un_cancelled")
 */
class PaymentUnCancelled
{
    private $logger;
    private $em;

    /** @var ContainerInterface */
    private $container;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "container" = @Inject("service_container")
     * })
     */
    function __construct(Logger $logger, EntityManager $em, ContainerInterface $container)
    {
        $this->logger    = $logger;
        $this->em        = $em;
        $this->container = $container;
    }

    public function execute(Payment $payment)
    {
        $fh = new \DateTime('now');
        $fhts = $fh->getTimestamp();

        if ($purchase = $payment->getPurchase())
        {
            if ($purchase->getWasCanceled())
            {
                $newPurchase = clone $purchase;
                $newPurchase->setExtraCostFromParent($purchase);
                $newPurchase->setReason('Uncancelled');
                $newPurchase->setAmountWolo(0);
                $newPurchase->setLastUpdateAt($fh);
                $newPurchase->setLastUpdatedAtUnix($fhts);

                $this->em->persist($newPurchase);
                $this->em->flush();
            }

            $purchase
                ->setWasCanceled(false)
                ->setCancelInProcess(false)
                ->setReason(null)
                ->setLastUpdateAt($fh)
                ->setLastUpdatedAtUnix($fhts);
            ;
        }

        if ($payment instanceof SubscriptionEventualityPayment)
            $payment
                ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                        ->find(PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID)
                );
        else
            $payment
                ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                        ->find(PaymentStatusCategoryEnum::COMPLETED_ID)
                );


        $this->em->flush();


        $this->logger->addInfo('Payment was UNCANCELED, Payment ID: '.$payment->getId());
    }

} 