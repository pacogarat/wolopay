<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App
 *
 * @ORM\Table(name="app_has_pay_method_provider_country")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppHasPayMethodProviderCountryRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("app_has_pay_method_provider_country")
 */
class AppHasPayMethodProviderCountry
{
    /**
     * @var \AppBundle\Entity\PayMethodProviderHasCountry
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethodProviderHasCountry", inversedBy="appHasPayMethodProviderCountries", fetch="EAGER")
     * @ORM\JoinColumn(name="pay_method_provider_has_country_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @ORM\Id()
     * @Expose()
     * @Inline()
     * @Groups({"Public", "Default"})
     */
    private $payMethodProviderHasCountry;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="appHasPayMethodProviderCountry")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @ORM\Id()
     */
    private $app;

    /**
     * To show extra cost apply to this pmpc or his amount is fixed
     * @Expose()
     * @Groups({"ForcePrice"})
     */
    private $tempForcePrice;

    /**
     * To show extra money u must pay if choose this pay method
     * @Expose()
     * @Groups({"ForcePrice"})
     */
    private $tempForcePriceDiff;

    /**
     * To show extra cost apply to this pmpc or his amount is fixed
     * @var Currency
     * @Expose()
     * @Groups({"ForcePrice"})
     */
    private $tempForcePriceCurrency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

    function __construct($payMethodProviderHasCountry = null, $app = null)
    {
        $this->payMethodProviderHasCountry = $payMethodProviderHasCountry;
        $this->app                         = $app;
    }

    public function __toString()
    {
        return $this->app.' '.$this->payMethodProviderHasCountry;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param \AppBundle\Entity\App $app
     * @return $this
     */
    public function setApp($app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @return $this
     */
    public function setPayMethodProviderHasCountry($payMethodProviderHasCountry)
    {
        $this->payMethodProviderHasCountry = $payMethodProviderHasCountry;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PayMethodProviderHasCountry
     */
    public function getPayMethodProviderHasCountry()
    {
        return $this->payMethodProviderHasCountry;
    }

    /**
     * @param mixed $tempForcePrice
     * @return $this
     */
    public function setTempForcePrice($tempForcePrice)
    {
        $this->tempForcePrice = $tempForcePrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempForcePrice()
    {
        return $this->tempForcePrice;
    }

    /**
     * @param mixed $tempForcePriceDiff
     * @return $this
     */
    public function setTempForcePriceDiff($tempForcePriceDiff)
    {
        $this->tempForcePriceDiff = $tempForcePriceDiff;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempForcePriceDiff()
    {
        return $this->tempForcePriceDiff;
    }

    /**
     * @param mixed $tempForcePriceCurrency
     * @return $this
     */
    public function setTempForcePriceCurrency(Currency $tempForcePriceCurrency)
    {
        $this->tempForcePriceCurrency = $tempForcePriceCurrency;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getTempForcePriceCurrency()
    {
        return $this->tempForcePriceCurrency;
    }


}
