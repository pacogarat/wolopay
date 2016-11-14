<?php

namespace AppBundle\Payment\Actions;

use AppBundle\Command\AppNotificationCommand;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Purchase;
use AppBundle\Payment\Bean\PaymentExtraCostBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\Event\PurchaseExtraCostEvent;
use AppBundle\Payment\Util\CalculateFee;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\PurchaseManager;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.payment.purchase_extra_cost")
 */
class PurchaseExtraCost
{
    /** @var ContainerInterface */
    private $container;

    /** @var EntityManager */
    private $em;

    /** @var CalculateFee */
    private $calculateFee;

    /** @var \Monolog\Logger*/
    private $logger;

    /** @var \AppBundle\Command\AppNotificationCommand  */
    private $appNotificationSend;

    /** @var \AppBundle\Service\CurrencyService  */
    private  $currencyExchange;

    /** @var \AppBundle\Service\PurchaseManager */
    private
        $purchaseManager;

    /**
     * @InjectParams({
     *    "container" = @Inject("service_container"),
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "calculateFee" = @Inject("shop.payment.calculate_fee_service"),
     *    "appNotificationSend" = @Inject("command.shop.app_notification.send"),
     *    "currencyExchange" = @Inject("common.currency"),
     *    "purchaseManager" = @Inject("app.purchase_manager")
     * })
     */
    function __construct(ContainerInterface $container, Logger $logger, EntityManager $em, CalculateFee $calculateFee,
        AppNotificationCommand $appNotificationSend, CurrencyService $currencyExchange, PurchaseManager $purchaseManager)
    {
        $this->logger              = $logger;
        $this->em                  = $em;
        $this->calculateFee        = $calculateFee;
        $this->appNotificationSend = $appNotificationSend;
        $this->container           = $container;
        $this->currencyExchange    = $currencyExchange;
        $this->purchaseManager     = $purchaseManager;
    }

    /**
     * @param PurchaseExtraCostBean $purchaseExtraCostBean
     * @param Purchase $purchase
     * @param $reason
     * @throws \Exception
     * @return Purchase
     */
    public function purchaseExtraCost(PurchaseExtraCostBean $purchaseExtraCostBean, Purchase $purchase, $reason)
    {
        $currency = $purchase->getCurrency();

        if ($purchaseExtraCostBean->currencyId)
        {
            if (!$currency = $this->em->getRepository("AppBundle:Currency")->find($purchaseExtraCostBean->currencyId))
                throw new \Exception("Currency id '$purchaseExtraCostBean->currencyId' not found");
        }

        $payment = $purchase->getPayment();

        $newPurchase = $this->purchaseManager->createByPayment(
            $payment,
            $currency,
            $purchaseExtraCostBean->amountTotal,
            false,
            $currency->getExchangeRateEur(),
            $currency->getExchangeRateUsd(),
            $currency->getExchangeRateGbp(),
            true,
            0
        );

        $newPurchase
            ->setAmountTotal($purchaseExtraCostBean->amountTotal)
            ->setAmountGame($purchaseExtraCostBean->amountGame)
            ->setAmountProvider($purchaseExtraCostBean->amountProvider)
            ->setAmountTax($purchaseExtraCostBean->amountTax)
            ->setAmountWolo($purchaseExtraCostBean->amountWolo)
            ->setAmountTaxPaidByProvider(0)
            ->setTaxPercent(0)
            ->setAmountBeforeTaxes(0)
            ->setReason($reason)
            ->setPayment(null)
            ->setExtraCostFromParent($purchase)
        ;

        $this->logger->addInfo(
            "Purchase Saved (ExtraCost) $reason, Amount Total: " . $newPurchase->getAmountTotal() . " " . $currency->getId() .
            ", Payment reference: " . $payment->getId() . ", Profit sharing, Provider: " . $newPurchase->getAmountProvider().
            ", Wolo: " . $newPurchase->getAmountWolo() . ", Game: " . $newPurchase->getAmountGame() . ", Tax: " . $newPurchase->getAmountTax()
        );

        $this->em->persist($newPurchase);
        $this->em->flush();

        $this->container->get('event_dispatcher')
            ->dispatch(PurchaseExtraCostEvent::EVENT, new PurchaseExtraCostEvent($newPurchase))
        ;

        return $newPurchase;
    }
}