<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCurrency extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent (CurrencyEnum::ARGENTINE_PESO, 'ARGENTINE_PESO', '$', '0.0906', '0.123', '0.0724');
        $this->fillComponent (CurrencyEnum::BULGARIAN_LEV, 'BULGARIAN_LEV', '$', '0.508', '0.6895', '0.406');
        $this->fillComponent (CurrencyEnum::CHILEAN_PESO, 'CHILEAN_PESO', '$', '0.0013', '0.0018', '0.0011',0);
        $this->fillComponent (CurrencyEnum::COLOMBIAN_PESO, 'COLOMBIAN_PESO', '$', '0.0004', '0.0005', '0.0003');
        $this->fillComponent (CurrencyEnum::CZECH_KORUNA, 'CZECH_KORUNA', '$', '0.0364', '0.0495', '0.0291');
        $this->fillComponent (CurrencyEnum::EURO, 'EURO', '€', '1', '1.3572', '0.7993');
        $this->fillComponent (CurrencyEnum::POUND_STERLING, 'POUND_STERLING', '£', '1.2511', '1.6981', '1');
        $this->fillComponent (CurrencyEnum::HUNGARIAN_FORINT, 'HUNGARIAN_FORINT', '$', '0.0032', '0.0044', '0.0026');
        $this->fillComponent (CurrencyEnum::MOROCCAN_DIRHAM, 'MOROCCAN_DIRHAM', '$', '0.0893', '0.1211', '0.0713');
        $this->fillComponent (CurrencyEnum::MEXICAN_PESO, 'MEXICAN_PESO', '$', '0.0565', '0.0767', '0.0452');
        $this->fillComponent (CurrencyEnum::MALAYSIAN_RINGGIT, 'MALAYSIAN_RINGGIT', '$', '0.2285', '0.3101', '0.1826');
        $this->fillComponent (CurrencyEnum::PERUVIAN_SOL, 'PERUVIAN_SOL', '$', '0.2638', '0.358', '0.2108');
        $this->fillComponent (CurrencyEnum::POLISH_ZLOTY, 'POLISH_ZLOTY', '$', '0.2414', '0.3276', '0.1929');
        $this->fillComponent (CurrencyEnum::PARAGUAYAN_GUARANI, 'PARAGUAYAN_GUARANI', '$', '0.0002', '0.0002', '0.0001',0);
        $this->fillComponent (CurrencyEnum::RUSSIAN_RUBLE, 'RUSSIAN_RUBLE', '$', '0.0213', '0.0289', '0.017');
        $this->fillComponent (CurrencyEnum::SINGAPORE_DOLLAR, 'SINGAPORE_DOLLAR', '$', '0.589', '0.7995', '0.4708');
        $this->fillComponent (CurrencyEnum::TURKISH_LIRA, 'TURKISH_LIRA', '$', '0.3436', '0.4663', '0.2746');
        $this->fillComponent (CurrencyEnum::UKRAINIAN_HRYVNIA, 'UKRAINIAN_HRYVNIA', '$', '0.0627', '0.0851', '0.0501');
        $this->fillComponent (CurrencyEnum::DOLLAR, 'DOLLAR', '$', '0.7368', '1', '0.5889');
        $this->fillComponent (CurrencyEnum::VIETNAMESE_DONG, 'VIETNAMESE_DONG', '$', '0', '0', '0',0);
        $this->fillComponent (CurrencyEnum::SOUTH_AFRICAN_RAND, 'SOUTH_AFRICAN_RAND', '$', '0.0686', '0.0931', '0.0548');
        $this->fillComponent (CurrencyEnum::VENEZUELAN_BOLIVAR, 'VENEZUELAN_BOLIVAR', 'Bs.', '0.1397', '0.1575', '0.1026');

    }

    private function fillComponent($idISO, $name, $symbol, $eur, $usd, $gbp, $decimalPlaces=2)
    {
        $obj = new Currency($idISO);

        $obj
            ->setName($name)
            ->setSymbol($symbol)
            ->setExchangeRateEur($eur)
            ->setExchangeRateGbp($gbp)
            ->setExchangeRateUsd($usd)
            ->setDecimalPlaces($decimalPlaces)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('currency-'.$idISO, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }
} 