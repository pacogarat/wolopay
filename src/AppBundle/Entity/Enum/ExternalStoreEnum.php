<?php

namespace AppBundle\Entity\Enum;

class ExternalStoreEnum
{
    const FACEBOOK       = 'facebook';
    const STEAM          = 'steam';
    const STEAM_WEB      = 'steam_web';

    static $ALL_AVAILABLE = [self::FACEBOOK, self::STEAM, self::STEAM_WEB];
}
