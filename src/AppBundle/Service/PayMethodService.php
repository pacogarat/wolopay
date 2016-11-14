<?php


namespace AppBundle\Service;

use AppBundle\Entity\App;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Transaction;
use AppBundle\Payment\Util\CalculateFee;
use AppBundle\Payment\Util\PaymentProcessService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("app.pay_method")
 */
class PayMethodService
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /** @var Logger */
    private $logger;

    /** @var CurrencyService */
    private $currencyService;

    /** @var CalculateFee */
    private $calculateFeeService;

    /** @var PaymentProcessService */
    private $paymentProcessService;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "currencyService" = @Inject("common.currency"),
     *    "calculateFeeService" = @Inject("shop.payment.calculate_fee_service"),
     *    "paymentProcessService" = @Inject("shop.payment.payment_process"),
     * })
     */
    function __construct(EntityManager $em, Logger $logger, CurrencyService $currencyService, CalculateFee $calculateFeeService, PaymentProcessService $paymentProcessService)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->currencyService = $currencyService;
        $this->calculateFeeService = $calculateFeeService;
        $this->paymentProcessService = $paymentProcessService;
    }

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param AppHasPayMethodProviderCountry[] $appHasPMPC
     * @param \AppBundle\Entity\Transaction $transaction
     * @param \AppBundle\Entity\Currency $currency
     * @return AppHasPayMethodProviderCountry[]
     */
    public function calculateForcedPrices($appShopHasArticles, $appHasPMPC, Transaction $transaction, Currency $currency)
    {
        $result = [];

        foreach ($appHasPMPC as $key => $ahpmpc)
        {
            $pmpc = $ahpmpc->getPayMethodProviderHasCountry();

            $paymentDetail = new PaymentDetail('');
            $paymentDetail
                ->setCurrency($currency)
                ->setTransaction($transaction)
            ;

            $pmpc->setCurrency($appShopHasArticles[0]->getCountry()->getCurrency());
            $this->em->detach($pmpc);

            $SMS = $voice = null;

            if ($pmpc->hasAFixedAmount() && count($appShopHasArticles) > 1)
            {
                // ignore fixed amount for multiple articles
                continue;
            }

            if ($pmpc->hasAFixedAmount())
            {
                $SMS = $appShopHasArticles[0]->getSMSFromPMPC($pmpc);
                $voice = $appShopHasArticles[0]->getVoiceFromPMPC($pmpc);

                if (!$SMS && !$voice)
                    continue;
            }

            $periodicity=$totalEur=null;
            $this->paymentProcessService->completePaymentDetailConfiguration(
                $appShopHasArticles,
                $paymentDetail,
                $pmpc,
                $SMS,
                $voice,
                $total,
                $periodicity,
                $totalEur
            );

            $pdc = $paymentDetail->getPaymentDetailExtraCosts();

            if (!$pdc->isEmpty())
            {
                $ahpmpc->setTempForcePrice(
                    $total
                );

                $ahpmpc->setTempForcePriceDiff(
                    $pdc[0]->getAmount()
                );

                $ahpmpc->setTempForcePriceCurrency($currency);
            }

            $result[] = $ahpmpc;
        }

        return $result;
    }

    /**
     * @param AppHasPayMethodProviderCountry[] $appHasPMPC
     * @param AppShopHasArticle $appShopHasArticle
     */
    public function increaseTempForcePriceByProviderFee(AppShopHasArticle $appShopHasArticle, $appHasPMPC)
    {
        if ($appShopHasArticle->getArticle()->getArticleCategory()->getId() == ArticleCategoryEnum::FREE_PAYMENT_ID)
            return ;

        $currency = $appShopHasArticle->getCountry()->getCurrency();

        foreach ($appHasPMPC as $key => $ahpmpc)
        {
            $pmpc = $ahpmpc->getPayMethodProviderHasCountry();

            if ($ahpmpc->getApp()->getPayMethodsAddFeeToFinalAmount() && $ahpmpc->getTempForcePrice()
                && !$pmpc->hasAFixedAmount()
            )
            {
                $oldTemp = $ahpmpc->getTempForcePrice();

                $ahpmpc->setTempForcePrice(
                    $this->getAmountIncreasedByPMPC($oldTemp, $currency, $pmpc, $ahpmpc->getApp())
                );

                $ahpmpc->setTempForcePriceDiff(
                    round($ahpmpc->getTempForcePrice() - $oldTemp, $currency->getDecimalPlaces())
                );

                $ahpmpc->setTempForcePriceCurrency($currency);
            }
        }
    }

    public function getAmountIncreasedByPMPC($amount, Currency $currency, PayMethodProviderHasCountry $pmpc, App $app)
    {
        $amount = $this->getAmountOffsetByAPMPC($amount, $currency, $pmpc);
        $amount = $this->calculateFeeService->getAmountOffsetByWoloCommission($amount, $pmpc->getCurrency(), $app);
        $amount = $this->calculateFeeService->getAmountOffsetToVat($amount, $currency, $pmpc->getCountry());

        return $amount;
    }

    public function getAmountOffsetByAPMPC($amount, Currency $currency, PayMethodProviderHasCountry $pmpc)
    {
        $newAmount = $amount;

        if ($extra = $pmpc->getFeeProviderFixed())
        {
            $newAmount += $this->currencyService->getExchange($extra, $pmpc->getCurrency(), $currency->getId());
        }

        $pmpcFeeByPercent = $newAmount * $pmpc->getCurrentFeeProviderPercent() / 100 ;

        if ($minimal = $pmpc->getFeeProviderMinimal())
        {
            $minimal = $this->currencyService->getExchange($minimal, $pmpc->getCurrentFeeCurrency(), $currency);

            if ($minimal < $pmpcFeeByPercent)
            {
                $newAmount += $minimal;
                return round($newAmount, $currency->getDecimalPlaces());
            }
        }

        $newAmount = $newAmount * 100 / ( 100 - $pmpc->getCurrentFeeProviderPercent() );

        return round($newAmount, $currency->getDecimalPlaces());
    }

    /**
     * @param \AppBundle\Entity\AppHasPayMethodProviderCountry[] $appHasPMPCs
     * @param \AppBundle\Entity\AppShopHasArticle[] $appShopHasArticles
     * @return \AppBundle\Entity\AppHasPayMethodProviderCountry[]
     */
    public function removeAmount0PayMethods($appShopHasArticles, $appHasPMPCs)
    {
        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            foreach ($appHasPMPCs as $key => $appHasPMPC)
            {
                $pmpc = $appHasPMPC->getPayMethodProviderHasCountry();
                $result = $appShopHasArticle->calculateRangeValues([$pmpc]);

                if ($result === null)
                {
                    unset($appHasPMPCs[$key]);
                    continue;
                }

                if ($result === 0 && $pmpc->getPayMethod()->getArticleCategory()->getId() !== ArticleCategoryEnum::FREE_PAYMENT_ID)
                {
                    unset($appHasPMPCs[$key]);
                    continue;
                }
            }
        }

        return $appHasPMPCs;
    }
}