<?php

namespace AppBundle\Entity\Enum;

class PaymentServiceCategoryEnum
{
    const PAYPAL_IPN_BASIC              = 'shop.payment.paypal_ipn_pay_method';
    const PAYPAL_CREDIT_CARD_IPN        = 'shop.payment.paypal_credit_card_ipn_pay_method';
    const PAYPAL_IPN_SUBSCRIPTION_BASIC = 'shop.payment.paypal_ipn_subscription_pay_method';
    const BOA_COMPRA_IPN                = 'shop.payment.boa_compra_ipn_pay_method';
    const BOA_COMPRA_SUBSCRIPTION_IPN   = 'shop.payment.boa_compra_subscription_ipn_pay_method';
    const TIGO_IPN                      = 'shop.payment.tigo_ipn_pay_method';

    // Prepaid cards
    const PAYSAFECARD_IPN = 'shop.payment.paysafecard_ipn_pay_method';
    const RIXTY_IPN       = 'shop.payment.rixty_ipn_pay_method';
    const UKASH_IPN       = 'shop.payment.ukash_ipn_pay_method';

    // Nvia payments
    const NVIA_SMS_IPN    = 'shop.payment.nvia_sms_ipn_pay_method';
    const NVIA_VOICE_IPN  = 'shop.payment.nvia_voice_ipn_pay_method';
    const NVIA_PROMO_CODE = 'shop.payment.nvia_promo_code_pay_method';

    const FORTUNO_IPN    = 'shop.payment.fortuno_sms_ipn_pay_method';

    // Credit card

    // multiple
    const XSOLLA_IPN = 'shop.payment.xsolla_ipn_pay_method';
    const XSOLLA_SUBSCRIPTION_IPN = 'shop.payment.xsolla_subscription_ipn_pay_method';

    const ADYEN_IPN = 'shop.payment.adyen_ipn_pay_method';
    const ADYEN_SUBSCRIPTION_IPN = 'shop.payment.adyen_subscription_ipn_pay_method';

    const NETELLER_IPN = 'shop.payment.neteller_ipn_pay_method';
    const MOL_THAILAND_IPN = 'shop.payment.mol_thailand_ipn_pay_method';
    const TEST_IPN = 'shop.payment.test_ipn_pay_method';
    const G2A_IPN = 'shop.payment.g2a_ipn_pay_method';
    const CHERRY_CREDITS_IPN = 'shop.payment.cherry_credits_ipn_pay_method';
    const FACEBOOK_IPN = 'shop.payment.facebook_ipn_pay_method';
    const FACEBOOK_SUBSCRIPTION_IPN = 'shop.payment.facebook_subscription_ipn_pay_method';
    const STEAM_WEB_IPN = 'shop.payment.steam_web_ipn_pay_method';

    static public $PREFIXED_PRICE_PAYMETHODS = [self::NVIA_SMS_IPN, self::FORTUNO_IPN, self::NVIA_VOICE_IPN];
}
