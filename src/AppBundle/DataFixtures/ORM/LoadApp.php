<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\App;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\ClientUserHasApp;
use AppBundle\Entity\ClientUserHasApps;
use AppBundle\Entity\Enum\CommissionBaseEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Enum\RoleAdminEnum;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadApp extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use SonataMedia;

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
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;
        /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router */
        $router= $this->container->get('router');
        $mainDomain = $this->container->getParameter('domain_main');
        $date = new \DateTime('now');
        $paymentNotification = $mainDomain. $router->generate('payment_pg_notification_test');
        $blIPs = array( '193.219.96.100'=>array("createdAt"=>$date,"isRange"=>false, "isIPv6"=>false),
                        '193.219.96.0/24'=>array("createdAt"=>$date,"isRange"=>true, "isIPv6"=>false),
                        '0:0:0:0:0:ffff:c1db:6064'=>array("createdAt"=>$date,"isRange"=>false, "isIPv6"=>true),
                        '0:0:0:0:0:ffff:c1db:6064/24'=>array("createdAt"=>$date,"isRange"=>true, "isIPv6"=>true));

        $this->fillComponent('NviaDemo', 'Demo', 'logo_nvia.png', [

                PayMethodEnum::NETELLER_NAME.'-'.ProviderEnum::NETELLER_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::RIXTY_NAME.'-'.ProviderEnum::RIXTY_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::RIXTY_NAME.'-'.ProviderEnum::RIXTY_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::RUSSIA,

                PayMethodEnum::VISA_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::OTHER,
                PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::PAYSAFECARD_NAME.'-'.ProviderEnum::PAYSAFECARD_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::PAYSAFECARD_NAME.'-'.ProviderEnum::PAYSAFECARD_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::UKASH_NAME.'-'.ProviderEnum::UKASH_NAME.'-'.CountryEnum::USA,

                PayMethodEnum::SMS_NAME.'-'.ProviderEnum::NVIA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::VOICE_NAME.'-'.ProviderEnum::NVIA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::SMS_NAME.'-'.ProviderEnum::FORTUNO_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::PROMO_NAME.'-'.ProviderEnum::NVIA_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::OTHERS_NAME.'-'.ProviderEnum::XSOLLA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::VISA_NAME.'-'.ProviderEnum::XSOLLA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::VISA_NAME.'-'.ProviderEnum::ADYEN_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::VISA_SUBSCRIPTION_NAME.'-'.ProviderEnum::ADYEN_NAME.'-'.CountryEnum::USA,

                PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::OTHERS_SUBS_NAME.'-'.ProviderEnum::XSOLLA_NAME.'-'.CountryEnum::TURKEY,

                PayMethodEnum::CALL12_NAME.'-'.ProviderEnum::MOL_NAME.'-'.CountryEnum::USA,
                PayMethodEnum::TEST_NAME.'-'.ProviderEnum::NVIA_NAME.'-'.CountryEnum::USA,

                PayMethodEnum::G2A_NAME.'-'.ProviderEnum::G2A_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::CHERRY_CREDITS_NAME.'-'.ProviderEnum::CHERRY_CREDIT_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::STEAM_WEB_NAME.'-'.ProviderEnum::STEAM_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::BOA_COMPRA_NAME.'-'.ProviderEnum::BOA_COMPRA_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::BOA_COMPRA_SUBSCRIPTION_NAME.'-'.ProviderEnum::BOA_COMPRA_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::FACEBOOK_NAME.'-'.ProviderEnum::FACEBOOK_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::FACEBOOK_SUBSCRIPTION_NAME.'-'.ProviderEnum::FACEBOOK_NAME.'-'.CountryEnum::SPAIN,

                PayMethodEnum::TIGO_NAME.'-'.ProviderEnum::TIGO_NAME.'-'.CountryEnum::SPAIN,

            ],
            2.5, $paymentNotification, $paymentNotification, 'http://www.nviasms.com', null, '', true, ['mgarcia', 'dmorillo'],
            CommissionBaseEnum::WOLOPAYNET,0,0.1,CurrencyEnum::EURO,0.10,0,$blIPs
        );

        $this->fillComponent('Gallegos', 'GalleGame', 'gallegos.png', [
                PayMethodEnum::RIXTY_NAME.'-'.ProviderEnum::RIXTY_NAME.'-'.CountryEnum::SPAIN,
                PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-'.CountryEnum::SPAIN,
            ],
            10, $paymentNotification, $paymentNotification, '', null, '', true, ['mgarcia']
        );

    }

    private function fillComponent(
        $clientKey,
        $nameApp,
        $logoImg,
        array $payMethodsKey,
        $pgTaxPercent=2.5,
        $urlNotificationPayment = '',
        $urlNotificationSubscription = '',
        $urlHomeSite = '',
        $urlExtra = null,
        $urlLogo = '',
        $active = true,
        $clientUsersKeys = [],
        $commissionBase= CommissionBaseEnum::WOLOPAYNET,
        $commissionPercent=0,
        $commissionFixedFee=0.10,
        $commissionCurrency=CurrencyEnum::EURO,
        $commissionMax=0.10,
        $commissionMin=0,
        $arrBlacklistedIPs = []
    )
    {
        $obj = new App();

        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/app/'.$logoImg, App::SONATA_CONTEXT);

        $obj
            ->setClient($this->getReference('client-'.$clientKey))
            ->setName($nameApp)
            ->setTaxPercentApplicable($pgTaxPercent)
            ->setUrlNotificationPayment($urlNotificationPayment)
            ->setUrlNotificationSubscription($urlNotificationSubscription)
            ->setUrlHomeSite($urlHomeSite)
            ->setLogo($media)
            ->setActive($active)
            ->setUrlNotificationExtra($urlExtra)
            ->addCountry($this->getReference('country-'.CountryEnum::SPAIN))
            ->addCountry($this->getReference('country-'.CountryEnum::USA))
            ->addCountry($this->getReference('country-'.CountryEnum::OTHER_AUSTRALIA))
            ->addCountry($this->getReference('country-'.CountryEnum::OTHER_ASIA))
            ->addCountry($this->getReference('country-'.CountryEnum::OTHER))
            ->addCountry($this->getReference('country-'.CountryEnum::OTHER_NORTH_AMERICA))
            ->setCommissionBase($commissionBase)
            ->setCommissionPercent($commissionPercent)
            ->setCommissionFixedFee($commissionFixedFee)
            ->setCommissionCurrency($this->getReference('currency-'. $commissionCurrency))
            ->setCommissionMax($commissionMax)
            ->setCommissionMin($commissionMin)
            ->setHasVirtualCurrencyEnabled(true)
            ->setCanCustomizeAppTabs(true)
        ;


        $obj
            ->addLanguage($this->getReference('language-'.LanguageEnum::SPANISH))
            ->addLanguage($this->getReference('language-'.LanguageEnum::ENGLISH))
        ;

        $obj->addCountry($this->getReference('country-'.CountryEnum::OTHER));

        foreach ($payMethodsKey as $payMethod)
        {
            $obj->addAppHasPayMethodProviderCountry(
                new AppHasPayMethodProviderCountry($this->getReference('pay_method_provider_has_country-'.$payMethod), $obj)
            );
        }

        $obj->addBlacklistedIPsArray($arrBlacklistedIPs);


        $this->om->persist($obj);
        $this->om->flush();

        foreach ($clientUsersKeys as $clientUsersKey)
        {
            $obj->addClientUsersHasApp( new ClientUserHasApp($obj, $this->getReference('client_user-'.$clientUsersKey), $this->getReference('role_admin_category-'.RoleAdminEnum::OWNER)) );
        }

        $this->om->flush();

        $this->addReference('app-'.$nameApp, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200; // the order in which fixtures will be loaded
    }
} 