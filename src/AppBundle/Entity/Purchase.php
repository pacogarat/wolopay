<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CurrencyService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Purchase
 *
 * @ORM\Table(name="purchase"))
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PurchaseRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("purchase")
 */
class Purchase
{
    const PREFIX = 'WOP_';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="was_canceled", type="boolean", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $wasCanceled = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancel_in_process", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $cancelInProcess = false;

    /**
     * @var \AppBundle\Entity\Transaction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transaction", inversedBy="purchases")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default"})
     */
    private $transaction;

    /**
     * @var \AppBundle\Entity\Provider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provider")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     */
    private $provider;

    /**
     * @var \AppBundle\Entity\PayMethod
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethod")
     * @ORM\JoinColumn(name="pay_method_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $payMethod;

    /**
     * Country from PMPC
     *
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $country;

    /**
     * articles country configuration
     *
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_configured_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $countryConfigured;

    /**
     * Currency from PMPC
     *
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $currency;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gamer")
     * @ORM\JoinColumn(name="gamer_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $gamer;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var \AppBundle\Entity\Payment
     *
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Payment", inversedBy="purchase")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $payment;

    /**
     * @var \AppBundle\Entity\PurchaseNotification
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PurchaseNotification", cascade={"persist"}, mappedBy="purchases")
     * @Expose()
     * @Groups({"Default"})
     */
    private $purchaseNotification;

    /**
     * @var \AppBundle\Entity\Purchase
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Purchase", inversedBy="extraCostFromChildren")
     * @ORM\JoinColumn(name="extra_cost_from_parent_id", referencedColumnName="id", nullable=true)
     */
    private $extraCostFromParent;

    /**
     * @var \AppBundle\Entity\Purchase[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Purchase", mappedBy="extraCostFromParent")
     * @Expose()
     * @Groups({"ExtraCost"})
     * @MaxDepth(2)
     */
    private $extraCostFromChildren;

    /**
     * @var String
     *
     * @ORM\Column(name="partial_payment", type="string", length=45, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $partialPayment;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_total", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_tax", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountTax;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_tax_paid_by_provider", type="float", precision=10, scale=4, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountTaxPaidByProvider;


    /**
     * @var float
     *
     * @ORM\Column(name="tax_percent", type="float", precision=10, scale=4, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $taxPercent;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_before_taxes", type="float", precision=10, scale=5, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountBeforeTaxes;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_wolo", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountWolo;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_provider", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountProvider; //before taxes

    /**
     * @var float
     *
     * @ORM\Column(name="amount_game", type="float", precision=10, scale=2, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountGame;

    /**
     * @var float
     *
     * @ORM\Column(name="provider_fee_percent", type="float", precision=10, scale=0, nullable=false)
     */
    private $providerFeePercent=0;

    /**
     * @var float
     *
     * @ORM\Column(name="provider_real_fee_percent", type="float", precision=10, scale=0, nullable=false)
     */
    private $providerRealFeePercent=0; /*If there's a min or fixed fee, this stores the real % kept by provider */

    /**
     * @var float
     *
     * @ORM\Column(name="provider_fixed_fee_amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $providerFixedFeeAmount=0;

    /**
     * @var float
     *
     * @ORM\Column(name="provider_tax_amount_minimal", type="float", precision=10, scale=0, nullable=false)
     */
    private $providerMinFeeAmount=0;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_eur", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $exchangeRateEur;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_usd", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $exchangeRateUsd;

    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate_gbp", type="float", precision=10, scale=0, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $exchangeRateGbp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cli", type="boolean", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $cli=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="test", type="boolean", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $test=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="used_app_provider_credentials", type="boolean", nullable=false)
     */
    private $usedAppProviderCredentials=false;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $reason;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="created_at_unix", type="integer", nullable=false)
     */
    private $createdAtUnix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $lastUpdateAt;

    /**
     * @var int
     *
     * @ORM\Column(name="last_updated_at_unix", type="integer", nullable=true)
     */
    private $lastUpdatedAtUnix;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = uniqid(self::PREFIX);
        $this->createdAt = new \DateTime('now');
        $this->createdAtUnix = $this->createdAt->getTimestamp();
        $this->purchaseNotification = new \Doctrine\Common\Collections\ArrayCollection();
        $this->extraCostFromChildren = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __clone()
    {
        $this->__construct();
        $this->payment = null;
    }

    public function __toString()
    {
        return (string ) $this->getId();
    }

    /**
     * Set exchangeRateEur
     *
     * @param float $exchangeRateEur
     * @return Purchase
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
     * @return Purchase
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return Purchase
     */
    public function setCountry(\AppBundle\Entity\Country $country = null)
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
     * @return Purchase
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
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return Purchase
     */
    public function setApp(\AppBundle\Entity\App $app = null)
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
     * Set transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     * @return Purchase
     */
    public function setTransaction(\AppBundle\Entity\Transaction $transaction = null)
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
     * Set provider
     *
     * @param \AppBundle\Entity\Provider $provider
     * @return Purchase
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
     * Set gamer
     *
     * @param \AppBundle\Entity\Gamer $gamer
     * @return Purchase
     */
    public function setGamer(\AppBundle\Entity\Gamer $gamer)
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Purchase
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
     * Set createdAtUnix
     *
     * @param integer $createdAtUnix
     * @return Purchase
     */
    public function setCreatedAtUnix($createdAtUnix)
    {
        $this->createdAtUnix = $createdAtUnix;

        return $this;
    }

    /**
     * Get createdAtUnix
     *
     * @return integer 
     */
    public function getCreatedAtUnix()
    {
        return $this->createdAtUnix;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Purchase
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set payment
     *
     * @param \AppBundle\Entity\Payment $payment
     * @return Purchase
     */
    public function setPayment(\AppBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \AppBundle\Entity\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set amountTotal
     *
     * @param float $amountTotal
     * @return Purchase
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    /**
     * Get amountTotal
     *
     * @return float 
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    /**
     * Set amountProvider
     *
     * @param float $amountProvider
     * @return Purchase
     */
    public function setAmountProvider($amountProvider)
    {
        $this->amountProvider = $amountProvider;

        return $this;
    }

    /**
     * Get amountProvider
     *
     * @return float 
     */
    public function getAmountProvider()
    {
        return $this->amountProvider;
    }

    /**
     * Set amountGame
     *
     * @param float $amountGame
     * @return Purchase
     */
    public function setAmountGame($amountGame)
    {
        $this->amountGame = $amountGame;

        return $this;
    }

    /**
     * Get amountGame
     *
     * @return float 
     */
    public function getAmountGame()
    {
        return $this->amountGame;
    }

    /**
     * Set providerTaxPercent
     *
     * @param float $providerFeePercent
     * @return Purchase
     */
    public function setProviderFeePercent($providerFeePercent)
    {
        $this->providerFeePercent = $providerFeePercent;

        return $this;
    }

    /**
     * Get providerTaxPercent
     *
     * @return float 
     */
    public function getProviderFeePercent()
    {
        return $this->providerFeePercent;
    }

    /**
     * @return float
     */
    public function getProviderRealFeePercent()
    {
        return $this->providerRealFeePercent;
    }

    /**
     * @param float $providerRealFeePercent
     * @return $this
     */
    public function setProviderRealFeePercent($providerRealFeePercent)
    {
        $this->providerRealFeePercent = $providerRealFeePercent;
        return $this;
    }

    /**
     * Set providerTaxAmount
     *
     * @param float $providerFixedFeeAmount
     * @return Purchase
     */
    public function setProviderFixedFeeAmount($providerFixedFeeAmount)
    {
        $this->providerFixedFeeAmount = $providerFixedFeeAmount;

        return $this;
    }

    /**
     * Get providerTaxAmount
     *
     * @return float 
     */
    public function getProviderFixedFeeAmount()
    {
        return $this->providerFixedFeeAmount;
    }

    /**
     * Set providerTaxAmountMinimal
     *
     * @param float $providerMinFeeAmount
     * @return Purchase
     */
    public function setProviderMinFeeAmount($providerMinFeeAmount)
    {
        $this->providerMinFeeAmount = $providerMinFeeAmount;

        return $this;
    }

    /**
     * Get providerTaxAmountMinimal
     *
     * @return float
     */
    public function getProviderMinFeeAmount()
    {
        return $this->providerMinFeeAmount;
    }

    /**
     * Set partialPayment
     *
     * @param string $partialPayment
     * @return Purchase
     */
    public function setPartialPayment($partialPayment)
    {
        $this->partialPayment = $partialPayment;

        return $this;
    }

    /**
     * Get partialPayment
     *
     * @return string
     */
    public function getPartialPayment()
    {
        return $this->partialPayment;
    }

    /**
     * Add purchaseNotification
     *
     * @param \AppBundle\Entity\PurchaseNotification $purchaseNotification
     * @return Purchase
     */
    public function addPurchaseNotification(\AppBundle\Entity\PurchaseNotification $purchaseNotification)
    {
        $this->purchaseNotification[] = $purchaseNotification;

        return $this;
    }

    /**
     * Remove purchaseNotification
     *
     * @param \AppBundle\Entity\PurchaseNotification $purchaseNotification
     */
    public function removePurchaseNotification(\AppBundle\Entity\PurchaseNotification $purchaseNotification)
    {
        $this->purchaseNotification->removeElement($purchaseNotification);
    }

    /**
     * Get purchaseNotification
     *
     * @return \AppBundle\Entity\PurchaseNotification[]
     */
    public function getPurchaseNotification()
    {
        return $this->purchaseNotification;
    }

    /**
     * Set wasCanceled
     *
     * @param boolean $wasCanceled
     * @return Purchase
     */
    public function setWasCanceled($wasCanceled)
    {
        $this->wasCanceled = $wasCanceled;

        return $this;
    }

    /**
     * Get wasCanceled
     *
     * @return boolean 
     */
    public function getWasCanceled()
    {
        return $this->wasCanceled;
    }

    /**
     * @param float $exchangeRateGbp
     * @return $this
     */
    public function setExchangeRateGbp($exchangeRateGbp)
    {
        $this->exchangeRateGbp = $exchangeRateGbp;

        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRateGbp()
    {
        return $this->exchangeRateGbp;
    }

    /**
     * @VirtualProperty()
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getTransaction()->getId();
    }

    /**
     * @VirtualProperty()
     * @return bool
     */
    public function getRefundEnabled()
    {
        return $this->getWasCanceled() === false && $this->getProvider()->getRefundEnabled() && $this->amountTotal > 0;
    }

    /**
     * @param boolean $cli
     * @return $this
     */
    public function setCli($cli)
    {
        $this->cli = $cli;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCli()
    {
        return $this->cli;
    }

    /**
     * @param boolean $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param \AppBundle\Entity\PayMethod $payMethod
     * @return $this
     */
    public function setPayMethod(\AppBundle\Entity\PayMethod $payMethod)
    {
        $this->payMethod = $payMethod;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PayMethod
     */
    public function getPayMethod()
    {
        return $this->payMethod;
    }

    /**
     * @return float
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    /**
     * @param float $taxPercent
     */
    public function setTaxPercent($taxPercent)
    {
        $this->taxPercent = $taxPercent;
        return $this;
    }

    /**
     * @param float $amountTax
     * @return $this
     */
    public function setAmountTax($amountTax)
    {
        $this->amountTax = $amountTax;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTax()
    {
        return $this->amountTax;
    }

    /**
     * @VirtualProperty()
     * @return float
     */
    public function getRealAmountTax(){
        return $this->amountTaxPaidByProvider ?: $this->amountTax;
    }

    /**
     * @return float
     */
    public function getAmountBeforeTaxes()
    {
        return $this->amountBeforeTaxes;
    }

    /**
     * @param float $amountBeforeTaxes
     * @return $this
     */
    public function setAmountBeforeTaxes($amountBeforeTaxes)
    {
        $this->amountBeforeTaxes = $amountBeforeTaxes;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountWolo()
    {
        return $this->amountWolo;
    }

    /**
     * @param float $amountWolo
     * @return $this
     */
    public function setAmountWolo($amountWolo)
    {
        $this->amountWolo = $amountWolo;
        return $this;
    }

    public function getCountryGamer()
    {
        return $this->getTransaction()->getCountryDetected() ?: $this->getCountry();
    }

    public function isASubscription()
    {
        return $this->payment instanceof SubscriptionEventualityPayment;
    }

    /**
     * @return float
     */
    public function getAmountTaxPaidByProvider()
    {
        return $this->amountTaxPaidByProvider;
    }

    /**
     * @param float $amountTaxPaidByProvider
     * @return Purchase
     */
    public function setAmountTaxPaidByProvider($amountTaxPaidByProvider)
    {
        $this->amountTaxPaidByProvider = $amountTaxPaidByProvider;
        return $this;
    }

    public function getArticlesString($lang = LanguageEnum::ENGLISH)
    {
        if ($this->payment instanceof SingleCustomPayment)
            return $this->transaction->getCustomArticleTitle();

        $articles = '';

        foreach ($this->getPayment()->getPaymentDetail()->getPaymentDetailHasArticles() as $pda)
        {
            $articles .= ', '.ArticleService::getTranslationBasic($pda->getArticle()->getNameCurrentLabel(), $pda->getItemsQuantity(), $lang);
        }

        $articles = substr($articles, 2);

        return $articles;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Purchase
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param boolean $cancelInProcess
     * @return $this
     */
    public function setCancelInProcess($cancelInProcess)
    {
        $this->cancelInProcess = $cancelInProcess;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCancelInProcess()
    {
        return $this->cancelInProcess;
    }

    /**
     * @param \AppBundle\Entity\Purchase $extraCostFromParent
     * @return $this
     */
    public function setExtraCostFromParent($extraCostFromParent)
    {
        $this->extraCostFromParent = $extraCostFromParent;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Purchase
     */
    public function getExtraCostFromParent()
    {
        return $this->extraCostFromParent;
    }

    /**
     * @return \AppBundle\Entity\Purchase
     */
    public function getExtraCostFromChildren()
    {
        return $this->extraCostFromChildren;
    }

    /**
     * @VirtualProperty()
     *
     * @return string
     */
    public function getCanReactivate()
    {
        if ($this->provider->getRefundEnabled())
            return false;

        return true;
    }


    /**
     * @VirtualProperty()
     *
     * @return string
     */
    public function getDetailedPaymentType()
    {
        if ($this->isASubscription()){
            /** @var SubscriptionEventualityPayment $payment */
            $payment = $this->payment;
            $subscription = $payment->getSubscriptionEventuality()->getSubscription();
            /** @var  ArrayCollection $eventualities */
            $eventualities = $subscription->getSubscriptionEventualities();
            $pos = $eventualities->indexOf($payment->getSubscriptionEventuality());

            //$pos = $payment->getSubscriptionEventuality()->getSubscription()->getNCompletedPayments();
            if ($pos>0) return "subscription_renewal";
            return "new_subscription";
        }else{
            return $this->getPayMethod()->getArticleCategory()->getId();
        }

    }



    /**
     * @VirtualProperty()
     * @Groups({"RealAmountFromParent"})
     * @return float
     */
    public function getRealAmountTotalFromParentPurchase()
    {
        $totalAmount = $this->getAmountTotal();

        foreach ($this->extraCostFromChildren as $children)
        {
            $totalAmount += CurrencyService::calculateExchangePrimitive(
                $children->getAmountTotal(),
                $children->getCurrency(),
                $this->getCurrency()
            );
        }


        return $totalAmount;
    }

    /**
     * @VirtualProperty()
     * @Groups({"RealAmountFromParent"})
     * @return float
     */
    public function getRealAmountTaxFromParentPurchase()
    {
        $totalTax = $this->getAmountTax();

        foreach ($this->extraCostFromChildren as $children)
        {
            $totalTax += CurrencyService::calculateExchangePrimitive(
                $children->getAmountTax(),
                $children->getCurrency(),
                $this->getCurrency()
            );
        }

        return $totalTax;
    }

    /**
     * @VirtualProperty()
     * @Groups({"RealAmountFromParent"})
     * @return float
     */
    public function getRealAmountGameFromParentPurchase()
    {
        $amountGame = $this->getAmountGame();

        foreach ($this->extraCostFromChildren as $children)
        {
            $amountGame += CurrencyService::calculateExchangePrimitive(
                $children->getAmountGame(),
                $children->getCurrency(),
                $this->getCurrency()
            );
        }

        return $amountGame;
    }

    /**
     * @VirtualProperty()
     * @Groups({"RealAmountFromParent"})
     * @return float
     */
    public function getRealAmountWoloFromParentPurchase()
    {
        $amountWolo = $this->getAmountWolo();

        foreach ($this->extraCostFromChildren as $children)
        {
            $amountWolo += $children->getAmountWolo();
        }

        return $amountWolo;
    }

    /**
     * @VirtualProperty()
     * @Groups({"RealAmountFromParent"})
     * @return float
     */
    public function getRealAmountProviderFromParentPurchase()
    {
        $amountProvider = $this->getAmountProvider();

        foreach ($this->extraCostFromChildren as $children)
        {
            $amountProvider += $children->getAmountProvider();
        }

        return $amountProvider;
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

    /**
     * @return \DateTime
     */
    public function getLastUpdateAt()
    {
        return $this->lastUpdateAt;
    }

    /**
     * @param \DateTime $lastUpdateAt
     * @return $this
     */
    public function setLastUpdateAt($lastUpdateAt)
    {
        $this->lastUpdateAt = $lastUpdateAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastUpdatedAtUnix()
    {
        return $this->lastUpdatedAtUnix;
    }

    /**
     * @param int $lastUpdatedAtUnix
     * @return $this
     */
    public function setLastUpdatedAtUnix($lastUpdatedAtUnix)
    {
        $this->lastUpdatedAtUnix = $lastUpdatedAtUnix;
        return $this;
    }
}
