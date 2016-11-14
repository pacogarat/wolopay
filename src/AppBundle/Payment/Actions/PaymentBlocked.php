<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Payment;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.blocked")
 */
class PaymentBlocked
{
    private $logger;
    private $em;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    function __construct(Logger $logger, EntityManager $em)
    {
        $this->logger = $logger;
        $this->em     = $em;
    }

    public function execute(Payment $payment)
    {
        $fh = new \DateTime('now');
        $fhts = $fh->getTimestamp();

        $payment->setStatusCategory(
            $this->em->getRepository("AppBundle:PaymentStatusCategory")
                ->find(PaymentStatusCategoryEnum::BLOCKED_ID)
        );

        if ($payment->getPurchase())
        {
            $payment->getPurchase()
                ->setWasCanceled(true)
                ->setReason('Payment Blocked')
                ->setLastUpdateAt($fh)
                ->setLastUpdatedAtUnix($fhts)
            ;
        }

        $this->em->flush();

        $this->logger->addCritical('Payment was Blocked!');
    }

} 