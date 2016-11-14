<?php
/**
 * Created by MGDSoftware. 10/09/2015
 */

namespace AppBundle\DataFixtures\Specific;


use AppBundle\Entity\Affiliate;
use AppBundle\Entity\Gamer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAffiliate  extends AbstractFixture implements OrderedFixtureInterface {
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
        $this->fillComponent('Demo', 'afiliado1');
        $this->fillComponent('Demo', 'afiliado2');
        $this->fillComponent('Demo', 'afiliado3');
        $this->fillComponent('Demo', 'afiliado4');
        $this->fillComponent('Demo', 'afiliado5');
        $this->fillComponent('Demo', 'afiliado6');


    }

    private function fillComponent($appKey, $affiliateId, $pmp_id=null){

        $obj = new Affiliate($this->getReference('app-'.$appKey)->getClient(), $affiliateId);
    
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