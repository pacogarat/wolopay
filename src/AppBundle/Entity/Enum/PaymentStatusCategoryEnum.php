<?php

namespace AppBundle\Entity\Enum;

/**
 * Class StateCategoryEnum
 * @package AppBundle\Entity\Enum
 */
class PaymentStatusCategoryEnum
{
    const BEGIN_ID      = 1;
    const PROCESSING_ID = 5;
    const PENDING_ID    = 30;

    const COMPLETED_ID  = 200; // In subscriptions = subscription finished
    const SUBSCRIPTION_ACTIVE_ID   = 201;

    const CANCELED_ID   = 300; // Cancelled by us
    const REFUNDED_ID   = 302;

    const FAILED_ID     = 500;
    const BLOCKED_ID    = 501;




}
