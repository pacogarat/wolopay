<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\PayMethod;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadPayMethod extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent(PayCategoryEnum::PREPAID_CARD_ID,ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::UKASH_NAME,'ukash.png');
        $this->fillComponent(PayCategoryEnum::PREPAID_CARD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::PAYSAFECARD_NAME,'paysafecard.png');
        $this->fillComponent(PayCategoryEnum::PREPAID_CARD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::RIXTY_NAME, 'rixty.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::OTHERS_NAME, 'others.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, PayMethodEnum::OTHERS_SUBS_NAME, 'others.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::PAYPAL_SINGLE_NAME, 'paypal.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, PayMethodEnum::PAYPAL_SUBSCRIPTION_NAME, 'paypal.png');
        $this->fillComponent(PayCategoryEnum::MOBILE_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::SMS_NAME, 'sms.png');
        $this->fillComponent(PayCategoryEnum::VOICE_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::VOICE_NAME, 'phone.png');
        $this->fillComponent(PayCategoryEnum::PROMO_CODE_ID,  ArticleCategoryEnum::FREE_PAYMENT_ID, PayMethodEnum::PROMO_NAME, 'promo_code.png');
        $this->fillComponent(PayCategoryEnum::CREDIT_CARD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::VISA_NAME, 'credit.png');
        $this->fillComponent(PayCategoryEnum::CREDIT_CARD_ID,  ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, PayMethodEnum::VISA_SUBSCRIPTION_NAME, 'credit.png');
        $this->fillComponent(PayCategoryEnum::CREDIT_CARD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::WEBMONEY_NAME, 'webmoney.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::NETELLER_NAME, 'neteller.png');
        $this->fillComponent(PayCategoryEnum::PREPAID_CARD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::CALL12_NAME, '12_call.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::TEST_NAME, 'test.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::VIRTUAL_CURRENCY_NAME, 'test.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::G2A_NAME, 'g2a.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::CHERRY_CREDITS_NAME, 'cherry_credits.png');
        $this->fillComponent(PayCategoryEnum::EXTERNAL_STORES_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::FACEBOOK_NAME, 'facebook.png');
        $this->fillComponent(PayCategoryEnum::EXTERNAL_STORES_ID,  ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, PayMethodEnum::FACEBOOK_SUBSCRIPTION_NAME, 'facebook.png');
        $this->fillComponent(PayCategoryEnum::EXTERNAL_STORES_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::STEAM_WEB_NAME, 'steam.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::BOA_COMPRA_NAME, 'boacompra.png');
        $this->fillComponent(PayCategoryEnum::PROVIDER_METHOD_ID,  ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, PayMethodEnum::BOA_COMPRA_SUBSCRIPTION_NAME, 'boacompra.png');
        $this->fillComponent(PayCategoryEnum::MOBILE_ID,  ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::TIGO_NAME, 'tigo-money.jpg');


    }

    private function fillComponent($payId, $articleCategoryId, $name, $img)
    {
        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/'.$img, PayMethod::SONATA_CONTEXT);

        $obj = new PayMethod();

        $obj
            ->setArticleCategory($this->getReference('article_category-'.$articleCategoryId))
            ->setPayCategory($this->getReference('pay_category-'.$payId))
            ->setName($name)
            ->setImgIcon($media)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('pay_method-'.$name, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 120; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 