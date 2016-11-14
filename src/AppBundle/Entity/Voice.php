<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * PayMethodVoice
 *
 * @ORM\Table(name="voice")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VoiceRepository")
 * @ExclusionPolicy("all")
 */
class Voice
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
     * @var \AppBundle\Entity\PayMethodProviderHasCountry
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethodProviderHasCountry", inversedBy="voices")
     * @ORM\JoinColumn(name="pay_method_provider_country_id", referencedColumnName="id", nullable=false)
     */
    private $payMethodProviderHasCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=20, nullable=false)
     */
    private $number;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="call_max_duration", type="integer", nullable=false)
     */
    private $callMaxDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="call_legal_duration", type="integer", nullable=false)
     */
    private $callLegalDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }


    function __toString()
    {
        return ($this->payMethodProviderHasCountry ? $this->payMethodProviderHasCountry->getCountry() : '').' ('.$this->amount.')';
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Voice
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set callMaxDuration
     *
     * @param integer $callMaxDuration
     * @return Voice
     */
    public function setCallMaxDuration($callMaxDuration)
    {
        $this->callMaxDuration = $callMaxDuration;

        return $this;
    }

    /**
     * Get callMaxDuration
     *
     * @return integer 
     */
    public function getCallMaxDuration()
    {
        return $this->callMaxDuration;
    }

    /**
     * Set callLegalDuration
     *
     * @param integer $callLegalDuration
     * @return Voice
     */
    public function setCallLegalDuration($callLegalDuration)
    {
        $this->callLegalDuration = $callLegalDuration;

        return $this;
    }

    /**
     * Get callLegalDuration
     *
     * @return integer 
     */
    public function getCallLegalDuration()
    {
        return $this->callLegalDuration;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Voice
     */
    private function setCreatedAt($createdAt)
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
     * Get id
     *
     * @return \AppBundle\Entity\PayMethod
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payMethodProviderHasCountry
     *
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @return Voice
     */
    public function setPayMethodProviderHasCountry(\AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry)
    {
        $this->payMethodProviderHasCountry = $payMethodProviderHasCountry;

        return $this;
    }

    /**
     * Get payMethodProviderHasCountry
     *
     * @return \AppBundle\Entity\PayMethodProviderHasCountry
     */
    public function getPayMethodProviderHasCountry()
    {
        return $this->payMethodProviderHasCountry;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Voice
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
}
