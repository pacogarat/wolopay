<?php


namespace AppBundle\Entity\NotPersisted;


use AppBundle\Entity\Currency;

class Money
{
    /** @var Currency */
    private $currency;
    private $amount;
    public $extraData = [];

    function __construct($amount, Currency $currency, $extraData = [])
    {
        $this->amount    = $amount;
        $this->currency  = $currency;
        $this->extraData = $extraData;
    }

    /**
     * @param mixed $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param mixed $amount
     * @return $this
     */
    public function sumAmount($amount)
    {
        $this->amount += $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

} 