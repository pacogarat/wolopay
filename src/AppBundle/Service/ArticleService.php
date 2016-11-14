<?php


namespace AppBundle\Service;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\ArticleSpecialTypeEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\ShopOrderTypeEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailArticlesHasGivenArticle;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaException;
use AppBundle\Exception\NviaHackSecurityException;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Payment\Util\CalculateFee;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("shop_app.article")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 */
class ArticleService
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /** @var Logger */
    private $logger;

    /** @var CurrencyService */
    private $currencyService;

    /** @var CalculateFee */
    private $calculateFeeService;

    /** @var  int  */
    private $shopping_cart_max_items;

    /** @var  float  */
    private $shopping_cart_max_price_eur;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "currencyService" = @Inject("common.currency"),
     *    "calculateFeeService" = @Inject("shop.payment.calculate_fee_service"),
     *    "shopping_cart_max_items" = @Inject("%shopping_cart_max_items%"),
     *    "shopping_cart_max_price_eur" = @Inject("%shopping_cart_max_price_eur%"),
     * })
     */
    function __construct(EntityManager $em, Logger $logger, CurrencyService $currencyService, CalculateFee $calculateFeeService,
                         $shopping_cart_max_items, $shopping_cart_max_price_eur)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->currencyService = $currencyService;
        $this->calculateFeeService = $calculateFeeService;
        $this->shopping_cart_max_items = $shopping_cart_max_items;
        $this->shopping_cart_max_price_eur = $shopping_cart_max_price_eur;
    }

    /**
     * @param AppShopHasArticle $appShopHasArticle
     */
    public function deleteOfferIfInvalidByUser(AppShopHasArticle $appShopHasArticle, Gamer $gamer)
    {
        if (!$this->isOfferValidByUser($appShopHasArticle, $gamer))
        {
            $appShopHasArticle->setOffer(null);
            $this->logger->addDebug('Removed offer from article (user limit)');
        }
    }

    public function isOfferValidByUser(AppShopHasArticle $appShopHasArticle, Gamer $gamer, $quantity = 1)
    {
        if ($appShopHasArticle->getOffer())
        {
            $offerProgrammer = $appShopHasArticle->getOffer()->getOfferProgrammer();
            $result = $this->em->getRepository("AppBundle:Purchase")->countByGamerIdAndOfferProgrammer($gamer->getId(), $offerProgrammer->getId());

            if ($offerProgrammer->getLimitPerUser() && $offerProgrammer->getLimitPerUser() < ($result + $quantity))
            {
                return 0;

            }elseif ($offerProgrammer->getLimitPerUser()){

                return $offerProgrammer->getLimitPerUser() + 1 - ($result + $quantity);
            }

        }

        return 99999;
    }

    /**
     * @param Article $article
     * @param \AppBundle\Entity\Gamer $gamer
     * @param int $quantity
     * @return Article[]
     */
    public function isArticleValidByUser(Article $article, Gamer $gamer, $quantity = 1)
    {
        if ($article->getNPurchasesPerClient() > 0)
        {
            $articleCountPurchases = $this->em->getRepository("AppBundle:Purchase")->
                countByGamerIdAndArticleIdGroupByArticle($gamer->getId(), $article->getId());

            $this->logger->addInfo("GamerId ".$gamer->getId().", Articles purchased by gamer = $articleCountPurchases, limit ". $article->getNPurchasesPerClient());

            if ($article->getNPurchasesPerClient() < ($articleCountPurchases + $quantity))
                return false;
        }

        return true;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param \AppBundle\Entity\Gamer $gamer
     * @param \AppBundle\Entity\PayMethodProviderHasCountry[]|null $pmpcs
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function parseAppShopHasArticlesToVerifyArticles(array $appShopHasArticles, Gamer $gamer = null, $pmpcs=null, $externalStore=null, $include_free=false)
    {
        $articles = [];

        foreach ($appShopHasArticles as $key => $appShopHasArticle)
        {
            $key = (int) $key;

            $valid = true;
            $appShopHasArticle->setExternalStore($externalStore);

            $articleCategoryId = $appShopHasArticle->getArticle()->getArticleCategory()->getId();
            $this->logger->addDebug("Verifications to articleId: ".$appShopHasArticle->getArticle()->getId()." - $articleCategoryId");

            if ($gamer)
                $this->deleteOfferIfInvalidByUser($appShopHasArticle, $gamer);

            try{
                $rangeValues = $appShopHasArticle->calculateRangeValues($pmpcs,false,$externalStore);


                if ( ($rangeValues === null) && (!$include_free))
                {
                    $valid = false;
                    $this->logger->addDebug("Article removed by Range values INVALID is null");
                }

                if ($rangeValues !== null && $include_free &&
                    ($rangeValues['min'] < 0.01 && $articleCategoryId !== ArticleCategoryEnum::FREE_PAYMENT_ID  ) ||
                    ($rangeValues['min'] > 0.01 && $articleCategoryId === ArticleCategoryEnum::FREE_PAYMENT_ID ) )
                {
                    $valid = false;
                    $this->logger->addDebug("article removed by Range values INVALID, value: ".($rangeValues !== null ? print_r($rangeValues, true) : ''));

                }


                if ($valid && $this->isArticleValid($appShopHasArticle->getArticle(), $gamer))
                {
                    $articles[$key] = $appShopHasArticle->getArticle();

                }else{

                    $this->logger->addDebug("Article Removed");
                    unset($appShopHasArticles[$key]);
                }

            }catch (\Exception $e){

                unset($appShopHasArticles[$key]);
                $this->logger->addError("Configuration error from article ".($appShopHasArticle->getArticle() ?
                    $appShopHasArticle->getArticle()->getId() : '').', shop '.$appShopHasArticle->getId().', '.$e->getMessage());
            }
        }

        return $appShopHasArticles;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return float
     */
    public function getCartTotalPriceInEur(array $appShopHasArticles){
        $finalPriceEur = 0;

        foreach ($appShopHasArticles as $key => $appShopHasArticle) {
            $key = (int)$key;
            $articlePrice=$articlePriceEur=0;

            $articlePrice = $appShopHasArticle->getCurrentAmount();
            if ($articlePrice==0)
                continue;

            $articleCurrency = $appShopHasArticle->getLocalCurrency();
            $eurCurr = $this->em->getRepository('AppBundle:Currency')->find(CurrencyEnum::EURO);
            if ($articleCurrency !== CurrencyEnum::EURO){
                $articlePriceEur = CurrencyService::calculateExchangePrimitive($articlePrice, $articleCurrency, $eurCurr);
            }
            $finalPriceEur += $articlePriceEur;
        }
        return $finalPriceEur;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $pmpc
     * @param \AppBundle\Entity\Transaction $transaction
     * @param int $smsId
     * @param int $voiceId
     * @throws \AppBundle\Exception\NviaHackSecurityException
     * @throws \Exception
     */
    public function verifyArticlesAndPayMethodAreOk($appShopHasArticles, PayMethodProviderHasCountry $pmpc, Transaction $transaction, $smsId = null, $voiceId = null)
    {
        $articlesFiltered = $this->parseAppShopHasArticlesToVerifyArticles($appShopHasArticles, $transaction->getGamer(), [$pmpc]);
        $priceInEur = $this->getCartTotalPriceInEur($articlesFiltered);

        if (count($articlesFiltered) !== count($appShopHasArticles))
            throw new \Exception("Article invalid from this user");

        if (count($articlesFiltered) > $this->shopping_cart_max_items)
            throw new \Exception("Shopping cart max items ".$this->shopping_cart_max_items);

        /*
         if ($priceInEur > $this->shopping_cart_max_price_eur)
            throw new \Exception("Shopping cart max allowed price exceeded ".$this->shopping_cart_max_price_eur);
        */

        $last = $appShopHasArticles[0]->getArticle()->getArticleCategory()->getId();

        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            // verify articles are all the same type
            if ($appShopHasArticle->getArticle()->getArticleCategory()->getId() != $last)
                throw new \Exception("Articles have different types");

            if (!$transaction->getCountriesAvailable()->isEmpty() && !$transaction->getCountriesAvailable()->contains($appShopHasArticle->getCountry()))
                throw new NviaHackSecurityException("You cant choose this country", NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

            if (count($appShopHasArticle) > 1 && (!$pmpc->getSMSs()->isEmpty() || !$pmpc->getVoices()->isEmpty() ))
                throw new NviaHackSecurityException("You cant choose multiple articles with variable amount", NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

            $last = $appShopHasArticle->getArticle()->getArticleCategory()->getId();
        }

        // Override special Provider
        $payCategoryId = $pmpc->getPayMethod()->getPayCategory()->getId();

        switch ($payCategoryId)
        {
            case PayCategoryEnum::MOBILE_ID:

                if (!$pmpc->getPayMethodHasProvider()->getIsOurImplementation())
                    return;

                if (!$smsId)
                    throw new \Exception("parameter 'sms_id' is required to mobile payments ");

                $sms = $pmpc->getSMSById($smsId);

                if (!$sms)
                    throw new \Exception("This payment PMPC haven't this SMS id:".$smsId);

                break;
            case PayCategoryEnum::VOICE_ID:

                if (!$voiceId)
                    throw new \Exception("parameter 'voice_id' is required to mobile payments ");

                $voice = $pmpc->getVoiceById($voiceId );

                if (!$voice)
                    throw new \Exception("This payment haven't voice");

                break;
        }
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param \AppBundle\Entity\Country $countryClient
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function increaseAmountBySpecialConfigurations(array $appShopHasArticles, Country $countryClient)
    {
        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            if ($appShopHasArticle->getArticle()->getApp()->getTaxToFinalAmount())
            {
                $appShopHasArticle->setTempForcePrice(
                    $this->calculateFeeService->getAmountOffsetToVat(
                        $appShopHasArticle->getAmount(),
                        $appShopHasArticle->getCountry()->getCurrency(),
                        $countryClient
                    )
                );

                if ($offer = $appShopHasArticle->getOffer())
                {
                    $offer->setTempForcePrice(
                        $this->calculateFeeService->getAmountOffsetToVat(
                            $offer->getAmount(),
                            $appShopHasArticle->getCountry()->getCurrency(),
                            $countryClient
                        )
                    );
                }
            }
        }

        return $appShopHasArticles;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return AppShopHasArticle[]
     */
    public function filterToExternalStores($appShopHasArticles)
    {
        return $this->removeArticlesWith0Amount($appShopHasArticles);
    }

    /**
     * @param \AppBundle\Entity\Article $article
     * @param \AppBundle\Entity\Gamer $gamer
     * @return bool
     */
    public function isArticleValid(Article $article, Gamer $gamer = null)
    {
        $valid = true;

        if (!$article->isValidDates())
        {
            $valid = false;
            $this->logger->addDebug("Article dates, is valid: ".$valid);
        }

        if ($article->getNPurchasesTotal() !== null &&
            $article->getTimesBought() >= $article->getNPurchasesTotal())
        {
            $valid = false;
            $this->logger->addDebug(
                "Article removed by limit times to bought, limit:" . $article
                    ->getNPurchasesTotal() . ", purchased:" . $article->getTimesBought()
            );
        }

        if ($gamer && !$this->isArticleValidByUser($article, $gamer))
        {
            $valid = false;
            $this->logger->addDebug('Removed by user limit');
        }


        return $valid;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return AppShopHasArticle[]
     */
    public function removeArticlesWith0Amount($appShopHasArticles)
    {
        $result = [];
        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            if ($appShopHasArticle->getAmount() > 0)
                $result[] = $appShopHasArticle;
        }

        return $result;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param \AppBundle\Entity\Country|\AppBundle\Entity\Currency $countryClient
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function exchangeFromAppShopHasArticles(array $appShopHasArticles, Country $countryClient)
    {
        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            if ($countryClient->getCurrency()->getId() !== $appShopHasArticle->getLocalCurrency()->getId())
            {
                if ($appShopHasArticle->getOffer())
                {
                    $appShopHasArticle->getOffer()
                        ->setAmount(
                            UtilHelper::prettyPrice(
                                $this->currencyService->getExchange(
                                    $appShopHasArticle->getOffer()->getAmount(),
                                    $appShopHasArticle->getLocalCurrency(),
                                    $countryClient->getCurrency()->getId()
                                ),
                                $countryClient->getCurrency()->getDecimalPlaces(),
                                $countryClient->getDecimalFormat()
                            )
                        )
                    ;
                }

                if ($appShopHasArticle->getTempForcePrice())
                {
                    $appShopHasArticle->
                        setTempForcePrice(
                            UtilHelper::prettyPrice(
                                $this->currencyService->getExchange(
                                    $appShopHasArticle->getTempForcePrice(),
                                    $appShopHasArticle->getLocalCurrency(),
                                    $countryClient->getCurrency()->getId()
                                ),
                                $countryClient->getCurrency()->getDecimalPlaces(),
                                $countryClient->getDecimalFormat()
                            )
                        )
                    ;
                }

                $appShopHasArticle
                    ->setAmount(
                        UtilHelper::prettyPrice(
                            $this->currencyService->getExchange(
                                $appShopHasArticle->getAmount(),
                                $appShopHasArticle->getLocalCurrency(),
                                $countryClient->getCurrency()->getId()
                            ),
                            $countryClient->getCurrency()->getDecimalPlaces(),
                            $countryClient->getDecimalFormat()
                        )
                    )
                    ->setCountry($countryClient)
                ;

            }
        }
    }

    static public function getTranslation(AppShopHasArticle $asha, $lang, TransUnit $transunit)
    {
        return self::getTranslationBasic($transunit, $asha->getCurrentItemsQuantity(), $lang);
    }

    static public function getTranslationBasic(TransUnit $transunit = null, $itemsQuantity, $lang = LanguageEnum::ENGLISH)
    {
        if (!$transunit)
            return '';

        /** @var \Lexik\Bundle\TranslationBundle\Model\Translation $translation */
        $translation = $transunit->getTranslation(
            $lang
        ) ?: $transunit->getTranslation(LanguageEnum::ENGLISH);

        return strip_tags(
            preg_replace('/\{\[\{[ ]*number[ ]*\}\]\}/',
                $itemsQuantity,
                $translation->getContent()
            )
        );
    }

    /**
     * @param string $orderType
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return AppShopHasArticle[]
     */
    public function orderByType($orderType, $appShopHasArticles)
    {
        switch ($orderType)
        {
            case ShopOrderTypeEnum::ORDER_BY_PRICE_ASC:
                $appShopHasArticles = $this->orderByPriceASC($appShopHasArticles);
                break;
            case $orderType == ShopOrderTypeEnum::ORDER_BY_PRICE_DESC:
                $appShopHasArticles = $this->orderByPriceDESC($appShopHasArticles);
                break;
            case ShopOrderTypeEnum::ORDER_BY_DATABASE_VALUES:
            default:
                // shop is order by database values by default
        }

        return $appShopHasArticles;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return \ArrayIterator|\Traversable
     */
    private function orderByPriceASC($appShopHasArticles)
    {
        $stopwatch = null;
        /*if ($this->has('debug.stopwatch')) {
            $stopwatch = $this->get('debug.stopwatch');
            $stopwatch->start('Order Articles ASC');
        }*/

        usort($appShopHasArticles, function($a, $b) {

            $getAmount = function (AppShopHasArticle $appS)
            {
                $amount = $appS->calculateRangeValues();

                if ( $amount === null)
                {
                    throw new \Exception('Cant get Amount');
                }

                return (float) (($amount['min']+$amount['max']) / 2);
            };

            /** @var $a AppShopHasArticle */
            /** @var $b AppShopHasArticle */

            if ($a->getOffer() && !$b->getOffer())
                return -1;

            if (!$a->getOffer() && $b->getOffer() )
                return 1;

            $name_a = $getAmount($a);
            $name_b = $getAmount($b);

            return $name_a == $name_b ?
                ($a->getCurrentItemsQuantity() == $b->getCurrentItemsQuantity() ?
                    0 : $a->getCurrentItemsQuantity() > $b->getCurrentItemsQuantity() ? -1 : 1
                )
                : $name_a > $name_b ? 1 : -1;

        });

        if ($stopwatch)
            $stopwatch->stop('Order Articles ASC');

        return $appShopHasArticles;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @return \ArrayIterator|\Traversable
     */
    private function orderByPriceDESC($appShopHasArticles)
    {
        $stopwatch = null;
        /*if ($this->has('debug.stopwatch')) {
            $stopwatch = $this->get('debug.stopwatch');
            $stopwatch->start('Order Articles DESC');
        }
        */

        usort($appShopHasArticles, function($a, $b) {

            $getAmount = function (AppShopHasArticle $appS)
            {
                $amount = $appS->calculateRangeValues();

                if ( $amount === null)
                {
                    throw new \Exception('Cant get Amount');
                }

                return (float) (($amount['min']+$amount['max']) / 2);
            };

            /** @var $a AppShopHasArticle */
            /** @var $b AppShopHasArticle */

            if ($a->getOffer() && !$b->getOffer())
                return -1;

            if (!$a->getOffer() && $b->getOffer() )
                return 1;

            $name_a = $getAmount($a);
            $name_b = $getAmount($b);

            return $name_a == $name_b ?
                ($a->getCurrentItemsQuantity() == $b->getCurrentItemsQuantity() ?
                    0 : $b->getCurrentItemsQuantity() > $a->getCurrentItemsQuantity() ? -1 : 1
                )
                : $name_b > $name_a ? 1 : -1;
        });

        if ($stopwatch)
            $stopwatch->stop('Order Articles DESC');

        return $appShopHasArticles;
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $paymentDetailHasArticles = $paymentCompletedEvent->getPaymentProcess()->getPaymentDetail()->getPaymentDetailHasArticles();
        foreach ($paymentDetailHasArticles as $paymentDetailHasArticle)
        {
            $paymentDetailHasArticle->getArticle()->addTimesBought($paymentDetailHasArticle->getArticlesQuantity());
        }
        $this->em->flush();
    }

    public function findAppShopByCountryOrHisOtherCountry(Article $article, $country, $gamerLevel)
    {
        $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdWithGamerLevel(
            $country->getId(),
            $article->getId(),
            $gamerLevel
        );

        if (!$appShopHasArticle)
        {

            foreach (CountryEnum::$OTHERS_ALL as $countryOthersId)
            {
                $countryXOther = $this->em->getRepository("AppBundle:Country")->find($countryOthersId);

                if ($countryXOther->getContinent() && $countryXOther->getContinent()->getId() === $country->getContinent()->getId())
                {
                    $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdWithGamerLevel(
                        $countryXOther->getId(),
                        $article->getId(),
                        $gamerLevel
                    );
                }
            }
        }

        if (!$appShopHasArticle)
        {
            $countryOther = $this->em->getRepository("AppBundle:Country")->find(CountryEnum::OTHER);

            $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdWithGamerLevel(
                $countryOther->getId(),
                $article->getId(),
                $gamerLevel
            );
        }

        return $appShopHasArticle;
    }

    public function fillRemainingArticleSpecialTypeForGamer(Article $article, Gamer $gamer)
    {
        if ( $article->getSpecialType() )
        {
            switch ($article->getSpecialType()->getId())
            {
                case ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX:
                    $this->fillRemainingArticleGachaBox($article, $gamer);
                    break;
            }
        }
    }

    private function fillRemainingArticleGachaBox(Article $article, Gamer $gamer)
    {
        $paymentDetailArticlesHasGivenArticle = $this->calculateRemainingForGamerBoxGacha($article, $gamer, true);
        $gachaRemaining = $paymentDetailArticlesHasGivenArticle->getRemainingForUserHistory();

        foreach ($article->getArticlesGacha() as $articleGacha)
        {
            $remaining = 0;
            $articlePossibleId = $articleGacha->getPossibleArticle()->getId();

            if (isset($gachaRemaining[$articlePossibleId]))
                $remaining = $gachaRemaining[$articlePossibleId];

            $articleGacha->setRemainingForUser($remaining);
        }
    }

    /**
     * @param \AppBundle\Entity\Article $article
     * @param \AppBundle\Entity\Gamer $gamer
     * @param bool $fillValidGacha
     * @param bool $forceNewState
     * @return PaymentDetailArticlesHasGivenArticle
     */
    private function calculateRemainingForGamerBoxGacha(Article $article, Gamer $gamer, $fillValidGacha = false, $forceNewState = false)
    {
        $gachaId = $article->getId();
        $gamerId = $gamer->getId();

        $lastPaymentDetailArticleHasGivenArticle = $this->em->getRepository("AppBundle:PaymentDetailArticlesHasGivenArticle")->
            findLastBoxGachaByGamerIdAndArticleId($gamerId, $gachaId);

        if ($article->getHoursToResetGacha() && $lastPaymentDetailArticleHasGivenArticle)
        {
            $interval = new \DateInterval('PT' . $article->getHoursToResetGacha()  . 'H');

            $initialDate = clone($lastPaymentDetailArticleHasGivenArticle->getGachaInitialDate());

            $resetAt = clone($initialDate);
            $resetAt->add($interval);

            $now = new \DateTime();

            if($now <= $resetAt)
            {
                if ($fillValidGacha)
                {
                    $article
                        ->setValidFromGacha($initialDate)
                        ->setValidToGacha($resetAt);
                }

            }else{

                $lastPaymentDetailArticleHasGivenArticle = null;
            }
        }

        $nStep = 1;
        $remainingForUser = [];
        $initialDate = new \DateTime();

        // new State
        foreach($article->getArticlesGacha() as $articleInGacha)
        {
            $articleId = $articleInGacha->getPossibleArticle()->getId();
            $remainingForUser[$articleId] = $articleInGacha->getAmountToGive();
        }

        if ($forceNewState)
        {
            return new PaymentDetailArticlesHasGivenArticle(null, null, $remainingForUser, $initialDate, $nStep);
        }

        // loading old state and verifies that its available
        if ($lastPaymentDetailArticleHasGivenArticle)
        {
            $history = $lastPaymentDetailArticleHasGivenArticle->getRemainingForUserHistory();
            $history[$lastPaymentDetailArticleHasGivenArticle->getArticle()->getId()]--;

            if (max($history) > 0)
            {
                $remainingForUser = $history;
                $initialDate = $lastPaymentDetailArticleHasGivenArticle->getGachaInitialDate();
                $nStep = $lastPaymentDetailArticleHasGivenArticle->getGachaStep() + 1;
            }
        }

        return new PaymentDetailArticlesHasGivenArticle(null, null, $remainingForUser, $initialDate, $nStep);
    }

    /**
     * @param \AppBundle\Entity\Article $article
     * @param \AppBundle\Entity\Gamer $gamer
     */
    private function calculateStepGachaForGamer(Article $article, Gamer $gamer = null)
    {
//        $gamerLastPurchasedArticle = null;
//        $gachaId = $article->getId();
//        $gamerId = $gamer->getId();
//
//        /** @var array $gamerPurchases */
//        $gamerPurchases = $this->em->getRepository("AppBundle:Purchase")->
//            findLastStepGachaArticlePurchasedByGamerIdAndArticleId($gamerId, $gachaId, $article->getTotalToGiveInGacha());
//
//        if ($gamerPurchases){
//            $gamerLastPurchasedArticle = $gamerPurchases['lastPurchase'];
//            /** @var \DateTime $iDate */
//            $iDate = $gamerPurchases['initialDate'];
//            $iDate = $iDate->format(\DateTime::ISO8601);
//
//            /** @var \DateTime $initialDate */
//            $initialDate = new \DateTime($iDate);
//            /** @var \DateTime $initialDate */
//            $resetAt = new \DateTime($iDate);
//            $resetAt->add(new \DateInterval('PT' . $article->getHoursToResetGacha()  . 'H'));
//            $nowUtc = new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) );
//
//            if($nowUtc <= $resetAt){
//                $article->setValidFrom($initialDate)->setValidTo($resetAt);
//            }else{
//                $gamerPurchases = [];
//            }
//        }
//
//        $first = true;
//        $give=false;
//
//        /** @var ArticleGachaHasArticle $articleInGacha */
//        foreach($article->getArticlesGacha() as $articleInGacha)
//        {
//            if ($first)
//                $firstArticle = $articleInGacha;
//
//            if ($give){
//
//                $first=false;
//                $articleInGacha->setRemainingForUser(1);
//
//            } else{
//
//                $articleInGacha->setRemainingForUser(0);
//            }
//
//            if (($gamerLastPurchasedArticle) && ($articleInGacha->getPossibleArticle()->getId() == $gamerLastPurchasedArticle))
//                $give=true;
//        }
//        if ($first)
//            $firstArticle->setRemainingForUser(1);
    }

    /**
     * @param PaymentDetail $paymentDetail
     * @throws NviaException
     */
    public function addGivenArticlesInSpecialTypeArticles(PaymentDetail $paymentDetail)
    {
        $paymentDetailHasArticles = $paymentDetail->getPaymentDetailHasArticles();
        $gamer   = $paymentDetail->getTransaction()->getGamer();

        foreach ($paymentDetailHasArticles as $paymentDetailHasArticle)
        {
            $key         = $gamer->getId();
            $maxAcquire  = 1;
            $permissions = 0666;
            $autoRelease = 1;

            //SEMAPHORE
            $semaphore = sem_get($key, $maxAcquire, $permissions, $autoRelease);

            sem_acquire($semaphore);  //blocking

            for ($quantityIterate=0; $quantityIterate < $paymentDetailHasArticle->getArticlesQuantity(); $quantityIterate++)
            {
                $article = $paymentDetailHasArticle->getArticle();
                $paymentDetailArticlesHasGivenArticle = null;

                switch ($paymentDetailHasArticle->getArticle()->getSpecialType())
                {
                    case ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX:

                        $paymentDetailArticlesHasGivenArticle = $this->createGivenArticleGachaBox($article, $gamer);
                        break;

                    case ArticleSpecialTypeEnum::ARTICLE_GACHA_STEP:

                        $paymentDetailArticlesHasGivenArticle = $this->createGivenArticleGachaStep($article, $gamer);
                        break;

                    case ArticleSpecialTypeEnum::ARTICLE_RANDOM:

                        $paymentDetailArticlesHasGivenArticle = $this->createGivenArticleRandom($article, $gamer);
                        break;

                    case ArticleSpecialTypeEnum::ARTICLE_PACK:
                        //Nothing special to do
                        break;

                    default:
                        // Not special article
                        break;
                }

                if ($paymentDetailArticlesHasGivenArticle)
                {
                    $paymentDetailArticlesHasGivenArticle->setPaymentDetailHasArticle($paymentDetailHasArticle);

                    $this->em->persist($paymentDetailArticlesHasGivenArticle);
                    $this->em->flush($paymentDetailArticlesHasGivenArticle);
                }
            }
            sem_release($semaphore);
            sem_remove($semaphore);
        }

    }

    /**
     * @param Article $gacha
     * @param Gamer $gamer
     * @param bool $forceNewState
     * @throws \AppBundle\Exception\NviaException
     * @return PaymentDetailArticlesHasGivenArticle
     */
    protected function createGivenArticleGachaBox(Article $gacha, Gamer $gamer, $forceNewState = false)
    {
        $paymentDetailArticlesHasGivenArticle = $this->calculateRemainingForGamerBoxGacha($gacha, $gamer, false, $forceNewState);

        $gachaStep = $paymentDetailArticlesHasGivenArticle->getGachaStep();
        $initialDate = $paymentDetailArticlesHasGivenArticle->getGachaInitialDate();
        $remainingForUser = $paymentDetailArticlesHasGivenArticle->getRemainingForUserHistory();

        if (!$remainingForUser)
            throw new NviaException("remaining for user is null or empty");

        //Calculate remaining articles (no matter what we showed, something may have happened, so calculate again
        $validArticles = [];

        foreach ($gacha->getArticlesGacha() as $article)
        {
            $possibleArticle = $article->getPossibleArticle();

            if (!isset($remainingForUser[$possibleArticle->getId()]) || $remainingForUser[$possibleArticle->getId()] <= 0)
                continue;

            $i = $remainingForUser[$possibleArticle->getId()];

            while ($i > 0)
            {
                $validArticles[] = [
                    'article' => $possibleArticle
                ];
                $i--;
            }
        }

        if (count($validArticles) === 0)
        {
            $this->logger->addInfo('GACHA: Force new state because not valid articles available in current "articlesGacha"');
            return $this->createGivenArticleGachaBox($gacha, $gamer, true);
        }

        $give = mt_rand(0, count($validArticles) - 1);
        /** @var Article $article */
        $arr = $validArticles[$give];

        $this->logger->addInfo("ArticleGiven set: " . $arr['article']);

        return new PaymentDetailArticlesHasGivenArticle($arr['article'], null, $remainingForUser, $initialDate, $gachaStep);
    }

    /**
     * @param Article $gacha
     * @param Gamer $gamer
     * @return PaymentDetailArticlesHasGivenArticle
     */
    protected function createGivenArticleGachaStep(Article $gacha, Gamer $gamer)
    {
        //Give one specific article (store in "given_article")
//        $gacha = $paymentDetailHasArticle->getArticle();
//        $artService->calculateGachaForGamer($gacha, $paymentDetail->getTransaction()->getGamer());
//        $articles = $gacha->getArticlesGacha();
//        foreach ($articles as $article)
//        {
//            if ($article->getRemainingForUser() >0)
//            {
//                $paymentDetailHasArticle->addPaymentDetailArticlesHasGivenArticle(
//                    new PaymentDetailArticlesHasGivenArticle($article->getPossibleArticle(), $paymentDetailHasArticle, null)
//                );
//                break;
//            }
//        }
    }

    /**
     * @param Article $gacha
     * @param Gamer $gamer
     * @return PaymentDetailArticlesHasGivenArticle
     */
    protected function createGivenArticleRandom(Article $gacha, Gamer $gamer)
    {
//        $randArt = $paymentDetailHasArticle->getArticle();
//        $randArts = $randArt->getArticlesRandom();
//        $countArts = $randArts->count();
//
//        $paymentDetailHasArticle->addPaymentDetailArticlesHasGivenArticle(
//            new PaymentDetailArticlesHasGivenArticle(
//                $randArt->getArticlesRandom()->indexOf( array_rand($countArts, 1) ),
//                $paymentDetailHasArticle,
//                null
//            )
//        );

    }
}