<?php


namespace AppBundle\Tests\Functional\Service\Promo\Rules;

use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use AppBundle\Service\Promo\Rules\PromoDateLeaf;
use AppBundle\Service\Promo\Rules\PromoNTotalUsesLeaf;
use Symfony\Component\HttpFoundation\Request;

class PromoNTotalUsesLeafTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PromoDateLeaf
     */
    private $promodateleaf;


    /**
     * @var Gamer
     */
    private $g;

    public function setUp()
    {
        $this->promodateleaf = new PromoNTotalUsesLeaf();

        $this->g = $this->getMockBuilder('\\AppBundle\\Entity\\Gamer')->disableOriginalConstructor()->getMock();
    }

    public function testBasicOk()
    {
        $promo = new Promo();
        $promo->setNTotalUses(1)->setCountNTimeUsed(0);
        $code = new PromoCode();
        $code->setNTotalUses(2)->setCountNTimeUsed(1);
        $promo->addPromoCode($code);

        $this->assertTrue($this->promodateleaf->isValid($promo, $code,$this->g));


    }

    public function testBasicKO1()
    {
        $promo = new Promo();
        $promo->setNTotalUses(1)->setCountNTimeUsed(1);
        $code = new PromoCode();
        $code->setNTotalUses(2)->setCountNTimeUsed(1);
        $promo->addPromoCode($code);

        $this->assertFalse($this->promodateleaf->isValid($promo, $code,$this->g));

    }

    public function testBasicKO2()
    {
        $promo = new Promo();
        $promo->setNTotalUses(2)->setCountNTimeUsed(1);
        $code = new PromoCode();
        $code->setNTotalUses(1)->setCountNTimeUsed(1);
        $promo->addPromoCode($code);

        $this->assertFalse($this->promodateleaf->isValid($promo, $code,$this->g));


    }

}