<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\SMSOperator;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSMSOperator extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $this->fillComponent('Vodafone', 'VO', CountryEnum::SPAIN, 'vodafone.png');
        $this->fillComponent('Orange', 'AM', CountryEnum::SPAIN, 'orange.png' );
        $this->fillComponent('Yoigo', 'YO', CountryEnum::SPAIN, 'yoigo.png');
        $this->fillComponent('Movistar', 'MO', CountryEnum::SPAIN, 'movistar.png');
    }

    private function fillComponent($name, $shortName, $countryKey, $img)
    {
        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/sms_operator/'.$img, SMSOperator::SONATA_CONTEXT);

        $obj = new SMSOperator();

        $obj
            ->setName($name)
            ->setShortName($shortName)
            ->setCountry($this->getReference('country-'.$countryKey))
            ->setImgIcon($media)
       ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('sms_operator-'.$shortName.'-'.$countryKey, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

} 