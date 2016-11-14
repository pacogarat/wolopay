<?php


namespace AppBundle\Payment\Other;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("app.internal_payment_notification")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.cancelled"})
 */
class InternalPaymentNotificationService
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @Inject("%business_intelligence_available%")
     * @var Boolean
     */
    public $businessActive;

    /**
     * @Inject("common.currency")
     * @var CurrencyService
     */
    public $currencyExchangeService;


    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $purchase = $paymentCompletedEvent->getPurchase();
        $transaction = $purchase->getTransaction();
        $app = $purchase->getApp();

        if ($transaction->getTest())
           return false;

        $firstLetter = (int)substr($purchase->getCountry()->getMCC(), 0, 1);
        $isEurope = ($firstLetter === 2 ? true: false );

        try{
            return $this->execute($app->getInternalPaymentNotificationUrl(), $purchase->getAmountGame(),
                $purchase->getProvider()->getName().$purchase->getPayMethod()->getPayCategory()->getName(),
                $purchase->getTransaction()->getId(), $purchase->getCurrency()->getId(),
                $purchase->getGamer()->getGamerExternalId(), $app->getId(), $isEurope
            );
        }catch (\Exception $e){
            // continue
        }

        return false;
    }

    /**
     * @param $appInternalPaymentUrl
     * @param $amount
     * @param $providerDesc
     * @param $transactionId
     * @param $currencyId
     * @param $externalUserId
     * @param string $gameId
     * @param bool $isEurope
     * @param bool $isCancellation
     * @return bool
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\BadResponseException
     * @throws \Exception
     */
    public function execute($appInternalPaymentUrl, $amount, $providerDesc, $transactionId, $currencyId,
        $externalUserId, $gameId= '', $isEurope=false, $isCancellation=false)
    {
        if (!$this->businessActive || !$appInternalPaymentUrl)
        {
            $this->logger->addInfo("Internal payment Notification are disabled");
            return false;
        }

        if ( ($gameId=='JAGGED54818b1882966') && (strpos($externalUserId,"_")!==false) )
        {
            $uid=$externalUserId;
            $cortado = explode("_", $uid, 2);
            $prefix = $cortado[0];

            if( $prefix == "es" || $prefix == "latam")
                $externalUserId = $cortado[1];
            else
                $externalUserId = $uid;
        }

        if ($isEurope)
            $currencyFinal = CurrencyEnum::EURO;
        else
            $currencyFinal = CurrencyEnum::DOLLAR;

        $amount = $this->currencyExchangeService->getExchangeSimple($amount, $currencyId, $currencyFinal);
        if ($isCancellation) $amount =  (-1) * $amount;

        if (strpos($appInternalPaymentUrl,'?') === false)
            $appInternalPaymentUrl .= '?';

        $url = $appInternalPaymentUrl . '&value=' . $amount . '&carrier=' . $transactionId . ':' . $currencyId. $providerDesc . '&uid=' . $externalUserId;

        $this->logger->addInfo("Internal payment notification: $url");

        try{

            $request = $this->guzzle->get($url);
            $response  = $request->send();

        }catch (BadResponseException $e){
            $response = $e->getResponse();

            $this->logger->addWarning("Notification error:" . $e->getMessage());
            throw $e;
        }catch (\Exception $e){

            $this->logger->addInfo("Crash ".$e->getMessage());
            throw $e;
        }

        return true;
    }

    public function onShopPaymentCancelled(PaymentCancelledEvent $paymentCancelledEvent)
    {
        if (!$paymentCancelledEvent->getWasCompletedBeforeCancelled()
            || !$paymentCancelledEvent->getNewPurchaseExtraCost()
            || $paymentCancelledEvent->getNewPurchaseExtraCost()->getTest()
        ) {
            return false;
        }

        $payment = $paymentCancelledEvent->getPayment();
        $purchase = $payment->getPurchase();
        /*
        $newPurchase = $paymentCancelledEvent->getNewPurchaseExtraCost();
        $oldPaymentProcess = $payment->getPaymentProcess();
        */
        $transaction = $purchase->getTransaction();
        $app = $purchase->getApp();

        if ($transaction->getTest())
            return false;

        $firstLetter = (int)substr($purchase->getCountry()->getMCC(), 0, 1);
        $isEurope = ($firstLetter === 2 ? true: false );
        $isCancel = true;

        try{
            $this->execute($app->getInternalPaymentNotificationUrl(), $purchase->getAmountGame(),
                $purchase->getProvider()->getName().$purchase->getPayMethod()->getPayCategory()->getName(),
                $purchase->getTransaction()->getId(), $purchase->getCurrency()->getId(),
                $purchase->getGamer()->getGamerExternalId(), $app->getId(), $isEurope, $isCancel
            );
        }catch (\Exception $e){
            // continue
        }
        return true;

    }

} 