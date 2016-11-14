<?php

namespace AppBundle\Entity\Enum;

class RoleAdminEnum
{

    const OWNER      = 'ROLE_OWNER';
    const SUPPORT    = 'ROLE_SUPPORT';
    const CONFIG     = 'ROLE_CONFIGURE';
    const MARKETING  = 'ROLE_MARKETING';
    const ACCOUNTING = 'ROLE_ACCOUNTING';

    const DEVELOPER          = 'ROLE_DEVELOPER';
    const DEMO_GENERAL       = 'ROLE_DEMO_GENERAL';

    static function getAll()
    {
        return [self::OWNER, self::SUPPORT, self::MARKETING, self::ACCOUNTING, self::DEVELOPER];
    }

}
