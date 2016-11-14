<?php

namespace AppBundle\Entity\SuperClass;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AppShop
 *
 * @ORM\MappedSuperclass
 * @ExclusionPolicy("all")
 */
class CodePurchase
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @Assert\NotBlank()
     * @Assert\Length(min="4")
     * @ORM\Column(name="code", type="string", length=45, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="float",precision=10, scale=4, nullable=false)
     */
    private $amount;

    /**
     * @var \AppBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     */
    protected $currency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usedAt", type="datetime", nullable=true)
     */
    private $usedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function __toString()
    {
        return $this->getCode();
    }

    /**
     * Set code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return $this
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
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return $this
     */
    public function setCurrency(\AppBundle\Entity\Currency $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \AppBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set usedAt
     *
     * @param \DateTime $usedAt
     * @return $this
     */
    public function setUsedAt($usedAt)
    {
        $this->usedAt = $usedAt;

        return $this;
    }

    /**
     * @return $this
     */
    public function setUsedAtNow()
    {
        $this->usedAt = new \DateTime();

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
