<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Service\CurrencyService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @ORM\Table(name="payment_detail")
 * @ORM\Entity()
 * @ExclusionPolicy("all")
 * @XmlRoot("payment_detail")
 */
class PaymentDetail
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\PaymentDetailHasArticles
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PaymentDetailHasArticles", mappedBy="paymentDetail", cascade={"all"})
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    protected $paymentDetailHasArticles;

    /**
     * @var \AppBundle\Entity\SMS
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SMS")
     * @ORM\JoinColumn(name="sms_id", referencedColumnName="id", nullable=true)
     */
    private $sms;

    /**
     * @var \AppBundle\Entity\SMS
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Voice")
     * @ORM\JoinColumn(name="voice_id", referencedColumnName="id", nullable=true)
     */
    private $voice;

    /**
     * @var \AppBundle\Entity\PayMethod
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethod", inversedBy="payMethodHasProvider")
     * @ORM\JoinColumn(name="pay_method_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $payMethod;

    /**
     * @var \AppBundle\Entity\Payment
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="paymentDetail")
     */
    private $payment;

    /**
     * @var \AppBundle\Entity\PaymentDetailExtraCost[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PaymentDetailExtraCost", mappedBy="paymentDetail", cascade={"ALL"})
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    private $paymentDetailExtraCosts;

    /**
     * @var \AppBundle\Entity\Provider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provider")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $provider;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $country;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_configured_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $countryConfigured;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    protected $currency;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", scale=2, precision=10)
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    protected $amount;

    /**
     * @var float
     *
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    protected $amountEur;

    /**
     * @var \AppBundle\Entity\Transaction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transaction" )
     */
    protected $transaction;

    /**
     * @var \AppBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $language;

    /**
     * @var float
     *
     * @ORM\Column(name="security_random_ipn_id", type="string", nullable=true)
     */
    protected $securityRandomIpn;

    /**
     * @var float
     *
     * @ORM\Column(name="security_random_done_id", type="string", nullable=true)
     */
    protected $securityRandomDone;

    /**
     * @var float
     *
     * @ORM\Column(name="security_random_cancel_id", type="string", nullable=true)
     */
    protected $securityRandomCancel;

    /**
     * @var float
     *
     * @ORM\Column(name="security_random_refund_id", type="string", nullable=true)
     */
    protected $securityRandomRefund;

    /**
     * @var boolean
     *
     * @ORM\Column(name="used_app_provider_credentials", type="boolean", nullable=false)
     */
    private $usedAppProviderCredentials=false;

    /**
     * @var array
     *
     * @ORM\Column(name="extra_data", type="json_array", nullable=false)
     */
    private $extraData=[];

    /**
     * Constructor
     */
    public function __construct($id = null)
    {
        $this->paymentDetailHasArticles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paymentDetailExtraCosts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->securityRandomIpn = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
        $this->securityRandomDone = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
        $this->securityRandomCancel = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
        $this->securityRandomRefund = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     * @return $this
     */
    public function setTransaction(\AppBundle\Entity\Transaction $transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \AppBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set amount
     *
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $amount = round($amount, 2);
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
     * Set amount in Eur
     *
     * @param $amountEur
     * @return $this
     */
    public function setAmountEur($amountEur)
    {
        $amountEur = round($amountEur, 2);
        $this->amountEur = $amountEur;

        return $this;
    }


    /**
     * @return float
     */
    public function getAmountEur()
    {
        return $this->amountEur;
    }


    /**
     * Set language
     *
     * @param \AppBundle\Entity\Language $language
     * @return $this
     */
    public function setLanguage(\AppBundle\Entity\Language $language)
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
     * Add paymentHasArticles
     *
     * @param \AppBundle\Entity\PaymentDetailHasArticles $paymentHasArticles
     * @return $this
     */
    public function addPaymentDetailHasArticle(\AppBundle\Entity\PaymentDetailHasArticles $paymentHasArticles)
    {
        $this->paymentDetailHasArticles[] = $paymentHasArticles;
        $paymentHasArticles->setPaymentDetails($this);

        return $this;
    }

    /**
     * Remove paymentHasArticles
     *
     * @param \AppBundle\Entity\PaymentDetailHasArticles $paymentHasArticles
     */
    public function removePaymentDetailHasArticle(\AppBundle\Entity\PaymentDetailHasArticles $paymentHasArticles)
    {
        $this->paymentDetailHasArticles->removeElement($paymentHasArticles);
    }

    /**
     * Get paymentHasArticles
     *
     * @return \AppBundle\Entity\PaymentDetailHasArticles[]|ArrayCollection
     */
    public function getPaymentDetailHasArticles()
    {
        return $this->paymentDetailHasArticles;
    }

    public function getPaymentDetailHasArticleByAppShopHasArticleId($appShopHasArticleId, OfferProgrammer $offerProgrammer = null)
    {
        /** @var $pdha PaymentDetailHasArticles */
        foreach ($this->paymentDetailHasArticles as $pdha)
        {
            if ($pdha->getAppShopHasArticle() && $pdha->getAppShopHasArticle()->getId() == $appShopHasArticleId && $pdha->getOfferProgrammer() === $offerProgrammer)
            {
                return $pdha;
            }
        }

        return null;
    }

    public function getPaymentDetailHasArticleByArticleAndOfferProgrammer($articleId, OfferProgrammer $offerProgrammer = null)
    {
        /** @var $pdha PaymentDetailHasArticles */
        foreach ($this->paymentDetailHasArticles as $pdha)
        {
            if ($pdha->getArticle()->getId() == $articleId && $pdha->getOfferProgrammer() === $offerProgrammer)
            {
                return $pdha;
            }
        }

        return null;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return PaymentDetail
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
     * Set payMethod
     *
     * @param \AppBundle\Entity\PayMethod $payMethod
     * @return PaymentDetail
     */
    public function setPayMethod(\AppBundle\Entity\PayMethod $payMethod)
    {
        $this->payMethod = $payMethod;

        return $this;
    }

    /**
     * Get payMethod
     *
     * @return \AppBundle\Entity\PayMethod
     */
    public function getPayMethod()
    {
        return $this->payMethod;
    }

    /**
     * Set provider
     *
     * @param \AppBundle\Entity\Provider $provider
     * @return PaymentDetail
     */
    public function setProvider(\AppBundle\Entity\Provider $provider)
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
        return $this->provider;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return PaymentDetail
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
     * Set sms
     *
     * @param \AppBundle\Entity\SMS $sms
     * @return PaymentDetail
     */
    public function setSms(\AppBundle\Entity\SMS $sms = null)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * Get sms
     *
     * @return \AppBundle\Entity\SMS
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * Set voice
     *
     * @param \AppBundle\Entity\Voice $voice
     * @return PaymentDetail
     */
    public function setVoice(\AppBundle\Entity\Voice $voice = null)
    {
        $this->voice = $voice;

        return $this;
    }

    /**
     * Get voice
     *
     * @return \AppBundle\Entity\Voice
     */
    public function getVoice()
    {
        return $this->voice;
    }

    /**
     * Set securityRandomIpn
     *
     * @param string $securityRandomIpn
     * @return PaymentDetail
     */
    public function setSecurityRandomIpn($securityRandomIpn)
    {
        $this->securityRandomIpn = $securityRandomIpn;

        return $this;
    }

    /**
     * Get securityRandomIpn
     *
     * @return string 
     */
    public function getSecurityRandomIpn()
    {
        return $this->securityRandomIpn;
    }

    /**
     * Set securityRandomDone
     *
     * @param string $securityRandomDone
     * @return PaymentDetail
     */
    public function setSecurityRandomDone($securityRandomDone)
    {
        $this->securityRandomDone = $securityRandomDone;

        return $this;
    }

    /**
     * Get securityRandomDone
     *
     * @return string 
     */
    public function getSecurityRandomDone()
    {
        return $this->securityRandomDone;
    }

    /**
     * Set securityRandomCancel
     *
     * @param string $securityRandomCancel
     * @return PaymentDetail
     */
    public function setSecurityRandomCancel($securityRandomCancel)
    {
        $this->securityRandomCancel = $securityRandomCancel;

        return $this;
    }

    /**
     * Get securityRandomCancel
     *
     * @return string 
     */
    public function getSecurityRandomCancel()
    {
        return $this->securityRandomCancel;
    }

    /**
     * @param array $extraData
     * @return $this
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param array $creditCardsArray
     * @return $this
     */
    public function setExtraDataCreditCardsAvailable(array $creditCardsArray)
    {
        $this->extraData['credit_cards_available'] = $creditCardsArray;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraDataCreditCardsAvailable()
    {
        if (!isset($this->extraData['credit_cards_available']))
            return null;

        return $this->extraData['credit_cards_available'];
    }

    /**
     * Payment hosted after insert credit card info, post will be execute to this url
     *
     * @param array $url
     * @return $this
     */
    public function setExtraDataEndUrl($url)
    {
        $this->extraData['end_url'] = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtraDataCreditEndUrl()
    {
        if (!isset($this->extraData['end_url']))
            return null;

        return $this->extraData['end_url'];
    }

    /**
     * @param \AppBundle\Entity\Payment $payment
     * @return $this
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @deprecated don't use it
     * @return \AppBundle\Entity\Payment[]
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param boolean $usedAppProviderCredentials
     * @return $this
     */
    public function setUsedAppProviderCredentials($usedAppProviderCredentials)
    {
        $this->usedAppProviderCredentials = $usedAppProviderCredentials;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getUsedAppProviderCredentials()
    {
        return $this->usedAppProviderCredentials;
    }

    public function getCountryGamer()
    {
        if ($this->getTransaction()->getCountryDetected())
            return $this->getTransaction()->getCountryDetected();

        if (!in_array($this->country->getId(), CountryEnum::$OTHERS_ALL))
            return $this->country;

        return null;
    }

    /**
     * @param float $securityRandomRefund
     * @return $this
     */
    public function setSecurityRandomRefund($securityRandomRefund)
    {
        $this->securityRandomRefund = $securityRandomRefund;
        return $this;
    }

    /**
     * @return float
     */
    public function getSecurityRandomRefund()
    {
        return $this->securityRandomRefund;
    }

    /**
     * @VirtualProperty()
     * @Groups("CountAllArticlesQuantities")
     * @Type("integer")
     * @return string
     */
    public function countAllArticlesQuantities()
    {
        $count = 0;

        foreach ($this->getPaymentDetailHasArticles() as $pdha)
        {
            $count += $pdha->getArticlesQuantity();
        }

        return $count;
    }

    /**
     * Add paymentDetailExtraCost
     *
     * @param \AppBundle\Entity\PaymentDetailExtraCost $paymentDetailExtraCost
     *
     * @return PaymentDetail
     */
    public function addPaymentDetailExtraCost(\AppBundle\Entity\PaymentDetailExtraCost $paymentDetailExtraCost)
    {
        $this->paymentDetailExtraCosts[] = $paymentDetailExtraCost;
        $paymentDetailExtraCost->setPaymentDetail($this);

        return $this;
    }

    /**
     * Remove paymentDetailExtraCost
     *
     * @param \AppBundle\Entity\PaymentDetailExtraCost $paymentDetailExtraCost
     */
    public function removePaymentDetailExtraCost(\AppBundle\Entity\PaymentDetailExtraCost $paymentDetailExtraCost)
    {
        $this->paymentDetailExtraCosts->removeElement($paymentDetailExtraCost);
    }

    /**
     * Get paymentDetailExtraCosts
     *
     * @return \Doctrine\Common\Collections\Collection|PaymentDetailExtraCost[]
     */
    public function getPaymentDetailExtraCosts()
    {
        return $this->paymentDetailExtraCosts;
    }

    /**
     * @param \AppBundle\Entity\Country $countryConfigured
     * @return $this
     */
    public function setCountryConfigured($countryConfigured)
    {
        $this->countryConfigured = $countryConfigured;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCountryConfigured()
    {
        return $this->countryConfigured;
    }

    public function getSumExtraCosts()
    {
        $amount = 0;
        foreach ($this->getPaymentDetailExtraCosts() as $e)
        {
            $amount += CurrencyService::calculateExchangePrimitive($e->getAmount(), $e->getCurrency(), $this->getCurrency());
        }

        return $amount;
    }



}