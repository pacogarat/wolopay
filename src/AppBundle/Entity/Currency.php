<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Currency
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CurrencyRepository")
 * @ExclusionPolicy("all")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="currency_region")
 */
class Currency
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=3)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public", "CurrencyStandard"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=3, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull", "CurrencyStandard"})
     */
    private $symbol;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_eur", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"CurrencyFull"})
     */
    private $exchangeRateEur;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_usd", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"CurrencyFull"})
     */
    private $exchangeRateUsd;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_gbp", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"CurrencyFull"})
     */
    private $exchangeRateGbp;

    /**
     * @var integer
     *
     * @ORM\Column(name="decimal_places", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $decimalPlaces=2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     */
    private $updatedAt;


    function __construct($id)
    {
        $this->createdAt = new \DateTime('now');
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->getName().' ('.$this->getId(). ')' ;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set exchangeRateEur
     *
     * @param float $exchangeRateEur
     * @return Currency
     */
    public function setExchangeRateEur($exchangeRateEur)
    {
        $this->exchangeRateEur = $exchangeRateEur;

        return $this;
    }

    /**
     * Get exchangeRateEur
     *
     * @return float 
     */
    public function getExchangeRateEur()
    {
        return $this->exchangeRateEur;
    }

    /**
     * Set exchangeRateUsd
     *
     * @param float $exchangeRateUsd
     * @return Currency
     */
    public function setExchangeRateUsd($exchangeRateUsd)
    {
        $this->exchangeRateUsd = $exchangeRateUsd;

        return $this;
    }

    /**
     * Get exchangeRateUsd
     *
     * @return float 
     */
    public function getExchangeRateUsd()
    {
        return $this->exchangeRateUsd;
    }

    /**
     * Set exchangeRateGbp
     *
     * @param float $exchangeRateGbp
     * @return Currency
     */
    public function setExchangeRateGbp($exchangeRateGbp)
    {
        $this->exchangeRateGbp = $exchangeRateGbp;

        return $this;
    }

    /**
     * @return int
     */
    public function getDecimalPlaces()
    {
        return $this->decimalPlaces;
    }

    /**
     * @param int $decimalPlaces
     * @return Currency
     */
    public function setDecimalPlaces($decimalPlaces)
    {
        $this->decimalPlaces = $decimalPlaces;

        return $this;
    }



    /**
     * Get exchangeRateGbp
     *
     * @return float 
     */
    public function getExchangeRateGbp()
    {
        return $this->exchangeRateGbp;
    }


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Currency
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Currency
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
     * @param string $id ISO
     * @return Currency
     */
    private  function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Currency
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
}
