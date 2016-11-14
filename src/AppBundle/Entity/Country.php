<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\CountryEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CountryRepository")
 * @ExclusionPolicy("all")
 * @ORM\Cache(usage="READ_ONLY", region="country_region")
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=2)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CountryFull", "ArticleFull", "Basic"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CountryFull", "ArticleFull", "Basic"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="local_name", type="string", length=55, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CountryFull", "ArticleFull"})
     */
    private $localName;


    /**
     * @var string
     *
     * @ORM\Column(name="mcc", type="integer", length=11, nullable=false)
     * @Expose()
     * @Groups({"CountryFull"})
     */
    private $mcc;

    /**
     * @var string
     *
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     */
    private $order=1;

    /**
     * @var float
     *
     * @ORM\Column(name="vat", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"CountryFull"})
     */
    private $vat;

    /**
     * @var \AppBundle\Entity\VatCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VatCategory")
     * @ORM\JoinColumn(name="vat_category_id", referencedColumnName="id", nullable=false)
     */
    private $vatCategory;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\Cache("NONSTRICT_READ_WRITE")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"CountryFull", "ArticleFull"})
     */
    private $currency;

    /**
     * @var \AppBundle\Entity\Continent
     *
     * @ORM\Cache("READ_ONLY")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Continent")
     * @ORM\JoinColumn(name="continent_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"CountryFull", "Continent"})
     */
    private $continent;

    /**
     * @var float
     *
     * @ORM\Column(name="decimal_format", type="float", precision=10, scale=5, nullable=true)
     */
    private $decimalFormat;

    /**
     * @var float
     *
     * @ORM\Column(name="cost_of_living", type="float", precision=10, scale=5, nullable=false)
     */
    private $costOfLiving;

    /**
     * @var string
     *
     * @ORM\Column(name="time_zone", type="string", length=100, nullable=true)
     */
    private $timeZone;

    /**
     * @var string
     *
     * @ORM\Column(name="utc_offset", type="string", length=100, nullable=true)
     */
    private $utcOffset;

    /**
     * @var string
     *
     * @ORM\Column(name="utc_dst_offset", type="string", length=100, nullable=true)
     */
    private $utcDstOffset;

    /**
     * @var \AppBundle\Entity\Language
     *
     * @ORM\Cache("READ_ONLY")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"CountryFull"})
     */
    private $language;

    /**
     * To separate normal list excluding others and proxies
     *
     * @var boolean
     *
     * @ORM\Column(name="standard", type="boolean", nullable=true)
     */
    private $standard = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Exclude
     */
    private $createdAt;


    function __construct($id, $continent = null)
    {
        $this->createdAt = new \DateTime('now');
        $this->id = $id;

        if ($continent)
            $this->setContinent($continent);
    }

    public  function __toString()
    {
        return $this->name.' ('.($this->getCurrency() ? $this->getCurrency()->getId() : '¿?').')';
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
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
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return Country
     */
    public function setCurrency(\AppBundle\Entity\Currency $currency = null)
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
     * Set language
     *
     * @param \AppBundle\Entity\Language $language
     * @return Country
     */
    public function setLanguage(\AppBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Country
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
     * Set id
     *
     * @param string $id
     * @return Country
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $order
     * @return Country
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }


    /**
     * Set code
     *
     * @param integer $mcc
     * @return Country
     */
    public function setMCC($mcc)
    {
        $this->mcc = $mcc;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getMCC()
    {
        return $this->mcc;
    }

    /**
     * @param float $vat
     * @return $this
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param \AppBundle\Entity\Continent $continent
     * @return $this
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Continent
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * @param float $costOfLiving
     * @return $this
     */
    public function setCostOfLiving($costOfLiving)
    {
        $this->costOfLiving = $costOfLiving;
        return $this;
    }

    /**
     * @return float
     */
    public function getCostOfLiving()
    {
        return $this->costOfLiving;
    }

    /**
     * @param \AppBundle\Entity\VatCategory $vatCategory
     * @return $this
     */
    public function setVatCategory($vatCategory)
    {
        $this->vatCategory = $vatCategory;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\VatCategory
     */
    public function getVatCategory()
    {
        return $this->vatCategory;
    }

    /**
     * @param float $timeZone
     * @return $this
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * @return float
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @param float $decimalFormat
     * @return $this
     */
    public function setDecimalFormat($decimalFormat)
    {
        $this->decimalFormat = $decimalFormat;
        return $this;
    }

    /**
     * @return float
     */
    public function getDecimalFormat()
    {
        return $this->decimalFormat;
    }

    /**
     * @return string
     */
    public function getLocalName()
    {
        return $this->localName;
    }

    /**
     * @param string $localName
     *
     * @return Country
     */
    public function setLocalName($localName)
    {
        $this->localName = $localName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     * @param string $utcOffset
     *
     * @return Country
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;

        return $this;
    }

    /**
     * @return string
     */
    public function getUtcDstOffset()
    {
        return $this->utcDstOffset;
    }

    /**
     * @param string $utcDstOffset
     *
     * @return Country
     */
    public function setUtcDstOffset($utcDstOffset)
    {
        $this->utcDstOffset = $utcDstOffset;

        return $this;
    }

    public function isStandardIsoCountry()
    {
        return !in_array($this->getId(), array_merge(CountryEnum::$OTHERS_ALL, [CountryEnum::PROXY]) );
    }

    /**
     * @param boolean $standard
     * @return $this
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getStandard()
    {
        return $this->standard;
    }


}
