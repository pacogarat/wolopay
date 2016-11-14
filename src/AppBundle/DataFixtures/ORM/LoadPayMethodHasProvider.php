<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\ExternalStoreEnum;
use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\PayMethodHasProvider;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadPayMethodHasProvider extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent(PayMethodEnum::RIXTY_NAME,  ProviderEnum::RIXTY_NAME, PaymentServiceCategoryEnum::RIXTY_IPN, 25, 0, 0);
        $this->fillComponent(PayMethodEnum::VISA_NAME, ProviderEnum::PAYPAL_NAME, PaymentServiceCategoryEnum::PAYPAL_CREDIT_CARD_IPN, 3, 0, 0, true, false);
        $this->fillComponent(PayMethodEnum::PAYPAL_SINGLE_NAME, ProviderEnum::PAYPAL_NAME, PaymentServiceCategoryEnum::PAYPAL_IPN_BASIC, 3, 0, 0, 0 ,false);
        $this->fillComponent(PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME, ProviderEnum::PAYPAL_NAME, PaymentServiceCategoryEnum::PAYPAL_IPN_SUBSCRIPTION_BASIC, 3, 0, 0, false);
        $this->fillComponent(PayMethodEnum::PAYSAFECARD_NAME, ProviderEnum::PAYSAFECARD_NAME, PaymentServiceCategoryEnum::PAYSAFECARD_IPN, 11, 0, 0);
        $this->fillComponent(PayMethodEnum::UKASH_NAME, ProviderEnum::UKASH_NAME, PaymentServiceCategoryEnum::UKASH_IPN, 20, 0, 0);
        $this->fillComponent(PayMethodEnum::SMS_NAME, ProviderEnum::NVIA_NAME, PaymentServiceCategoryEnum::NVIA_SMS_IPN, 60, 0, 0, 9, true, false, null, [], true);
        $this->fillComponent(PayMethodEnum::VOICE_NAME, ProviderEnum::NVIA_NAME, PaymentServiceCategoryEnum::NVIA_VOICE_IPN, 60, 0, 0, 9, true, false, null, [], true);
        $this->fillComponent(PayMethodEnum::PROMO_NAME, ProviderEnum::NVIA_NAME, PaymentServiceCategoryEnum::NVIA_PROMO_CODE, 100, 0, 0, 9, false, true, null, [], true); // 100% product is free!
        $this->fillComponent(PayMethodEnum::OTHERS_NAME, ProviderEnum::XSOLLA_NAME, PaymentServiceCategoryEnum::XSOLLA_IPN, 15, 0, 0, true);
        $this->fillComponent(PayMethodEnum::VISA_NAME, ProviderEnum::XSOLLA_NAME, PaymentServiceCategoryEnum::XSOLLA_IPN, 15, 0, 0, 9, true, false, null, ['external_provider_id' => 26]);
        $this->fillComponent(PayMethodEnum::VISA_NAME, ProviderEnum::ADYEN_NAME, PaymentServiceCategoryEnum::ADYEN_IPN, 15, 0);
        $this->fillComponent(PayMethodEnum::VISA_SUBSCRIPTION_NAME, ProviderEnum::ADYEN_NAME, PaymentServiceCategoryEnum::ADYEN_SUBSCRIPTION_IPN,  15, 0, 0, 9, true, false, null, [], false, true, true);
        $this->fillComponent(PayMethodEnum::OTHERS_SUBS_NAME, ProviderEnum::XSOLLA_NAME, PaymentServiceCategoryEnum::XSOLLA_SUBSCRIPTION_IPN, 15, 0, 0, 9,true);
        $this->fillComponent(PayMethodEnum::SMS_NAME, ProviderEnum::FORTUNO_NAME, PaymentServiceCategoryEnum::FORTUNO_IPN, 0, 0, 0, 9, true, false, null, [], true);
//        $this->fillComponent('3pay.png', PayCategoryEnum::MOBILE_ID.'-'.TabCategoryEnum::SINGLE_PAYMENT_ID, ProviderEnum::XSOLLA_NAME, PaymentServiceCategoryEnum::XSOLLA_3PAY_IPN, 25, 0, 0, true, false, '3 Pay');
        $this->fillComponent(PayMethodEnum::WEBMONEY_NAME, ProviderEnum::XSOLLA_NAME, PaymentServiceCategoryEnum::XSOLLA_IPN, 25, 0, 0, 9, true, false, 'Web Money', ['external_provider_id' => 6]);
        $this->fillComponent(PayMethodEnum::NETELLER_NAME, ProviderEnum::NETELLER_NAME, PaymentServiceCategoryEnum::NETELLER_IPN, 1, 0, 0, false);
        $this->fillComponent(PayMethodEnum::CALL12_NAME, ProviderEnum::MOL_NAME, PaymentServiceCategoryEnum::MOL_THAILAND_IPN, 5, 0, 0, 9, true, false, null, ['external_provider_id' => '12call']);
        $this->fillComponent(PayMethodEnum::TEST_NAME, ProviderEnum::NVIA_NAME, PaymentServiceCategoryEnum::TEST_IPN, 5, 0);
        $this->fillComponent(PayMethodEnum::VIRTUAL_CURRENCY_NAME, ProviderEnum::NVIA_NAME, PaymentServiceCategoryEnum::TEST_IPN, 5, 0);
        $this->fillComponent(PayMethodEnum::G2A_NAME, ProviderEnum::G2A_NAME, PaymentServiceCategoryEnum::G2A_IPN, 5, 0, 0, 99, false);
        $this->fillComponent(PayMethodEnum::CHERRY_CREDITS_NAME, ProviderEnum::CHERRY_CREDIT_NAME, PaymentServiceCategoryEnum::CHERRY_CREDITS_IPN, 5, 0, 0, 99, false);
        $this->fillComponent(PayMethodEnum::FACEBOOK_NAME, ProviderEnum::FACEBOOK_NAME, PaymentServiceCategoryEnum::FACEBOOK_IPN, 5, 0, 0, 99, false, false, null, [], false, true, false, ExternalStoreEnum::FACEBOOK);
        $this->fillComponent(PayMethodEnum::FACEBOOK_SUBSCRIPTION_NAME, ProviderEnum::FACEBOOK_NAME, PaymentServiceCategoryEnum::FACEBOOK_SUBSCRIPTION_IPN, 5, 0, 0, 99, false);
        $this->fillComponent(PayMethodEnum::STEAM_WEB_NAME, ProviderEnum::STEAM_NAME, PaymentServiceCategoryEnum::STEAM_WEB_IPN, 5, 0, 0, 99, false);
        $this->fillComponent(PayMethodEnum::BOA_COMPRA_NAME, ProviderEnum::BOA_COMPRA_NAME, PaymentServiceCategoryEnum::BOA_COMPRA_IPN, 5, 0, 0, false);
        $this->fillComponent(PayMethodEnum::BOA_COMPRA_SUBSCRIPTION_NAME, ProviderEnum::BOA_COMPRA_NAME, PaymentServiceCategoryEnum::BOA_COMPRA_SUBSCRIPTION_IPN, 5, 0, 0, false);
        $this->fillComponent(PayMethodEnum::TIGO_NAME, ProviderEnum::TIGO_NAME, PaymentServiceCategoryEnum::TIGO_IPN, 5, 0, 0, false, false);

    }

    private function fillComponent($payMethodKey, $providerName, $serviceId, $feePercent, $feeMinimal, $feeExtraEachPayment=0, $order=9,
        $isIframe=true, $isAjax=false, $name= null, $extraOptions = [], $ourImplementation=false, $canBeCustomTransaction=true, $needMakeRequestPayment = false, $externalStore= null )
    {
        $obj = new PayMethodHasProvider();

        $obj
            ->setIsIframe($isIframe)
            ->setIsAjax($isAjax)
            ->setPayMethod($this->getReference('pay_method-'.$payMethodKey))
            ->setProvider($this->getReference('provider-'.$providerName))
            ->setFeeProviderPercent($feePercent)
            ->setFeeProviderMinimal($feeMinimal)
            ->setFeeProviderFixed($feeExtraEachPayment)
            ->setFeeCurrency($this->getReference('currency-' . CurrencyEnum::EURO))
            ->setPaymentServiceCategory($this->getReference('payment_service_category-'.$serviceId))
            ->setName($name)
            ->setOrder(9)
            ->setExtraOptions($extraOptions)
            ->setIsOurImplementation($ourImplementation)
            ->setCanBeCustomTransaction($canBeCustomTransaction)
            ->setNeedMakeRequestPayment($needMakeRequestPayment)
            ->setExternalStore($externalStore)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('pay_method_has_provider-'.$payMethodKey.'-'.$providerName, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 140; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 