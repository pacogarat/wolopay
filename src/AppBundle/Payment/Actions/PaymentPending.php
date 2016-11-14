<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Payment\Event\PaymentPendingEvent;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;


/**
 * @Service("shop.payment.pending")
 */
class PaymentPending
{
    private $logger;
    private $em;

    /** @var ContainerAwareEventDispatcher */
    private $dispacher;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "dispacher" = @Inject("event_dispatcher")
     * })
     */
    function __construct(Logger $logger, EntityManager $em, $dispacher)
    {
        $this->logger    = $logger;
        $this->em        = $em;
        $this->dispacher = $dispacher;
    }

    public function execute(PaymentProcessInterface $payment, $reason=null)
    {

        $payment->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                ->find(PaymentStatusCategoryEnum::PENDING_ID)
        );

        $transaction = $payment->getPaymentDetail()->getTransaction();
        if (in_array($transaction->getStatusCategory()->getId(), [TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
            TransactionStatusCategoryEnum::FAILED_ID]))
        {
            $transaction->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")
                    ->find(TransactionStatusCategoryEnum::PENDING_PAYMENT_ID)
            );
            $transaction->setReason($reason);
            $this->dispacher->dispatch(PaymentPendingEvent::EVENT, new PaymentPendingEvent($payment));
        }

        $this->logger->addInfo('now actual TransactionStatus: '.$transaction->getStatusCategory()->getName());

        $this->em->flush();

        $this->logger->addInfo('Payment is pending reason: '.$reason);
    }

}
