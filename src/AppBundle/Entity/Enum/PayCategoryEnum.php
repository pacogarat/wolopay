<?php

namespace AppBundle\Entity\Enum;

/**
 * the class PayCategory is information does not affect the logic
 */
class PayCategoryEnum
{
    const CREDIT_CARD_ID     = 'credit_card';
    const PREPAID_CARD_ID    = 'prepaid_card';
    const PROVIDER_METHOD_ID = 'provider_method';
    const MOBILE_ID          = 'mobile';
    const VOICE_ID           = 'voice';
    const PROMO_CODE_ID      = 'promo_code';
    const CASH_ID            = 'cash';
    const BANK_TRANSFER_ID   = 'bank_transfer';

    const EXTERNAL_STORES_ID = 'external_stores';
} 