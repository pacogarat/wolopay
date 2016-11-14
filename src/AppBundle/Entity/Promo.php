<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Promocion
 *
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PromoRepository")
 * @XmlRoot("promo")
 * @ExclusionPolicy("all")
 */
class Promo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $name;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var \AppBundle\Entity\PromoType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PromoType")
     * @ORM\JoinColumn(name="promo_type_id", referencedColumnName="id", nullable=true)
     */
    private $promoType;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_uses_per_user", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "PromoFull"})
     */
    private $nUsesPerUser=1;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_total_uses", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "PromoFull"})
     */
    private $nTotalUses;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_n_time_used", type="integer", nullable=false)
     * @Expose()
     * @Groups({"PromoFull"})
     */
    private $countNTimeUsed=0;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PromoCode", mappedBy="promo", cascade={"persist"}, orphanRemoval=true)
     * @Valid()
     * @Expose()
     * @Groups({"PromoFull"})
     */
    private $promoCodes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "PromoFull"})
     */
    private $beginAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "PromoFull"})
     */
    private $endAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"PromoFull"})
     */
    protected $createdAt;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');

        $this->promoCodes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Promo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return Promo
     */
    public function setApp(\AppBundle\Entity\App $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return \AppBundle\Entity\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Add promoCodes
     *
     * @param \AppBundle\Entity\PromoCode $promoCodes
     * @return Promo
     */
    public function addPromoCode(\AppBundle\Entity\PromoCode $promoCodes)
    {
        $this->promoCodes[] = $promoCodes;
        $promoCodes->setPromo($this);
        $promoCodes->setApp($this->getApp());


        return $this;
    }

    /**
     * Remove promoCodes
     *
     * @param \AppBundle\Entity\PromoCode $promoCodes
     */
    public function removePromoCode(\AppBundle\Entity\PromoCode $promoCodes)
    {
        $this->promoCodes->removeElement($promoCodes);
    }

    /**
     * Get promoCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPromoCodes()
    {
        return $this->promoCodes;
    }

    /**
     * @return PromoType
     */
    public function getPromoType()
    {
        return $this->promoType;
    }

    /**
     * @param PromoType $type
     * @return Promo
     */
    public function setPromoType($type)
    {
        $this->promoType = $type;
        return $this;
    }

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
     * @return Promo
     */
    public function setBeginAt($beginAt=null)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Promo
     */
    public function setEndAt($endAt=null)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Promo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getNUsesPerUser()
    {
        return $this->nUsesPerUser;
    }

    /**
     * @param int $nUsesPerUser
     *
     * @return Promo
     */
    public function setNUsesPerUser($nUsesPerUser)
    {
        $this->nUsesPerUser = $nUsesPerUser;

        return $this;
    }

    /**
     * @return int
     */
    public function getNTotalUses()
    {
        return $this->nTotalUses;
    }

    /**
     * @param int $nTotalUses
     *
     * @return Promo
     */
    public function setNTotalUses($nTotalUses)
    {
        $this->nTotalUses = $nTotalUses;

        return $this;
    }

    /**
     * Set countNTimeUsed
     *
     * @param integer $countNTimeUsed
     * @return Promo
     */
    public function setCountNTimeUsed($countNTimeUsed)
    {
        $this->countNTimeUsed = $countNTimeUsed;

        return $this;
    }

    /**
     * Set nTotalUses
     *
     * @param integer $sumCountNTimeUsed
     * @return PromoCode
     */
    public function sumCountNTimeUsed($sumCountNTimeUsed=1)
    {
        $this->countNTimeUsed += $sumCountNTimeUsed;

        return $this;
    }

    /**
     * Get countNTimeUsed
     *
     * @return integer
     */
    public function getCountNTimeUsed()
    {
        return $this->countNTimeUsed;
    }

}
