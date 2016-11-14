<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\PayMethodProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPayMethodProviderHasCountry extends AbstractFixture implements OrderedFixtureInterface
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

        $this->fillComponent(PayMethodEnum::RIXTY_NAME.'-'.ProviderEnum::RIXTY_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::RIXTY_NAME.'-'.ProviderEnum::RIXTY_NAME, CountryEnum::SPAIN, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::RUSSIA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::VISA_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::OTHER, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::PAYSAFECARD_NAME.'-'.ProviderEnum::PAYSAFECARD_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::PAYSAFECARD_NAME.'-'.ProviderEnum::PAYSAFECARD_NAME, CountryEnum::USA, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::UKASH_NAME.'-'.ProviderEnum::UKASH_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::UKASH_NAME.'-'.ProviderEnum::UKASH_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);


        $this->fillComponent(PayMethodEnum::PROMO_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO, false, false);

        $this->fillComponent(PayMethodEnum::SMS_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO, false);
        $this->fillComponent(PayMethodEnum::SMS_NAME.'-'.ProviderEnum::FORTUNO_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO, false);

        $this->fillComponent(PayMethodEnum::VOICE_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::SPAIN, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::OTHERS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::SPAIN, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::VISA_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::SPAIN, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::VISA_NAME.'-'.ProviderEnum::ADYEN_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::NETELLER_NAME.'-'.ProviderEnum::NETELLER_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::VISA_SUBSCRIPTION_NAME.'-'.ProviderEnum::ADYEN_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::SPAIN, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::TURKEY, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::OTHERS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::TURKEY, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::OTHERS_NAME.'-'.ProviderEnum::XSOLLA_NAME, CountryEnum::POLAND, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::CALL12_NAME.'-'.ProviderEnum::MOL_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::TEST_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);

        $this->fillComponent(PayMethodEnum::VIRTUAL_CURRENCY_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::OTHER, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::VIRTUAL_CURRENCY_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::POLAND, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::VIRTUAL_CURRENCY_NAME.'-'.ProviderEnum::NVIA_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::G2A_NAME.'-'.ProviderEnum::G2A_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::CHERRY_CREDITS_NAME.'-'.ProviderEnum::CHERRY_CREDIT_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::FACEBOOK_SUBSCRIPTION_NAME.'-'.ProviderEnum::FACEBOOK_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::FACEBOOK_NAME.'-'.ProviderEnum::FACEBOOK_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::FACEBOOK_NAME.'-'.ProviderEnum::FACEBOOK_NAME, CountryEnum::USA, CurrencyEnum::DOLLAR);
        $this->fillComponent(PayMethodEnum::STEAM_WEB_NAME.'-'.ProviderEnum::STEAM_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::BOA_COMPRA_NAME.'-'.ProviderEnum::BOA_COMPRA_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);
        $this->fillComponent(PayMethodEnum::BOA_COMPRA_SUBSCRIPTION_NAME.'-'.ProviderEnum::BOA_COMPRA_NAME, CountryEnum::SPAIN, CurrencyEnum::EURO);

        $this->fillComponent(PayMethodEnum::TIGO_NAME.'-'.ProviderEnum::TIGO_NAME, CountryEnum::SPAIN, CurrencyEnum::VENEZUELAN_BOLIVAR);

    }

    private function fillComponent($payMethodKey, $country, $currency, $default=true, $active = true)
    {
        $obj = new PayMethodProviderHasCountry();

        $obj
            ->setPayMethodHasProvider($this->getReference('pay_method_has_provider-'.$payMethodKey))
            ->setCountry($this->getReference('country-'.$country))
            ->setCurrency($this->getReference('currency-'.$currency))
            ->setDefault($default)
            ->setActive($active)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('pay_method_provider_has_country-'.$payMethodKey.'-'.$country, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 160; // the order in which fixtures will be loaded
    }
} 