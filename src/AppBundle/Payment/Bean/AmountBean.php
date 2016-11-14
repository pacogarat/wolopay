<?php


namespace AppBundle\Payment\Bean;


use AppBundle\Entity\Currency;

class AmountBean
{
    public $amount;   // Override amount
    public $vatAmount; //override VAT, in case provider pays VAT, but we have to show it to customer.

    /** @var Currency */
    public $amountCurrency; // Override amount currency

    public $exchangeEUR;
    public $exchangeGBP;
    public $exchangeUSD;

    function __construct($amount = null, Currency $amountCurrency = null, $exchangeFromAmount=false, $exchangeEUR=false, $exchangeUSD = null, $exchangeGBP=null, $vatAmount=null)
    {
        $this->amount = $amount;
        $this->vatAmount = $vatAmount;

        $this->amountCurrency = $amountCurrency;

        $this->exchangeEUR = $exchangeEUR;
        $this->exchangeUSD = $exchangeUSD;
        $this->exchangeGBP = $exchangeGBP;

        if ($this->amount !== null && $exchangeFromAmount)
        {
            $this->exchangeEUR = $this->calculateCurrencyExchange($exchangeEUR);
            $this->exchangeUSD = $this->calculateCurrencyExchange($exchangeUSD);
            $this->exchangeGBP = $this->calculateCurrencyExchange($exchangeGBP);
        }
    }

    private function calculateCurrencyExchange($exchange)
    {
        if ($exchange===null)
            return null;

        if ($this->amount===0)
            return 0;

        return (1*$exchange) / $this->amount;
    }


} 