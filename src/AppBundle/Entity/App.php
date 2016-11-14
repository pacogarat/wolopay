<?php

namespace AppBundle\Entity;

use AppBundle\Helper\UtilHelper;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * App
 *
 * @ORM\Table(name="app")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ExclusionPolicy("all")
 * @XmlRoot("app")
 */
class App
{
    const SONATA_CONTEXT='app';
    const REGEX_VALID_BLACKLIST_IP = '^((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d)|\*)){4}(?:(\/|\-)((|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){1,4})?$';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public", "AppFull", "AdminStep0"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="apps")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * @var \AppBundle\Entity\AppShop[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\AppShop", mappedBy="app", cascade={"all"})
     */
    private $appShops;

    /**
     * @var \AppBundle\Entity\AppTab
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\AppTab", mappedBy="app", orphanRemoval=true)
     */
    private $appTabs;

    /**
     * @var \AppBundle\Entity\AppTab
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\ItemTab", mappedBy="app", orphanRemoval=true)
     */
    private $itemTabs;

    /**
     * @var \AppBundle\Entity\LevelCategory[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\LevelCategory", mappedBy="app", cascade={"all"})
     */
    private $appLevels;

    /**
     * @var \AppBundle\Entity\AppHasPayMethodProviderCountry[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\AppHasPayMethodProviderCountry", mappedBy="app", cascade={"all"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     */
    private $appHasPayMethodProviderCountry;

    /**
     * @var \AppBundle\Entity\Language[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Language", fetch="EAGER")
     * @ORM\JoinTable(name="app_has_languages")
     */
    private $languages;

    /**
     * @var \AppBundle\Entity\Country[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Country", fetch="EAGER")
     * @ORM\JoinTable(name="app_has_countries")
     */
    private $countries;

    /**
     * @var \AppBundle\Entity\Country[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Country")
     * @ORM\JoinTable(name="app_has_blacklisted_countries")
     */
    private $blacklistedCountries;

    /**
     * @var array
     *
     * @ORM\Column(name="blacklisted_ips", type="array", nullable=true)
     */
    private $blacklistedIPs=[];

    /**
     * @var \AppBundle\Entity\Gamer[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Gamer", mappedBy="app", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    private $gamers;

    /**
     * @var \AppBundle\Entity\AppApiCredentials
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AppApiCredentials", mappedBy="app", cascade={"all"})
     */
    private $appApiHasCredential;

    /**
     * @var \AppBundle\Entity\ClientUserHasApp
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientUserHasApp", mappedBy="app", cascade={"all"})
     */
    private $clientUsersHasApps;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Groups({"AppFull", "Basic"})
     * @Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Url
     * @ORM\Column(name="url_home_site", type="string", length=255, nullable=false)
     * @Groups({"AppFull", "Basic"})
     * @Expose()
     */
    private $urlHomeSite;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="logo", referencedColumnName="id", nullable=false)
     * @Groups({"AppFull", "Basic"})
     * @Expose()
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="url_notification_payment", type="string", length=255, nullable=false)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $urlNotificationPayment;

    /**
     * @var string
     *
     * @ORM\Column(name="url_notification_subscription", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $urlNotificationSubscription;

    /**
     * @var string
     *
     * @Assert\Url
     * @ORM\Column(name="url_notification_new_gamer", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $urlNotificationNewGamer;

    /**
     * @var string
     *
     * @ORM\Column(name="url_notification_extra", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $urlNotificationExtra;

    /**
     * @var string
     *
     * @ORM\Column(name="internal_payment_notification_url", type="string", length=255, nullable=true)
     */
    private $internalPaymentNotificationUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="notification_retries_on_failure", type="integer", nullable=false)
     */
    private $notificationRetriesOnFailure = 25;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_email", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $ownerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="administration_email", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $administrationEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="technical_email", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $technicalEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="end_user_support_email", type="string", length=255, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $endUserSupportEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="translations_domain", type="string", length=100, nullable=false)
     */
    private $translationDomain;

    /**
     * @var float
     * deprecated
     *
     * @ORM\Column(name="tax_percent_applicable", type="float", precision=5, scale=2, nullable=false)
     */
    private $taxPercentApplicable = 5; //This should be the TAX applied to the game (in fact it should be obtained from its country)

    /**
     * @var \Appbundle\Entity\Enum\CommissionBaseEnum
     *
     * @ORM\Column(name="comission_base", type="string", length=25, nullable=false)
     */
    private $commissionBase = Enum\CommissionBaseEnum::WOLOPAYNET;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="comission_currency_id", referencedColumnName="id", nullable=true)
     */
    private $commissionCurrency = Enum\CurrencyEnum::EURO;

    /**
     * @var float;
     *
     * @ORM\Column(name="commission_min", type="float", precision=5, scale=2, nullable=true)
     */
    private $commissionMin = 0.1;

    /**
     * @var float;
     *
     * @ORM\Column(name="commission_max", type="float", precision=5, scale=2, nullable=true)
     */
    private $commissionMax = 0.10;

    /**
     * @var float;
     *
     * @ORM\Column(name="commission_percent", type="float", precision=5, scale=2, nullable=true)
     */
    private $commissionPercent = 0;

    /**
     * @var float;
     *
     * @ORM\Column(name="commission_fixed_fee", type="float", precision=5, scale=2, nullable=true)
     */
    private $commissionFixedFee = 0.1;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_alias", type="string", length=20, nullable=true)
     */
    private $smsAlias;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pay_methods_max_fee_provider_percent", type="float", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $payMethodsMaxFeeProviderPercent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pay_methods_add_fee_to_final_amount", type="boolean", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $payMethodsAddFeeToFinalAmount=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tax_to_final_amount", type="boolean", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $taxToFinalAmount=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wolopay_fee_to_final_amount", type="boolean", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $wolopayFeeToFinalAmount=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pretty_price_is_enabled", type="boolean", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $prettyPriceIsEnabled=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cost_of_live_is_enabled", type="boolean", nullable=true)
     * @Groups({"AdminStep0"})
     * @Expose()
     */
    private $costOfLiveIsEnabled=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_virtual_currency_enabled", type="boolean", nullable=true)
     * @Expose()
     */
    private $hasVirtualCurrencyEnabled=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_customize_app_tabs", type="boolean", nullable=true)
     * @Expose()
     */
    private $canCustomizeAppTabs=false;

    /**
     * @var int
     *
     * @ORM\Column(name="seconds_to_join_transactions", type="integer", nullable=true)
     */
    private $secondsToJoinTransactions = 25;

    /**
     * @var string
     *
     * @ORM\Column(name="external_app_id", type="string", length=50, nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $externalAppId;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="document", referencedColumnName="id", nullable=true)
     * @Expose()
     */
    private $document;


    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     * @Groups({"AppFull"})
     * @Expose()
     */
    private $active=true;

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
        $this->appHasLevelCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appShops = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appHasPayMethodProviderCountry = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientUsersHasApps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blacklistedCountries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gamers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affiliates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appTabs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @ORM\PrePersist
     */
    public function generateId()
    {
        $name = str_replace(' ','', strtoupper($this->name));
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        $name= (strlen($name) > 6) ? substr($name,0,6) : $name;
        $this->id = uniqid($name);

        $this->setTranslationDomain($this->id);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return App
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
     * Set urlHomeSite
     *
     * @param string $urlHomeSite
     * @return App
     */
    public function setUrlHomeSite($urlHomeSite)
    {
        $this->urlHomeSite = $urlHomeSite;

        return $this;
    }

    /**
     * Get urlHomeSite
     *
     * @return string 
     */
    public function getUrlHomeSite()
    {
        return $this->urlHomeSite;
    }

    /**
     * Set urlNotificationPayment
     *
     * @param string $urlNotificationPayment
     * @return App
     */
    public function setUrlNotificationPayment($urlNotificationPayment)
    {
        $this->urlNotificationPayment = $urlNotificationPayment;

        return $this;
    }

    /**
     * Get urlNotificationPayment
     *
     * @return string 
     */
    public function getUrlNotificationPayment()
    {
        return $this->urlNotificationPayment;
    }

    /**
     * Set urlNotificationSubscription
     *
     * @param string $urlNotificationSubscription
     * @return App
     */
    public function setUrlNotificationSubscription($urlNotificationSubscription)
    {
        $this->urlNotificationSubscription = $urlNotificationSubscription;

        return $this;
    }

    /**
     * Get urlNotificationSubscription
     *
     * @return string 
     */
    public function getUrlNotificationSubscription()
    {
        return $this->urlNotificationSubscription;
    }

    /**
     * @param string $urlNotificationExtra
     * @return $this
     */
    public function setUrlNotificationExtra($urlNotificationExtra)
    {
        $this->urlNotificationExtra = $urlNotificationExtra;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlNotificationExtra()
    {
        return $this->urlNotificationExtra;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return App
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return App
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set createdAt
     *
     * @deprecated NOT USE IT
     * @param \DateTime $createdAt
     * @return App
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
     * Get appHasLevelCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppHasLevelCategories()
    {
        return $this->appHasLevelCategories;
    }

    /**
     * Add appShops
     *
     * @param \AppBundle\Entity\AppShop $appShops
     * @return App
     */
    public function addAppShop(\AppBundle\Entity\AppShop $appShops)
    {
        $this->appShops[] = $appShops;
        $appShops->setApp($this);

        return $this;
    }

    /**
     * Remove appShops
     *
     * @param \AppBundle\Entity\AppShop $appShops
     */
    public function removeAppShop(\AppBundle\Entity\AppShop $appShops)
    {
        $this->appShops->removeElement($appShops);
    }

    /**
     * Get appShops
     *
     * @return AppShop[]
     */
    public function getappShops()
    {
        return $this->appShops;
    }

    /**
     * Get getappShopByLevelCategory
     *
     * @param $levelCategoryId
     * @return AppShop
     */
    public function getappShopByLevelCategory($levelCategoryId)
    {
        foreach ($this->getappShops() as $appShop)
        {
            if ($appShop->getLevelCategory()->getId() == $levelCategoryId)
                return $appShop;
        }

        return null;
    }

    /**
     * Set id
     *
     * @param string $id
     * @deprecated Only used to test
     * @return App
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get setPayMethodProviderHasCountries
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $ac
     * @return \AppBundle\Entity\PayMethodProviderHasCountry[]
     */
    public function setAppHasPayMethodProviderCountries($ac)
    {
        $this->appHasPayMethodProviderCountry->clear();

        foreach ($ac as $v)
            $this->appHasPayMethodProviderCountry[]= new AppHasPayMethodProviderCountry($v, $this);

        return $this;
    }

    /**
     * Set appApiHasCredential
     *
     * @param \AppBundle\Entity\AppApiCredentials $appApiHasCredential
     * @return App
     */
    public function setAppApiHasCredential(\AppBundle\Entity\AppApiCredentials $appApiHasCredential = null)
    {
        $this->appApiHasCredential = $appApiHasCredential;

        return $this;
    }

    /**
     * Get appApiHasCredential
     *
     * @return \AppBundle\Entity\AppApiCredentials
     */
    public function getAppApiHasCredential()
    {
        return $this->appApiHasCredential;
    }


    /**
     * Set translationDomain
     *
     * @param string $translationDomain
     * @return App
     */
    public function setTranslationDomain($translationDomain)
    {
        $this->translationDomain = $translationDomain;

        return $this;
    }

    /**
     * Get translationDomain
     *
     * @return string 
     */
    public function getTranslationDomain()
    {
        return $this->translationDomain;
    }


    /**
     * Set logo
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $logo
     * @return App
     */
    public function setLogo(\Application\Sonata\MediaBundle\Entity\Media $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set taxPercentApplicable
     *
     * @param float $taxPercentApplicable
     * @return App
     */
    public function setTaxPercentApplicable($taxPercentApplicable)
    {
        $this->taxPercentApplicable = $taxPercentApplicable;

        return $this;
    }

    /**
     * Get taxPercentApplicable
     *
     * @return float 
     */
    public function getTaxPercentApplicable()
    {
        return $this->taxPercentApplicable;
    }

    /**
     * Set commissionBase
     *
     * @param string $commissionBase
     * @return App
     */
    public function setCommissionBase($commissionBase)
    {
        $this->commissionBase=$commissionBase;

        return $this;
    }

    /**
     * Get commissionBase
     *
     * @return float
     */
    public function getCommissionBase()
    {
        return $this->commissionBase;
    }

    /**
     * @param  \AppBundle\Entity\Currency $currency
     * @return App
     */
    public function setCommissionCurrency(\AppBundle\Entity\Currency $currency)
    {
        $this ->commissionCurrency = $currency;

        return $this;
    }

    /**
     *  Get commissionCurrency
     *
     * @return \AppBundle\Entity\Currency
     */
    public function getCommissionCurrency()
    {
        return $this->commissionCurrency;
    }

    /**
     * Set commissionMin
     * 
     * @param float  $commission
     * @return App
     */
    public function setCommissionMin($commission)
    {
        $this->commissionMin = $commission;
        
        return $this;
        
    }

    /**
     * Get commissionMin
     * 
     * @return float
     */
    public function getCommissionMin()
    {
        return $this->commissionMin;    
    }

    /**
     * Set commissionMax
     *
     * @param float $commission
     * @return App
     */
    public function setCommissionMax($commission)
    {
        $this->commissionMax = $commission;

        return $this;

    }

    /**
     * Get commissionMax
     *
     * @return float
     */
    public function getCommissionMax()
    {
        return $this->commissionMax;
    }

    /**
     * Set commissionPercent
     *
     * @param float $percentage
     * @return App
     */
    public function setCommissionPercent($percentage)
    {
        $this->commissionPercent = $percentage;

        return $this;

    }

    /**
     * Get commissionPercent
     *
     * @return float
     */
    public function getCommissionPercent()
    {
        return $this->commissionPercent;
    }

    /**
     * Set commissionFixedFee
     *
     * @param float $fixedFee
     * @return App
     */
    public function setCommissionFixedFee($fixedFee)
    {
        $this->commissionFixedFee = $fixedFee;

        return $this;

    }

    /**
     * Get commissionFixedFee
     *
     * @return float
     */
    public function getCommissionFixedFee()
    {
        return $this->commissionFixedFee;
    }
    
    /**
     * Set smsAlias
     *
     * @param string $smsAlias
     * @return App
     */
    public function setSmsAlias($smsAlias)
    {
        $this->smsAlias = $smsAlias;

        return $this;
    }

    /**
     * Get smsAlias
     *
     * @return string 
     */
    public function getSmsAlias()
    {
        return $this->smsAlias;
    }

    /**
     * @param \AppBundle\Entity\AppShop[] $appShops
     */
    public function setAppShops($appShops)
    {
        $this->appShops = $appShops;
    }

    /**
     * Add payMethodProviderHasCountries
     *
     * @param \AppBundle\Entity\ClientUserHasApp $clientUsersHasApps
     * @return App
     */
    public function addClientUsersHasApp(\AppBundle\Entity\ClientUserHasApp $clientUsersHasApps)
    {
        $this->clientUsersHasApps[] = $clientUsersHasApps;

        return $this;
    }

    /**
     * Remove payMethodProviderHasCountries
     *
     * @param \AppBundle\Entity\ClientUserHasApp $clientUsersHasApps
     * @internal param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountries
     */
    public function removeClientUsersHasApp(\AppBundle\Entity\ClientUserHasApp $clientUsersHasApps)
    {
        $this->clientUsersHasApps->removeElement($clientUsersHasApps);
    }

    /**
     * @return \AppBundle\Entity\ClientUserHasApp[]
     */
    public function getClientUsersHasApps()
    {
        return $this->clientUsersHasApps;
    }


    /**
     * @param \AppBundle\Entity\Country[] $countries
     * @return $this
     */
    public function setCountries($countries)
    {
        $this->countries->clear();

        foreach ($countries as $country)
            $this->countries[] = $country;

        return $this;
    }

    /**
     * @param Country $country
     * @return App
     */
    public function addCountry(Country $country)
    {
        if (!$this->countries->contains($country))
            $this->countries[] = $country;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param $id
     * @return Country|null
     */
    public function hasCountry($id)
    {
        foreach ($this->countries as $country)
        {
            if ($country->getId() == $id)
                return $country;
        }
        return false;
    }



    /**
     * Remove country
     *
     * @param \AppBundle\Entity\Country $country
     */
    public function removeCountry(Country $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * Remove all countries
     */
    public function removeAllCountries()
    {
        $this->countries->clear();
    }

    /************************************ BLACKLIST COUNTRIES  *******************************************/

    /**
     * @param \AppBundle\Entity\Country[] $countries
     * @return $this
     */
    public function setBlacklistedCountries($countries)
    {
        $this->blacklistedCountries->clear();

        foreach ($countries as $country)
            $this->blacklistedCountries[] = $country;

        return $this;
    }

    /**
     * @param Country $country
     * @return App
     */
    public function addBlacklistedCountry(Country $country)
    {
        if (!$this->blacklistedCountries->contains($country))
            $this->blacklistedCountries[] = $country;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country[]
     */
    public function getBlacklistedCountries()
    {
        return $this->blacklistedCountries;
    }

    /**
     * @param $countryId
     * @return boolean
     */
    public function hasBlacklistedCountry($countryId)
    {
        foreach ($this->blacklistedCountries as $blacklistedCountry)
        {
            if ($blacklistedCountry->getId() == $countryId)
                return true;
        }
        return false;
    }

    /**
     * Remove Blacklisted country
     *
     * @param \AppBundle\Entity\Country $country
     * @return $this
     */
    public function removeBlacklistedCountry(\AppBundle\Entity\Country $country)
    {
        $this->blacklistedCountries->removeElement($country);
        return $this;
    }

    /**
     * Remove all blacklisted countries
     * @return $this
     */
    public function removeAllBlacklistedCountries()
    {
        $this->blacklistedCountries->clear();
        return $this;
    }

    /**
     * @param Gamer $gamer
     * @return App
     */
    public function addGamer(Gamer $gamer)
    {
        if (!$this->gamers->contains($gamer))
            $this->gamers[] = $gamer;

        return $this;
    }

    /************************************ BLACKLIST GAMERS *******************************************/

    /**
     * @param Gamer $gamer
     * @return App
     */
    public function blacklistGamer(Gamer $gamer)
    {
        $gamer->setBlacklisted();
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Gamer[]
     */
    public function getBlacklistedGamers()
    {
        $criteria = Criteria::create();

        $criteria->where(Criteria::expr()->eq('blacklisted', true));
        $sal =  $this->gamers->matching($criteria);
        return $sal;

    }

    /**
     * @param $gamerId
     * @return boolean
     */
    public function hasBlacklistedGamer($gamerId)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('blacklisted', true))->andWhere(Criteria::expr()->eq('id', $gamerId));
        return !$this->gamers->matching($criteria)->isEmpty();
    }

    /**
     * UN-blacklist  gamer
     *
     * @param string $gamerId
     * @return $this
     */
    public function unBlacklistGamer($gamerId) {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('blacklisted', true))->andWhere(Criteria::expr()->eq('id', $gamerId));
        $m=$this->gamers->matching($criteria);
        $m->map(function($gamer){ $gamer->unsetBlacklisted(); });
        return $this;
    }

    /**
     * UN-blacklisted all gamers
     * @return $this
     */
    public function unBlacklistAllGamers(){
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('blacklisted', true));
        $m=$this->gamers->matching($criteria);
        $m->map( function($gamer){ $gamer->unsetBlacklisted(); }  );
        return $this;
    }

    /************************************ BLACKLIST IPs *******************************************/

    /**
     * @param $ip
     * @param bool $isIPv6
     * @return App
     */
    public function addBlacklistedIP($ip, $isIPv6=false)
    {
        if (!$this->isBlacklistedIpValid($ip))
            return $this;

        if ($this->blacklistedIPs == null)
            $this->blacklistedIPs = [];

        $this->blacklistedIPs[$ip] = [
            'ip'        => $ip,
            'createdAt' => new \DateTime('now'),
            'isRange'   => $this->hasRange($ip),
            'isIPv6'    => $isIPv6
        ];

        return $this;
    }

    private function hasRange($ip)
    {
        return preg_match('/(\-|\/|\*)/', $ip) === 1;
    }

    public function isBlacklistedIpValid($ip)
    {
        return preg_match('/'.self::REGEX_VALID_BLACKLIST_IP.'/', $ip) === 1;
    }

    /**
     * @param $arrayIPs
     * @return App
     */
    public function addBlacklistedIPsArray($arrayIPs){
        if ($this->blacklistedIPs)
        {
            $this->blacklistedIPs = array_merge($this->blacklistedIPs, $arrayIPs);
        }
        else
        {
            $this->blacklistedIPs = $arrayIPs;
        }
        return $this;
    }

    /**
     * @param $ip
     * @return App
     */
    public function removeBlacklistedIP($ip)
    {
        if ($this->blacklistedIPs && isset($this->blacklistedIPs[$ip]))
        {
            unset($this->blacklistedIPs[$ip]);
        }
        return $this;
    }

    /**
     * @param bool $onlyNotRanges
     * @return array
     */
    public function getBlacklistedIPs($onlyNotRanges=false){
        if ($onlyNotRanges) {
            $sal = array();
            foreach ($this->blacklistedIPs as $ip => $values) {
                if ($values['isRange']===false) {
                    $sal[$ip] = $values;
                }
            }
        }
        return $this->blacklistedIPs;
    }
    /**
     * @return array
     */
    public function getBlacklistedRanges(){
        $sal=array();
        foreach ($this->blacklistedIPs as $ip => $values){
            if ($values['isRange']){
                $sal[$ip]=$values;
            }
        }
        return $sal;
    }

    /**
     * @param $ip
     * @return bool
     *
     */
    public function hasBlacklistedIP($ip)
    {
        return array_key_exists($ip, $this->blacklistedIPs);
    }

    /**
     * @return App
     */
    public function removeAllBlacklistedIPs(){
        $this->blacklistedIPs = array();
        return $this;
    }

    /************************************ TESTING  GAMERS *******************************************/
    /**
     * @param Gamer $gamer
     * @return App
     */
    public function setForTestingGamer(Gamer $gamer)
    {
        $gamer->setForTesting();
        return $this;
    }

    /**
     * @param String $gamerExternalId
     * @return App
     */
    public function setForTestingGamerExternalId($gamerExternalId)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('gamerExternalId', $gamerExternalId));
        $m=$this->gamers->matching($criteria);
        $m->map( function($gamer){ $gamer->setForTesting(); } );
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Gamer[]
     */
    public function getForTestingGamers()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('forTesting', true));
        $sal =  $this->gamers->matching($criteria);
        return $sal;

    }

    /**
     * @param $gamerExternalId
     * @return boolean
     */
    public function hasForTestingExternalGamerId($gamerExternalId)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('forTesting', true))->andWhere(Criteria::expr()->eq('gamerExternalId', $gamerExternalId));
        return !$this->gamers->matching($criteria)->isEmpty();
    }
    /**
     * @param Gamer $gamer
     * @return boolean
     */
    public function hasForTestingGamer(Gamer $gamer)
    {
        return $gamer->isForTesting();
    }

    /**
     * UNset For Testing  gamer
     *
     * @param string $gamerExternalId
     * @return $this
     */
    public function UnsetForTestingGamerExternalId($gamerExternalId) {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('forTesting', true))->andWhere(Criteria::expr()->eq('gamerExternalId', $gamerExternalId));
        $m=$this->gamers->matching($criteria);
        $m->map( function($gamer){ $gamer->unsetForTesting(); } );
        return $this;
    }

    /**
     * UNset For Testing  gamer
     *
     * @param Gamer $gamer
     * @return $this
     */
    public function UnsetForTestingGamer(Gamer $gamer) {
        $gamer->unsetForTesting();
        return $this;
    }

    /**
     * UNset For Testing all  gamers
     *
     * @return $this
     */
    public function UnsetForTestingAllGamers() {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('forTesting', true));
        $m=$this->gamers->matching($criteria);
        $m->map( function($gamer){ $gamer->unsetForTesting(); } );
        return $this;
    }

    /************************************ END TESTING  GAMERS *******************************************/

    /**
     * @param \AppBundle\Entity\Language[] $languages
     * @return $this
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * Add languages
     *
     * @param \AppBundle\Entity\Language $language
     * @return App
     */
    public function addLanguage(\AppBundle\Entity\Language $language)
    {
        if (!$this->languages->contains($language))
            $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \AppBundle\Entity\Language $languages
     */
    public function removeLanguage(\AppBundle\Entity\Language $languages)
    {
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return Language[]
     */
    public function getLanguages()
    {
        return $this->languages;
    }


    /**
     * @param string $internalPaymentNotificationUrl
     * @return $this
     */
    public function setInternalPaymentNotificationUrl($internalPaymentNotificationUrl)
    {
        $this->internalPaymentNotificationUrl = $internalPaymentNotificationUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getInternalPaymentNotificationUrl()
    {
        return $this->internalPaymentNotificationUrl;
    }

    /**
     * Add appHasPayMethodProviderCountry
     *
     * @param \AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountry
     * @return App
     */
    public function addAppHasPayMethodProviderCountry(\AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountry)
    {
        if ($appHpmp = $this->hasPayMethodProviderCountry($appHasPayMethodProviderCountry->getPayMethodProviderHasCountry()))
        {
            $appHpmp->setActive($appHasPayMethodProviderCountry->getActive());

        }else{

            $appHasPayMethodProviderCountry->setApp($this);
            $this->appHasPayMethodProviderCountry[] = $appHasPayMethodProviderCountry;
        }

        return $this;
    }

    /**
     * Remove appHasPayMethodProviderCountry
     *
     * @param \AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountry
     */
    public function removeAppHasPayMethodProviderCountry(\AppBundle\Entity\AppHasPayMethodProviderCountry $appHasPayMethodProviderCountry)
    {
        $this->appHasPayMethodProviderCountry->removeElement($appHasPayMethodProviderCountry);
    }

    /**
     * Get appHasPayMethodProviderCountry
     *
     * @return \AppBundle\Entity\AppHasPayMethodProviderCountry[]
     */
    public function getAppHasPayMethodProviderCountry()
    {
        return $this->appHasPayMethodProviderCountry;
    }

    /**
     * @param PayMethodProviderHasCountry $pmpc
     * @return AppHasPayMethodProviderCountry|bool
     */
    public function hasPayMethodProviderCountry(PayMethodProviderHasCountry $pmpc)
    {
        /** @var LazyCriteriaCollection $result */
        $criteria = Criteria::create()->where(Criteria::expr()->eq("payMethodProviderHasCountry", $pmpc));
        $result = $this->appHasPayMethodProviderCountry->matching($criteria);

        return $result->count() == 1 ? $result->getValues()[0] : false;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (($this->commissionFixedFee || $this->commissionMax || $this->commissionMin) && !$this->getCommissionCurrency() )
        {
            $context
                ->buildViolation('Commision currency must be set')
                ->atPath('commissionCurrency')
                ->addViolation();
        }
    }

    /**
     * @return AppLevel[]
     */
    public function getAppLevels()
    {
        return $this->appLevels;
    }

    /**
     * @param AppLevel[] $appLevels
     *
     * @return App
     */
    public function setAppLevels($appLevels)
    {
        $this->appLevels = $appLevels;

        return $this;
    }

    /**
     * @param boolean $hasVirtualCurrencyEnabled
     * @return $this
     */
    public function setHasVirtualCurrencyEnabled($hasVirtualCurrencyEnabled)
    {
        $this->hasVirtualCurrencyEnabled = $hasVirtualCurrencyEnabled;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasVirtualCurrencyEnabled()
    {
        return $this->hasVirtualCurrencyEnabled;
    }

    /**
     * @param \AppBundle\Entity\AppTab $appTabs
     * @return $this
     */
    public function setAppTabs($appTabs)
    {
        $this->appTabs = $appTabs;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppTab[]
     */
    public function getAppTabs()
    {
        return $this->appTabs;
    }

    /**
     * @param boolean $canCustomizeAppTabs
     * @return $this
     */
    public function setCanCustomizeAppTabs($canCustomizeAppTabs)
    {
        $this->canCustomizeAppTabs = $canCustomizeAppTabs;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCanCustomizeAppTabs()
    {
        return $this->canCustomizeAppTabs;
    }

    /**
     * @return string
     */
    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    /**
     * @param string $ownerEmail
     * @return App
     */
    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdministrationEmail()
    {
        return $this->administrationEmail;
    }

    /**
     * @param string $administrationEmail
     * @return App
     */
    public function setAdministrationEmail($administrationEmail)
    {
        $this->administrationEmail = $administrationEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getTechnicalEmail()
    {
        return $this->technicalEmail;
    }

    /**
     * @param string $technicalEmail
     * @return App
     */
    public function setTechnicalEmail($technicalEmail)
    {
        $this->technicalEmail = $technicalEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndUserSupportEmail()
    {
        return $this->endUserSupportEmail;
    }

    /**
     * @param string $endUserSupportEmail
     * @return App
     */
    public function setEndUserSupportEmail($endUserSupportEmail)
    {
        $this->endUserSupportEmail = $endUserSupportEmail;
        return $this;
    }

    /**
     * @return int
     */
    public function getNotificationRetriesOnFailure()
    {
        return $this->notificationRetriesOnFailure;
    }

    /**
     * @param int $notificationRetriesOnFailure
     *
     * @return App
     */
    public function setNotificationRetriesOnFailure($notificationRetriesOnFailure)
    {
        if ($notificationRetriesOnFailure<0)$notificationRetriesOnFailure=0;
        $this->notificationRetriesOnFailure = $notificationRetriesOnFailure;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\ClientHasProviderCredential[]
     */
    public function getAppHasProviderClientCredentials()
    {
        return $this->client->getClientHasProviderCredentials();
    }

    /**
     * @return LazyCriteriaCollection
     */
    public function getAppHasPayMethodProviderHasCountryIsActive()
    {
        $criteria = Criteria::create();

        $criteria
            ->where(Criteria::expr()->eq('active', true))
        ;
        return $this->appHasPayMethodProviderCountry->matching($criteria);
    }

    /**
     * @param Country $countryId
     * @return AppHasPayMethodProviderCountry[]|LazyCriteriaCollection
     */
    public function getAppHasPayMethodProviderHasCountryIsActiveAndCountryId($countryId)
    {
        $em = UtilHelper::getEntityManagerFromPersistentCollection($this->appHasPayMethodProviderCountry);
        $qb = $em->createQueryBuilder();

        $qb
            ->select('pmpc.id')
            ->from('AppBundle:PayMethodProviderHasCountry', 'pmpc')
            ->Where('pmpc.country = ?1')
            ->setParameter(1, $countryId)
        ;

        $query = $qb->getQuery();
        $pmpcsIds = $query->getScalarResult();
        $pmpcsIds = array_map('current', $pmpcsIds);

        $criteria = Criteria::create();

        $criteria
            ->where(Criteria::expr()->eq('active', true))
            ->andWhere(
                $criteria->expr()->in('payMethodProviderHasCountry', $pmpcsIds)
            )
        ;

        return $this->appHasPayMethodProviderCountry->matching($criteria);
    }

    /**
     * @param Provider $provider
     * @return ClientHasProviderCredential
     */
    public function getProviderClientCredentials(Provider $provider)
    {
        return $this->client->getProviderClientCredentialsForApp($provider, $this);
    }

    /**
     * @return string
     */
    public function getUrlNotificationNewGamer()
    {
        return $this->urlNotificationNewGamer;
    }

    /**
     * @param string $urlNotificationNewGamer
     * @return App
     */
    public function setUrlNotificationNewGamer($urlNotificationNewGamer)
    {
        $this->urlNotificationNewGamer = $urlNotificationNewGamer;
        return $this;
    }



    /**
     * Set blacklistedIPs
     *
     * @param array $blacklistedIPs
     *
     * @return App
     */
    public function setBlacklistedIPs($blacklistedIPs)
    {
        $this->blacklistedIPs = $blacklistedIPs;

        return $this;
    }

    /**
     * Get hasVirtualCurrencyEnabled
     *
     * @return boolean
     */
    public function getHasVirtualCurrencyEnabled()
    {
        return $this->hasVirtualCurrencyEnabled;
    }

    /**
     * Add appTab
     *
     * @param \AppBundle\Entity\AppTab $appTab
     *
     * @return App
     */
    public function addAppTab(\AppBundle\Entity\AppTab $appTab)
    {
        $this->appTabs[] = $appTab;

        return $this;
    }

    /**
     * Remove appTab
     *
     * @param \AppBundle\Entity\AppTab $appTab
     */
    public function removeAppTab(\AppBundle\Entity\AppTab $appTab)
    {
        $this->appTabs->removeElement($appTab);
    }

    /**
     * Add itemTab
     *
     * @param \AppBundle\Entity\ItemTab $itemTab
     *
     * @return App
     */
    public function addItemTab(\AppBundle\Entity\ItemTab $itemTab)
    {
        $this->itemTabs[] = $itemTab;

        return $this;
    }

    /**
     * Remove itemTab
     *
     * @param \AppBundle\Entity\itemTab $itemTab
     */
    public function removeItemTab(\AppBundle\Entity\itemTab $itemTab)
    {
        $this->itemTabs->removeElement($itemTab);
    }

    /**
     * Get itemTabs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemTabs()
    {
        return $this->itemTabs;
    }

    /**
     * Add appLevel
     *
     * @param \AppBundle\Entity\LevelCategory $appLevel
     *
     * @return App
     */
    public function addAppLevel(\AppBundle\Entity\LevelCategory $appLevel)
    {
        $this->appLevels[] = $appLevel;

        return $this;
    }

    /**
     * Remove appLevel
     *
     * @param \AppBundle\Entity\LevelCategory $appLevel
     */
    public function removeAppLevel(\AppBundle\Entity\LevelCategory $appLevel)
    {
        $this->appLevels->removeElement($appLevel);
    }

    /**
     * Remove gamer
     *
     * @param \AppBundle\Entity\Gamer $gamer
     */
    public function removeGamer(\AppBundle\Entity\Gamer $gamer)
    {
        $this->gamers->removeElement($gamer);
    }

    /**
     * Get gamers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGamers()
    {
        return $this->gamers;
    }

    /**
     * @param float|null $payMethodsMaxFeeProviderPercent
     * @return $this
     */
    public function setPayMethodsMaxFeeProviderPercent($payMethodsMaxFeeProviderPercent)
    {
        $this->payMethodsMaxFeeProviderPercent = $payMethodsMaxFeeProviderPercent;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPayMethodsMaxFeeProviderPercent()
    {
        return $this->payMethodsMaxFeeProviderPercent;
    }

    /**
     * @param boolean $costOfLiveIsEnabled
     * @return $this
     */
    public function setCostOfLiveIsEnabled($costOfLiveIsEnabled)
    {
        $this->costOfLiveIsEnabled = $costOfLiveIsEnabled;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCostOfLiveIsEnabled()
    {
        return $this->costOfLiveIsEnabled;
    }

    /**
     * @param boolean $prettyPriceIsEnabled
     * @return $this
     */
    public function setPrettyPriceIsEnabled($prettyPriceIsEnabled)
    {
        $this->prettyPriceIsEnabled = $prettyPriceIsEnabled;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPrettyPriceIsEnabled()
    {
        return $this->prettyPriceIsEnabled;
    }

    /**
     * @param boolean $payMethodsAddFeeToFinalAmount
     * @return $this
     */
    public function setPayMethodsAddFeeToFinalAmount($payMethodsAddFeeToFinalAmount)
    {
        $this->payMethodsAddFeeToFinalAmount = $payMethodsAddFeeToFinalAmount;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPayMethodsAddFeeToFinalAmount()
    {
        return $this->payMethodsAddFeeToFinalAmount;
    }

    /**
     * @param boolean $taxToFinalAmount
     * @return $this
     */
    public function setTaxToFinalAmount($taxToFinalAmount)
    {
        $this->taxToFinalAmount = $taxToFinalAmount;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getTaxToFinalAmount()
    {
        return $this->taxToFinalAmount;
    }

    /**
     * @param boolean $wolopayFeeToFinalAmount
     * @return $this
     */
    public function setWolopayFeeToFinalAmount($wolopayFeeToFinalAmount)
    {
        $this->wolopayFeeToFinalAmount = $wolopayFeeToFinalAmount;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getWolopayFeeToFinalAmount()
    {
        return $this->wolopayFeeToFinalAmount;
    }

    /**
     * @return int
     */
    public function getSecondsToJoinTransactions()
    {
        return $this->secondsToJoinTransactions;
    }

    /**
     * @param int $secondsToJoinTransactions
     * @return $this
     */
    public function setSecondsToJoinTransactions($secondsToJoinTransactions)
    {
        $this->secondsToJoinTransactions = $secondsToJoinTransactions;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalAppId()
    {
        return $this->externalAppId;
    }

    /**
     * @param string $externalAppId
     * @return $this
     */
    public function setExternalAppId($externalAppId)
    {
        $this->externalAppId = $externalAppId;
        return $this;
    }



}
