<?php
/**
 * Created by MGDSoftware. 10/09/2015
 */

namespace AppBundle\DataFixtures\Specific;


use AppBundle\Entity\Gamer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGamer  extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;
        $this->fillComponent('Demo', 'ttDvd1');
        $this->fillComponent('Demo', 'ttDvd2');
        $this->fillComponent('Demo', 'ttDvd3');
        $this->fillComponent('Demo', 'ttDvd4');
        $this->fillComponent('Demo', 'ttDvd5');
        $this->fillComponent('Demo', 'ttDvd6',false,true);
        $this->fillComponent('Demo', 'ttDvd7',false,true);
        $this->fillComponent('Demo', 'malo1', true);
        $this->fillComponent('Demo', 'malo2', true);
        $this->fillComponent('Demo', 'malo3', true);


    }

    private function fillComponent($appKey, $externalId,  $blacklisted=false, $forTesting=false){

        $obj = new Gamer($this->getReference('app-'.$appKey), $externalId);
        if ($blacklisted) $obj->setBlacklisted();
        if ($forTesting) $obj->setForTesting();

        $this->om->persist($obj);
        $this->om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 315; // the order in which fixtures will be loaded
    }

}