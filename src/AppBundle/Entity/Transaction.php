<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\SuperClass\AppShopBase;
use AppBundle\Validator\Constraints as AppBundleAsserts;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Transaction
 *
 * @ORM\Table(name="`transaction`")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TransactionRepository")
 * @ORM\AssociationOverrides({
 *      @ORM\AssociationOverride(name="levelCategory",
 *          joinColumns=@ORM\JoinColumn(
 *              name="level_category_id", referencedColumnName="id", nullable=true
 *          )
 *      ),
 *      @ORM\AssociationOverride(name="css",
 *          joinColumns=@ORM\JoinColumn(
 *              name="shop_css_id", referencedColumnName="id", nullable=true
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="valueLower",
 *          column = @ORM\Column(
 *              type     = "integer",
 *              name     = "value_lower",
 *              nullable = true
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="valueHigher",
 *          column = @ORM\Column(
 *              type     = "integer",
 *              name     = "value_higher",
 *              nullable = true
 *          )
 *      )
 * })
 * @ExclusionPolicy("all")
 * @XmlRoot("transaction")
 * @AppBundleAsserts\TransactionGeneral()
 */
class Transaction extends AppShopBase implements UserInterface
{
    const PREFIX = 'WOT_';

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="string", length=100)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppApiCredentials
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\AppApiCredentials")
     * @ORM\JoinColumn(name="app_api_crendetials_id", referencedColumnName="id", nullable=false)
     */
    private $apiCrendetials;

    /**
     * @var \AppBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $languageDefault;

    /**
     * @var \AppBundle\Entity\Purchase[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Purchase", mappedBy="transaction")
     */
    private $purchases;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gamer")
     * @ORM\JoinColumn(name="gamer_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     * @Assert\NotBlank()
     * @AppBundleAsserts\SameApp()
     */
    private $gamer;

    /**
     * @var \AppBundle\Entity\TransactionStatusCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TransactionStatusCategory")
     * @ORM\JoinColumn(name="state_category_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $statusCategory;

    /**
     * External stores like 'facebook', 'steam', 'mobage'
     * @var string
     *
     * @ORM\Column(name="external_store", type="string", nullable=true)
     */
    protected $externalStore;




    /**
     * @var \AppBundle\Entity\Country[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinTable(name="transaction_has_countries_available")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $countriesAvailable;

    /**
     * settled in the shop
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_detected_id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $countryDetected;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fixed_country", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $fixedCountry=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fixed_language", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $fixedLanguage=false;

    /**
     * @var AppTab
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AppTab")
     * @ORM\JoinTable(name="transaction_has_app_tabs_available")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $appTabsAvailable;

    /**
     * This Url is used to redirect to the shop on createTransaction in a iframe or a new window
     *
     * @deprecated only for serialization
     * @Type("string")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $url;

    /**
     * This Url is used to redirect to the shop on createTransaction, It'll be loaded in same page via ajax, it have a requirement.
     * Must be exist a div with class "wolo-container".
     *
     * @deprecated only for serialization
     * @Type("string")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $urlJs;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    protected $reason;

    /**
     * @var string
     *
     * @Assert\Url()
     * @ORM\Column(name="url_notification", type="string", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    protected $urlNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="value_current", type="integer", nullable=true)
     * @Assert\NotBlank(groups={"transactionBasic"})
     * @Assert\Type("numeric")
     */
    protected $valueCurrent=null;

    /**
     * @var \AppBundle\Entity\PayMethod[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PayMethod")
     * @ORM\JoinTable(name="transaction_has_pay_methods_available")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $payMethodsAvailable;

    /**
     * @var \AppBundle\Entity\Article[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinTable(name="transaction_has_articles_available")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $articlesAvailable;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="selected_article_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $selectedArticle;

    /**
     * @var \AppBundle\Entity\AppTab
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppTab")
     * @ORM\JoinColumn(name="selected_app_tab_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $selectedAppTab;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_param", type="string", length=125, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     *
     * To Basic transaction like Custom
     */
    private $customParam;

    /**
     * @var String
     *
     * @Assert\Url()
     * @ORM\Column(name="`return`", type="string", length=255, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $return;

    /**
     * @var float
     *
     * @ORM\Column(name="custom_amount", type="float", scale=2, precision=10, nullable=true)
     * @Assert\Type("numeric")
     * @Assert\GreaterThan(value="0")
     * @Assert\NotBlank(groups={"custom"})
     */
    protected $customAmount=null;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="custom_currency_id", referencedColumnName="id", nullable=true)
     * @Assert\NotBlank(groups={"custom"})
     */
    private $customCurrency=null;

    /**
     * @var \AppBundle\Entity\PayMethod
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethod")
     * @ORM\JoinColumn(name="custom_pay_method_id", referencedColumnName="id", nullable=true)
     * @Assert\NotBlank(groups={"custom"})
     */
    private $customPayMethod=null;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="custom_country_id", referencedColumnName="id", nullable=true)
     * @Assert\NotBlank(groups={"custom"})
     */
    private $customCountry=null;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_article_title", type="string", nullable=true)
     * @Assert\NotBlank(groups={"custom"})
     */
    protected $customArticleTitle=null;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_article_description", type="text", nullable=true)
     */
    protected $customArticleDescription=null;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="article_virtual_currency_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @AppBundleAsserts\SameApp()
     */
    private $articleVirtualCurrency;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_virtual_currency_id", referencedColumnName="id", nullable=true)
     */
    private $countryVirtualCurrency;

    /**
     * Force generic PMPC like facebook
     *
     * @var String
     *
     * @ORM\Column(name="force_generic_pmpc", type="string", nullable=true)
     */
    protected $forceGenericPMPC = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="first_pay_methods", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $firstPayMethods=false;

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
     * @ORM\Column(name="has_pay_methods_section", type="boolean", nullable=false)
     */
    private $hasPayMethodsSection=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cli", type="boolean", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $cli=false;

    /**
     * @ var string
     * @ORM\Column(name="gamer_ip", type="string", nullable=true)
     */
    private $gamerIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_at", type="datetime", nullable=true)
     */
    private $expireAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $expiredAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $beginAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $endAt;

    /**
     * Constructor
     */
    public function __construct(Gamer $gamer=null, AppShop $appShop=null, $currentValue=null)
    {
        $this->beginAt = new \DateTime('now');
        $this->id = uniqid(self::PREFIX);

        $this->gamer = $gamer;

        if ($gamer)
            $this->app = $gamer->getApp();

        $this->valueCurrent = $currentValue;

        if ($appShop)
            $this->setAppShopMapped($appShop);

        $this->appTabsAvailable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countriesAvailable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesAvailable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payMethodsAvailable = new \Doctrine\Common\Collections\ArrayCollection();
        $this->purchases = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct();
    }

    public function __toString()
    {
        return $this->getId();
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
     * Set Url for transaction serialization
     *
     * @param $url
     * @return Transaction
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set Url for transaction serialization
     *
     * @param $urlJs
     * @return Transaction
     */
    public function setUrlJs($urlJs)
    {
        $this->urlJs = $urlJs;

        return $this;
    }

    /**
     * Set gamer
     *
     * @param \AppBundle\Entity\Gamer $gamer
     * @return Transaction
     */
    public function setGamer(\AppBundle\Entity\Gamer $gamer = null)
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
     * Set id
     *
     * @param string $id
     * @return Transaction
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
     * @return Transaction
     */
    private function setBeginAt($beginAt)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Transaction
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Set setEndAtNow
     *
     * @return Transaction
     */
    public function setEndAtNow()
    {
        $this->endAt = new \DateTime('now');

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param \DateTime $expireAt
     * @return $this
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @param \DateTime $expiredAt
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * Set setEndAtNow
     *
     * @return Transaction
     */
    public function setExpiredAtNow()
    {
        $this->expiredAt = new \DateTime('now');

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }



    /**
     * @param \AppBundle\Entity\TransactionStatusCategory $statusCategory
     * @return Transaction
     */
    public function setStatusCategory($statusCategory)
    {
        $this->statusCategory = $statusCategory;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\TransactionStatusCategory
     */
    public function getStatusCategory()
    {
        return $this->statusCategory;
    }

    /**
     * Set apiCrendetials
     *
     * @param \AppBundle\Entity\AppApiCredentials $apiCrendetials
     * @return Transaction
     */
    public function setApiCrendetials(\AppBundle\Entity\AppApiCredentials $apiCrendetials)
    {
        $this->apiCrendetials = $apiCrendetials;

        return $this;
    }

    /**
     * Get apiCrendetials
     *
     * @return \AppBundle\Entity\AppApiCredentials
     */
    public function getApiCrendetials()
    {
        return $this->apiCrendetials;
    }


    /**
     * Set valueCurrent
     *
     * @param integer $valueCurrent
     * @return Transaction
     */
    public function setValueCurrent($valueCurrent)
    {
        $this->valueCurrent = $valueCurrent;

        return $this;
    }

    /**
     * Get valueCurrent
     *
     * @return integer
     */
    public function getValueCurrent()
    {
        return $this->valueCurrent;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    public function getLogsFolder()
    {
        return 'transactions/' . $this->getApp()->getId() . '/' . $this->getBeginAt()->format('Y-m-d');
    }

    public function getLogFilePath()
    {
        return $this->getLogsFolder().'/'.$this->getId().'.log';
    }

    /**
     * Get levelCategory
     *
     * @return \AppBundle\Entity\LevelCategory
     */
    public function getLevelCategory()
    {
        return $this->levelCategory;
    }

    public function getRoles()
    {
        $roles = [RoleEnum::TRANSACTION];

        if (!$this->statusCategory)
            return $roles;

//        if ($this->getExpiredAt())
//            return $roles;

        $arr= [
            TransactionStatusCategoryEnum::BEGIN_ID,
            TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
            TransactionStatusCategoryEnum::SHOPPING_ID,
            TransactionStatusCategoryEnum::FAILED_ID,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_SHOPPING;
        }

        $arr= [
            TransactionStatusCategoryEnum::SHOPPING_ID,
            TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
            TransactionStatusCategoryEnum::FAILED_ID,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_PAYMENT_CHECK_IN;
        }

        $arr= [
            TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
            TransactionStatusCategoryEnum::PENDING_PAYMENT_ID,
            TransactionStatusCategoryEnum::FAILED_ID,
            TransactionStatusCategoryEnum::COMPLETED_ID,
            TransactionStatusCategoryEnum::BLOCKED_ID,
            TransactionStatusCategoryEnum::EXPIRED_ID,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_PAYMENT_CHECK_OUT;
        }

        $arr= [
            TransactionStatusCategoryEnum::PENDING_PAYMENT_ID,
            TransactionStatusCategoryEnum::COMPLETED_ID,
            TransactionStatusCategoryEnum::BLOCKED_ID,
            TransactionStatusCategoryEnum::EXPIRED_ID,
            TransactionStatusCategoryEnum::BLACKLISTED_COUNTRY,
            TransactionStatusCategoryEnum::BLACKLISTED_GAMER,
            TransactionStatusCategoryEnum::BLACKLISTED_IP,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_FINISHED;
        }

        $arr= [
            TransactionStatusCategoryEnum::COMPLETED_ID,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_PAYMENT_REFUND;
        }

        $arr= [
            TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
            TransactionStatusCategoryEnum::PENDING_PAYMENT_ID,
            TransactionStatusCategoryEnum::FAILED_ID,
            TransactionStatusCategoryEnum::BLOCKED_ID,
            TransactionStatusCategoryEnum::EXPIRED_ID,
        ];

        if (in_array($this->statusCategory->getId(), $arr ))
        {
            $roles[]= RoleEnum::TRANSACTION_PAYMENT_CANCELLED;
        }

        return $roles;
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->id;
    }

    public function eraseCredentials()
    {
    }


    /**
     * Set languageDefault
     *
     * @param \AppBundle\Entity\Language $languageDefault
     * @return Transaction
     */
    public function setLanguageDefault(\AppBundle\Entity\Language $languageDefault = null)
    {
        $this->languageDefault = $languageDefault;

        return $this;
    }

    /**
     * Get languageDefault
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguageDefault()
    {
        return $this->languageDefault;
    }

    /**
     * Add countriesAvailable
     *
     * @param \AppBundle\Entity\Country $countriesAvailable
     * @return Transaction
     */
    public function addCountriesAvailable(\AppBundle\Entity\Country $countriesAvailable)
    {
        $this->countriesAvailable[] = $countriesAvailable;

        return $this;
    }

    /**
     * Add countriesAvailable
     *
     * @param \AppBundle\Entity\Country[] $countriesAvailable
     * @return Transaction
     */
    public function setCountriesAvailable(array $countriesAvailable)
    {
        foreach ($countriesAvailable as $country)
            $this->addCountriesAvailable($country);

        return $this;
    }

    /**
     * Remove countriesAvailable
     *
     * @param \AppBundle\Entity\Country $countriesAvailable
     */
    public function removeCountriesAvailable(\AppBundle\Entity\Country $countriesAvailable)
    {
        $this->countriesAvailable->removeElement($countriesAvailable);
    }

    /**
     * Get countriesAvailable
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountriesAvailable()
    {
        return $this->countriesAvailable;
    }

    /**
     * Get countriesAvailable
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountriesAvailableCurrent()
    {
        if ($this->countriesAvailable->isEmpty())
            $this->app->getCountries();

        return $this->app->getCountries();
    }

    /**
     * @param boolean $fixedCountry
     * @return $this
     */
    public function setFixedCountry($fixedCountry)
    {
        $this->fixedCountry = $fixedCountry;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFixedCountry()
    {
        return $this->fixedCountry;
    }


    /**
     * @param \AppBundle\Entity\PayMethod $payMethod
     * @return Transaction
     */
    public function addPayMethodAvailable(\AppBundle\Entity\PayMethod $payMethod)
    {
        $this->payMethodsAvailable[] = $payMethod;

        return $this;
    }

    /**
     * @param PayMethod[] $payMethods
     * @return $this
     */
    public function setPayMethodsAvailable($payMethods)
    {
        foreach ($payMethods as $payMethod)
        {
            $this->addPayMethodAvailable($payMethod);
        }

        return $this;
    }

    /**
     * @return \AppBundle\Entity\PayMethod[]
     */
    public function getPayMethodsAvailable()
    {
        return $this->payMethodsAvailable;
    }


    /**
     * Remove payMethodsAvailable
     *
     * @param \AppBundle\Entity\PayMethod $payMethod
     */
    public function removePayMethodsAvailable(\AppBundle\Entity\PayMethod $payMethod)
    {
        $this->payMethodsAvailable->removeElement($payMethod);
    }


    /**
     * @param Purchase $purchase
     * @return Transaction
     */
    public function addPurchase(\AppBundle\Entity\Purchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Purchase[]
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Remove removePurchase
     *
     * @param \AppBundle\Entity\Purchase $purchase
     */
    public function removePurchase(\AppBundle\Entity\Purchase $purchase)
    {
        $this->purchases->removeElement($purchase);
    }


    /**
     * @param Article $article
     * @return Transaction
     */
    public function addArticlesAvailable(\AppBundle\Entity\Article $article)
    {
        $this->articlesAvailable[] = $article;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Article[]
     */
    public function getArticlesAvailable()
    {
        return $this->articlesAvailable;
    }

    /**
     * @param Article[] $articles
     * @return $this
     */
    public function setArticlesAvailable(array $articles)
    {
        foreach ($articles as $article)
        {
            $this->addArticlesAvailable($article);
        }

        return $this;
    }

    /**
     * Remove articlesAvailable
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticlesAvailable(\AppBundle\Entity\Article $article)
    {
        $this->articlesAvailable->removeElement($article);
    }

    /**
     * @param String $customParam
     * @return $this
     */
    public function setCustomParam($customParam)
    {
        $this->customParam = $customParam;

        return $this;
    }

    /**
     * @return String
     */
    public function getCustomParam()
    {
        return $this->customParam;
    }

    /**
     * @param \AppBundle\Entity\Article $selectedArticle
     * @return $this
     */
    public function setSelectedArticle(\AppBundle\Entity\Article $selectedArticle=null)
    {
        $this->selectedArticle = $selectedArticle;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Article
     */
    public function getSelectedArticle()
    {
        return $this->selectedArticle;
    }

    /**
     * @param String $return
     * @return $this
     */
    public function setReturn($return)
    {
        $this->return = $return;

        return $this;
    }

    /**
     * @return String
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
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
     * @param float $customAmount
     * @return $this
     */
    public function setCustomAmount($customAmount)
    {
        $this->customAmount = $customAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getCustomAmount()
    {
        return $this->customAmount;
    }

    /**
     * @param String $customArticleDescription
     * @return $this
     */
    public function setCustomArticleDescription($customArticleDescription)
    {
        $this->customArticleDescription = $customArticleDescription;
        return $this;
    }

    /**
     * @return String
     */
    public function getCustomArticleDescription()
    {
        return $this->customArticleDescription;
    }

    /**
     * @param String $customArticleTitle
     * @return $this
     */
    public function setCustomArticleTitle($customArticleTitle)
    {
        $this->customArticleTitle = $customArticleTitle;
        return $this;
    }

    /**
     * @return String
     */
    public function getCustomArticleTitle()
    {
        return $this->customArticleTitle;
    }

    /**
     * @param \AppBundle\Entity\Country $customCurrency
     * @return $this
     */
    public function setCustomCurrency($customCurrency)
    {
        $this->customCurrency = $customCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCustomCurrency()
    {
        return $this->customCurrency;
    }

    /**
     * @param \AppBundle\Entity\PayMethod $customPayMethod
     * @return $this
     */
    public function setCustomPayMethod($customPayMethod)
    {
        $this->customPayMethod = $customPayMethod;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PayMethod
     */
    public function getCustomPayMethod()
    {
        return $this->customPayMethod;
    }

    /**
     * @param \AppBundle\Entity\AppTab $selectedAppTab
     * @return $this
     */
    public function setSelectedAppTab($selectedAppTab)
    {
        $this->selectedAppTab = $selectedAppTab;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppTab
     */
    public function getSelectedAppTab()
    {
        return $this->selectedAppTab;
    }

    /**
     * @param \AppBundle\Entity\Country $customCountry
     * @return $this
     */
    public function setCustomCountry($customCountry)
    {
        $this->customCountry = $customCountry;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCustomCountry()
    {
        return $this->customCountry;
    }

    /**
     * @param \AppBundle\Entity\Country $countryDetected
     * @return $this
     */
    public function setCountryDetected($countryDetected)
    {
        $this->countryDetected = $countryDetected;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCountryDetected()
    {
        return $this->countryDetected;
    }

    public function removeFieldsUnnecessaryToCustom()
    {
        $this
            ->setTutorialEnabled(null)
            ->setFixedCountry(null)
            ->setValueHigher(null)
            ->setValueLower(null)
        ;

        $this->css = null;
        $this->levelCategory = null;

        return $this;
    }

    public function removeFieldsUnnecessaryToBasic()
    {
        $this
            ->setCustomArticleTitle(null)
            ->setCustomArticleDescription(null)
            ->setCustomPayMethod(null)
            ->setCustomAmount(null)
            ->setCustomCountry(null)
            ->setCustomCurrency(null)
        ;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->css && !$this->css->getPublic())
        {
            if (!in_array($this->app , $this->css->getApps()->toArray()))
            {
                $context->buildViolation('Invalid theme')
                    ->atPath('css')
                    ->addViolation();
            }
        }
    }

    /**
     * @param \AppBundle\Entity\Article $articleVirtualCurrency
     * @return $this
     */
    public function setArticleVirtualCurrency(Article $articleVirtualCurrency=null)
    {
        $this->articleVirtualCurrency = $articleVirtualCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Article
     */
    public function getArticleVirtualCurrency()
    {
        return $this->articleVirtualCurrency;
    }

    /**
     * @param \AppBundle\Entity\Country $countryVirtualCurrency
     * @return $this
     */
    public function setCountryVirtualCurrency(Country $countryVirtualCurrency=null)
    {
        $this->countryVirtualCurrency = $countryVirtualCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCountryVirtualCurrency()
    {
        return $this->countryVirtualCurrency;
    }

    /**
     * @param boolean $firstPayMethods
     * @return $this
     */
    public function setFirstPayMethods($firstPayMethods)
    {
        $this->firstPayMethods = $firstPayMethods;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFirstPayMethods()
    {
        return $this->firstPayMethods;
    }

    /**
     * Add appTabsAvailable
     *
     * @param \AppBundle\Entity\AppTab $appTabsAvailable
     * @return Transaction
     */
    public function setAppTabsAvailable($appTabsAvailable)
    {
        $this->appTabsAvailable->clear();

        foreach ($appTabsAvailable as $appTabAvailable)
            $this->appTabsAvailable[] = $appTabAvailable;

        return $this;
    }

    /**
     * Add appTabsAvailable
     *
     * @param \AppBundle\Entity\AppTab $appTabsAvailable
     * @return Transaction
     */
    public function addAppTabsAvailable(\AppBundle\Entity\AppTab $appTabsAvailable)
    {
        $this->appTabsAvailable[] = $appTabsAvailable;

        return $this;
    }

    /**
     * Remove appTabsAvailable
     *
     * @param \AppBundle\Entity\AppTab $appTabsAvailable
     */
    public function removeAppTabsAvailable(\AppBundle\Entity\AppTab $appTabsAvailable)
    {
        $this->appTabsAvailable->removeElement($appTabsAvailable);
    }

    /**
     * Get appTabsAvailable
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppTabsAvailable()
    {
        return $this->appTabsAvailable;
    }

    /**
     * @param string $urlNotification
     * @return $this
     */
    public function setUrlNotification($urlNotification)
    {
        $this->urlNotification = $urlNotification;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlNotification()
    {
        return $this->urlNotification;
    }

    /**
     * @param boolean $fixedLanguage
     * @return $this
     */
    public function setFixedLanguage($fixedLanguage)
    {
        $this->fixedLanguage = $fixedLanguage;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFixedLanguage()
    {
        return $this->fixedLanguage;
    }

    /**
     * @return string
     */
    public function getExternalStore()
    {
        return $this->externalStore;
    }

    /**
     * @param string $externalStore
     * @return $this
     */
    public function setExternalStore($externalStore)
    {
        $this->externalStore = $externalStore;
        return $this;
    }


    /**
     * @param boolean $hasPayMethodsSection
     * @return $this
     */
    public function setHasPayMethodsSection($hasPayMethodsSection)
    {
        $this->hasPayMethodsSection = $hasPayMethodsSection;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasPayMethodsSection()
    {
        return $this->hasPayMethodsSection;
    }

    /**
     * @param String $forceGenericPMPC
     * @return $this
     */
    public function setForceGenericPMPC($forceGenericPMPC)
    {
        $this->forceGenericPMPC = $forceGenericPMPC;
        return $this;
    }

    /**
     * @return String
     */
    public function getForceGenericPMPC()
    {
        return $this->forceGenericPMPC;
    }

    /**
     * @return mixed
     */
    public function getGamerIp()
    {
        return $this->gamerIp;
    }

    /**
     * @param mixed $gamerIp
     * return $this
     */
    public function setGamerIp($gamerIp)
    {
        $this->gamerIp = $gamerIp;
        return $this;
    }
}
