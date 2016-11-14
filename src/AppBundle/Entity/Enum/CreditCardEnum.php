<?php

namespace AppBundle\Entity\Enum;

class CreditCardEnum
{
    const VISA        = 'Visa';
    const MASTER_CARD = 'MasterCard';
    const DISCOVER    = 'Discover';
    const AMEX        = 'Amex';
    const MAESTRO     = 'Maestro';

    public static function getAll()
    {
        return [self::VISA, self::MASTER_CARD, self::DISCOVER, self::AMEX, self::MAESTRO ];
    }
}
