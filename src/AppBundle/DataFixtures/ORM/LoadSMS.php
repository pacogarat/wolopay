<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Enum\SMSLogicCategoryEnum;
use AppBundle\Entity\SMS;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSMS extends AbstractFixture implements OrderedFixtureInterface
{
    const SHORT_NUMBER_1='7755';
    const SHORT_NUMBER_2='7754';
    const SHORT_NUMBER_3='7753';

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

        $this->fillComponent(5.3, self::SHORT_NUMBER_1, SMSLogicCategoryEnum::MO_AND_MT_AND_CODE, 'YO-'.CountryEnum::SPAIN, PayMethodEnum::SMS_NAME.'-'.ProviderEnum::NVIA_NAME.'-'. CountryEnum::SPAIN);
        $this->fillComponent(5.8, self::SHORT_NUMBER_2, SMSLogicCategoryEnum::MO_AND_MT_AND_CODE, 'VO-'.CountryEnum::SPAIN, PayMethodEnum::SMS_NAME.'-'.ProviderEnum::NVIA_NAME.'-'. CountryEnum::SPAIN);
        $this->fillComponent(2, self::SHORT_NUMBER_3, SMSLogicCategoryEnum::MO_AND_MT_AND_CODE, 'MO-'.CountryEnum::SPAIN, PayMethodEnum::SMS_NAME.'-'.ProviderEnum::FORTUNO_NAME.'-'. CountryEnum::SPAIN);

    }

    private function fillComponent($amount, $shortNumber, $logicCategoryId, $smsOperatorKey, $pmpcKey, $mobileSingUp='sms.mobile_text_sing_up.write_pin', $legalText='sms.legal_text.standard')
    {
        $obj = new SMS();

        $obj
            ->setAmount($amount)
            ->setShortNumber($shortNumber)
            ->setSmsLogicCategory($this->getReference('sms_logic_category-'.$logicCategoryId))
            ->setOperator($this->getReference('sms_operator-'.$smsOperatorKey))
            ->setPayMethodProviderHasCountry($this->getReference('pay_method_provider_has_country-'.$pmpcKey))
            ->setMobileTextSingUpLabel($this->getReference('translation-'.$mobileSingUp))
            ->setLegalTextLabel($this->getReference('translation-'.$legalText))
       ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('sms-'.$shortNumber, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200; // the order in which fixtures will be loaded
    }

} 