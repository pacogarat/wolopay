<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @ORM\Table(name="single_free_payment")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SinglePaymentRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("single_free_payment")
 */
class SingleFreePayment extends SinglePayment
{
    const PREFIX = 'SINFREEPAY_';

    /**
     * @var \AppBundle\Entity\PromoCode
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PromoCode")
     * @ORM\JoinColumn(name="promo_code_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $promoCode;

    public function getType()
    {
        return 'single_free_payment';
    }

    /**
     * @param \AppBundle\Entity\PromoCode $promoCode
     * @return $this
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\PromoCode
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }


}
