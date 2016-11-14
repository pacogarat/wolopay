<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AppShopHasArticles
 *
 * @ORM\Table(name="app_shop_has_articles", indexes={
 *          @Index (name="index_app_shop_has_articles__app_shop_id_article_id", columns={"app_shop_id","article_id"})
 *   },
 *   uniqueConstraints={@ORM\UniqueConstraint(name="ASHA_UNIQUE_", columns={"article_id", "app_shop_id","country_id"})})
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppShopHasArticleRepository")
 * @UniqueEntity({"article", "appShop", "country"})
 * @ORM\HasLifecycleCallbacks()
 * @XmlRoot("app_shop_has_article")
 */
class AppShopHasArticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"AppShopHasArticleFull"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="appShopHasArticles", fetch="LAZY")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", fetch="LAZY")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "AppShopHasArticleFull"})
     */
    private $country;

    /**
     * @var \AppBundle\Entity\AppShop
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppShop", inversedBy="appShopHasArticles", fetch="LAZY")
     * @ORM\JoinColumn(name="app_shop_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"AppShopHasArticleFull"})
     */
    private $appShop;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit", fetch="LAZY")
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "AppShopHasArticleFull&Translations"})
     * @Accessor(getter="getNameCurrentLabel")
     */
    private $nameLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit", fetch="LAZY")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "AppShopHasArticleFull&Translations"})
     * @Accessor(getter="getDescriptionCurrentLabel")
     */
    private $descriptionLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit", fetch="LAZY")
     * @ORM\JoinColumn(name="description_short_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "AppShopHasArticleFull&Translations"})
     * @Accessor(getter="getDescriptionShortCurrentLabel")
     */
    private $descriptionShortLabel;

    /**
     * @var \AppBundle\Entity\Offer
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Offer", mappedBy="appShopHasArticle", cascade={"all"}, fetch="LAZY")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $offer;

    /**
     * Override Article Amount
     *
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Accessor(getter="getCurrentAmountByPMPCs")
     * @Groups({"Default", "Public", "AppShopHasArticleFull"})
     */
    private $amount;

    /** @var float|null Used when extraCost are related  */
    private $tempForcePrice;

    private $payMethodProviderHasCountriesAffectCache = null;

    /**
     * @var String externalStore
     */
    private $externalStore = null;

    /**
     * Override Article Amount
     *
     * @var float
     *
     * @ORM\Column(name="virtual_currency_amount", type="float", precision=10, scale=4, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "AppShopHasArticleFull"})
     */
    private $virtualCurrencyAmount;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Public", "Default"})
     * @Accessor(getter="getImageCurrent")
     * @Inline()
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sms_alias", type="string", length=20, nullable=true)
     */
    private $smsAlias;

    /**
     * @var \AppBundle\Entity\SMS[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\SMS")
     * @ORM\JoinTable(name="app_shop_articles_has_sms")
     * @Expose()
     * @Groups({"AppShopArticleHasPMPCFull"})
     */
    private $SMSs;

    /**
     * @var \AppBundle\Entity\Voice
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Voice")
     * @ORM\JoinTable(name="app_shop_articles_has_voices")
     * @Expose()
     * @Groups({"AppShopArticleHasPMPCFull"})
     */
    private $voices;

    /**
     * @var string
     *
     * @Expose()
     * @Groups({"Public", "Default"})
     * @ORM\Column(name="`order`", type="integer", length=3, nullable=false)
     */
    private $order=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Groups({"Default", "Public","AppShopHasAppTabs&Tab"})
     * @Expose()
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $updatedAt;

    function __construct(Country $country=null, Article $article=null, AppShop $appShop= null, $amount = null)
    {
        $this->appShop = $appShop;
        $this->country = $country;
        $this->article = $article;
        $this->amount = $amount;

        $this->createdAt = new \DateTime('now');

        $this->SMSs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->voices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function  __toString()
    {
        return $this->getArticle()." ".$this->getCountry();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AppShopHasArticle
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
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return AppShopHasArticle
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return AppShopHasArticle
     */
    public function setArticle(\AppBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set appShop
     *
     * @param \AppBundle\Entity\AppShop $appShop
     * @return AppShopHasArticle
     */
    public function setAppShop(\AppBundle\Entity\AppShop $appShop)
    {
        $this->appShop = $appShop;

        return $this;
    }

    /**
     * Get appShop
     *
     * @return \AppBundle\Entity\AppShop
     */
    public function getAppShop()
    {
        return $this->appShop;
    }

    /**
     * Set offer
     *
     * @param \AppBundle\Entity\Offer $offer
     * @return AppShopHasArticle
     */
    public function setOffer(\AppBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        if ($offer)
            $offer->setAppShopHasArticle($this);

        return $this;
    }

    /**
     * Get offer
     *
     * @return \AppBundle\Entity\Offer
     */
    public function getOffer($quantity = 1)
    {
        if (!$this->offer || !$this->offer->getOfferProgrammer()->isValidFromShoppingCartByArticleQuantity($quantity))
            return null;

        return $this->offer;
    }

    public function t()
    {
//        $this->payMethodHasProvidersAll->
    }


    /**
     * @param PayMethodProviderHasCountry[] $pmpcs
     * @param bool $removeCache
     * @return array|null
     */
    public function calculateRangeValues($pmpcs=null, $removeCache=false, $externalStore=null)
    {
        if (!$pmpcs)
        {
            $pmpcs = $this->getPayMethodsHasProvidersCurrentAffect();
        }

        if (!$externalStore) $externalStore = $this->getExternalStore();

        $min = 99999999; $max=0;

        $calculateMaxMin = function ($amount) use (&$min, &$max)
        {
            if ($amount > $max)
                $max = $amount;

            if ($amount < $min)
                $min = $amount;
        };

        foreach ($pmpcs as $pmpc)
        {
            if (!$pmpc->getActiveCurrent())
                continue;

            if ( (!$externalStore) && (! $pmpc->getSMSs()->isEmpty()) )
            {

                if ($this->getSMSs()->isEmpty())
                    continue;

                foreach ($this->getSMSs() as $sms)
                {
                    if ($sms->getPayMethodProviderHasCountry()->getId() !== $pmpc->getId())
                        continue;

                    // Required exchange because api can change country/currency dynamic
                    $calculateMaxMin(
                        CurrencyService::calculateExchangePrimitive(
                            $sms->getAmount(),
                            $sms->getPayMethodProviderHasCountry()->getCountry()->getCurrency(),
                            $this->getCountry()->getCurrency()
                        )
                    );
                }

            }else if ( (!$externalStore) && (!$pmpc->getVoices()->isEmpty()) ) {

                if ($this->getVoices()->isEmpty())
                    continue;

                foreach ($this->getVoices() as $voice)
                {
                    if ($voice->getPayMethodProviderHasCountry()->getId() !== $pmpc->getId())
                        continue;

                    // Required exchange because api can change country/currency dynamic
                    $calculateMaxMin(
                        CurrencyService::calculateExchangePrimitive(
                            $voice->getAmount(),
                            $voice->getPayMethodProviderHasCountry()->getCountry()->getCurrency(),
                            $this->getCountry()->getCurrency()
                        )
                    );
                }

            }else{

                if (!$pmpc || (in_array(
                            $pmpc->getPayMethod()->getPayCategory()->getId(),
                            [PayCategoryEnum::MOBILE_ID, PayCategoryEnum::VOICE_ID]
                        ) && $pmpc->getPayMethodHasProvider()->getIsOurImplementation()
                    )
                ) {
                    continue;
                }

                $amount = $this->getCurrentAmount();

                if (($amount == 0 && $pmpc->getPayMethod()->getArticleCategory()->getId() != ArticleCategoryEnum::FREE_PAYMENT_ID)
                    OR $amount < 0
                )
                {
                    continue;
                }

                $calculateMaxMin($amount);
            }
        }

        if ($min == 99999999 && $max == 0)
            return null;

        $decimalPlaces = $this->country->getCurrency()->getDecimalPlaces();

        $result = [
            'min'=> round($min, $decimalPlaces),
            'max'=> round($max, $decimalPlaces),
        ];

        return $result;
    }

    /**
     * @VirtualProperty()
     * @Type("array")
     * @return array
     */
    public function getAmountRange()
    {
        $result = $this->calculateRangeValues();

        if ($result === null || $result['min'] === $result['max'])
            return null; //because will be sent only a simple amount

        return $result;
    }

    /**
     * @return float
     */
    public function getCurrentAmountByPMPCs()
    {
        $result = $this->calculateRangeValues();

        if ($result && $result['min'] === $result['max'])
            return $result['min'];
        else
            return null;
    }

    /**
     * @param int $quantityOrder
     * @return float
     */
    public function getCurrentAmount($quantityOrder = 1)
    {
        if ($this->article->getArticleCategory()->getId() == ArticleCategoryEnum::FREE_PAYMENT_ID)
            return 0;

        if ($this->getOffer($quantityOrder))
        {
            return $this->getOffer()->getTempForcePrice() ?: $this->getOffer()->getAmount();
        }

        return $this->getCurrentAmountWithoutOffer();
    }

    /**
     * @VirtualProperty()
     * @Type("float")
     * @Groups({"AppShopHasArticleFull", "Public", "Default"})
     * @return float
     */
    public function getCurrentAmountWithoutOffer()
    {
        if ($this->tempForcePrice)
            return $this->tempForcePrice;

        return $this->amount;
    }

    /**
     * @VirtualProperty()
     * @Type("integer")
     * @Groups({"AppShopHasArticleFull", "Public", "Default"})
     * @param int $quantityOrder
     * @return integer
     */
    public function getCurrentItemsQuantity($quantityOrder = 1)
    {
        if (!$this->getOffer($quantityOrder))
            return $this->getArticle()->getItemsQuantity();

        return $this->getOffer($quantityOrder)->getItemsQuantity();
    }

    /**
     * @VirtualProperty()
     */
    public function getLocalCurrency()
    {
        return $this->country->getCurrency();
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return AppShopHasArticle
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImageCurrent()
    {
        if ($this->getOffer() && $this->getOffer()->getImage())
            return $this->getOffer()->getImage();

        if ($this->getImage())
            return $this->getImage();

        return $this->article->getImageCurrent();
    }

    /**
     * Set nameLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel
     * @return Item
     */
    public function setNameLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel = null)
    {
        $this->nameLabel = $nameLabel;

        return $this;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getNameLabel()
    {
        return $this->nameLabel;
    }


    /**
     * Set descriptionLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel
     * @return Item
     */
    public function setDescriptionLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel = null)
    {
        $this->descriptionLabel = $descriptionLabel;

        return $this;
    }

    /**
     * Get descriptionLabel
     *
     * @return String
     */
    public function getDescriptionLabel()
    {
        return $this->descriptionLabel;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getNameCurrentLabel()
    {
        if ($this->getOffer() && $this->getOffer()->getNameLabel())
            return $this->getOffer()->getNameLabel();

        if ($this->getNameLabel())
            return $this->getNameLabel();

        return $this->getArticle()->getNameCurrentLabel();
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionCurrentLabel()
    {
        if ($this->getDescriptionLabel())
            return $this->getDescriptionLabel();

        return $this->getArticle()->getDescriptionCurrentLabel();
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
     * Set smsAlias
     *
     * @param string $smsAlias
     * @return AppShopHasArticle
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
     * @return string
     */
    public function getSmsAliasCurrent()
    {
        if ($this->smsAlias)
            return $this->smsAlias;

        if ($this->getAppShop()->getApp()->getSmsAlias())
            return $this->getAppShop()->getApp()->getSmsAlias();

        return null;
    }

    public function __clone()
    {
        if($this->id)
            $this->id = null;
    }

    /**
     * Set amount
     *
     * @param float|null $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @deprecated Don't use this method often, its a hack for request
     * @param $payMethodProviderHasCountriesAffectCache
     */
    public function setPayMethodProviderHasCountriesAffectCache($payMethodProviderHasCountriesAffectCache)
    {
        $this->payMethodProviderHasCountriesAffectCache = $payMethodProviderHasCountriesAffectCache;
    }

    /**
     * Get PayMethodHasCountry[]
     *
     * @param null $countryId
     * @return PayMethodProviderHasCountry[]
     */
    public function getPayMethodsHasProvidersCurrentAffect($countryId = null)
    {
        if ($countryId = null && $this->payMethodProviderHasCountriesAffectCache !== null)
            return $this->payMethodProviderHasCountriesAffectCache;


        $appHasPMPCs = $this->getAppShop()->getApp()->getAppHasPayMethodProviderHasCountryIsActiveAndCountryId($countryId ?: $this->country->getId());

        $appHasPMPCs->filter(
            function($entry) {
                /** @var $entry AppHasPayMethodProviderCountry */
                return $entry->getPayMethodProviderHasCountry()->getActiveCurrent();
            }
        );

        $result = [];
        foreach ($appHasPMPCs as $appHasPMPC)
        {
            /** @var AppHasPayMethodProviderCountry $appHasPMPC */
            $result []= $appHasPMPC->getPayMethodProviderHasCountry();
        }

        $this->payMethodProviderHasCountriesAffectCache = $result;

        return $result;
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
     * @param float $virtualCurrencyAmount
     * @return $this
     */
    public function setVirtualCurrencyAmount($virtualCurrencyAmount)
    {
        $this->virtualCurrencyAmount = $virtualCurrencyAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getVirtualCurrencyAmount()
    {
        return $this->virtualCurrencyAmount;
    }

    /**
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionShortLabel
     * @return $this
     */
    public function setDescriptionShortLabel($descriptionShortLabel)
    {
        $this->descriptionShortLabel = $descriptionShortLabel;
        return $this;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionShortLabel()
    {
        return $this->descriptionShortLabel;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionShortCurrentLabel()
    {
        if ($this->getDescriptionShortLabel())
            return $this->getDescriptionShortLabel();

        return $this->getArticle()->getDescriptionShortCurrentLabel();
    }

    /**
     * Cant duplicate articles
     * @Groups({"Default"})
     * @VirtualProperty
     *
     * @return Article[]
     */
    public function getArticlesExtra()
    {
        if ((! $this->getOffer() || !$this->getOffer()->getOfferProgrammer()->getArticlesExtra()) && $this->article->getArticlesExtra())
            return $this->article->getArticlesExtra();

        if (! $this->getOffer() || !$this->getOffer()->getOfferProgrammer()->getArticlesExtra())
            return [];

        /** @var \Doctrine\Common\Collections\ArrayCollection() $articlesExtra */
        $articlesExtra = $this->getOffer()->getOfferProgrammer()->getArticlesExtra();
        $articlesExtraPrimitive = $this->article->getArticlesExtra();

        $validArticlesExtraPrimitive = [];

        foreach ($articlesExtraPrimitive as $article)
        {
            if (!$articlesExtra->contains($article) && $article->getId() !== $this->getArticle()->getId())
                $validArticlesExtraPrimitive[]=$article;
        }

        if ($articlesExtra->contains($this->getArticle()))
            $articlesExtra->removeElement($this->article);

        return array_values(array_merge($articlesExtra->toArray(), $validArticlesExtraPrimitive));
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add sMSs
     *
     * @param \AppBundle\Entity\SMS $sMSs
     *
     * @return AppShopHasArticle
     */
    public function addSMS(\AppBundle\Entity\SMS $sMSs)
    {
        if ($this->SMSs->contains($sMSs) == false)
        {
            $this->SMSs[] = $sMSs;
        }

        return $this;
    }

    /**
     * Remove sMSs
     *
     * @param \AppBundle\Entity\SMS $sMSs
     */
    public function removeSMSs(\AppBundle\Entity\SMS $sMSs)
    {
        $this->SMSs->removeElement($sMSs);
    }

    /**
     * Get sMSs
     *
     * @return \AppBundle\Entity\SMS[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getSMSs()
    {
        return $this->SMSs;
    }

    /**
     * @param PayMethodProviderHasCountry $pmpc
     * @return \AppBundle\Entity\SMS[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getSMSFromPMPC(PayMethodProviderHasCountry $pmpc)
    {
        foreach ($this->getSMSs() as $sms)
        {
            if ($sms->getPayMethodProviderHasCountry()->getId() == $pmpc->getId())
                return $sms;
        }

        return null;
    }

    /**
     * @param PayMethodProviderHasCountry $pmpc
     * @return \AppBundle\Entity\SMS[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getVoiceFromPMPC(PayMethodProviderHasCountry $pmpc)
    {
        foreach ($this->getVoices() as $voice)
        {
            if ($voice->getPayMethodProviderHasCountry()->getId() == $pmpc->getId())
                return $voice;
        }

        return null;
    }

    /**
     * Add voice
     *
     * @param \AppBundle\Entity\Voice $voice
     *
     * @return AppShopHasArticle
     */
    public function addVoice(\AppBundle\Entity\Voice $voice)
    {
        if ($this->voices->contains($voice) == false)
        {
            $this->voices[] = $voice;
        }

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
     * Get voices
     *
     * @return \Doctrine\Common\Collections\Collection|\AppBundle\Entity\Voice[] $voice
     */
    public function getVoices()
    {
        return $this->voices;
    }

    public function hasSameAliasPricesAndShortNumber()
    {
        if ($this->getSMSs()->isEmpty())
            return false;

        $same = false;
        $alias = $this->getSMSs()[0]->getAliasDefault();
        $shortNumber = $this->getSMSs()[0]->getShortNumber();
        $amount = $this->getSMSs()[0]->getAmount();

        foreach ($this->getSMSs() as $sms)
        {
            if ($sms->getAliasDefault() == $alias && $shortNumber == $sms->getShortNumber() && $amount == $sms->getAmount())
                $same = true;
            else
                return false;
        }

        return $same;
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
     * @return mixed
     */
    public function clearTempForcePrices()
    {
        $this->tempForcePrice = null;

        if ($this->getOffer())
            $this->getOffer()->setTempForcePrice(null);
    }

    /**
     * @return String
     */
    public function getExternalStore()
    {
        return $this->externalStore;
    }

    /**
     * @param String $externalStore
     * @return $this
     */
    public function setExternalStore($externalStore)
    {
        $this->externalStore = $externalStore;
        return $this;
    }



    /**
     * @VirtualProperty()
     * @Type("boolean")
     * @return boolean
     */
    public function isCartAvailable()
    {
        if ($this->getArticle()->getArticleCategory()->getId() !== ArticleCategoryEnum::SINGLE_PAYMENT_ID)
            return false;

        if (!$this->getAmount())
            return false;

        return true;
    }
}
