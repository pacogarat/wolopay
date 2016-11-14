<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Payment;
use AppBundle\Payment\Event\PaymentFailedEvent;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.payment.failed")
 */
class PaymentFailed
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

    public function execute(Payment $payment, $reason=null)
    {
        $this->logger->addInfo('Payment was Failed');

        $payment->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                ->find(PaymentStatusCategoryEnum::FAILED_ID)
        );

        $this->em->flush();

        $this->container->get('event_dispatcher')
            ->dispatch(PaymentFailedEvent::EVENT, new PaymentFailedEvent($payment))
        ;
    }

} 