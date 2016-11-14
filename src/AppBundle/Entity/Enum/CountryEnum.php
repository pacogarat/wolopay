<?php

namespace AppBundle\Entity\Enum;

use AppBundle\Entity\Country;

class CountryEnum
{
    const SPAIN     = 'ES';
    const USA       = 'US';
    const ZIMBABWE  = 'ZW';
    const TURKEY    = 'TR';
    const POLAND    = 'PL';
    const ARGENTINA = 'AR';
    const BRAZIL    = 'BR';
    const MEXICO    = 'MX';
    const VENEZUELA = 'VE';
    const COLOMBIA  = 'CO';
    const ECUADOR   = 'EC';
    const EGYPT     = 'EG';
    const NORWAY    = 'NO';

    const PERU           = 'PE';
    const UNITED_KINGDOM = 'UK';
    const BOLIVIA        = 'BO';
    const RUSSIA         = 'RU';

    const OTHER               = 'XA'; // Generic 4 all
    const OTHER_EUROPE        = 'XB';
    const OTHER_SOUTH_AMERICA = 'XC';
    const OTHER_AUSTRALIA     = 'XD';
    const OTHER_NORTH_AMERICA = 'XE';
    const OTHER_ASIA          = 'XF';
    const OTHER_AFRICA        = 'XG';

    const PROXY     = 'A1';

    public static $OTHERS_ALL = [
        self::OTHER,
        self::OTHER_EUROPE,
        self::OTHER_AUSTRALIA,
        self::OTHER_SOUTH_AMERICA,
        self::OTHER_NORTH_AMERICA,
        self::OTHER_ASIA
    ];

    public static function getOtherIdFromCountry(Country $country)
    {
        if ($country->getStandard())
        {
            switch ($country->getContinent()->getId())
            {
                case ContinentEnum::EUROPE:
                    return self::OTHER_EUROPE;
                case ContinentEnum::NORTH_AMERICA:
                    return self::OTHER_NORTH_AMERICA;
                case ContinentEnum::SOUTH_AMERICA:
                    return self::OTHER_SOUTH_AMERICA;
                case ContinentEnum::ASIA:
                    return self::OTHER_ASIA;
                case ContinentEnum::AUSTRALIA:
                    return self::OTHER_AUSTRALIA;
                case ContinentEnum::AFRICA:
                    return self::OTHER_AFRICA;
            }
        }

        return self::OTHER;
    }


}
