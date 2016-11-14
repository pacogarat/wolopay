<?php


namespace AppBundle\Payment\Util;

use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\SingleFreePayment;
use AppBundle\Entity\SinglePayment;
use AppBundle\Entity\SMS;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\Voice;
use AppBundle\Exception\NviaException;
use AppBundle\Exception\NviaHackSecurityException;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Util\ArticleExtraCost\ArticleTempPriceService;
use AppBundle\Payment\Util\CartExtraCost\CartExtraCostService;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CountryService;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("shop.payment.payment_process")
 */
class PaymentProcessService
{
    private $isProduction;

    private $logger;

    /** @var EntityManagerInterface */
    protected $em;

    /** @var CurrencyService */
    protected $currencyService;

    /** @var ArticleService */
    protected $articleService;

    /** @var CartExtraCostService */
    protected $cartExtraCostService;

    /** @var ArticleTempPriceService */
    protected $articleTempPriceService;

    /** @var CountryService */
    protected $countryService;


    /**
     * @InjectParams({
     *    "isProduction" = @Inject("%is_production%"),
     *    "logger" = @Inject("logger"),
     *    "em"    = @Inject("doctrine.orm.default_entity_manager"),
     *    "currencyService" = @Inject("common.currency"),
     *    "articleService" = @Inject("shop_app.article"),
     *    "cartExtraCostService" = @Inject("app.cart_extra_cost"),
     *    "articleTempPrice" = @Inject("app.article_temp_price"),
     *    "countryService" = @Inject("country"),
     * })
     */
    function __construct(
        Logger $logger,
        EntityManagerInterface $em,
        CurrencyService $currencyService,
        ArticleService $articleService,
        $isProduction,
        CartExtraCostService $cartExtraCostService,
        ArticleTempPriceService $articleTempPrice,
        CountryService $countryService
    )
    {
        $this->logger          = $logger;
        $this->em              = $em;
        $this->currencyService = $currencyService;
        $this->isProduction    = $isProduction;
        $this->articleService  = $articleService;
        $this->cartExtraCostService = $cartExtraCostService;
        $this->articleTempPriceService = $articleTempPrice;
        $this->countryService = $countryService;
    }

    /**
     * @param $paymentProcessId
     * @return PaymentProcessInterface
     * @throws \AppBundle\Exception\NviaHackSecurityException
     */
    public function getPaymentProcessObjectById($paymentProcessId)
    {
        $payment = null;

        if (strpos($paymentProcessId, Subscription::PREFIX) !== false )
            $payment = $this->em->getRepository("AppBundle:Subscription")->find($paymentProcessId);
        else if (strpos($paymentProcessId, SinglePayment::PREFIX) !== false )
            $payment = $this->em->getRepository("AppBundle:SinglePayment")->find($paymentProcessId);
        else if (strpos($paymentProcessId, SingleFreePayment::PREFIX) !== false )
            $payment = $this->em->getRepository("AppBundle:SingleFreePayment")->find($paymentProcessId);
        else if (strpos($paymentProcessId, SingleCustomPayment::PREFIX) !== false )
            $payment = $this->em->getRepository("AppBundle:SingleCustomPayment")->find($paymentProcessId);

        if (!$payment)
        {
            $this->logger->addInfo("payment with id $paymentProcessId doesn't exist");
            throw new NviaHackSecurityException(NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);
        }

        return $payment;
    }

    public function getPaymentProcessObjectByExtraData($conditionString){
        $sql = "SELECT * FROM payment_detail pd WHERE pd.extra_data LIKE '$conditionString' ORDER BY id DESC LIMIT 1";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        $sqlResult = $stmt->fetchAll();
        $payment_detail_id = $sqlResult[0]['id'];
        return self::getPaymentProcessObjectById($payment_detail_id);
    }

    /**
     * @param PaymentProcessInterface $paymentProcess
     * @return PayMethodProviderHasCountry
     * @throws \Exception
     */
    public function getPMPCFromPaymentProcess(PaymentProcessInterface $paymentProcess)
    {
        $paymentDetail = $paymentProcess->getPaymentDetail();
        return $this->getPMPCFromPaymentDetail($paymentDetail);
    }

    /**
     * @param PaymentDetail $paymentDetail
     * @return PayMethodProviderHasCountry
     * @throws \Exception
     */
    public function getPMPCFromPaymentDetail(PaymentDetail $paymentDetail)
    {
        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")
            ->findOneByPayMethodIdAndProviderIdAndCountryId(
                $paymentDetail->getPayMethod()->getId(),
                $paymentDetail->getProvider()->getId(),
                $paymentDetail->getCountry()->getId()
            )
        ;

        if (!$pmpc)
        {
            $msg = "PMPC ".$paymentDetail->getPayment()->getId()." trying to cancel subscription PMPC wasn't found ".
                "pm=".$paymentDetail->getPayMethod()->getId().", providerId".$paymentDetail->getProvider()->getId().
                ", country=".$paymentDetail->getCountry()->getId();

            throw new \Exception($msg);
        }

        return $pmpc;
    }

    public function getPayMethodProviderHasCountry(PaymentProcessInterface $pp)
    {
        $detail = $pp->getPaymentDetail();
        return $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $detail->getPayMethod()->getId(), $detail->getProvider()->getId(), $detail->getCountry()->getId()
        );
    }

    private function createPaymentProcessObject($articleCategoryId, $ip, Country $country=null)
    {
        // Insert a Payment Interface like SinglePayment or Subscription
        if ($articleCategoryId == ArticleCategoryEnum::SINGLE_PAYMENT_ID)
        {
            $paymentProcess = new SinglePayment($ip);
            $paymentDetail = new PaymentDetail( $paymentProcess->getId() );

        }else if ($articleCategoryId == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID){

            $paymentProcess = new Subscription($ip, $country);
            $paymentDetail = new PaymentDetail( $paymentProcess->getId() );

        }else if ($articleCategoryId == ArticleCategoryEnum::FREE_PAYMENT_ID){

            $paymentProcess = new SingleFreePayment($ip);
            $paymentDetail = new PaymentDetail( $paymentProcess->getId() );

        }else if ($articleCategoryId == ArticleCategoryEnum::CUSTOM_PAYMENT_ID){

            $paymentProcess = new SingleCustomPayment($ip);
            $paymentDetail = new PaymentDetail( $paymentProcess->getId() );

        }else{

            throw new NviaException("This articles hasn't a valid category");
        }

        return [$paymentProcess, $paymentDetail];
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @param Transaction $transaction
     * @param Request $request
     * @param $language
     * @throws \Exception
     * @return PaymentProcessInterface
     */
    public function createPaymentProcess($appShopHasArticles, $payMethodProviderHasCountry, $transaction, Request $request, $language)
    {
        $articleCategory = $payMethodProviderHasCountry->getPayMethodHasProvider()->getPayMethod()->getArticleCategory()->getId();

        /** @var PaymentDetail $paymentDetail */
        list($paymentProcess, $paymentDetail) =$this->createPaymentProcessObject($articleCategory, $request->getClientIp(),$payMethodProviderHasCountry->getCountry());

        /** @var PaymentProcessInterface $paymentProcess */
        $paymentProcess
            ->setApp($transaction->getApp())
            ->setGamer($transaction->getGamer())
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                    ->find(PaymentStatusCategoryEnum::BEGIN_ID)
            )
            ->setPaymentDetail( $paymentDetail )
        ;

        $providerClientCredentials = $transaction->getApp()->getProviderClientCredentials($payMethodProviderHasCountry->getProvider());

        $useAppProviderCredentials = false;

        if ($providerClientCredentials !== null)
            $useAppProviderCredentials = true;

        $paymentDetail
            ->setCountry($payMethodProviderHasCountry->getCountry())
            ->setCurrency($payMethodProviderHasCountry->getCurrency())
            ->setProvider($payMethodProviderHasCountry->getProvider())
            ->setPayMethod($payMethodProviderHasCountry->getPayMethod())
            ->setTransaction($transaction)
            ->setLanguage($language)
            ->setUsedAppProviderCredentials($useAppProviderCredentials)
        ;

        $sms = null;
        //$providerName = $payMethodProviderHasCountry->getProvider()->getName();

        if ($payMethodProviderHasCountry->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::MOBILE_ID
            && $payMethodProviderHasCountry->getPayMethodHasProvider()->getIsOurImplementation())
        {
            $sms = $this->em->getRepository("AppBundle:SMS")->find($request->get('sms_id'));
            $paymentDetail->setSms($sms);
        }

        $voice=null;
        if ($payMethodProviderHasCountry->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::VOICE_ID
            && $payMethodProviderHasCountry->getPayMethodHasProvider()->getIsOurImplementation())
        {
            $voice = $this->em->getRepository("AppBundle:Voice")->find($request->get('voice_id'));
            $paymentDetail->setVoice($voice);
        }

        $this->completePaymentDetailConfiguration($appShopHasArticles, $paymentDetail, $payMethodProviderHasCountry, $sms, $voice, $total, $periodicity);

        if ($paymentProcess instanceof Subscription)
        {
            if ($periodicity == 9999)
                throw new \Exception("Can't get any periodicity");

            $paymentProcess
                ->setPeriodicity($periodicity) // modify when we are using a cart
                ->setNeedMakeRequestPayment($payMethodProviderHasCountry->getPayMethodHasProvider()->getNeedMakeRequestPayment())
                ->setAmountForEachPaymentToComplete($total)
                ->setAmountForEachPayment($total)
            ;
        }

        $paymentDetail
            ->setAmount($total)
            ->setCurrency($payMethodProviderHasCountry->getCurrency())
        ;

        $this->em->persist($paymentProcess);
        $this->em->flush();

        return $paymentProcess;
    }

    public function completePaymentDetailConfigurationWithBasicPayMethod(
        $appShopHasArticles,
        PaymentDetail $paymentDetail,
        Country $country,
        &$total = null,
        &$periodicity = null,
        &$totalEur = null

    )
    {
        $pm = $this->em->getRepository("AppBundle:PayMethod")->findOneByPayCategoryIdAndArticleCategoryIdAndName(
            PayCategoryEnum::PROVIDER_METHOD_ID,
            ArticleCategoryEnum::SINGLE_PAYMENT_ID,
            PayMethodEnum::PAYPAL_SINGLE_NAME
        );
        $provider = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name'=>ProviderEnum::PAYPAL_NAME]);
        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId($pm, $provider, $country);

        $pmpc->setCurrency($country->getCurrency());

        $this->completePaymentDetailConfiguration($appShopHasArticles, $paymentDetail, $pmpc, null, null, $total, $periodicity, true, $totalEur);
    }

    /**
     * This method is used to calculate and show the final price in shop and to insert in database in paymentController
     *
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param PaymentDetail $paymentDetail
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @param \AppBundle\Entity\SMS $sms
     * @param \AppBundle\Entity\Voice $voice
     * @param $total
     * @param $periodicity
     * @param bool $ignoreExtraCosts
     */
    public function completePaymentDetailConfiguration(
        $appShopHasArticles,
        PaymentDetail $paymentDetail,
        PayMethodProviderHasCountry $payMethodProviderHasCountry,
        SMS $sms = null,
        Voice $voice = null,
        &$total = null,
        &$periodicity = null,
        $ignoreExtraCosts = false,
        &$totalEur = null
    )
    {
        $eurCurr = $this->em->getRepository('AppBundle:Currency')->find(CurrencyEnum::EURO);
        $this->articleTempPriceService->injectTempPrices($appShopHasArticles, $payMethodProviderHasCountry->getCountry());

        $this->logger->addDebug("PaymentDetailHasArticles begin ".count($paymentDetail->getPaymentDetailHasArticles()));

        $countByArticle = function (Article $article = null) use ($paymentDetail)
        {
            $count = 0;
            foreach ($paymentDetail->getPaymentDetailHasArticles() as $pdha)
            {
                if ($pdha->getArticle()->getId() === $article->getId() )
                    $count+=$pdha->getArticlesQuantity();
            }

            return $count;
        };

        $getNArticlesFromOffersAddedInSameDetail = function (OfferProgrammer $offerProgrammer, PaymentDetailHasArticles $ignoreAppShopHasArticle = null) use ($paymentDetail)
        {
            $count = 0;
            foreach ($paymentDetail->getPaymentDetailHasArticles() as $pdha)
            {
                if ($ignoreAppShopHasArticle && $pdha->getId() === $ignoreAppShopHasArticle->getId() )
                    continue;

                if ($pdha->getOfferProgrammer() && $pdha->getOfferProgrammer()->getId() == $offerProgrammer->getId())
                    $count += $pdha->getArticlesQuantity();
            }

            return $count;
        };

        // Calculate total amount, because it can be more than one article
        $total = $totalEur = 0;
        $periodicity = 9999;
        $gamer = $paymentDetail->getTransaction()->getGamer();

        foreach ($appShopHasArticles as $sha)
        {
            $paymentDetail->setCountryConfigured($sha->getCountry());

            if (!$this->articleService->isArticleValidByUser($sha->getArticle(), $gamer, $countByArticle($sha->getArticle()) + 1))
            {
                $this->logger->addDebug("Removed article because gamer exceed limit of uses");
                continue;
            }

            if ($sha->getArticle()->getRemainingUnits() < $countByArticle($sha->getArticle()) + 1)
            {
                $this->logger->addDebug("Removed article because article exceed limit of uses");
                continue;
            }

            $tabName = $this->getCurrentTabName($sha);

            $offerProgrammerIsRight = null;
            if ($sha->getOffer() && $this->articleService->isOfferValidByUser($sha, $gamer, 1 + $getNArticlesFromOffersAddedInSameDetail($sha->getOffer()->getOfferProgrammer())))
            {
                $offerProgrammerIsRight = $sha->getOffer()->getOfferProgrammer();
                $this->logger->addInfo("offer programmer is right");
            }

            // Search article in paymentDetailHasArticle and offer can depends by "offer and article quantity"
            $before = $paymentDetail->getPaymentDetailHasArticleByAppShopHasArticleId($sha->getId(), $offerProgrammerIsRight);

            $quantityInserting = 1;
            $offerIsAvailable4Quantity = false;

            if ($before)
            {
                if ($before->getOfferProgrammer())
                {
                    $quantityInserting = $before->getArticlesQuantity()+1+$getNArticlesFromOffersAddedInSameDetail($before->getOfferProgrammer(), $before);

                    $offerIsAvailable4Quantity = $before->getOfferProgrammer()->isValidFromShoppingCartByArticleQuantity($quantityInserting) &&
                        $this->articleService->isOfferValidByUser($sha, $gamer, $quantityInserting)
                    ;
                }
                // Search again with real offer by articleQuantity
                $before = $paymentDetail->getPaymentDetailHasArticleByAppShopHasArticleId($sha->getId(), $offerIsAvailable4Quantity ? $before->getOfferProgrammer() : null);
            }else{
                if ($sha->getOffer())
                {
                    $offerProgrammer = $sha->getOffer()->getOfferProgrammer();
                    $quantityInserting = 1 + $getNArticlesFromOffersAddedInSameDetail($offerProgrammer);

                    $offerIsAvailable4Quantity = $offerProgrammer->isValidFromShoppingCartByArticleQuantity($quantityInserting) &&
                            $this->articleService->isOfferValidByUser($sha, $gamer, $quantityInserting);
                }
            }

            if ($paymentDetailHasArticle = $before)
            {
                $paymentDetailHasArticle->addArticlesQuantity();
            }else{
                $this->logger->addDebug("Created a new PaymentDetailHasArticles");
                $paymentDetailHasArticle = new PaymentDetailHasArticles($sha, $paymentDetail, $tabName, $quantityInserting);

                if (!$offerIsAvailable4Quantity)
                {
                    $paymentDetailHasArticle
                        ->setOfferProgrammer(null)
                        ->setItemsQuantity($sha->getArticle()->getItemsQuantity())
                    ;
                }

                $paymentDetail->addPaymentDetailHasArticle($paymentDetailHasArticle);
            }

            if ($sha->getArticle()->getArticleCategory()->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID && $sha->getArticle()->getPeriodicity() && $sha->getArticle()->getPeriodicity() < $periodicity)
                $periodicity = $sha->getArticle()->getPeriodicity();

            /** @var Currency $currency */
            if ($payMethodProviderHasCountry->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::MOBILE_ID
                && $payMethodProviderHasCountry->getPayMethodHasProvider()->getIsOurImplementation())
            {
                $price = $sms->getAmount();
                $priceEur=$this->currencyService->getExchange($price, $paymentDetail->getCurrency(),$eurCurr);
                $currency = null;

            }else if ($payMethodProviderHasCountry->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::VOICE_ID
                && $payMethodProviderHasCountry->getPayMethodHasProvider()->getIsOurImplementation() ){

                $price = $voice->getAmount();
                $priceEur=$this->currencyService->getExchange($price, $paymentDetail->getCurrency(),$eurCurr);
                $currency = null;

            }else{

                if (!$offerIsAvailable4Quantity)
                    $price = $sha->getCurrentAmountWithoutOffer();
                else
                    $price = $sha->getCurrentAmount($quantityInserting);

               $currency = $sha->getCountry()->getCurrency();
               $priceEur=$this->currencyService->getExchange($price, $currency,$eurCurr);
            }

            // IGNORE IF PRICE IS 0
            if ($price === 0 && $sha->getArticle()->getArticleCategory()->getId() == ArticleCategoryEnum::SINGLE_PAYMENT_ID)
            {
                $this->logger->addDebug("This article removed because price is 0");
                $paymentDetail->removePaymentDetailHasArticle($paymentDetailHasArticle);
                continue;
            }



            // Exchange currency country to currency pmprovider
            if ($currency !== null && $currency->getId() != $payMethodProviderHasCountry->getCurrency()->getId())
            {
                $priceEur = $this->currencyService->getExchange($price, $currency,$eurCurr);
                $price = $this->currencyService->getExchange($price, $currency, $payMethodProviderHasCountry->getCurrency()->getId());
                $price = UtilHelper::prettyPrice($price, $payMethodProviderHasCountry->getCurrency()->getDecimalPlaces());
            }


            $paymentDetailHasArticle->setAmount($price); // added round
            $paymentDetailHasArticle->setAmountEur($priceEur);
            $total += $paymentDetailHasArticle->getAmount();
            $totalEur += $paymentDetailHasArticle->getAmountEur();

            // Add More articles in same purchase
            foreach ($sha->getArticlesExtra() as $article)
            {
                $offerProgrammer = null;

                if ($sha->getOffer())
                    $offerProgrammer = $sha->getOffer()->getOfferProgrammer();

                if ($before = $paymentDetail->getPaymentDetailHasArticleByArticleAndOfferProgrammer($article->getId(), $offerProgrammer))
                {
                    $before->addArticlesQuantity();
                    continue;
                }

                $paymentDetailHasArticle = new PaymentDetailHasArticles($sha, $paymentDetail, $tabName) ;
                $paymentDetailHasArticle
                    ->setAmount(0)
                    ->setArticle($article)
                    ->setAppShopHasArticle(null)
                    ->setItemsQuantity($article->getItemsQuantity())
                ;

                $paymentDetail->addPaymentDetailHasArticle($paymentDetailHasArticle);
            }
        }

        if ($ignoreExtraCosts == false)
        {
            $this->cartExtraCostService->addExtraCosts($total, $paymentDetail, $payMethodProviderHasCountry);
        }

        $this->logger->addDebug("PaymeentDetailHasArticles end ".count($paymentDetail->getPaymentDetailHasArticles()));
    }


    public function getCurrentTabName(AppShopHasArticle $sha){
        /*one article is in many app_shop_has_app_tabs...... but only one per app_shop*/
        $appShop = $sha->getAppShop();
        $article = $sha->getArticle();
        /** @var AppShopHasAppTab $appShopAppTab */
        $appShopAppTab = $this->em->getRepository("AppBundle:AppShopHasAppTab")->findOneByAppShopIdAndArticleId($appShop->getId(), $article->getId());
        $tabName = $appShopAppTab->getAppTab()->getName();

        return $tabName;
    }

    /**
     * @param Article[] $articles
     * @param $articleCategoryId
     * @param Transaction $transaction
     * @param \AppBundle\Entity\PayMethod $payMethod
     * @param $amount
     * @param string $currencyId
     * @param string $providerName
     * @param string $lang
     * @param string $ip
     * @param int $paymentStatusId
     * @return PaymentProcessInterface
     */
    public function createPaymentProcessCLI(array $articles = [], $articleCategoryId, Transaction $transaction,
        PayMethod $payMethod, $amount, $currencyId = CurrencyEnum::EURO, $providerName = ProviderEnum::NVIA_NAME,
        $lang = LanguageEnum::ENGLISH, $ip='CLI', $paymentStatusId = PaymentStatusCategoryEnum::PROCESSING_ID)
    {

        list($paymentProcess, $paymentDetail) = $this->createPaymentProcessObject($articleCategoryId, $ip, $transaction->getApp()->getClient()->getCountry());

        /** @var PaymentProcessInterface $paymentProcess */
        $paymentProcess
            ->setApp($transaction->getApp())
            ->setGamer($transaction->getGamer())
            ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find($paymentStatusId))
            ->setPaymentDetail( $paymentDetail )
        ;

        /** @var PaymentDetail $paymentDetail */
        $paymentDetail
            ->setAmount($amount)
            ->setCountry($transaction->getApp()->getClient()->getCountry())
            ->setCurrency($this->em->getRepository("AppBundle:Currency")->find($currencyId))
            ->setProvider($this->em->getRepository("AppBundle:Provider")->findOneBy(['name'=> $providerName]))
            ->setPayMethod($payMethod)
            ->setTransaction($transaction)
            ->setLanguage($this->em->getRepository("AppBundle:Language")->find($lang))
        ;

        if ($transaction->getCountryVirtualCurrency())
        {
            $countryConfigured = $this->countryService->getCountryConfiguredAndCloserFromApp(
                $transaction->getApp(),
                [$transaction->getLevelCategory()->getId()],
                $transaction->getCountryVirtualCurrency()
            );

            $paymentDetail
                ->setCountry($transaction->getCountryVirtualCurrency())
                ->setCountryConfigured($countryConfigured)
            ;
        }

        foreach ($articles as $article)
        {
            $paymentDetailHasArticle = new PaymentDetailHasArticles(null, $paymentDetail);
            $paymentDetailHasArticle
                ->setAmount($amount)
                ->setItemsQuantity($article->getItemsQuantity())
                ->setArticle($article)
            ;

            $paymentDetail->addPaymentDetailHasArticle($paymentDetailHasArticle);
        }

        $transaction->setStatusCategory(
            $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID)
        );

        $this->em->persist($paymentProcess);
        $this->em->flush();

        return $paymentProcess;
    }

} 