<?php


namespace AppBundle\Service\Promo\Rules;


use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use Monolog\Logger;

class PromoNTotalUsesLeaf extends AbstractPromoRule
{
    /**
     * @param Promo $promo
     * @param PromoCode $promoCode
     * @param Gamer $gamer
     * @param Logger $logger
     * @return bool
     */
    public function isValid(Promo $promo, PromoCode $promoCode, Gamer $gamer=null, Logger $logger=null)
    {
        if ( ($promo->getNTotalUses() != null) AND ($promo->getNTotalUses() <= $promo->getCountNTimeUsed()))
            return false;


        if ($promoCode->getNTotalUses() != null AND $promoCode->getNTotalUses() <= $promoCode->getCountNTimeUsed())
            return false;

        return true;
    }

}