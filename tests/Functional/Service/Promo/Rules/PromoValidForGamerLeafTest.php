<?php


namespace AppBundle\Tests\Functional\Service\Promo\Rules;

use AppBundle\Entity\Gamer;
use AppBundle\Entity\PromoCodeUsedByGamer;
use AppBundle\Service\Promo\Rules\PromoValidForGamerLeaf;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Request;

class PromoValidForGamerLeafTest extends FunctionalTestCase
{
    /**
     * @var PromoValidForGamerLeaf
     */
    private $pv;

    /**
     * @var Gamer
     */
    private $g;

    public function setUp()
    {

        parent::setUp();
        $this->loadAllFixtures();
        $this->pv = new PromoValidForGamerLeaf($this->em);
        $this->g = new Gamer($this->getApp(),'ttDvd');
        $this->em->persist($this->g);
        $this->em->flush();
    }

    public function testBasicOk()
    {
        $promo = $this->em->getRepository("AppBundle:Promo")->findAll()[0];
        $promo->setNTotalUses(1);


        $this->em->flush();


        $this->assertTrue($this->pv->isValid($promo, $promo->getPromoCodes()[0],$this->g));

        $pc = new PromoCodeUsedByGamer();
        $pc->setGamer($this->g)->setPromoCode($promo->getPromoCodes()[0]);
        $this->em->persist($pc);
        $this->em->flush();

        $this->assertFalse($this->pv->isValid($promo, $promo->getPromoCodes()[0],$this->g));
    }


}