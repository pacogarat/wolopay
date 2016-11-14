<?php

namespace AppBundle\Entity\Enum;

/**
 * Transaction States category, And Payment State category
 *
 * Class StateCategoryEnum
 * @package AppBundle\Entity\Enum
 */
final class TransactionStatusCategoryEnum
{
    const BEGIN_ID              = 1;
    const SHOPPING_ID           = 25;
    const PROCESSING_PAYMENT_ID = 50;

    const PENDING_PAYMENT_ID    = 100; // Payments without instant process
    const COMPLETED_ID          = 200;

    const FAILED_ID             = 500;
    const BLOCKED_ID            = 700;
    const BLACKLISTED_COUNTRY   = 800;
    const BLACKLISTED_GAMER     = 801;
    const BLACKLISTED_IP        = 802;

    const EXPIRED_ID            = 1000;

    static function getErrorsWithPersonalErrorMsg()
    {
        return [
            self::BLACKLISTED_COUNTRY,
            self::BLACKLISTED_GAMER,
            self::BLACKLISTED_IP,
        ];
    }

}
