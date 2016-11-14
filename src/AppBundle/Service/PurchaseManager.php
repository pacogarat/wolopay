<?php

namespace AppBundle\Service;

use AppBundle\Command\AppNotificationCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\Provider;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Transaction;
use AppBundle\Payment\Bean\PaymentExtraCostBean;
use AppBundle\Payment\Util\CalculateFee;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("app.purchase_manager")
 */
class PurchaseManager
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
    public $appNotificationSend;

    /** @var \AppBundle\Service\CurrencyService  */
    public  $currencyExchange;


    /**
     * @InjectParams({
     *    "container" = @Inject("service_container"),
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "calculateFee" = @Inject("shop.payment.calculate_fee_service"),
     *    "appNotificationSend" = @Inject("command.shop.app_notification.send"),
     *    "currencyExchange" = @Inject("common.currency")
     * })
     */
    function __construct(ContainerInterface $container, Logger $logger, EntityManager $em, CalculateFee $calculateFee,
        AppNotificationCommand $appNotificationSend, CurrencyService $currencyExchange)
    {
        $this->logger              = $logger;
        $this->em                  = $em;
        $this->calculateFee        = $calculateFee;
        $this->appNotificationSend = $appNotificationSend;
        $this->container           = $container;
        $this->currencyExchange    = $currencyExchange;
    }

    /**
     * @param Purchase $purchase
     * @param string $reason
     * @return Purchase
     */
    public function savePurchaseWithNegativeValues(Purchase $purchase, $reason = 'Payment cancelled')
    {
        $payment = $purchase->getPayment();
        $purchaseFromPayment = $payment->getPurchase();
        $currency = $purchaseFromPayment->getCurrency();

        $purchase = $this->createByPayment(
            $payment,
            $currency,
            0,
            null,
            $purchaseFromPayment->getExchangeRateEur(),
            $purchaseFromPayment->getExchangeRateUsd(),
            $purchaseFromPayment->getExchangeRateGbp(),
            true,
            0
        );

        /*when theres a refund, all is paid by the game -so far*/
        $purchase
            ->setAmountTotal(-$purchaseFromPayment->getAmountTotal() - $purchaseFromPayment->getAmountWolo())
            ->setAmountGame(-$purchaseFromPayment->getAmountGame() - $purchaseFromPayment->getAmountWolo())
            ->setAmountProvider(0)
            ->setAmountTaxPaidByProvider(-$purchaseFromPayment->getAmountTaxPaidByProvider())
            ->setAmountBeforeTaxes(-$purchaseFromPayment->getAmountBeforeTaxes())
            ->setAmountTax(-$purchaseFromPayment->getAmountTax())
            ->setAmountWolo(0)
            ->setReason($reason)
            ->setPayment(null)
            ->setExtraCostFromParent($purchaseFromPayment)
        ;

        $this->logger->addInfo("Created a negative new purchase to restore amounts from purchase table, ".
            "amountTotal: ".$purchase->getAmountTotal().", amountGame: ".$purchase->getAmountGame().", ".
            "amountTax: ".$purchase->getAmountTax().", amountTaxPaidByProvide: ".$purchase->getAmountTaxPaidByProvider().
            ", Payment reference: ".$payment->getId()
        );

        $this->em->persist($purchase);
        $this->em->flush();

        return $purchase;
    }

    /**
     * @param Payment $payment
     * @param Currency $currencyUsed
     * @param $amountTotal
     * @param $partialPayment
     * @param $exchangeEUR
     * @param $exchangeUSD
     * @param $exchangeGBP
     * @param $isCLI
     * @param $amountProviderTax
     * @return \AppBundle\Entity\Purchase
     */
    public function createByPayment(
        Payment $payment,
        Currency $currencyUsed,
        $amountTotal,
        $partialPayment,
        $exchangeEUR,
        $exchangeUSD,
        $exchangeGBP,
        $isCLI,
        $amountProviderTax
    )
    {
        $paymentDetails = $payment->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();

        return $this->create(
            $paymentDetails->getProvider(),
            $paymentDetails->getCountry(),
            $paymentDetails->getPayMethod(),
            $currencyUsed,
            $transaction->getApp(),
            $transaction->getGamer(),
            $transaction,
            $payment,
            $amountTotal,
            $partialPayment,
            $exchangeEUR,
            $exchangeUSD,
            $exchangeGBP,
            $isCLI,
            $amountProviderTax,
            $paymentDetails->getUsedAppProviderCredentials(),
            $paymentDetails->getCountryConfigured()
        );
    }

    public function create(
        Provider $provider,
        Country $country,
        PayMethod $payMethod,
        Currency $currencyUsed,
        App $app,
        Gamer $gamer,
        Transaction $transaction,
        $payment,
        $amountTotal,
        $partialPayment,
        $exchangeEUR,
        $exchangeUSD,
        $exchangeGBP,
        $isCLI,
        $amountProviderTax,
        $usedAppProviderCredentials,
        Country $countryConfigured = null
    )
    {
        $purchase = new Purchase();

        $purchase
            ->setUsedAppProviderCredentials($usedAppProviderCredentials)
            ->setProvider($provider)
            ->setCountry($country)
            ->setPayMethod($payMethod)
            ->setCurrency($currencyUsed)
            ->setApp($app)
            ->setGamer($gamer)
            ->setTransaction($transaction)
            ->setPayment($payment)
            ->setAmountTotal( $amountTotal )
            ->setPartialPayment($partialPayment)
            ->setExchangeRateEur($exchangeEUR)
            ->setExchangeRateUsd($exchangeUSD)
            ->setExchangeRateGbp($exchangeGBP)
            ->setCli($isCLI)
            ->setTest($transaction->getTest())
            ->setAmountTaxPaidByProvider($amountProviderTax)
            ->setCountryConfigured($countryConfigured)
        ;

        return $purchase;
    }
}