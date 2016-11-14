<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Provider;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadProvider extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent(ProviderEnum::RIXTY_NAME, 'COFCOFCOF',  CountryEnum::USA, false, array(CurrencyEnum::EURO, CurrencyEnum::DOLLAR));
        $this->fillComponent(ProviderEnum::PAYPAL_NAME, 'C1FCOFCOF', CountryEnum::USA, false, array(CurrencyEnum::EURO, CurrencyEnum::DOLLAR), true);
        $this->fillComponent(ProviderEnum::PAYSAFECARD_NAME, 'C1FC3COF', CountryEnum::USA, false, array(CurrencyEnum::EURO, CurrencyEnum::DOLLAR), true);
        $this->fillComponent(ProviderEnum::UKASH_NAME, 'C1F3C3COF', CountryEnum::USA, false, array(CurrencyEnum::EURO, CurrencyEnum::DOLLAR));
        $this->fillComponent(ProviderEnum::NVIA_NAME, 'C1FXXXOF', CountryEnum::SPAIN, false, array(CurrencyEnum::DOLLAR), false, null, null, false);
        $this->fillComponent(ProviderEnum::XSOLLA_NAME, 'C1FX3XXOF', CountryEnum::SPAIN, true, array(CurrencyEnum::DOLLAR));
        $this->fillComponent(ProviderEnum::FORTUNO_NAME, 'C1FX35X3OF', CountryEnum::SPAIN, true, array(CurrencyEnum::EURO));
        $this->fillComponent(ProviderEnum::ADYEN_NAME, '32FX35X3OF', CountryEnum::SPAIN, true, array(CurrencyEnum::EURO), true);
        $this->fillComponent(ProviderEnum::NETELLER_NAME, '322X3OF', CountryEnum::SPAIN, true, array(CurrencyEnum::EURO), true);
        $this->fillComponent(ProviderEnum::MOL_NAME, '3231213213OF', CountryEnum::SPAIN, true, array(CurrencyEnum::DOLLAR));
        $this->fillComponent(ProviderEnum::G2A_NAME, 'g2aF', CountryEnum::SPAIN, false, array(CurrencyEnum::EURO));
        $this->fillComponent(ProviderEnum::CHERRY_CREDIT_NAME, 'Cherry', CountryEnum::SPAIN, false, array(CurrencyEnum::EURO), false, CurrencyEnum::DOLLAR, 1300);
        $this->fillComponent(ProviderEnum::BOA_COMPRA_NAME, 'BoaCompra', CountryEnum::SPAIN, false, array(CurrencyEnum::EURO), false, CurrencyEnum::DOLLAR, null);
        $this->fillComponent(ProviderEnum::FACEBOOK_NAME, 'facebook', CountryEnum::SPAIN, false, array(CurrencyEnum::EURO), true, CurrencyEnum::DOLLAR);
        $this->fillComponent(ProviderEnum::STEAM_NAME, 'Steam', CountryEnum::SPAIN, false, array(CurrencyEnum::EURO), true, CurrencyEnum::DOLLAR);
        $this->fillComponent(ProviderEnum::TIGO_NAME, 'Tigo', CountryEnum::SPAIN, false, array(CurrencyEnum::VENEZUELAN_BOLIVAR), false, CurrencyEnum::DOLLAR);

    }

    private function fillComponent($companyName, $cif, $countryKey, $freeVat=false, array $currenciesAvailable, $hasClientCredentials = false, $currencyVirtualExchange = null, $amountVirtualExchange= null, $refundEnabled = true)
    {
        $obj = new Provider();

        $obj
            ->setRefundEnabled($refundEnabled)
            ->setHasClientCredentials($hasClientCredentials)
            ->setFreeVat($freeVat)
            ->setName($companyName)
            ->setNameCompany($companyName)
            ->setCif($cif)
            ->setCountry($this->getReference('country-'.$countryKey))
        ;

        foreach ($currenciesAvailable as $currencyId)
        {
            $obj->addCurrenciesAvailable(
                $this->getReference('currency-'.$currencyId)
            );
        }

        if ($amountVirtualExchange)
        {
            $obj
                ->setVirtualCurrencyExchangeAmount($amountVirtualExchange)
                ->setVirtualCurrencyExchangeCurrency($this->getReference('currency-'.$currencyVirtualExchange))
            ;
        }

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('provider-'.$companyName, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }



} 