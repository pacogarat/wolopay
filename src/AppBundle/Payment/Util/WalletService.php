<?php


namespace AppBundle\Payment\Util;

use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("wallet")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 */
class WalletService
{
    private $logger;

    /** @var EntityManagerInterface */
    protected $em;

    /** @var CurrencyService */
    protected $currencyService;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em"    = @Inject("doctrine.orm.default_entity_manager"),
     *    "currencyService" = @Inject("common.currency")
     * })
     */
    function __construct(Logger $logger, EntityManagerInterface $em, CurrencyService $currencyService)
    {
        $this->logger          = $logger;
        $this->em              = $em;
        $this->currencyService = $currencyService;
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $paymentCompletedEvent->getPayment();
        $transaction = $paymentCompletedEvent->getPaymentProcess()->getPaymentDetail()->getTransaction();
//        $this->notifyStatusUpdated($transaction->getId());
    }
} 