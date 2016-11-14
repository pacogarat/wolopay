<?php

namespace AppBundle\Payment\Actions;

use AppBundle\Command\AppNotificationCommand;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SinglePayment;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\SubscriptionEventuality;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Exception\NviaException;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentDetailBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Payment\Util\CalculateFee;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\PurchaseManager;
use AppBundle\Service\PurchaseNotificationService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("shop.payment.completed")
 */
class PaymentCompleted
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

    /** @var \AppBundle\Service\PurchaseManager */
    public  $purchaseManager;

    /** @var \AppBundle\Service\ArticleService */
    public $articleService;

    private $partialPayment=null;

    /** @var \AppBundle\Service\PurchaseNotificationService */
    public $purchaseNotificationService;

    /**
     * @InjectParams({
     *    "container" = @Inject("service_container"),
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "calculateFee" = @Inject("shop.payment.calculate_fee_service"),
     *    "appNotificationSend" = @Inject("command.shop.app_notification.send"),
     *    "currencyExchange" = @Inject("common.currency"),
     *    "purchaseManager" = @Inject("app.purchase_manager"),
     *    "articleService" =  @Inject("shop_app.article"),
     *    "purchaseNotificationService" =  @Inject("app.purchase_notification"),
     * })
     */
    function __construct(ContainerInterface $container, Logger $logger, EntityManager $em, CalculateFee $calculateFee,
        AppNotificationCommand $appNotificationSend, CurrencyService $currencyExchange, PurchaseManager $purchaseManager,
        ArticleService $articleService, PurchaseNotificationService $purchaseNotificationService)
    {
        $this->logger                      = $logger;
        $this->em                          = $em;
        $this->calculateFee                = $calculateFee;
        $this->appNotificationSend         = $appNotificationSend;
        $this->container                   = $container;
        $this->currencyExchange            = $currencyExchange;
        $this->purchaseManager             = $purchaseManager;
        $this->articleService              = $articleService;
        $this->purchaseNotificationService = $purchaseNotificationService;

    }

    public function execute(PaymentProcessInterface $paymentProcess, $transactionExternalId, PaymentFeeBean $feeBean =null,
        AmountBean $amountOverride = null, $CLI = false, PaymentDetailBean $paymentDetailBean=null)
    {
        /** @var AmountBean $amountOverride */
        $amountOverride = $amountOverride ?: new AmountBean();

        // Reset values
        $this->partialPayment = null;

        $paymentDetail = $paymentProcess->getPaymentDetail();
        $transaction    = $paymentDetail->getTransaction();

        $transaction->setReason(null); // clean pending or failed reasons

        if ($paymentProcess instanceof Subscription)
        {
            $payment = $this->configureSubscriptionPayment($paymentProcess);

        }else if ($paymentProcess instanceof SinglePayment){

            $transaction->setEndAtNow();
            $payment = $paymentProcess;
            $payment->setAmount($paymentDetail->getAmount());

        }else{

            throw new \Exception("Unknown process payment");
        }

        $payment
            ->setApp($transaction->getApp())
            ->setGamer($transaction->getGamer())
            ->setTransactionExternalId($transactionExternalId)
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find(
                PaymentStatusCategoryEnum::COMPLETED_ID
            ))
        ;

        if ($paymentDetailBean)
        {
            $arrT=$payment->getPaymentDetail()->getExtraData();
            $nArr=array_merge($arrT, $paymentDetailBean->providerMethodExtraData);
            $payment->getPaymentDetail()->setExtraData($nArr);
        }

        $transactionStatus = TransactionStatusCategoryEnum::COMPLETED_ID;
        $transaction
            ->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find($transactionStatus))
        ;

        $currencyUsed = $amountOverride->amountCurrency ?: $paymentDetail->getCurrency();
        $pricePaid = $amountOverride->amount ?: $payment->getAmount();
        $vatPaidByProvider = $amountOverride->vatAmount ?:0;

        $purchase = $this->purchaseManager->createByPayment(
            $payment,
            $currencyUsed,
            $pricePaid,
            $this->partialPayment,
            $amountOverride->exchangeEUR ?: $currencyUsed->getExchangeRateEur(),
            $amountOverride->exchangeUSD ?: $currencyUsed->getExchangeRateUsd(),
            $amountOverride->exchangeGBP ?: $currencyUsed->getExchangeRateGbp(),
            $CLI,
            $vatPaidByProvider
        );

        // Search actual paymethod provider
        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")
            ->findOneByPayMethodIdAndProviderIdAndCountryId(
                $paymentDetail->getPayMethod()->getId(),
                $paymentDetail->getProvider()->getId(),
                $paymentDetail->getCountry()->getId()
            )
        ;

        if (!$pmpc)
        {
            $msg = "Doesn't found a provider configuration to manage purchase! with params".
                ', Paymethod: ' . $paymentDetail->getPayMethod()->getId().' - '. $paymentDetail->getPayMethod().
                ', Provider: ' . $paymentDetail->getProvider()->getId().' - '. $paymentDetail->getProvider().
                ', Country: ' . $paymentDetail->getCountry()->getId().' - '. $paymentDetail->getCountry()
            ;

            throw new NviaException($msg);
        }

        // fill purchase with Profit
        $this->calculateFee->calculateByPurchase($purchase, $pmpc, $feeBean);

        $this->em->persist($purchase);
        $this->em->persist($payment);
        $this->em->flush();

        //Give REAL Articles in case of Gacha or random (BEFORE notifications!)
        $this->articleService->addGivenArticlesInSpecialTypeArticles($paymentDetail);

        $purchaseNotifications = $this->purchaseNotificationService->generateNotificationsToEvent($purchase);
        $this->em->flush();

        $this->em->refresh($payment);
        $this->em->refresh($paymentProcess);

        $this->logger->addInfo("Payment Process, payment and purchase were SAVED!");

        try{
            $this->logger->addInfo("Executing event: '".PaymentCompletedEvent::EVENT."'");
            $this->container->get('event_dispatcher')->dispatch(PaymentCompletedEvent::EVENT,
                new PaymentCompletedEvent($paymentProcess, $transactionExternalId, $payment, $purchase, $purchaseNotifications, $feeBean)
            );

        }catch (\Exception $e){
            $this->logger->addError("We have an error post payment in event: '".PaymentCompletedEvent::EVENT."' error message is: ".$e->getMessage());
        }

        return $purchase;
    }

    /**
     * @param Subscription $subscription
     * @return SubscriptionEventualityPayment
     */
    private function configureSubscriptionPayment(Subscription $subscription)
    {
        $subscription
            ->addNCompletedPayments(1)
        ;

        $subscriptionEventuality = new SubscriptionEventuality($subscription);
        if ($subscription->isAPartialPayment())
        {
            // its a Partial payment like SMS Subscription

            if ($tmp = $this->em->getRepository("AppBundle:SubscriptionEventuality")
                ->findOneBySubscriptionIdAndIsActive( $subscription->getId() ))
            {
                $subscriptionEventuality = $tmp;
            }

            $this->partialPayment = $subscriptionEventuality->getId();
        }

        $subscriptionEventuality
            ->addNPurchase()
            ->setSubscription($subscription)
            ->addTotalAmount($subscription->getAmountForEachPayment())
        ;

        if ($subscriptionEventuality->getTotalAmount() > $subscription->getAmountForEachPaymentToComplete())
        {
            $this->saveExtraMoneyInTheNextEventuality($subscription, $subscriptionEventuality);
        }

        if ($subscriptionEventuality->getTotalAmount() == $subscription->getAmountForEachPaymentToComplete())
        {
            $subscriptionEventuality->setEndAtNow();
            $this->notification = true;
        }

        $payment = new SubscriptionEventualityPayment($subscriptionEventuality);
        $payment
            ->setPaymentDetail($subscription->getPaymentDetail())
            ->setAmount($subscription->getAmountForEachPayment())
        ;

        $this->em->persist($subscriptionEventuality);

        return $payment;
    }

    private function saveExtraMoneyInTheNextEventuality(Subscription $subscription, SubscriptionEventuality $subscriptionEventuality)
    {
        $diff = $subscriptionEventuality->getTotalAmount() - $subscription->getAmountForEachPaymentToComplete();

        // Extra money Saved
        $seNext = new SubscriptionEventuality();
        $seNext
            ->setSubscription($subscription)
            ->addNPurchase(1)
            ->setTotalAmount($diff)
        ;

        $this->em->persist($seNext);

        $subscriptionEventuality->setTotalAmount($subscription->getAmountForEachPaymentToComplete());
    }


}