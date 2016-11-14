<?php


namespace AppBundle\Command\Billing;


use AppBundle\Entity\NotPersisted\Money;

/**
 * Class BillingClientOwesInject
 * @package AppBundle\Command
 */
class BillingClientOwesInjectConcept
{
    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var Money */
    private $money;

    /** @var Money */
    private $moneyInClientCurrency;

    function __construct($extraSummaryConceptName, Money $extraSummaryConceptMoney = null, $extraSummaryConceptDesc = null)
    {
        $this->money = $extraSummaryConceptMoney;
        $this->name = $extraSummaryConceptName;

        if ($extraSummaryConceptDesc)
            $this->description = $extraSummaryConceptDesc;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \AppBundle\Entity\NotPersisted\Money
     */
    public function getMoney()
    {
        return $this->money;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \AppBundle\Entity\NotPersisted\Money $moneyInClientCurrency
     * @return $this
     */
    public function setMoneyInClientCurrency($moneyInClientCurrency)
    {
        $this->moneyInClientCurrency = $moneyInClientCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\NotPersisted\Money
     */
    public function getMoneyInClientCurrency()
    {
        return $this->moneyInClientCurrency;
    }



}