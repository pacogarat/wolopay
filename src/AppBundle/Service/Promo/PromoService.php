<?php


namespace AppBundle\Service\Promo;

use AppBundle\Entity\Gamer;
use AppBundle\Entity\PromoCode;
use AppBundle\Entity\PromoCodeUsedByGamer;
use AppBundle\Entity\SingleFreePayment;
use AppBundle\Service\Promo\Rules\PromoComposite;
use AppBundle\Service\Promo\Rules\PromoDateLeaf;
use AppBundle\Service\Promo\Rules\PromoNTotalUsesLeaf;
use AppBundle\Service\Promo\Rules\PromoValidForGamerLeaf;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\HttpKernel\Tests\Logger;


/**
 * @Service("app.shop.promo")
 */
class PromoService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /** @var   */
    private $rules;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    public function verifyIsAValidPromo(PromoCode $promoCode, Gamer $gamer=null)
    {
        $promoComposite = new PromoComposite($this->logger);

        $promoComposite->add(new PromoDateLeaf());
        $promoComposite->add(new PromoNTotalUsesLeaf());
        if ($gamer) $promoComposite->add(new PromoValidForGamerLeaf($this->em));

        return $promoComposite->isValid($promoCode->getPromo(), $promoCode, $gamer);
    }

    public function promoCodePurchaseCompleted(SingleFreePayment $paymentProcess, PromoCode $promoCode)
    {
        $promoUsedByGamer = new PromoCodeUsedByGamer();
        $promoUsedByGamer
            ->setGamer($paymentProcess->getPaymentDetail()->getTransaction()->getGamer())
            ->setPromoCode($promoCode)
        ;

        $this->em->persist($promoUsedByGamer);

        $promoCode->sumCountNTimeUsed(1);
        $promoCode->getPromo()->sumCountNTimeUsed(1);

        $paymentProcess->setPromoCode($promoCode);

        $this->em->flush();
    }

} 