<?php


namespace AppBundle\Payment\Util;

use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CommissionBaseEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\VatCategoryEnum;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Purchase;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Service\CurrencyService;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.calculate_fee_service")
 */
class CalculateFee
{
    /** @var CurrencyService */
    protected $currencyService;

    private $logger;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "currencyService" = @Inject("common.currency")
     * })
     */
    function __construct(Logger $logger,  CurrencyService $currencyService)
    {
        $this->logger = $logger;
        $this->currencyService = $currencyService;
    }

    /**
     * Fill purchase with amountProvider, amountWolo, amountGame and also conditions to calculate it
     *
     * @param Purchase $purchase
     * @param PayMethodProviderHasCountry $pmpc
     * @param PaymentFeeBean $paymentFeeBean
     */
    public function calculateByPurchase(Purchase $purchase, PayMethodProviderHasCountry $pmpc, PaymentFeeBean $paymentFeeBean = null)
    {
        $result = $this->calculate(
            $purchase->getAmountTotal(),
            $purchase->getCurrency(),
            $pmpc,
            $purchase->getApp(),
            $purchase->getCountryGamer(),
            $paymentFeeBean
        );

        list($amountProvider, $amountWolo, $amountGame) = $result[0];
        list($providerFeePercent, $providerRealFeePercent, $providerMinFeeAmount, $providerFixedFeeAmount, $taxPercent, $taxAmount, $priceBeforeTaxes) = $result[1];

        $purchase
            ->setAmountWolo($amountWolo)
            ->setAmountProvider($amountProvider)
            ->setAmountGame($amountGame)
            ->setAmountTax($taxAmount)
            ->setAmountBeforeTaxes($priceBeforeTaxes)
            ->setProviderFeePercent($providerFeePercent)
            ->setProviderRealFeePercent($providerRealFeePercent)
            ->setProviderMinFeeAmount($providerMinFeeAmount)
            ->setProviderFixedFeeAmount($providerFixedFeeAmount)
            ->setTaxPercent($taxPercent)
        ;

        $this->logger->addInfo("Total amount: ".$purchase->getAmountTotal().$purchase->getCurrency()->getId().
            ", Profit sharing, Provider: $amountProvider, Wolo: $amountWolo, Game: $amountGame, Tax: $taxAmount"
        );
    }

    public function calculate($paidAmount, Currency $paidCurrency, PayMethodProviderHasCountry $pmpc, App $app, Country $countryDetectedGamer, PaymentFeeBean $paymentFeeBean = null)
    {
        /*
         * 1.- See if we already have what the payment method keeps (as in paypal). if we do, done
         * 2.- See if we have to deduct VAT before calculating commissions for payMethod
         * 3.- Calculate VAT and substract if necessary
         * 4-. calculate commission (% + fixed), checking correct currency
         * 5.- See if payMethod has a min fee. If it does, and commission is lower, apply min; again check currency
         */

        $providerTotalFeeAmount = $providerFeePercent = $providerMinFeeAmount = $providerFixedFeeAmount = 0;
        $priceBeforeTaxes = $paidAmount;
        $taxAmount = 0;
        $taxPercent = null;


        $providerFeesCurrency = $pmpc->getCurrentFeeCurrency();

        if (!$pmpc->getProvider()->getFreeVat() && !$pmpc->isCurrentPriceSentNet())
        {
            switch ($countryDetectedGamer->getVatCategory()->getId())
            {
                case VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID:
                    list($priceBeforeTaxes, $taxAmount, $taxPercent) = $this->calculateTax_VAT_FROM_BUYER_COUNTRY($paidAmount, $countryDetectedGamer, $pmpc);
                    break;
            }
        }

        if ($paymentFeeBean && $paymentFeeBean->totalFee)
        {
            $providerTotalFeeAmount = $this->currencyService->getExchangeSimple($paymentFeeBean->totalFee, $paymentFeeBean->currencyFee->getId(), $paidCurrency->getId());
        }
        else
        {
            //% fee for the payment method (like paypal = 3.4%)
            if ($paymentFeeBean && $paymentFeeBean->percentFee){
                $providerFeePercent = $paymentFeeBean->percentFee;
            }
            else
            {
                $providerFeePercent = ($pmpc->getCurrentFeeProviderPercent() ? : 0);
            }

            //fixed fee for payment method (like paypal= 0.35eur)
            if ($paymentFeeBean && $paymentFeeBean->providerFixedFeeAmount && $paymentFeeBean->currencyFee)
            {
                $providerFixedFeeAmount = $this->currencyService->getExchangeSimple(
                    $paymentFeeBean->providerFixedFeeAmount, $paymentFeeBean->currencyFee->getId(), $paidCurrency->getId());
            }
            else {
                $providerFixedFeeAmount = $pmpc->getCurrentFeeProviderFixed() ?
                 $this->currencyService->getExchange($pmpc->getCurrentFeeProviderFixed(), $pmpc->getCurrentFeeCurrency(), $paidCurrency->getId()):0;
            }

            //min fee for the payment method for low prices
            if ($paymentFeeBean && $paymentFeeBean->minFee && $paymentFeeBean->currencyFee)
            {

                $providerMinFeeAmount = $this->currencyService->getExchangeSimple(
                    $paymentFeeBean->minFee, $paymentFeeBean->currencyFee->getId(), $paidCurrency->getId());
            }
            else
            {
                $providerMinFeeAmount = $pmpc->getCurrentFeeProviderMinimal()?
                    $this->currencyService->getExchange($pmpc->getCurrentFeeProviderMinimal(), $pmpc->getCurrentFeeCurrency(), $paidCurrency->getId()) :0;
            }

            $extraCost = 0;
            if ($paymentFeeBean && $paymentFeeBean->extraFee && $paymentFeeBean->currencyFee)
            {
                $extraCost = $paymentFeeBean->extraFee;
                $providerFeesCurrency   = $paymentFeeBean->currencyFee;
                $extraCost = $this->currencyService->getExchangeSimple($extraCost, $providerFeesCurrency->getId(), $paidCurrency->getId());
            }

            $basePrice4PayMethodCommission = $paidAmount;
            if ($pmpc->isCurrentFeeCalculatedWithNet() && $priceBeforeTaxes)
            {
                $basePrice4PayMethodCommission = $priceBeforeTaxes;
            }

            $providerTotalFeeAmount = ($providerFeePercent * $basePrice4PayMethodCommission) / 100 ;
            $providerTotalFeeAmount += $providerFixedFeeAmount;

            //echo "providerTotalFeeAmount=$providerTotalFeeAmount  \n providerFixedFeeAmount = $providerFixedFeeAmount \nproviderMinFeeAmount = $providerMinFeeAmount";
            if ($providerTotalFeeAmount < $providerMinFeeAmount)
            {
                $providerTotalFeeAmount = $providerMinFeeAmount;
            }

            $providerTotalFeeAmount += $extraCost;
        }

        //We'll store the % that the total payment provider fee means against the price paid without taxes
        $providerRealFeePercent = ($paidAmount ? $providerTotalFeeAmount / $paidAmount  * 100 : 0);

        //I've calculated how much the provider keeps.Now what's left for wolopay and 4 the game
        $woloCommissionType = $app->getCommissionBase(); //may be WoloPayNet/EndUserPrice
        $woloCommissionCurrency = $app->getCommissionCurrency();

        if ($woloCommissionType == CommissionBaseEnum::WOLOPAYNET){
            $woloBasePrice4Commission = $paidAmount - $taxAmount -  $providerTotalFeeAmount ;
        }elseif($woloCommissionType == CommissionBaseEnum::ENDUSERPRICE){
            $woloBasePrice4Commission = $paidAmount;
        }else{
            $woloBasePrice4Commission = $paidAmount - $taxAmount -  $providerTotalFeeAmount; //Asumo
            $this->logger->error("woloCommissionType $woloCommissionType not defined.");
        }

        $amount4wolo = 0;

        if ($app->getCommissionPercent()){
            $amount4wolo = $woloBasePrice4Commission * $app->getCommissionPercent() / 100;
        }

        if ($app->getCommissionFixedFee())
        {
            $woloFixedFeeInCurrency = $app->getCommissionFixedFee();
            if ($paidCurrency <> $woloCommissionCurrency){
                $woloFixedFeeInCurrency = $this->currencyService->getExchange($app->getCommissionFixedFee(), $woloCommissionCurrency, $paidCurrency->getId());
            }
            $amount4wolo += $woloFixedFeeInCurrency;
        }


        if ($app->getCommissionMin() !== null){
            $woloMinInCurrency = $app->getCommissionMin();
            if ($paidCurrency <> $woloCommissionCurrency){
                $woloMinInCurrency = $this->currencyService->getExchange($app->getCommissionMin(), $woloCommissionCurrency, $paidCurrency->getId());
            }
            if ($amount4wolo < $woloMinInCurrency)
                $amount4wolo = $woloMinInCurrency;
        }

        if ($app->getCommissionMax() !== null){
            $woloMaxInCurrency = $app->getCommissionMax();
            if ($paidCurrency <> $woloCommissionCurrency){
                $woloMaxInCurrency = $this->currencyService->getExchange($app->getCommissionMax(), $woloCommissionCurrency, $paidCurrency->getId());
            }
            if ($amount4wolo > $woloMaxInCurrency)
                $amount4wolo = $woloMaxInCurrency;
        }

        if ($paidAmount == 0)
            $amount4wolo = 0;

        // echo "paidAmount $paidAmount - taxAmount  $taxAmount -  providerTotalFeeAmount $providerTotalFeeAmount - amount4wolo $amount4wolo";

        $amount4Game = $paidAmount - $taxAmount - $providerTotalFeeAmount - $amount4wolo;

        return [
            [$providerTotalFeeAmount, $amount4wolo, $amount4Game],
            [$providerFeePercent, $providerRealFeePercent, $providerMinFeeAmount, $providerFixedFeeAmount, $taxPercent, $taxAmount, $priceBeforeTaxes]
        ];
    }

    private function calculateTax_VAT_FROM_BUYER_COUNTRY($paidAmount, Country $countryDetectedGamer, PayMethodProviderHasCountry $pmpc)
    {
        if (!$countryDetectedGamer->getVat() > 0)
        {
            $this->logger->addError("Invalid vat from country ".$countryDetectedGamer->getId());
            return 0;
        }

        $taxPercent       = $countryDetectedGamer->getVat();
        $priceBeforeTaxes = $paidAmount / (1 + ($taxPercent / 100));
        $taxAmount        = $paidAmount - $priceBeforeTaxes;

        return [$priceBeforeTaxes, $taxAmount, $taxPercent];
    }

    public function getAmountOffsetToVat($amount, Currency $currency, Country $countryClient)
    {
        if (!$amount)
            return $amount;

        $taxPercent = 0;

        switch ($countryClient->getVatCategory()->getId())
        {
            case VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID:
                $taxPercent = $countryClient->getVat();
                break;
        }

        if (!$taxPercent)
            return $amount;

        $taxOffset = $amount * 100 / ( 100 - $taxPercent );

        return round($taxOffset, $currency->getDecimalPlaces());
    }

    public function getAmountOffsetByWoloCommission($amount, Currency $currency, App $app)
    {
        // todo DAVID HELP :-), for now only adding 0.1
        return $amount + ($this->currencyService->getExchangeSimple(0.1, CurrencyEnum::EURO, $currency->getId()));
    }
} 