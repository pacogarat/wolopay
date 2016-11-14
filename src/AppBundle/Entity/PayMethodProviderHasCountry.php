<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * PayMethodProviderCountry
 *
 * @ORM\Table(name="pay_method_provider_has_country", uniqueConstraints={@ORM\UniqueConstraint(name="PMPC_UNIQUE_", columns={"country_id", "pay_method_has_provider_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PayMethodProviderHasCountryRepository")
 * @UniqueEntity({"country", "payMethodHasProvider"})
 * @ExclusionPolicy("all")
 */
class PayMethodProviderHasCountry
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin"})
     */
    private $country;

    /**
     * to implement validation with provider currencies available
     *
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     */
    private $currency;

    /**
     * @var \AppBundle\Entity\PayMethodHasProvider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethodHasProvider", inversedBy="payMethodProviderHasCountries", fetch="EAGER")
     * @ORM\JoinColumn(name="pay_method_has_provider_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Inline()
     */
    private $payMethodHasProvider;

    /**
     * @var \AppBundle\Entity\SMS
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\SMS", mappedBy="payMethodProviderHasCountry")
     * @Expose()
     * @Groups({"PayMethodProviderHasCountryFull"})
     */
    private $SMSs;

    /**
     * @var \AppBundle\Entity\Voice
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Voice", mappedBy="payMethodProviderHasCountry")
     * @Expose()
     * @Groups({"PayMethodProviderHasCountryFull"})
     */
    private $voices;

    /**
     * @var \AppBundle\Entity\AppHasPayMethodProviderCountry[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\AppHasPayMethodProviderCountry", mappedBy="payMethodProviderHasCountry")
     */
    private $appHasPayMethodProviderCountries;

    /** @var boolean
     *
     * @ORM\Column(name="price_sent_net", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $priceSentNet = false;//boolean. payMethod may need to receive net price and THEY add the taxes

    /** @var boolean
     *
     * @ORM\Column(name="fee_calculated_with_net", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $feeCalculatedWithNet = false; //boolean. payMethod may calculate fee over price without taxes.

    /**
     * @var integer
     *
     * @Expose()
     * @Groups({"PayMethodProviderHasCountryFull"})
     * @ORM\Column(name="fee_provider_percent", type="float", nullable=true)
     * @Accessor(getter="getCurrentFeeProviderPercent")
     */
    private $feeProviderPercent;

    /**
     * @var float
     *
     * @Expose()
     * @Groups({"PayMethodProviderHasCountryFull"})
     * @ORM\Column(name="fee_provider_fixed", type="float", nullable=true)
     * @Accessor(getter="getCurrentFeeProviderFixed")
     */
    private $feeProviderFixed;

    /**
     * @var float
     *
     * @Expose()
     * @Groups({"PayMethodProviderHasCountryFull"})
     * @ORM\Column(name="fee_provider_minimal", type="float", nullable=true)
     * @Accessor(getter="getCurrentFeeProviderMinimal")
     */
    private $feeProviderMinimal;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="fee_currency_id", referencedColumnName="id", nullable=true)
     */
    private $feeCurrency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="`default`", type="boolean", nullable=true)
     */
    private $default=false;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=25, nullable=true)
     */
    private $keyword;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="text_label_id", referencedColumnName="id", nullable=true)
     */
    private $textLabel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

    /**
     * @var string
     *
     * @Gedmo\SortablePosition()
     * @ORM\Column(name="`order`", type="integer", length=5, nullable=false)
     */
    private $order;

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
        $this->SMSs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->voices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appHasPayMethodProviderCountries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        if (!$this->getId() || !$this->getProvider())
            return ' Empty ';

        return $this->getProvider()->getName().'-'.$this->getPayMethod()->getName() .' '.
            $this->getPayMethod()->getArticleCategory()->getName() .' '. $this->getPayMethod()->getPayCategory()->getName().
            ' '. $this->getCountry()->getId().' '.$this->getCurrency()->getId()
        ;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return PayMethodProviderHasCountry
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PayMethodProviderHasCountry
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
     * Set provider, created to avoid will be recreate with setters and getters generator
     *
     * @deprecated Don't use this function use setPayMethodHasProvider
     *
     * @param \AppBundle\Entity\Provider $provider
     * @return PayMethodProviderHasCountry
     */
    private function setProvider(\AppBundle\Entity\Provider $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \AppBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->getPayMethodHasProvider()->getProvider();
    }

    /**
     * Get payMethod
     *
     * @return \AppBundle\Entity\PayMethod
     */
    public function getPayMethod()
    {
        return $this->getPayMethodHasProvider()->getPayMethod();
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return PayMethodProviderHasCountry
     */
    public function setCountry(\AppBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return PayMethodProviderHasCountry
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
     * Set textLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $textLabel
     * @return PayMethodProviderHasCountry
     */
    public function setTextLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $textLabel = null)
    {
        $this->textLabel = $textLabel;

        return $this;
    }

    /**
     * Get textLabel
     *
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit 
     */
    public function getTextLabel()
    {
        if (!$this->textLabel)
            return null;

        return $this->textLabel->getKey();
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return PayMethodProviderHasCountry
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean 
     */
    public function getDefault()
    {
        return $this->default;
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
     * Set payMethodHasProvider
     *
     * @param \AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider
     * @return PayMethodProviderHasCountry
     */
    public function setPayMethodHasProvider(\AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider)
    {
        $this->payMethodHasProvider = $payMethodHasProvider;

        return $this;
    }

    /**
     * Get payMethodHasProvider
     *
     * @return \AppBundle\Entity\PayMethodHasProvider
     */
    public function getPayMethodHasProvider()
    {
        return $this->payMethodHasProvider;
    }

    /**
     * Add sms
     *
     * @param \AppBundle\Entity\SMS $sms
     * @return PayMethodProviderHasCountry
     */
    public function addSMS(\AppBundle\Entity\SMS $sms)
    {
        $this->SMSs[] = $sms;

        return $this;
    }

    /**
     * Remove sms
     *
     * @param \AppBundle\Entity\SMS $sms
     */
    public function removeSMS(\AppBundle\Entity\SMS $sms)
    {
        $this->SMSs->removeElement($sms);
    }

    /**
     * Get sms
     *
     * @return \AppBundle\Entity\SMS[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getSMSs()
    {
        return $this->SMSs;
    }

    /**
     * Get sms
     *
     * @param $smsId
     * @return \AppBundle\Entity\SMS|null
     */
    public function getSMSById($smsId)
    {
        foreach ($this->SMSs as $sms)
        {
            if ($sms->getId() == $smsId)
            {
                return $sms;
            }
        }

        return null;
    }

    /**
     * Get sms
     *
     * @param $voiceId
     * @return \AppBundle\Entity\Voice|null
     */
    public function getVoiceById($voiceId)
    {
        foreach ($this->getVoices() as $voice)
        {
            if ($voice->getId() == $voiceId)
            {
                return $voice;
            }
        }

        return null;
    }


    /**
     * Add voice
     *
     * @param \AppBundle\Entity\Voice $voice
     * @return PayMethodProviderHasCountry
     */
    public function addVoice(\AppBundle\Entity\Voice $voice)
    {
        $this->voices[] = $voice;

        return $this;
    }

    /**
     * Remove voice
     *
     * @param \AppBundle\Entity\Voice $voice
     */
    public function removeVoice(\AppBundle\Entity\Voice $voice)
    {
        $this->voices->removeElement($voice);
    }

    /**
     * Get voice
     *
     * @return Voice[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getVoices()
    {
        return $this->voices;
    }

    /**
     * @param float $feeProviderMinimal
     * @return $this
     */
    public function setFeeProviderMinimal($feeProviderMinimal)
    {
        $this->feeProviderMinimal = $feeProviderMinimal;
        return $this;
    }

    /**
     * @return float
     */
    public function getFeeProviderMinimal()
    {
        return $this->feeProviderMinimal;
    }

    /**
     * @return float
     */
    public function getCurrentFeeProviderMinimal()
    {
        return $this->feeProviderMinimal ? $this->feeProviderMinimal : $this->getPayMethodHasProvider()->getFeeProviderMinimal();
    }

    /**
     * @param int $feeProviderPercent
     * @return $this
     */
    public function setFeeProviderPercent($feeProviderPercent)
    {
        $this->feeProviderPercent = $feeProviderPercent;
        return $this;
    }

    /**
     * @return int
     */
    public function getFeeProviderPercent()
    {
        return $this->feeProviderPercent;
    }

    /**
     * @return int
     */
    public function getCurrentFeeProviderPercent()
    {
        return $this->feeProviderPercent ? $this->feeProviderPercent : $this->getPayMethodHasProvider()->getFeeProviderPercent();
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
     * @return boolean
     */
    public function getActiveCurrent()
    {
        return $this->active && $this->payMethodHasProvider->getActive() && $this->getPayMethod()->getActive();
    }



    /**
     * @return float
     */
    public function getFeeProviderFixed()
    {
        return $this->feeProviderFixed;
    }

    /**
     * @param float $feeProviderFixed
     */
    public function setFeeProviderFixed($feeProviderFixed)
    {
        $this->feeProviderFixed = $feeProviderFixed;
        return $this;
    }

    /**
     * @return float
     */
    public function getCurrentFeeProviderFixed()
    {
        return $this->feeProviderFixed ?: $this->getPayMethodHasProvider()->getFeeProviderFixed();
    }

    /**
     * Add appHasPayMethodProviderCountries
     *
     * @param \AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountries
     * @return PayMethodProviderHasCountry
     */
    public function addAppHasPayMethodProviderCountry(\AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountries)
    {
        $this->appHasPayMethodProviderCountries[] = $appHasPayMethodProviderCountries;

        return $this;
    }

    /**
     * Remove appHasPayMethodProviderCountries
     *
     * @param \AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountries
     */
    public function removeAppHasPayMethodProviderCountry(\AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountries)
    {
        $this->appHasPayMethodProviderCountries->removeElement($appHasPayMethodProviderCountries);
    }

    /**
     * Get appHasPayMethodProviderCountries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppHasPayMethodProviderCountries()
    {
        return $this->appHasPayMethodProviderCountries;
    }

    /**
     * @return boolean
     */
    public function isPriceSentNet()
    {
        return $this->priceSentNet;
    }

    /**
     * @param boolean $priceSentNet
     * @return $this
     */
    public function setPriceSentNet($priceSentNet)
    {
        $this->priceSentNet = $priceSentNet;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCurrentPriceSentNet()
    {
        return $this->priceSentNet ?: $this->getPayMethodHasProvider()->isPriceSentNet();
    }

    /**
     * @return boolean
     */
    public function isFeeCalculatedWithNet()
    {
        return $this->feeCalculatedWithNet;
    }

    /**
     * @param boolean $feeCalculatedWithNet
     * @return $this
     */
    public function setFeeCalculatedWithNet($feeCalculatedWithNet)
    {
        $this->feeCalculatedWithNet = $feeCalculatedWithNet;
        return $this;
    }

    public function isCurrentFeeCalculatedWithNet(){
        return $this->feeCalculatedWithNet ?: $this->getPayMethodHasProvider()->isFeeCalculatedWithNet();
    }


    /**
     * @return Currency
     */
    public function getCurrentFeeCurrency()
    {
        return $this->feeCurrency ?: $this->getPayMethodHasProvider()->getFeeCurrency();
    }

    /**
     * @param \AppBundle\Entity\Currency $feeCurrency
     * @return $this
     */
    public function setFeeCurrency($feeCurrency)
    {
        $this->feeCurrency = $feeCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getFeeCurrency()
    {
        return $this->feeCurrency;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (($this->feeCurrency || $this->feeProviderFixed || $this->feeProviderMinimal) && !$this->getCurrentFeeCurrency() )
        {
            $context
                ->buildViolation('Fee currency must be settled')
                ->atPath('feeCurrency')
                ->addViolation();
        }
    }

    public function hasAFixedAmount()
    {
        if (!$this->SMSs->isEmpty() || !$this->voices->isEmpty())
            return true;

        return false;
    }

    /**
     * @param string $order
     * @return $this
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

}
