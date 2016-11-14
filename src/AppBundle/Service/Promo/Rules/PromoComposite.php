<?php


namespace AppBundle\Service\Promo\Rules;


use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use Monolog\Logger;

class PromoComposite extends AbstractPromoRule
{
    /** @var AbstractPromoRule[] */
    private $childs;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->childs = new \SplObjectStorage();
        $this->logger = $logger;
    }

    /**
     * @param AbstractPromoRule $c
     * @return mixed
     */
    public function add(AbstractPromoRule $c)
    {
        $this->childs->attach($c);
    }

    /**
     * @param AbstractPromoRule $c
     * @return mixed
     */
    public function remove(AbstractPromoRule $c)
    {
        $this->childs->detach($c);
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
        foreach ($this->childs as $child)
        {
            if ($child->isValid($promo, $promoCode, $gamer, $logger) === false)
            {
                if ($logger) $logger->addDebug('Promo verify: '.get_class($child).' [FAIL]');
                return false;
            }

            if ($logger) $logger->addDebug('Promo verify (promo='.$promo->getId().' ; code='. $promoCode->getCode().' ; gamer='.$gamer->getId().') : '.get_class($child).' [PASS]');
        }

        return true;
    }
}