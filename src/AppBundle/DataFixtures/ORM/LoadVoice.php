<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Voice;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadVoice extends AbstractFixture implements OrderedFixtureInterface
{
    const NUMBER_1 = '905400286';

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

        $this->fillComponent(29, self::NUMBER_1, PayMethodEnum::VOICE_NAME.'-'.ProviderEnum::NVIA_NAME.'-'. CountryEnum::SPAIN);

    }

    private function fillComponent($amount, $number, $pmpcKey, $callLegalDuration=3, $callMaxDuration=3)
    {
        $obj = new Voice();

        $obj
            ->setAmount($amount)
            ->setNumber($number)
            ->setPayMethodProviderHasCountry($this->getReference('pay_method_provider_has_country-'.$pmpcKey))
            ->setCallLegalDuration($callLegalDuration)
            ->setCallMaxDuration($callMaxDuration)
       ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('voice-'.$number, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200; // the order in which fixtures will be loaded
    }

} 