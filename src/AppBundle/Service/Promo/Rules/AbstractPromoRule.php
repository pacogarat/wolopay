<?php


namespace AppBundle\Service\Promo\Rules;


use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use Monolog\Logger;

abstract class AbstractPromoRule
{
//    /**
//     * @param AbstractPromoRule $c
//     * @return mixed
//     */
//    abstract public function add(AbstractPromoRule $c);
//
//    /**
//     * @param AbstractPromoRule $c
//     * @return mixed
//     */
//    abstract public function remove(AbstractPromoRule $c);

    /**
     * @param Promo $promo
     * @param PromoCode $promoCode
     * @param Gamer $gamer
     * @param Logger $logger
     * @return mixed
     */
    abstract public function isValid(Promo $promo, PromoCode $promoCode, Gamer $gamer=null, Logger $logger=null);

} 