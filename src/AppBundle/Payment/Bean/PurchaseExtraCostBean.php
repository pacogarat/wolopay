<?php


namespace AppBundle\Payment\Bean;


class PurchaseExtraCostBean
{
    public $amountTotal;
    public $amountGame;
    public $amountProvider;
    public $amountWolo;
    public $amountTax;
    public $currencyId;

    /**
     * @param null|string $currencyId if null take the purchase currency
     * @param $amountTotal
     * @param $amountGame
     * @param $amountProvider
     * @param int $amountTax
     * @param int $amountWolo
     */
    function __construct($currencyId, $amountTotal, $amountGame, $amountProvider, $amountTax=0, $amountWolo = 0)
    {
        $this->amountGame     = $amountGame;
        $this->amountProvider = $amountProvider;
        $this->amountTax      = $amountTax;
        $this->amountWolo     = $amountWolo;
        $this->currencyId     = $currencyId; // can be null
        $this->amountTotal    = $amountTotal;
    }

} 