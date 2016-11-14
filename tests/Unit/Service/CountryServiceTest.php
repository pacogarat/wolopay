<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;


use AppBundle\Entity\Continent;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ContinentEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Service\CountryService;


class CountryServiceTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CountryService
     */
    private $countryService;

    public function setUp()
    {
        parent::setUp();
        $r = new \ReflectionClass(CountryService::class);
        $this->countryService = $r->newInstanceWithoutConstructor();
    }

    public function providerGetCountryCloserFromCountries()
    {
        $europe       = new Continent(ContinentEnum::EUROPE);
        $africa       = new Continent(ContinentEnum::AFRICA);
        $asia         = new Continent(ContinentEnum::ASIA);
        $australia    = new Continent(ContinentEnum::AUSTRALIA);
        $northAmerica = new Continent(ContinentEnum::NORTH_AMERICA);
        $southAmerica = new Continent(ContinentEnum::SOUTH_AMERICA);

        $argentina = new Country(CountryEnum::ARGENTINA, $southAmerica);
        $bolivia = new Country(CountryEnum::BOLIVIA, $southAmerica);
        $brazil = new Country(CountryEnum::BRAZIL, $southAmerica);
        $spain = new Country(CountryEnum::SPAIN, $europe);
        $other = new Country(CountryEnum::OTHER);
        $otherSouthAmerica = new Country(CountryEnum::OTHER_SOUTH_AMERICA, $southAmerica);

        return array(
            'From existing country' => [
                [$argentina, $bolivia, $other],
                $argentina,
                $argentina,
            ],
            'Not existing country but exist a Other continent ' => [
                [$otherSouthAmerica, $bolivia, $spain, $other],
                $argentina,
                $otherSouthAmerica,
            ],
            'Not existing other country' => [
                [$brazil, $bolivia, $spain, $other],
                $argentina,
                $other,
            ],
            'Not existing any relation' => [
                [$brazil, $bolivia, $spain],
                $argentina,
                null,
            ],
        );
    }

    /**
     * @dataProvider providerGetCountryCloserFromCountries
     */
    public function testGetCountryCloserFromCountriesOk($countries, $countryFromSearch, Country $countryExpected = null)
    {
        $countryResult = $this->countryService->getCountryCloserFromCountries($countries, $countryFromSearch);

        $this->assertEquals($countryResult, $countryExpected);
    }

} 