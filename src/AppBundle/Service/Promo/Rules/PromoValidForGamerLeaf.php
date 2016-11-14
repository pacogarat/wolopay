<?php


namespace AppBundle\Service\Promo\Rules;


use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

class PromoValidForGamerLeaf extends AbstractPromoRule
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Promo $promo
     * @param PromoCode $promoCode
     * @param Gamer $gamer
     * @param Logger $logger
     * @return bool
     */
    public function isValid(Promo $promo, PromoCode $promoCode, Gamer $gamer=null, Logger $logger=null)
    {
        if (!$promoCode->getGamers()->isEmpty())
        {
            if (!$promoCode->getGamers()->contains($gamer))
                return false;
        }

        if ( ($promoCode->getNUsesPerUser()=== null) && ($promo->getNUsesPerUser() === null))
            return true;



        if ($promoCode->getNUsesPerUser()>0 ){

            if (!$gamer) return false;  //as there's limit, gamer is mandatory

            $nUses =$this->em->getRepository("AppBundle:PromoCodeUsedByGamer")
                ->countCodeUsesByGamer($promoCode->getId(), $gamer->getId());


            ($logger)?$logger->addDebug('Promo ' .$promo->getId(). ',Code: '. $promoCode->getCode().' Gamer: ' .$gamer->getGamerExternalId(). ', codeUsedByGamer ' . $nUses. ' times.'):null;

            if ($nUses >= $promoCode->getNUsesPerUser())
                return false;
        }

        if ($promo->getNUsesPerUser()>0){
            if (!$gamer) return false;

            $nAllUses = $this->em->getRepository("AppBundle:PromoCodeUsedByGamer")
                ->countCodesUsesByPromoAndGamer($promo->getId(), $gamer->getId());

            ($logger)?$logger->addDebug('Promo ' .$promo->getId(). ',Code: '. $promoCode->getCode().' Gamer: ' .$gamer->getGamerExternalId(). ', promoUsedByGamer: ' . $nAllUses . ' times.'):null;

            if ($nAllUses >= $promo->getNUsesPerUser())
                return false;
        }

        return true;
    }
}