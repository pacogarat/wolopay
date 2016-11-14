<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promocion
 *
 * @ORM\Table(name="promo_code_used_by_gamer")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PromoCodeUsedByGamerRepository")
 */
class PromoCodeUsedByGamer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gamer")
     * @ORM\JoinColumn(name="gamer_id", referencedColumnName="id")
     */
    private $gamer;

    /**
     * @var \AppBundle\Entity\PromoCode
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PromoCode")
     * @ORM\JoinColumn(name="promo_code_id", referencedColumnName="id", onDelete="cascade")
     */
    private $promoCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="used_at", type="datetime", nullable=false)
     */
    protected $usedAt;

    function __construct()
    {
        $this->usedAt = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gamer
     *
     * @param \AppBundle\Entity\Gamer $gamer
     * @return PromoCodeUsedByGamer
     */
    public function setGamer(\AppBundle\Entity\Gamer $gamer = null)
    {
        $this->gamer = $gamer;

        return $this;
    }

    /**
     * Get gamer
     *
     * @return \AppBundle\Entity\Gamer
     */
    public function getGamer()
    {
        return $this->gamer;
    }

    /**
     * Set promoCode
     *
     * @param \AppBundle\Entity\PromoCode $promoCode
     * @return PromoCodeUsedByGamer
     */
    public function setPromoCode(\AppBundle\Entity\PromoCode $promoCode = null)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return \AppBundle\Entity\PromoCode
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set usedAt
     *
     * @param \DateTime $usedAt
     * @return PromoCodeUsedByGamer
     */
    public function setUsedAt($usedAt)
    {
        $this->usedAt = $usedAt;

        return $this;
    }

    /**
     * Get usedAt
     *
     * @return \DateTime 
     */
    public function getUsedAt()
    {
        return $this->usedAt;
    }
}
