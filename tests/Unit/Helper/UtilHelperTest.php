<?php
namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use AppBundle\Helper\UtilHelper;

class UtilHelperTest  extends \PHPUnit_Framework_TestCase
{

    public function testPrettyPriceDontCrash()
    {
        UtilHelper::prettyPrice(999999999.66666666666666666666);
        UtilHelper::prettyPrice(999999999.66666666666666666666, 555, 999.9);
        UtilHelper::prettyPrice(555555555555555555555555555.6666666666666);
        UtilHelper::prettyPrice(222.33);
    }

    public function testPrettyPriceVerifyData()
    {
        // <1 => round(x,2)
        $this->assertEquals(0.23, UtilHelper::prettyPrice(0.23));
        // >1 && <=10 =>( si termina en .00 ó 0.95 o .99, dejarlo como esta)
        // round al multiplo de 0.05 mas cercano; si al redondear termina en cero, hacer q termine en el .95 mas cercano


        $this->assertEquals(4.00, UtilHelper::prettyPrice(4.00));
        $this->assertEquals(3.95, UtilHelper::prettyPrice(4.02));
        $this->assertEquals(4.05, UtilHelper::prettyPrice(4.03));
        $this->assertEquals(4.05, UtilHelper::prettyPrice(4.06));
        $this->assertEquals(4.10, UtilHelper::prettyPrice(4.08));
        $this->assertEquals(4.10, UtilHelper::prettyPrice(4.12));
        $this->assertEquals(4.15, UtilHelper::prettyPrice(4.13));
        $this->assertEquals(4.15, UtilHelper::prettyPrice(4.16));
        $this->assertEquals(4.20, UtilHelper::prettyPrice(4.18));
        $this->assertEquals(4.40, UtilHelper::prettyPrice(4.42));
        $this->assertEquals(4.45, UtilHelper::prettyPrice(4.43));
        $this->assertEquals(4.45, UtilHelper::prettyPrice(4.46));
        $this->assertEquals(4.50, UtilHelper::prettyPrice(4.48));
        $this->assertEquals(4.50, UtilHelper::prettyPrice(4.52));
        $this->assertEquals(4.55, UtilHelper::prettyPrice(4.53));
        $this->assertEquals(4.55, UtilHelper::prettyPrice(4.56));
        $this->assertEquals(4.60, UtilHelper::prettyPrice(4.58));
        $this->assertEquals(4.95, UtilHelper::prettyPrice(4.95));
        $this->assertEquals(4.95, UtilHelper::prettyPrice(4.96));
        $this->assertEquals(4.95, UtilHelper::prettyPrice(4.97));
        $this->assertEquals(4.95, UtilHelper::prettyPrice(4.98));
        $this->assertEquals(4.99, UtilHelper::prettyPrice(4.99));
        $this->assertEquals(5, UtilHelper::prettyPrice(5));

        // >=10 && <=25 => si termina en .00 ó 0.95 o .99, dejarlo como esta
        // round al multiplo de 0.25 mas cercano. si al redondear termina en cero, hacer q termine en el .95 mas cercano
        $this->assertEquals(18.95, UtilHelper::prettyPrice(19.06));
        $this->assertEquals(18.95, UtilHelper::prettyPrice(19.12));
        $this->assertEquals(19.25, UtilHelper::prettyPrice(19.16));
        $this->assertEquals(19.25, UtilHelper::prettyPrice(19.26));
        $this->assertEquals(19.25, UtilHelper::prettyPrice(19.36));
        $this->assertEquals(19.50, UtilHelper::prettyPrice(19.38));
        $this->assertEquals(19.50, UtilHelper::prettyPrice(19.46));
        $this->assertEquals(19.50, UtilHelper::prettyPrice(19.56));
        $this->assertEquals(19.75, UtilHelper::prettyPrice(19.66));
        $this->assertEquals(19.75, UtilHelper::prettyPrice(19.76));
        $this->assertEquals(19.75, UtilHelper::prettyPrice(19.86));
        $this->assertEquals(19.95, UtilHelper::prettyPrice(19.88));
        $this->assertEquals(19.95, UtilHelper::prettyPrice(19.90));
        $this->assertEquals(19.95, UtilHelper::prettyPrice(19.95));
        $this->assertEquals(19.99, UtilHelper::prettyPrice(19.99));

        $this->assertEquals(25, UtilHelper::prettyPrice(25));
        // >25 && <=300 => si termina en .00 ó 0.95 o .99, dejarlo como esta)
        // round multiplo 0.95 o mas cercano. si al redondear termina en cero, hacer q termine en el .95 mas cercano

        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.06));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.12));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.16));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.26));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.36));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.38));
        $this->assertEquals(28.95, UtilHelper::prettyPrice(29.46));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.56));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.66));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.76));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.86));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.88));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.90));
        $this->assertEquals(29.95, UtilHelper::prettyPrice(29.95));
        $this->assertEquals(29.99, UtilHelper::prettyPrice(29.99));


        $this->assertEquals(79.95, UtilHelper::prettyPrice(79.96));
        $this->assertEquals(132.99, UtilHelper::prettyPrice(132.99));
        $this->assertEquals(99.95, UtilHelper::prettyPrice(99.95));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(200.16));
        $this->assertEquals(299, UtilHelper::prettyPrice(299));

        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.06));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.12));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.16));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.26));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.36));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.38));
        $this->assertEquals(198.95, UtilHelper::prettyPrice(199.46));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.56));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.66));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.76));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.86));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.88));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.90));
        $this->assertEquals(199.95, UtilHelper::prettyPrice(199.95));
        $this->assertEquals(199.99, UtilHelper::prettyPrice(199.99));

        // >300 => roundToInt (funcion de Victor y paula; redondea al multiplo de 5 mas cercano)
        $this->assertEquals(720, UtilHelper::prettyPrice(721.555));
        $this->assertEquals(725, UtilHelper::prettyPrice(722.555));
        $this->assertEquals(1055, UtilHelper::prettyPrice(1055.55555555555555));


        //Con decimales
        $this->assertEquals(5.0000, UtilHelper::prettyPrice(5, 4));
        $this->assertEquals(4.5000, UtilHelper::prettyPrice(4.5, 4));
        $this->assertEquals(100, UtilHelper::prettyPrice(99.95,0));
        $this->assertEquals(199.9500, UtilHelper::prettyPrice(199.76,4));


    }

} 