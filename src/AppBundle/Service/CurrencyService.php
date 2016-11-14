<?php


namespace AppBundle\Service;

use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Provider;
use AppBundle\Exception\NviaException;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;


/**
 * @Service("common.currency")
 */
class CurrencyService
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /**
     * @InjectParams({
     *    "em" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    function __construct(EntityManager $em)
    {
        $this->em     = $em;
    }

    public function getExchangeSimple($amount, $amountCurrencyId, $currencyWantedId)
    {
        if ($amountCurrencyId === $currencyWantedId)
            return $amount;

        if (!$amountCurrency = $this->em->getRepository("AppBundle:Currency")->find($amountCurrencyId))
            throw new \Exception("invalid id currency $amountCurrencyId");

        return $this->getExchange($amount, $amountCurrency, $currencyWantedId);
    }

    public function getExchangeWithFeePercentIfNeedChangeCurrency($amount, Currency $amountCurrency, $currencyWantedId, $extraFeePercent)
    {
        $result = $this->getExchange($amount, $amountCurrency, $currencyWantedId);

        if ($amountCurrency->getId() === $currencyWantedId)
            return [$result, 0];

        $percentResult = $result * $extraFeePercent / 100;
        $total = $result - $percentResult;

        return [$total, $percentResult];
    }

    public function getExchange($amount, Currency $amountCurrency, $currencyWantedId)
    {
        if ($amountCurrency->getId() === $currencyWantedId)
            return $amount;

        $currencyWanted = $this->em->getRepository("AppBundle:Currency")->find($currencyWantedId);

        return self::calculateExchangePrimitive($amount, $amountCurrency, $currencyWanted);
    }

    public function getExchangeFromVirtualFromProvider($amountRealMoney, Currency $currency, Provider $provider)
    {
        if (!$provider->getVirtualCurrencyExchangeAmount() || !$provider->getVirtualCurrencyExchangeCurrency())
            throw new NviaException('Provider '.$provider->getId().' haven\'t virtual currency exchange configurated');

        return $this->getExchangeFromVirtual($amountRealMoney, $currency, $provider->getVirtualCurrencyExchangeAmount(), $provider->getVirtualCurrencyExchangeCurrency());
    }

    public function getExchangeFromVirtual($amountRealMoney, Currency $currency, $virtualAmountExchange, Currency $currencyVirtualCurrency)
    {
        $amountInCurrencyVirtualExchange = $this->getExchange($amountRealMoney, $currency, $currencyVirtualCurrency);

        return (int) ($amountInCurrencyVirtualExchange *  $virtualAmountExchange);
    }

    private static function getExchangeFromCurrency(Currency $currency, Currency $currencyWanted)
    {
        switch ($currencyWanted->getId())
        {
            case CurrencyEnum::EURO:
                $value =  $currency->getExchangeRateEur();
                break;
            case CurrencyEnum::DOLLAR:
                $value = $currency->getExchangeRateUsd();
                break;
            case CurrencyEnum::POUND_STERLING:
                $value =  $currency->getExchangeRateGbp();
                break;
            default:
                $euros = $currency->getExchangeRateEur();
                $value = $euros / $currencyWanted->getExchangeRateEur();
        }

        return $value;
    }

    static function calculateExchangePrimitive($amount, Currency $currency, Currency $currencyWanted)
    {
        if ($currency->getId() === $currencyWanted->getId())
            return $amount;

        $value = $amount * self::getExchangeFromCurrency($currency, $currencyWanted);

        if ($currencyWanted->getDecimalPlaces()==0){
            return round($value, $currencyWanted->getDecimalPlaces());
        }

        return $value;
    }

} 