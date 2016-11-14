<?php


namespace AppBundle\Service\Promo\Rules;


use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use Monolog\Logger;

class PromoDateLeaf extends AbstractPromoRule
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
        $now = new \DateTime();

        /* PROMO */

        if (($promo->getBeginAt() != null) AND ($promo->getBeginAt()->getTimestamp() >=  $now->getTimestamp()))
            return false;

        if (($promo->getEndAt() != null) AND ($promo->getEndAt()->getTimestamp() <=  $now->getTimestamp()))
            return false;

        /* CODE */
        if ($promoCode->getBeginAt() != null AND $promoCode->getBeginAt()->getTimestamp() >=  $now->getTimestamp())
            return false;

        if ($promoCode->getEndAt() != null AND $promoCode->getEndAt()->getTimestamp() <=  $now->getTimestamp())
            return false;

        return true;
    }
}