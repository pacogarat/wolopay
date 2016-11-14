<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Payment;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.unblocked")
 */
class PaymentUnBlocked
{
    /** @var \Monolog\Logger  */
    private $logger;
    /** @var \Doctrine\ORM\EntityManager  */
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
                ->find(TransactionStatusCategoryEnum::COMPLETED_ID)
        );

        if ($payment->getPurchase())
        {
            $payment->getPurchase()
                ->setWasCanceled(false)
                ->setReason(null)
                ->setLastUpdateAt($fh)
                ->setLastUpdatedAtUnix($fhts)
            ;
        }

        $this->em->flush();

        $this->logger->addInfo('Payment was UnBlocked!');
    }

} 