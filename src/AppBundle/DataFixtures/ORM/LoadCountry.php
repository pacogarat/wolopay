<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Continent;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\VatCategoryEnum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCountry extends AbstractFixture implements OrderedFixtureInterface
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

        $europe=new Continent('Europe');
        $northAmerica=new Continent('North America');
        $southAmerica=new Continent('South America');
        $asia=new Continent('Asia');
        $australia=new Continent('Australia');
        $other=new Continent('Other');

        $africa=new Continent('Africa');

        $this->om->persist($europe);
        $this->om->persist($southAmerica);
        $this->om->persist($northAmerica);
        $this->om->persist($asia);
        $this->om->persist($australia);
        $this->om->persist($africa);
        $this->om->persist($other);
        $this->om->flush();

        $this->fillComponent($europe, CountryEnum::SPAIN, 'España', 214, 1, CurrencyEnum::EURO, LanguageEnum::SPANISH, VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID);
        $this->fillComponent($europe, CountryEnum::RUSSIA, 'Russia', 250, 1, CurrencyEnum::RUSSIAN_RUBLE, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID);
        $this->fillComponent($northAmerica, CountryEnum::USA, 'United States', 310, 2, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH);
        $this->fillComponent($africa, CountryEnum::ZIMBABWE, 'Zimbabwe', 602, 0.5, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH);

        $this->fillComponent($europe, CountryEnum::TURKEY, 'Turkey', 286, 0.7, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 12, 9999);
        $this->fillComponent($europe, CountryEnum::POLAND, 'Poland', 260, 0.6, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 20, 9999);

        $this->fillComponent($other, CountryEnum::OTHER, 'Other', 0, 1, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 51, 9999, false);
        $this->fillComponent($europe, CountryEnum::OTHER_EUROPE, 'Europe', -1, 1, CurrencyEnum::EURO, LanguageEnum::ENGLISH, VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID, 21, 999, false);
        $this->fillComponent($northAmerica, CountryEnum::OTHER_NORTH_AMERICA, 'North America', -2, 1, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 21, 999, false);
        $this->fillComponent($asia, CountryEnum::OTHER_ASIA, 'Asia', -3, 1, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 21, 999, false);
        $this->fillComponent($australia, CountryEnum::OTHER_AUSTRALIA, 'Australia', -4, 1, CurrencyEnum::DOLLAR, LanguageEnum::ENGLISH, VatCategoryEnum::NONE_ID, 12, 9999, false);

    }

    private function fillComponent( Continent $continent, $id, $name, $code, $costOfLiving, $currencyId, $languageId, $vatCategoryId = VatCategoryEnum::NONE_ID, $vat=21, $order=1, $standard=true, $timeZone = 'Europe/Madrid')
    {
        $obj = new Country($id);

        $obj
            ->setName($name)
            ->setLocalName($name)
            ->setMCC($code)
            ->setVatCategory($this->getReference('vat_category-'.$vatCategoryId))
            ->setCurrency($this->getReference('currency-'.$currencyId))
            ->setLanguage($this->getReference('language-'.$languageId))
            ->setVat($vat)
            ->setOrder($order)
            ->setContinent($continent)
            ->setCostOfLiving($costOfLiving)
            ->setTimeZone($timeZone)
            ->setStandard($standard)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('country-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 40; // the order in which fixtures will be loaded
    }
} 