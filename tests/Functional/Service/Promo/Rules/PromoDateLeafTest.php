<?php


namespace AppBundle\Tests\Functional\Service\Promo\Rules;

use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use AppBundle\Service\Promo\Rules\PromoDateLeaf;
use Symfony\Component\HttpFoundation\Request;

class PromoDateLeafTest  extends \PHPUnit_Framework_TestCase
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
        $this->promodateleaf = new PromoDateLeaf();

        $this->g = $this->getMockBuilder('\\AppBundle\\Entity\\Gamer')->disableOriginalConstructor()->getMock();
    }

    public function testBasicOk()
    {
        $promo = new Promo();
        $promo->setBeginAt(new \DateTime('-1 DAY'))->setEndAt(new \DateTime('+ 1 DAY'));
        $code = new PromoCode();
        $code->setBeginAt(new \DateTime('-1 DAY'))->setEndAt(new \DateTime('+ 1 DAY'));
        $promo->addPromoCode($code);

        $this->assertTrue($this->promodateleaf->isValid($promo, $code,$this->g));


    }

    public function testBasicKO1()
    {
        $promo = new Promo();
        $promo->setBeginAt(new \DateTime('-2 DAY'))->setEndAt(new \DateTime('-1 DAY'));
        $code = new PromoCode();
        $code->setBeginAt(new \DateTime('-2 DAY'))->setEndAt(new \DateTime('+1 DAY'));
        $promo->addPromoCode($code);

        $this->assertFalse($this->promodateleaf->isValid($promo, $code,$this->g));

    }

    public function testBasicKO2()
    {
        $promo = new Promo();
        $promo->setBeginAt(new \DateTime('-2 DAY'))->setEndAt(new \DateTime('+1 DAY'));
        $code = new PromoCode();
        $code->setBeginAt(new \DateTime('-2 DAY'))->setEndAt(new \DateTime('-1 DAY'));
        $promo->addPromoCode($code);

        $this->assertFalse($this->promodateleaf->isValid($promo, $code,$this->g));

    }

}