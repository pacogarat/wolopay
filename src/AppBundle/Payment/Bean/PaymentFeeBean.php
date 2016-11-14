<?php


namespace AppBundle\Payment\Bean;

use AppBundle\Entity\Currency;


class PaymentFeeBean
{
    public $totalFee; // totalFee override all Fees! (if totalFee>0, "extra fee is not used"; total fee is the final one).
    public $currencyFee; //Currency in which the fees come

    public $percentFee; // new percentage fee to overrides original %fee
    public $minFee;     // min fee to overrides original min fee
    public $providerFixedFeeAmount;// new fixed fee to overrides original  fixed fee amount

    public $extraFee; // extraFee to add a new extra cost not foreseen -like a cost for a chargeback

    public $exchangeRateEur; //exchange rate used in reality (to override Wolopay one)
    public $exchangeRateUsd; //exchange rate used in reality (to override wolopay one)
    public $exchangeRateGbp; //exchange rate used in reality (to override wolopay one)

    function __construct(
        $totalFee,
        Currency $currencyFee,
        $percentFee = null,
        $providerFixedFeeAmount = null,
        $minFee = null,
        $extraFee = null,
        $exchangeRateEur = null,
        $exchangeRateUsd = null,
        $exchangeRateGbp = null
    )
    {
        $this->totalFee = $totalFee;
        $this->currencyFee = $currencyFee;

        $this->percentFee = $percentFee;
        $this->providerFixedFeeAmount = $providerFixedFeeAmount;
        $this->minFee = $minFee;

        $this->extraFee = $extraFee;

        $this->exchangeRateEur = $exchangeRateEur;
        $this->exchangeRateUsd = $exchangeRateUsd;
        $this->exchangeRateGbp = $exchangeRateGbp;
    }

} 