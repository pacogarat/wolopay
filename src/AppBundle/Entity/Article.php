<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Util\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity({"itemsQuantity","item"})
 * @ExclusionPolicy("all")
 * @XmlRoot("article")
 */
class Article
{
    const SONATA_CONTEXT='article';

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull", "ArticleOnlyId"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\ArticleCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArticleCategory")
     * @ORM\JoinColumn(name="article_category_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $articleCategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $itemsQuantity;

    /**
     * @var String
     *
     * @ORM\Column(name="external_article_id", type="string", length=256, nullable=true)
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $externalArticleId;

    /**
     * @var integer
     *
     * @Groups({"ArticleFull"})
     * @Expose()
     * @ORM\Column(name="n_purchases_per_client", type="integer", nullable=true)
     */
    private $nPurchasesPerClient;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_purchases_total", type="integer", nullable=true)
     * @Groups({"ArticleFull", "Default", "Public"})
     * @Expose()
     */
    private $nPurchasesTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="times_bought", type="integer", nullable=false)
     * @Groups({"ArticleFull"})
     * @Expose()
     */
    private $timesBought=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_when_stock_under_n", type="integer", nullable=false)
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $showWhenStockUnderN=0;

    /**
     * This image overwrite item image
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Accessor(getter="getImageCurrent")
     * @Inline()
     */
    private $image;

    /**
     * Only used to serialize
     * @Expose()
     * @Groups({"OriginalArticle"})
     * @Accessor(getter="getImage")
     */
    private $imageOriginal;

    /**
     * @var \AppBundle\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item", inversedBy="articles", fetch="EAGER")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"ItemFull","ArticleFull"})
     */
    private $item;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var \AppBundle\Entity\AppShopHasArticle[]
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AppShopHasArticle", mappedBy="article", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"createdAt" = "ASC"})
     * @Expose()
     * @Groups({"AppShopHasArticleFull"})
     */
    private $appShopHasArticles;

    /**
     * @var AppShopHasAppTab
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AppShopHasAppTab", mappedBy="articles")
     * @Expose()
     * @Groups("AppShopHasAppTabs&Tab")
     */
    private $appShopHasAppTab;

    /**
     * @var \AppBundle\Entity\Article[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinTable(name="article_has_articles_extra")
     * @Groups({"OfferProgrammerAddArticles"})
     * @MaxDepth(4)
     * @Groups({"ArticleFull"})
     * @Expose()
     */
    private $articlesExtra;

    /**
     * @var \AppBundle\Entity\ArticleGachaHasArticle[]
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArticleGachaHasArticle", mappedBy="article", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"order"="ASC"})
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $articlesGacha;

    /**
     * @var \AppBundle\Entity\ArticlePackHasArticle[]
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArticlePackHasArticle", mappedBy="article", cascade={"all"}, orphanRemoval=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $articlesPack;

    /**
     * @var \AppBundle\Entity\ArticleRandomHasArticle[]
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArticleRandomHasArticle", mappedBy="article", cascade={"all"}, orphanRemoval=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $articlesRandom;


    /**
     * @var \AppBundle\Entity\OfferProgrammer[]
     *
     * @Assert\Valid
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\OfferProgrammer", mappedBy="articles", cascade={"all"}, orphanRemoval=true)
     */
    private $offerProgrammers;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodicity", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $periodicity;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_standard", type="float", precision=10, scale=4, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $amountStandard;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit" )
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"ArticleFull&Translations", "ArticleOnlyName"})
     * @Accessor(getter="getNameCurrentLabel")
     */
    private $nameLabel;

    /**
     * Only used to serialize
     * @Expose()
     * @Groups({"OriginalArticle"})
     * @Accessor(getter="getNameLabel")
     */
    private $nameLabelOriginal;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"ArticleFull&Translations"})
     * @Accessor(getter="getDescriptionCurrentLabel")
     */
    private $descriptionLabel;

    /**
     * Only used to serialize
     * @Expose()
     * @Groups({"OriginalArticle"})
     * @Accessor(getter="getDescriptionLabel")
     */
    private $descriptionLabelOriginal;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_short_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"ArticleFull&Translations"})
     * @Accessor(getter="getDescriptionShortCurrentLabel")
     */
    private $descriptionShortLabel;

    /**
     * Only used to serialize
     * @Expose()
     * @Groups({"OriginalArticle"})
     * @Accessor(getter="getDescriptionShortLabel")
     */
    private $descriptionShortLabelOriginal;

    /**
     * @var boolean
     *
     * @Assert\Valid()
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_from", type="datetime", nullable=true)
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $validFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_to", type="datetime", nullable=true)
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $validTo;

    /**
     * @var \DateTime
     *
     * Calculate at run time
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $validFromGacha;

    /**
     * @var \DateTime
     *
     * Calculate at run time
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    private $validToGacha;

    /**
     * @var int
     *
     * @ORM\Column(name="hours_to_reset_gacha", type="integer", nullable=true)
     * @Groups({"Default", "Public", "ArticleFull"})
     * @Expose()
     */
    protected $hoursToResetGacha;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->appShopHasArticles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerProgrammers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesExtra = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesGacha = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesPack = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesRandom = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function __toString()
    {
        return str_replace('{[{number}]}', $this->getItemsQuantity(), ($this->getItem() ? $this->getItem()->getName() : ''). ' '.($this->getArticleCategory() ? $this->getArticleCategory()->getName() : ''));
    }

    /**
     * Set number
     *
     * @param integer $quantity
     * @return Article
     */
    public function setItemsQuantity($quantity)
    {
        $this->itemsQuantity = $quantity;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getItemsQuantity()
    {
        return $this->itemsQuantity;
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
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     * @return Article
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;
        $this->app  = $item->getApp();

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return Article
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
     * Set periodicity
     *
     * @param integer $periodicity
     * @return Article
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get periodicity
     *
     * @return integer
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
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
     * Add appShopHasArticles
     *
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticles
     * @return Article
     */
    public function addAppShopHasArticle(\AppBundle\Entity\AppShopHasArticle $appShopHasArticles)
    {
        $this->appShopHasArticles[] = $appShopHasArticles;
        $appShopHasArticles->setArticle($this);

        return $this;
    }

    /**
     * Remove appShopHasArticles
     *
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticles
     */
    public function removeAppShopHasArticle(\AppBundle\Entity\AppShopHasArticle $appShopHasArticles)
    {
        $this->appShopHasArticles->removeElement($appShopHasArticles);
    }

    /**
     * Remove all appShopHasArticles
     */
    public function removeAllAppShopHasArticle()
    {
        $this->appShopHasArticles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get appShopHasArticles
     *
     * @return  \AppBundle\Entity\AppShopHasArticle[]
     */
    public function getAppShopHasArticles()
    {
        return $this->appShopHasArticles;
    }


    /**
     * Set active
     *
     * @param boolean $active
     * @return Article
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
     * Get nameLabel
     *
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getNameLabel()
    {
        return $this->nameLabel;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getNameCurrentLabel()
    {
        if ($this->getNameLabel())
            return $this->getNameLabel();

        return $this->getItem()->getNameLabel();
    }

    /**
     * @return string
     */
    public function getNameCurrentKeyLabel()
    {
        return $this->getNameCurrentLabel()->getKey();
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
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit|null
     */
    public function getDescriptionLabel()
    {
        return $this->descriptionLabel;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionCurrentLabel()
    {
        if ($this->getDescriptionLabel())
            return $this->getDescriptionLabel();

        return $this->getItem()->getDescriptionLabel();
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionShortCurrentLabel()
    {
        if ($this->getDescriptionShortLabel())
            return $this->getDescriptionShortLabel();

        return $this->getItem()->getDescriptionShortLabel();
    }

    /**
     * @return String
     */
    public function getDescriptionCurrentKeyLabel()
    {
        return $this->getDescriptionCurrentLabel()->getKey();
    }

    /**
     * Set image
     *
     * @param MediaInterface $image
     * @return Article
     */
    public function setImage(MediaInterface $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImageCurrent()
    {
        if ($this->getImage())
            return $this->getImage();

        return $this->getItem()->getImage();
    }


    /**
     * Add offerProgrammers
     *
     * @param \AppBundle\Entity\OfferProgrammer $offerProgrammers
     * @return Article
     */
    public function addOfferProgrammer(\AppBundle\Entity\OfferProgrammer $offerProgrammers)
    {
        $this->offerProgrammers[] = $offerProgrammers;
        $offerProgrammers->setArticle($this);

        return $this;
    }

    /**
     * Remove offerProgrammers
     *
     * @param \AppBundle\Entity\OfferProgrammer $offerProgrammers
     */
    public function removeOfferProgrammer(\AppBundle\Entity\OfferProgrammer $offerProgrammers)
    {
        $this->offerProgrammers->removeElement($offerProgrammers);
    }

    /**
     * Get offerProgrammers
     *
     * @return OfferProgrammer[]
     */
    public function getOfferProgrammers()
    {
        return $this->offerProgrammers;
    }

    /**
     * @param \AppBundle\Entity\ArticleCategory $articleCategory
     * @return Article
     */
    public function setArticleCategory(\AppBundle\Entity\ArticleCategory $articleCategory)
    {
        $this->articleCategory = $articleCategory;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\ArticleCategory
     */
    public function getArticleCategory()
    {
        return $this->articleCategory;
    }

    /**
     * @param int $nPurchasesPerClient
     * @return $this
     */
    public function setNPurchasesPerClient($nPurchasesPerClient)
    {
        $this->nPurchasesPerClient = $nPurchasesPerClient;

        return $this;
    }

    /**
     * @return int
     */
    public function getNPurchasesPerClient()
    {
        return $this->nPurchasesPerClient;
    }

    public function __clone()
    {
        if($this->id)
        {
            $this->id = null;
        }
    }

    /**
     * @param float $amountStandard
     * @return $this
     */
    public function setAmountStandard($amountStandard)
    {
        $this->amountStandard = $amountStandard;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountStandard()
    {
        return $this->amountStandard;
    }

    /**
     * @param String $externalArticleId
     * @return $this
     */
    public function setExternalArticleId($externalArticleId)
    {
        $this->externalArticleId = $externalArticleId;
        return $this;
    }

    /**
     * @return String
     */
    public function getExternalArticleId()
    {
        return $this->externalArticleId;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @param \DateTime $validFrom
     *
     * @return Article
     */
    public function setValidFrom($validFrom)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param \DateTime $validTo
     */
    public function setValidTo($validTo)
    {
        $this->validTo = $validTo;
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

    public function isValidDates($dateString = 'now')
    {
        $date = new \DateTime($dateString);

        if ($this->getValidFrom())
        {
            if ($date->getTimestamp() <  $this->getValidFrom()->getTimestamp())
                return false;
        }

        if ($this->getValidTo())
        {
            if ($date->getTimestamp() >  $this->getValidTo()->getTimestamp())
                return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function getNPurchasesTotal()
    {
        return $this->nPurchasesTotal;
    }

    /**
     * @param int $nPurchasesTotal
     * @return $this
     */
    public function setNPurchasesTotal($nPurchasesTotal)
    {
        $this->nPurchasesTotal = $nPurchasesTotal;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimesBought()
    {
        return $this->timesBought;
    }

    /**
     * @param int $times
     * @return Article
     */
    public function addTimesBought($times = 1)
    {
        if (!$this->timesBought)
            $this->timesBought = 0;

        $this->timesBought += $times;

        return $this;
    }

    /**
     * @return int
     */
    public function getShowWhenStockUnderN()
    {
        return $this->showWhenStockUnderN;
    }

    /**
     * @param int $showWhenStockUnderN
     * @return Article
     */
    public function setShowWhenStockUnderN($showWhenStockUnderN)
    {
        $this->showWhenStockUnderN = $showWhenStockUnderN;
        return $this;
    }

    /**
     * @VirtualProperty
     *
     * @return int
     */
    public function getRemainingUnits()
    {
        return !$this->nPurchasesTotal ? 9999999 : $this->nPurchasesTotal - $this->timesBought;
    }

    /**
     * @VirtualProperty
     * @Groups("Default")
     * @MaxDepth(2)
     *
     * @return string
     */
    public function getItemTabs()
    {
        return $this->getItem()->getItemTabs();
    }

    /**
     * Set timesBought
     *
     * @param integer $timesBought
     *
     * @return Article
     */
    public function setTimesBought($timesBought)
    {
        $this->timesBought = $timesBought;

        return $this;
    }

    /**
     * Add articlesExtra
     *
     * @param \AppBundle\Entity\Article $articlesExtra
     *
     * @return Article
     */
    public function addArticlesExtra(\AppBundle\Entity\Article $articlesExtra)
    {
        $this->articlesExtra[] = $articlesExtra;

        return $this;
    }

    /**
     * Add articlesExtra
     *
     * @param \AppBundle\Entity\Article|array $articlesExtra
     *
     * @return Article
     */
    public function setArticlesExtra(array $articlesExtra)
    {
        $this->articlesExtra->clear();

        foreach ($articlesExtra as $article)
            $this->articlesExtra[] = $article;

        return $this;
    }

    /**
     * Remove articlesExtra
     *
     * @param \AppBundle\Entity\Article $articlesExtra
     */
    public function removeArticlesExtra(\AppBundle\Entity\Article $articlesExtra)
    {
        $this->articlesExtra->removeElement($articlesExtra);
    }

    /**
     * Get articlesExtra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticlesExtra()
    {
        return $this->articlesExtra;
    }

    /**
     * Add articlesGacha
     *
     * @param \AppBundle\Entity\Article $articleGacha
     *
     * @return Article
     */
    public function addArticleGacha(\AppBundle\Entity\Article $articleGacha)
    {
        $this->articlesGacha[] = $articleGacha;

        return $this;
    }

    /**
     * Add articlesGacha
     *
     * @param \AppBundle\Entity\Article|array $articlesGacha
     *
     * @return Article
     */
    public function setArticlesGacha(array $articlesGacha)
    {
        $this->articlesGacha->clear();

        foreach ($articlesGacha as $article)
            $this->articlesGacha[] = $article;

        return $this;
    }

    /**
     * Remove articleGacha
     *
     * @param \AppBundle\Entity\Article $articleGacha
     */
    public function removeArticleGacha(\AppBundle\Entity\Article $articleGacha)
    {
        $this->articlesGacha->removeElement($articleGacha);
    }
    /**
     * Remove articlesGacha
     */
    public function removeArticlesGacha()
    {
        $this->articlesGacha->clear();
    }

    /**
     * Get articlesGacha
     *
     * @return ArticleGachaHasArticle[]
     */
    public function getArticlesGacha()
    {
        return $this->articlesGacha;
    }

    public function getTotalToGiveInGacha()
    {
        $count=0;
        foreach ($this->articlesGacha as $art){
            $count += $art->getAmountToGive();
        }
        return $count;
    }

    public function getTotalToRemainForUser()
    {
        $count=0;
        foreach ($this->articlesGacha as $art)
        {
            if ($art->getRemainingForUser() > 0)
                $count += $art->getRemainingForUser();
        }
        return $count;
    }

    /**
     * Add articlesPack
     *
     * @param \AppBundle\Entity\Article $articlePack
     *
     * @return Article
     */
    public function addArticlePack(\AppBundle\Entity\Article $articlePack)
    {
        $this->articlesPack[] = $articlePack;

        return $this;
    }

    /**
     * Add articlesPack
     *
     * @param \AppBundle\Entity\Article|array $articlesPack
     *
     * @return Article
     */
    public function setArticlesPack(array $articlesPack)
    {
        $this->articlesPack->clear();

        foreach ($articlesPack as $article)
            $this->articlesPack[] = $article;

        return $this;
    }

    /**
     * Remove articlesPack
     *
     * @param \AppBundle\Entity\Article $articlePack
     */
    public function removeArticlesPack(\AppBundle\Entity\Article $articlePack)
    {
        $this->articlesPack->removeElement($articlePack);
    }

    /**
     * Get articlesPack
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticlesPack()
    {
        return $this->articlesPack;
    }

    /**
     * Add articlesRandom
     *
     * @param \AppBundle\Entity\Article $articleRandom
     *
     * @return Article
     */
    public function addArticleRandom(\AppBundle\Entity\Article $articleRandom)
    {
        $this->articlesRandom[] = $articleRandom;

        return $this;
    }

    /**
     * Add articlesRandom
     *
     * @param \AppBundle\Entity\Article|array $articlesRandom
     *
     * @return Article
     */
    public function setArticlesRandom(array $articlesRandom)
    {
        $this->articlesRandom->clear();

        foreach ($articlesRandom as $article)
            $this->articlesRandom[] = $article;

        return $this;
    }

    /**
     * Remove articlesRandom
     *
     * @param \AppBundle\Entity\Article $articleRandom
     */
    public function removeArticlesRandom(\AppBundle\Entity\Article $articleRandom)
    {
        $this->articlesRandom->removeElement($articleRandom);
    }

    /**
     * Get articlesRandom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticlesRandom()
    {
        return $this->articlesRandom;
    }

    /**
     * @return ArticleSpecialType
     */
    public function getSpecialType()
    {
        return $this->getItem()->getSpecialType();
    }

    /**
     * @param ArticleSpecialType $specialType
     * @return $this
     */
    public function setSpecialType($specialType)
    {
        $this->specialType = $specialType;
        return $this;
    }

    /**
     * @return int
     */
    public function getHoursToResetGacha()
    {
        return $this->hoursToResetGacha;
    }

    /**
     * @param int $hoursToResetGacha
     * @return $this
     */
    public function setHoursToResetGacha($hoursToResetGacha)
    {
        $this->hoursToResetGacha = $hoursToResetGacha;
        return $this;
    }

    /**
     * @deprecated dont use this method because is calculated at run time in some executions
     * @return \DateTime
     */
    public function getValidFromGacha()
    {
        return $this->validFromGacha;
    }

    /**
     * @param \DateTime $validFromGacha
     * @return $this
     */
    public function setValidFromGacha($validFromGacha)
    {
        $this->validFromGacha = $validFromGacha;
        return $this;
    }

    /**
     * @deprecated dont use this method because is calculated at run time in some executions
     * @return \DateTime
     */
    public function getValidToGacha()
    {
        return $this->validToGacha;
    }

    /**
     * @param \DateTime $validToGacha
     * @return $this
     */
    public function setValidToGacha($validToGacha)
    {
        $this->validToGacha = $validToGacha;
        return $this;
    }



}

