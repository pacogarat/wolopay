<?php

namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Subscription;
use AppBundle\Payment\Event\SubscriptionFinishedEvent;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.subscription.finished")
 */
class SubscriptionFinished
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
        $paymentProcess
            ->setEndAtNow()
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find(
                PaymentStatusCategoryEnum::COMPLETED_ID
            ))
        ;

        $this->logger->addInfo('Subscription '.$paymentProcess->getId().' finished');

        $this->em->flush();

        $this->container->get('event_dispatcher')
            ->dispatch(SubscriptionFinishedEvent::EVENT, new SubscriptionFinishedEvent($paymentProcess));
    }

}