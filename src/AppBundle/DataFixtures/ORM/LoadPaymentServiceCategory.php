<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use AppBundle\Entity\PaymentServiceCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPaymentServiceCategory extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent(PaymentServiceCategoryEnum::PAYPAL_IPN_BASIC, 'Paypal Ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::PAYPAL_IPN_SUBSCRIPTION_BASIC, 'Paypal subscription');
        $this->fillComponent(PaymentServiceCategoryEnum::PAYSAFECARD_IPN, 'PaySafeCard');
        $this->fillComponent(PaymentServiceCategoryEnum::RIXTY_IPN, 'Rixty');
        $this->fillComponent(PaymentServiceCategoryEnum::UKASH_IPN, 'Ukash Ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::NVIA_SMS_IPN, 'Nvia SMS');
        $this->fillComponent(PaymentServiceCategoryEnum::NVIA_VOICE_IPN, 'Nvia Voice');
        $this->fillComponent(PaymentServiceCategoryEnum::NVIA_PROMO_CODE, 'Nvia promo code');
        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_IPN, 'Xsolla');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_VISA_MASTERCARD_IPN, 'Xsolla Credit card');
        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_SUBSCRIPTION_IPN, 'Xsolla Subscription');
        $this->fillComponent(PaymentServiceCategoryEnum::FORTUNO_IPN, 'Fortuno SMS');
        $this->fillComponent(PaymentServiceCategoryEnum::ADYEN_IPN, 'Adyen');
        $this->fillComponent(PaymentServiceCategoryEnum::ADYEN_SUBSCRIPTION_IPN, 'Adyen Subscription');
        $this->fillComponent(PaymentServiceCategoryEnum::NETELLER_IPN, 'Neteller ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::MOL_THAILAND_IPN, 'Mol Thailand');
        $this->fillComponent(PaymentServiceCategoryEnum::TEST_IPN, 'Test');
        $this->fillComponent(PaymentServiceCategoryEnum::G2A_IPN, 'G2A');
        $this->fillComponent(PaymentServiceCategoryEnum::PAYPAL_CREDIT_CARD_IPN, 'Paypal credit card hosted');
        $this->fillComponent(PaymentServiceCategoryEnum::CHERRY_CREDITS_IPN, 'Cherry credits ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::FACEBOOK_IPN, 'Facebook ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::FACEBOOK_SUBSCRIPTION_IPN, 'Facebook subscription ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::STEAM_WEB_IPN, 'Steam ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::BOA_COMPRA_IPN, 'Boa Compra ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::BOA_COMPRA_SUBSCRIPTION_IPN, 'Boa Compra Subscription ipn');
        $this->fillComponent(PaymentServiceCategoryEnum::TIGO_IPN, 'Tigo');

//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_DOTPAY_IPN, 'Xsolla dotpay');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_WEBMONEY_IPN, 'Xsolla web money');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_PAYBYME_IPN, 'Xsolla pay by me');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_MANGIR_KART_IPN, 'Xsolla Mangir kart');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_DURMALIRA_IPN, 'Xsolla durmalira');
//        $this->fillComponent(PaymentServiceCategoryEnum::XSOLLA_3PAY_IPN, 'Xsolla 3Pay');

    }

    private function fillComponent($id, $name)
    {
        $obj = new PaymentServiceCategory($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('payment_service_category-'.$id, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 50; // the order in which fixtures will be loaded
    }
} 