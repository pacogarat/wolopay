<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Client;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\WoloPackEnum;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadClient extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $this->fillComponent('Wolopay', 'C127386', CountryEnum::SPAIN, 'wolopay.png', false);
        $this->fillComponent('NviaDemo', 'CICICICIF', CountryEnum::SPAIN, 'idc.png', true);
        $this->fillComponent('Gallegos', 'Clicli', CountryEnum::SPAIN, 'idc.png', true);

    }

    private function fillComponent($companyName, $cif, $countryKey, $logoImg, $active)
    {
        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/client/'.$logoImg, Client::SONATA_CONTEXT);

        $obj = new Client();

        $obj
            ->setCountry($this->getReference('country-'.$countryKey))
            ->setAddress('c/ Pasamar 1-3')
            ->setActive($active)
            ->setLogo($media)
            ->setWoloPack($this->getReference('wolo_pack-'.WoloPackEnum::STANDARD_ID))
            ->setPostalCode(28230)
            ->setFinanceEmail('mgarcia@nviasms.com')
            ->setCurrencyEarnings($this->getReference('currency-'.CurrencyEnum::EURO))
            ->setOnCreateAppActiveByDefault(true)
            ->setCif($cif)
            ->setVatNumber($countryKey.$cif)
            ->setNameCompany($companyName);

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('client-'.$companyName, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 80; // the order in which fixtures will be loaded
    }
} 