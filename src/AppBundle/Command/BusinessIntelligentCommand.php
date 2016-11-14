<?php


namespace AppBundle\Command;

use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailArticlesHasGivenArticle;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\Transaction;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Payment\Event\PurchaseExtraCostEvent;
use AppBundle\Payment\Event\TransactionStartedEvent;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\IPInfoService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;

/**
 * @Service("shop_app.business_intelligent")
 * @Tag("console.command")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.cancelled"})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.transaction.started"})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.purchase.extra_cost"})
 */
class BusinessIntelligentCommand extends Command
{
    /** @var \Doctrine\ORM\EntityManager  */
    protected $em;

    /** @var  Logger */
    protected $logger;

    /** @var  CurrencyService */
    protected $currencyService;

    /** @var  IPInfoService */
    protected $ipInfoService;

    /** @var String */
    protected $businessInteligenceAvailable;

    /** @var String */
    protected $rootDir;

    /** @var String */
    protected $env;

    /** @var String */
    protected $phpExePath;

    const ADDRESS = '193.219.96.147';
    const PORT    = '10107';


    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "businessInteligenceAvailable" = @Inject("%business_intelligence_available%"),
     *    "rootDir" = @Inject("%kernel.root_dir%"),
     *    "env" = @Inject("%kernel.environment%"),
     *    "phpExePath" = @Inject("%php_exe_path%"),
     *    "currencyService" = @Inject("common.currency"),
     *    "ipInfoService" = @Inject("common.ip_info"),
     * })
     */
    function __construct(EntityManager $em, Logger $logger, $businessInteligenceAvailable, CurrencyService $currencyService, $rootDir, $env, IPInfoService $ipInfoService, $phpExePath)
    {
        $this->em              = $em;
        $this->logger          = $logger;
        $this->currencyService = $currencyService;
        $this->ipInfoService   = $ipInfoService;
        $this->rootDir         = $rootDir;
        $this->env             = $env;
        $this->phpExePath      = $phpExePath;

        $this->businessInteligenceAvailable = $businessInteligenceAvailable;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('shop:business_intelligent:send')
            ->setDescription('Send msg to business Intelligent')
            ->addArgument('msg', InputArgument::REQUIRED, 'msg')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $msg = $input->getArgument('msg');
        $this->sendBusinessIntelligence($msg);
    }

    public function sendBusinessIntelligence($msg)
    {
        if ($this->businessInteligenceAvailable)
        {
            try{
                $this->sendToSonic($msg, self::ADDRESS, self::PORT);
            }catch (\Exception $e){
                $this->logger->addError($e->getMessage());
            }
        }
    }

    public function sendToSonic($msg, $address, $port)
    {
        $this->logger->addInfo("Sonic msg: $msg");
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket < 1) {
            throw new \Exception("ERROR: socket_create() failed, reason: " . socket_strerror($socket));
        } else {
            // timeout
            $timeout = 5;

            socket_set_nonblock($socket);
            $time = time();

            // loop until a connection is gained or timeout reached
            while (!@socket_connect($socket, $address, $port)) {
                $err = socket_last_error($socket);

                // success!
                if($err === 56) {
                    break;
                }

                // if timeout reaches then call exit();
                if ((time() - $time) >= $timeout) {

                    socket_close($socket);
                    throw new \RuntimeException("cannot establish connection with business intelligent, timeout");
                }

                // sleep for a bit
                usleep(250000);
            }

            socket_write($socket, $msg, strlen($msg));
            socket_close($socket);
        }
    }

    public function onShopPurchaseExtraCost(PurchaseExtraCostEvent $purchaseExtraCostEvent)
    {
        $newPurchase = $purchaseExtraCostEvent->getNewPurchase();

        if ($newPurchase->getTest())
            return;

        $oldPurchase = $newPurchase->getExtraCostFromParent();
        $oldPayment = $oldPurchase->getPayment();
        $oldPaymentProcess = $oldPayment->getPaymentProcess();

        $msg = $this->createMessageOnExtraCost($newPurchase, $oldPurchase, $oldPaymentProcess, $oldPayment);
        $this->asyncMSG($msg);

        return $msg;
    }

    public function onShopPaymentCancelled(PaymentCancelledEvent $paymentCancelledEvent)
    {
        if (!$paymentCancelledEvent->getWasCompletedBeforeCancelled()
            || !$paymentCancelledEvent->getNewPurchaseExtraCost()
            || $paymentCancelledEvent->getNewPurchaseExtraCost()->getTest()
        ) {
            return;
        }

        $payment = $paymentCancelledEvent->getPayment();
        $purchase = $payment->getPurchase();
        $newPurchaseExtraCost = $paymentCancelledEvent->getNewPurchaseExtraCost();

        $oldPaymentProcess = $payment->getPaymentProcess();

        $msg = $this->createMessageOnExtraCost($newPurchaseExtraCost, $purchase, $oldPaymentProcess, $payment);
        $msg = str_replace('WOLO2|RPAYMENT', 'WOLO2|REFUND', $msg);

        $this->asyncMSG($msg);

        return $msg;
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $payment = $paymentCompletedEvent->getPayment();
        $paymentProcess = $paymentCompletedEvent->getPaymentProcess();
        $paymentDetail = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetail->getTransaction();

        $msg = $this->createMessagesOnPurchase($payment, $paymentProcess, $paymentDetail, $transaction);

        $this->asyncMSG($msg);

        return $msg;
    }

    protected function createMessageOnExtraCost(Purchase $newPurchase, Purchase $oldPurchaseReference, PaymentProcessInterface $oldPaymentProcess, Payment $oldPayment)
    {
        $paymentDetails = $oldPaymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();

        $msgStatic = $this->getStaticPurchaseMessage();

        $searchAndReplace = [
            'WOLO2|COMPRA' => 'WOLO2|RPAYMENT',
            '{{purchase_id}}'          => $newPurchase->getId(),
            '{{purchase_price_final}}' => $newPurchase->getAmountTotal(),
            '{{purchase_price_final_euros}}' => $newPurchase->getAmountTotal()*$newPurchase->getExchangeRateEur(),

            '{{article_price_local_currency}}' => $newPurchase->getAmountTotal(),
            '{{article_price_euros_currency}}' => $newPurchase->getAmountTotal()*$newPurchase->getExchangeRateEur(),

            '{{purchase_currency_iso}}' => $newPurchase->getCurrency()->getId(),
            '{{purchase_currency_exchange_currency_vs_euros}}' => $newPurchase->getExchangeRateEur(),
            '{{game_price_purchase_currency}}' => $newPurchase->getAmountGame(),

            '{{game_price_euros_currency}}' => $newPurchase->getAmountGame() * $newPurchase->getExchangeRateEur(),
            '{{purchase_tax_percent}}' => $newPurchase->getTaxPercent(),
            '{{purchase_tax_amount_purchase_currency}}' => $newPurchase->getAmountTax(),

            '{{purchase_provider_fee_percent}}' => $newPurchase->getProviderFeePercent(),
            '{{purchase_provider_fee_amount_purchase_currency}}' => $newPurchase->getAmountProvider(),

            '{{parent_purchase}}' => $oldPurchaseReference->getId()
        ];

        $msg = str_replace(array_keys($searchAndReplace), $searchAndReplace, $msgStatic );

        $msg = $this->createMessagesOnPurchase($oldPayment, $oldPaymentProcess, $paymentDetails, $transaction, $msg);

        if (is_array($msg))
            return $msg[0];

        return $msg;
    }

    protected function createMessagesOnPurchase(
        Payment $payment,
        PaymentProcessInterface $paymentProcess,
        PaymentDetail $paymentDetail,
        Transaction $transaction,
        $msg = null
    )
    {
        if ($paymentProcess instanceof SingleCustomPayment || $transaction->getArticleVirtualCurrency())
            return $this->createMessageOnPurchase($payment, $paymentProcess, $transaction, $msg);

        $msgs = [];

        foreach ($paymentDetail->getPaymentDetailHasArticles() as $pdha)
        {
            for ($i=0; $i< $pdha->getArticlesQuantity(); $i++)
            {
                $msgs []= $this->createMessageOnPurchase($payment, $paymentProcess, $transaction, $pdha, $msg, $i);
            }
        }

        if (count($msgs) > 0)
        {
            $details = $msgs;
            array_walk($details, function(&$row, $key){
                $row = str_replace('|COMPRA|', '|DETALLE|', $row);
            });
            $msgs = array_merge([ $msgs[0] ], $details);
        }

        return $msgs;
    }


    protected function createMessageOnPurchase(
        Payment $payment,
        PaymentProcessInterface $paymentProcess,
        Transaction $transaction,
        PaymentDetailHasArticles $paymentDetailArticle = null,
        $msg = null,
        $lap = 1
    )
    {
        if ($transaction->getTest())
            return ;

        $purchase = $payment->getPurchase();

        $article = $offerProgrammer = $priceOffer = $articleSpecialType = null;
        $givenArticles = $extraArticles = $extraArticlesTemp = [];
        $appShopHasArticle = null;

        if ($paymentProcess instanceof SingleCustomPayment)
        {
            $articleName = $transaction->getCustomArticleTitle();
            $itemsQuantity = 1;

        }else if($transaction->getArticleVirtualCurrency()){

            $country = $transaction->getCountryVirtualCurrency();
            $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdAndLevelCategory($country->getId(), $transaction->getArticleVirtualCurrency()->getId(), $transaction->getLevelCategory()->getId());

            $article = $appShopHasArticle->getArticle();
            $articleName = $this->getTranslation($article->getNameCurrentLabel(), $appShopHasArticle->getCurrentItemsQuantity());
            $itemsQuantity = $appShopHasArticle->getCurrentItemsQuantity();
            $offer = $appShopHasArticle->getOffer();
            $offerProgrammer = $offer ? $offer->getOfferProgrammer() : null;
            $priceOffer = $offer ? $offer->getAmount() : null;
            $articleSpecialType = $article->getSpecialType() ?: 'normal';

        }else{

            $appShopHasArticle = $paymentDetailArticle->getAppShopHasArticle();
            $offerProgrammer = $paymentDetailArticle->getOfferProgrammer();
            $priceOffer = $paymentDetailArticle->getOfferProgrammer() ? $paymentDetailArticle->getAmount() : null;

            $article = $paymentDetailArticle->getArticle();
            $itemsQuantity = $paymentDetailArticle->getItemsQuantity();
            $articleName = $this->getTranslation($article->getNameCurrentLabel(), $paymentDetailArticle->getItemsQuantity());
            $articleSpecialType = $article->getSpecialType() ?: 'normal';
            $extraArticlesTemp = $article->getArticlesExtra();
        }

        $formatDateTimeDB = 'Y-m-d H:i:s';

        if ($appShopHasArticle)
        {
            $articleName = $this->getTranslation($article->getNameCurrentLabel(), $appShopHasArticle->getCurrentItemsQuantity());
            $extraArticlesTemp = $appShopHasArticle->getArticlesExtra();
        }

        /** @var PaymentDetailArticlesHasGivenArticle $paymentDetailArticleHGA */
        if ($paymentDetailArticle && $paymentDetailArticleHGA = $paymentDetailArticle->getPaymentDetailArticlesHasGivenArticles()->get($lap))
        {
            $givenArticle = $paymentDetailArticleHGA->getArticle();

            $givenArticles[]=[
                $givenArticle->getSpecialType() ?: 'normal',
                $givenArticle->getItem()->getId(),
                $givenArticle->getItemsQuantity(),
                $this->getTranslation($givenArticle->getNameCurrentLabel(), $givenArticle->getItemsQuantity()),
            ];
        }

        foreach ($extraArticlesTemp as $extraArticle)
        {
            $extraArticles[]= [
                $extraArticle->getSpecialType() ?: 'normal',
                $extraArticle->getItem()->getId(),
                $extraArticle->getItemsQuantity(),
                $this->getTranslation($extraArticle->getNameCurrentLabel(), $extraArticle->getItemsQuantity()),
            ];
        }

        if ($appShopHasArticle && $transaction->getCountryDetected())
        {
            if ( (strripos($purchase->getPayMethod()->getName(),"SMS")!==false) || (strripos($purchase->getPayMethod()->getName(),"Voice")!==false) ){
                $localPrice =  $purchase->getAmountTotal();
            }else{
                $localPrice = $this->currencyService->getExchange($appShopHasArticle->getCurrentAmount(), $appShopHasArticle->getCountry()->getCurrency(), $transaction->getCountryDetected()->getCurrency()->getId());
            }
            $euroPrice = $this->currencyService->getExchange($localPrice, $purchase->getCurrency(), CurrencyEnum::EURO);
        }
        else
        {
            $localPrice = 0;
            $euroPrice = $this->currencyService->getExchange($purchase->getAmountTotal(), $purchase->getCurrency(), CurrencyEnum::EURO);
        }

        if ($msg === null)
            $msg = $this->getStaticPurchaseMessage();

        $replaceVars = [
            '{{transaction_id}}' => $transaction->getId(),
            '{{purchase_id}}'    => $purchase->getId(),
            '{{purchase_type_id}}' => $purchase->isASubscription() ? 'subscription' : 'single_payment',
            '{{purchase_status}}' => $purchase->getWasCanceled() ? 'canceled' : 'completed',
            '{{purchase_date+time}}' => $purchase->getCreatedAt()->format($formatDateTimeDB),
            '{{purchase_local_user_date+time}}' => $this->getLocalDateTimeToFormat($purchase->getCreatedAt(), $transaction->getCountryDetected(), $formatDateTimeDB),
            '{{purchase_country_iso}}' => $purchase->getCountryConfigured() ? $purchase->getCountryConfigured()->getId() : $purchase->getCountry()->getId(),
            '{{purchase_price_final}}' => $purchase->getAmountTotal(),
            '{{purchase_price_final_euros}}' => $this->currencyService->getExchange($purchase->getAmountTotal(), $purchase->getCurrency(), CurrencyEnum::EURO) ,
            '{{article_price_local_currency}}' => $localPrice,
            '{{article_price_euros_currency}}' => $euroPrice,

            // Currency
            '{{purchase_currency_iso}}' => $purchase->getCurrency()->getId() ,
            '{{purchase_currency_exchange_currency_vs_euros}}' => $purchase->getExchangeRateEur() ,

            // Breakdown
            '{{game_price_purchase_currency}}' => $purchase->getAmountGame(),
            '{{game_price_euros_currency}}' => $this->currencyService->getExchange($purchase->getAmountGame(), $purchase->getCurrency(), CurrencyEnum::EURO) ,
            '{{purchase_tax_percent}}' => $purchase->getTaxPercent(),
            '{{purchase_tax_amount_purchase_currency}}' => $purchase->getRealAmountTax(),
            '{{purchase_provider_fee_percent}}' => $purchase->getProviderRealFeePercent(),
            '{{purchase_provider_fee_amount_purchase_currency}}' => $purchase->getAmountProvider(),

            // Offer
            '{{price_offer}}' => $priceOffer,
            '{{price_original}}' => $appShopHasArticle ? $appShopHasArticle->getAmount() : $purchase->getAmountTotal(),
            '{{offer_name}}' => $offerProgrammer ? $offerProgrammer->getName() : '',
            '{{items_quantity_offer}}' => $offerProgrammer ? $itemsQuantity : '',
            '{{items_quantity_original}}' =>  $article instanceof Article ? $article->getItemsQuantity() : 1,

            // Article
            '{{item_id}}' => $article instanceof Article ? $article->getItem()->getId() : '',
            '{{quantity_final}}' => $itemsQuantity,
            '{{article_name}}' => $articleName,

            // PayMethod details
            '{{category_pay_method_name}}' => $purchase->getPayMethod()->getPayCategory()->getName(),
            '{{pay_method_name}}' => $purchase->getPayMethod()->getName(),
            '{{pay_method_provider_name}}' => $purchase->getProvider()->getName(),

            // User Details
            '{{user_id}}' => $purchase->getGamer()->getId(),
            '{{external_user_id}}' => $purchase->getGamer()->getGamerExternalId(),
            '{{user_level}}' => $transaction->getValueCurrent(),
            '{{user_country_iso}}' => $transaction->getCountryDetected() ? $transaction->getCountryDetected()->getId() : '',

            // App Details
            '{{app_id}}' => $purchase->getApp()->getId(),
            '{{app_shop_level}}' => $transaction->getLevelCategory() ? $transaction->getLevelCategory()->getName() : '',
            '{{app_shop_theme}}' => $transaction->getCss() ? $transaction->getCss()->getName() : '',

            '{{parent_purchase}}' => '',

            // ADDED AFTER...
            '{{article_special_type}}' => $articleSpecialType,
            '{{json_4_especial_articles}}' => json_encode([
                    'givenArticles' => $givenArticles,
                    'extraArticles' => $extraArticles
                ]),
        ];

        $result = str_replace(array_keys($replaceVars), $replaceVars, $msg);
        $result = str_replace(['"',"'"], ['',''], $result);

        return $result;
    }

    private function getStaticPurchaseMessage()
    {
        // If you modify this order you need change extra cost replace
        // Basic Data
        return "WOLO2|COMPRA|{{transaction_id}}|{{purchase_id}}|{{purchase_type_id}}|{{purchase_status}}|{{purchase_date+time}}".
            "|{{purchase_local_user_date+time}}|{{purchase_country_iso}}|{{purchase_price_final}}|{{purchase_price_final_euros}}".
            "|{{article_price_local_currency}}|{{article_price_euros_currency}}".

            // Currency
            "|{{purchase_currency_iso}}|{{purchase_currency_exchange_currency_vs_euros}}".

            // Breakdown
            "|{{game_price_purchase_currency}}|{{game_price_euros_currency}}|{{purchase_tax_percent}}|{{purchase_tax_amount_purchase_currency}}".
            "|{{purchase_provider_fee_percent}}|{{purchase_provider_fee_amount_purchase_currency}}".

            // Reference to Offer
            "|{{price_offer}}|{{price_original}}|{{offer_name}}|{{items_quantity_offer}}|{{items_quantity_original}}".

            // Article
            "|{{item_id}}|{{quantity_final}}|{{article_name}}".

            // PayMethod details
            "|{{category_pay_method_name}}|{{pay_method_name}}|{{pay_method_provider_name}}".

            // User Details
            "|{{user_id}}|{{external_user_id}}|{{user_level}}|{{user_country_iso}}".

            // App Details
            "|{{app_id}}|{{app_shop_level}}|{{app_shop_theme}}".

            // Parent Purchase
            "|{{parent_purchase}}".

            // ADDED AFTER...
            "|{{article_special_type}}|{{json_4_especial_articles}}"

        ;
    }

    private function asyncMSG($msg)
    {
        if (!$msg)
            return;

        $logger = $this->logger;

        $async = function($msg) use ($logger){
            $exe = "$this->phpExePath $this->rootDir/../bin/console shop:business_intelligent:send '$msg' --env=$this->env";
            $process = new Process($exe);

            $logger->addInfo($exe);

            $process->start();
        };

        if (!is_array($msg))
            return $async($msg);

        foreach ($msg as $messsage)
            $async($messsage);
    }

    private function getLocalDateTimeToFormat(\DateTime $timeUtc, Country $country= null, $format)
    {
        $dateTime = $this->getLocalDateTime($timeUtc, $country);

        if ($dateTime)
            return $dateTime->format($format);

        return null;
    }

    /**
     * @param \DateTime $timeUtc
     * @param Country $country
     * @return \DateTime|null
     */
    private function getLocalDateTime(\DateTime $timeUtc, Country $country= null)
    {
        $timeUtcNew = clone $timeUtc;

        if (!$country)
            return null;

        $timeUtcNew->setTimezone( new \DateTimeZone($country->getTimeZone()) );

        return $timeUtcNew;
    }

    private function getTranslation($translation, $number)
    {
        return strip_tags(
            str_replace(
                ['{[{number}]}', '{[{ number }]}'],
                [$number, $number],
                $translation->getTranslation(LanguageEnum::ENGLISH)->getContent()
            )
        );
    }

    public function onShopTransactionStarted(TransactionStartedEvent $transactionStartedEvent)
    {
        $transaction = $transactionStartedEvent->getTransaction();

        if ($transaction->getCli() || $transaction->getTest())
            return ;

        $msg2 = $this->createMessageToTransactionStarted($transaction, $transactionStartedEvent->getRequest());
        $this->asyncMSG($msg2);
    }

    protected function createMessageToTransactionStarted(Transaction $transaction, Request $request)
    {
        $formatDateTimeDB = 'Y-m-d H:i:s';
        $browser = new \Browser();

            // Basic data
        $msg = 'WOLO2|INICIOTRANSACCION|{transaction_id}|{transaction_date+time}|{transaction_date+time_local_of_user}'.

            // User Details
            '|{user_country_iso}|{user_id}|{user_external_id}|{user_ip}|{user_browser}|{user_so}|{user_level}'.

            // App Shop Details
            '|{app_id}|{shop_level_category}|{shop_theme}'
        ;

        $replaceVars = [
            '{transaction_id}' => $transaction->getId(),
            '{transaction_date+time}' => $transaction->getBeginAt()->format($formatDateTimeDB),
            '{transaction_date+time_local_of_user}' => $this->getLocalDateTimeToFormat($transaction->getBeginAt(), $transaction->getCountryDetected(), $formatDateTimeDB),

            // User Details
            '{user_country_iso}' => $transaction->getCountryDetected() ? $transaction->getCountryDetected()->getId() : '',
            '{user_id}' => $transaction->getGamer()->getId(),
            '{user_external_id}' => $transaction->getGamer()->getGamerExternalId(),
            '{user_ip}' => $request->getClientIp(),
            '{user_browser}' => $browser->getBrowser(),
            '{user_so}' => $browser->getPlatform(),
            '{user_level}' => $transaction->getValueCurrent(),

            // App Shop Details
            '{app_id}' => $transaction->getApp()->getId(),
            '{shop_level_category}' => $transaction->getLevelCategory() ? $transaction->getLevelCategory()->getName() : '',
            '{shop_theme}' => $transaction->getCss() ? $transaction->getCss()->getName() : '',
        ];

        return str_replace(array_keys($replaceVars), $replaceVars, $msg);
    }
} 