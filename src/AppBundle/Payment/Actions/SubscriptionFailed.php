<?php

namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Subscription;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.subscription.failed")
 */
class SubscriptionFailed
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

    public function execute(Subscription $paymentProcess)
    {
        /** @var Subscription $paymentProcess */
        $paymentProcess
            ->setEndAtNow()
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find(
                PaymentStatusCategoryEnum::FAILED_ID
            ))
        ;

        $transaction = $paymentProcess->getPaymentDetail()->getTransaction();
        $transaction
            ->setEndAtNow()
            ->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
                    TransactionStatusCategoryEnum::FAILED_ID
            ))
        ;

        $this->logger->addInfo('Subscription '.$paymentProcess->getId().' was failed');

        $this->em->flush();

//        $this->container->get('event_dispatcher')
//            ->dispatch(SubscriptionCancelledEvent::EVENT, new SubscriptionCancelledEvent($paymentProcess))
//        ;
    }

}