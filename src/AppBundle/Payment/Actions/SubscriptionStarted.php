<?php

namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Subscription;
use AppBundle\Payment\Event\SubscriptionStartedEvent;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.subscription.started")
 */
class SubscriptionStarted
{
    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;

    /**
     * @var EntityManager
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var \Monolog\Logger
     * @Inject("logger")
     */
    public $logger;

    public function execute(Subscription $paymentProcess, $transactionExternalId)
    {
        $paymentDetail = $paymentProcess->getPaymentDetail();

        $transaction = $paymentDetail->getTransaction();

        $transaction
            ->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
                TransactionStatusCategoryEnum::COMPLETED_ID
            ))
        ;

        $paymentProcess
            ->setTransactionExternalId($transactionExternalId)
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find(
                PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID
            ))
        ;

        $this->logger->addInfo('Subscription '.$paymentProcess->getId().' started, transactionExternalId: '
            .$transactionExternalId
        );

        $this->em->flush();

        $this->container->get('event_dispatcher')
            ->dispatch(SubscriptionStartedEvent::EVENT, new SubscriptionStartedEvent($paymentProcess, $transactionExternalId));
    }

}