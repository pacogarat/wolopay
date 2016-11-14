<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Provider
 *
 * @ORM\Table(name="provider")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProviderRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("provider")
 */
class Provider extends Company
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=75, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinTable(name="provider_currencies_available")
     */
    private $currenciesAvailable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="free_vat", type="boolean", nullable=true)
     */
    private $freeVat = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_client_credentials", type="boolean", nullable=true)
     */
    private $hasClientCredentials = false;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\PayMethodHasProvider", mappedBy="provider", fetch="EXTRA_LAZY")
     */
    private $payMethodHasProviders;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\Column(name="virtual_currency_exchange_amount", type="float", precision=10, scale=4, nullable=true)
     */
    private $virtualCurrencyExchangeAmount;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="virtual_currency_exchange_currency", referencedColumnName="id", nullable=true)
     */
    private $virtualCurrencyExchangeCurrency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="refund_enabled", type="boolean", nullable=true)
     */
    private $refundEnabled=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active=true;


    function __construct()
    {
        $this->currenciesAvailable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payMethodHasProviders = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    public function  __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Provider
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
     * Add currenciesAvailable
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return Provider
     */
    public function addCurrenciesAvailable(\AppBundle\Entity\Currency $currency)
    {
        $this->currenciesAvailable[] = $currency;

        return $this;
    }

    /**
     * Remove currenciesAvailable
     *
     * @param \AppBundle\Entity\Currency $currency
     */
    public function removeCurrenciesAvailable(\AppBundle\Entity\Currency $currency)
    {
        $this->currenciesAvailable->removeElement($currency);
    }

    /**
     * Get currenciesAvailable
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCurrenciesAvailable()
    {
        return $this->currenciesAvailable;
    }

    /**
     * @param boolean $freeVat
     * @return $this
     */
    public function setFreeVat($freeVat)
    {
        $this->freeVat = $freeVat;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFreeVat()
    {
        return $this->freeVat;
    }

    /**
     * @return boolean
     */
    public function isEuVatPaidByProvider()
    {
        return $this->euVatPaidByProvider;
    }

    /**
     * @param boolean $euVatPaidByProvider
     */
    public function setEuVatPaidByProvider($euVatPaidByProvider)
    {
        $this->euVatPaidByProvider = $euVatPaidByProvider;
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
     * @param boolean $hasClientCredentials
     * @return $this
     */
    public function setHasClientCredentials($hasClientCredentials)
    {
        $this->hasClientCredentials = $hasClientCredentials;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasClientCredentials()
    {
        return $this->hasClientCredentials;
    }

    /**
     * @return mixed
     */
    public function getPayMethodHasProviders()
    {
        return $this->payMethodHasProviders;
    }

    /**
     * @param \AppBundle\Entity\Currency $virtualCurrencyExchangeAmount
     * @return $this
     */
    public function setVirtualCurrencyExchangeAmount($virtualCurrencyExchangeAmount)
    {
        $this->virtualCurrencyExchangeAmount = $virtualCurrencyExchangeAmount;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getVirtualCurrencyExchangeAmount()
    {
        return $this->virtualCurrencyExchangeAmount;
    }

    /**
     * @param \AppBundle\Entity\Currency $virtualCurrencyExchangeCurrency
     * @return $this
     */
    public function setVirtualCurrencyExchangeCurrency($virtualCurrencyExchangeCurrency)
    {
        $this->virtualCurrencyExchangeCurrency = $virtualCurrencyExchangeCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getVirtualCurrencyExchangeCurrency()
    {
        return $this->virtualCurrencyExchangeCurrency;
    }

    /**
     * @param boolean $refundEnabled
     * @return $this
     */
    public function setRefundEnabled($refundEnabled)
    {
        $this->refundEnabled = $refundEnabled;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRefundEnabled()
    {
        return $this->refundEnabled;
    }

}
