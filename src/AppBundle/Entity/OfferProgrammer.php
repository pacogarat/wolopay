<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Util\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * OfferProgrammer
 *
 * @ORM\Table(name="offer_programmer")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OfferProgrammerRepository")
 * @ExclusionPolicy("all")
 */
class OfferProgrammer
{
    const SONATA_CONTEXT='offer';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"Default", "OfferProgrammerFull"})
     * @Expose()
     */
    private $id;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     * @Groups({"Default", "OfferProgrammerFull"})
     * @Expose()
     */
    private $name;

    /**
     * @var \AppBundle\Entity\Article[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", inversedBy="offerProgrammers")
     * @ORM\JoinTable(name="offer_programmer_has_articles")
     * @Groups({"OfferProgrammerAddArticles"})
     * @MaxDepth(2)
     * @Expose()
     */
    private $articles;

    /**
     * @var \AppBundle\Entity\Article[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinTable(name="offer_programmer_has_articles_extra")
     * @Groups({"OfferProgrammerAddArticles"})
     * @MaxDepth(4)
     * @Expose()
     */
    private $articlesExtra;

    /**
     * @var \AppBundle\Entity\Country[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinTable(name="offer_programmer_has_countries")
     * @Groups({"Admin", "OfferProgrammerFull"})
     * @Expose()
     */
    private $countries;

    /**
     * @var \AppBundle\Entity\AppShop[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AppShop")
     * @ORM\JoinTable(name="offer_programmer_has_app_shops")
     * @Groups({"Admin", "OfferProgrammerFull"})
     * @Expose()
     */
    private $appShops;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=true)
     */
    private $nameLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     */
    private $descriptionLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_short_label_id", referencedColumnName="id", nullable=true)
     */
    private $descriptionShortLabel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="offer_from", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Accessor(getter="offerFromLocal")
     */
    private $offerFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="offer_to", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Accessor(getter="offerToLocal")
     */
    private $offerTo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="local_time", type="boolean", nullable=false)
     * @Expose()
     */
    private $localTime=false;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="offer_img", referencedColumnName="id", nullable=true)
     */
    private $offerImg;

    /**
     * @var float
     *
     * @Expose()
     * @ORM\Column(name="limit_purchases", type="integer", nullable=true)
     */
    private $limitPurchases;

    /**
     * @var float
     *
     * @ORM\Column(name="offset", type="integer", nullable=true)
     * @Expose()
     */
    private $offset;

    /**
     * @var float
     *
     * @ORM\Column(name="limit_per_user", type="integer", nullable=true)
     * @Expose()
     */
    private $limitPerUser;

    /**
     * @var float
     *
     * @ORM\Column(name="times_used", type="integer", nullable=false)
     * @Expose()
     */
    private $timesUsed=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pretty_price", type="boolean", nullable=true)
     * @Expose()
     */
    private $prettyPrice=false;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity_extra_percent", type="float", precision=5, scale=0, nullable=true)
     * @Expose()
     */
    private $quantityExtraPercent;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_percent_discount", type="float", precision=3, scale=0, nullable=true)
     * @Expose()
     */
    private $amountPercentDiscount;

    /**
     * @var \AppBundle\Entity\AppShop[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\PaymentDetailHasArticles", mappedBy="offerProgrammer", fetch="EXTRA_LAZY")
     */
    private $paymentDetailHasArticles;

    /**
     * @var bool $isActive
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     *
     */
    private $isActive=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime('now');

        $this->articles  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paymentDetailHasArticles  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articlesExtra  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appShops  = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function  __toString()
    {
        return $this->name;
    }

    /**
     * @param \AppBundle\Entity\AppShop[] $appShops
     * @return $this
     */
    public function setAppShops($appShops)
    {
        $this->appShops->clear();

        foreach ($appShops as $appShop)
            $this->appShops[] = $appShop;

        return $this;
    }

    /**
     * Add appShops
     *
     * @param \AppBundle\Entity\AppShop $appShops
     * @return OfferProgrammer
     */
    public function addAppShop(\AppBundle\Entity\AppShop $appShops)
    {
        $this->appShops[] = $appShops;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppShop[]
     */
    public function getAppShops()
    {
        return $this->appShops;
    }

    /**
     * @param \AppBundle\Entity\Article[] $articles
     * @return $this
     */
    public function setArticles($articles)
    {
        $this->articles->clear();

        foreach ($articles as $article)
            $this->articles[] = $article;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\Article[] $articles
     * @return $this
     */
    public function setArticlesExtra($articles)
    {
        $this->articlesExtra->clear();

        foreach ($articles as $article)
            $this->articlesExtra[] = $article;

        return $this;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     * @return OfferProgrammer
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Article[]
     */
    public function getArticles()
    {
        return $this->articles;
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
     * Add country
     *
     * @param \AppBundle\Entity\Country $country
     * @return OfferProgrammer
     */
    public function addCountry(\AppBundle\Entity\Country $country)
    {
        $this->countries[] = $country;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country[]
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    private function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel
     * @return $this
     */
    public function setDescriptionLabel($descriptionLabel)
    {
        $this->descriptionLabel = $descriptionLabel;
        return $this;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionLabel()
    {
        return $this->descriptionLabel;
    }

    /**
     * @param int $id
     * @return $this
     */
    private function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel
     * @return $this
     */
    public function setNameLabel($nameLabel)
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
     * @param \DateTime $offerFrom
     * @return $this
     */
    public function setOfferFrom($offerFrom)
    {
        $this->offerFrom = $offerFrom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOfferFrom()
    {
        return $this->offerFrom;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $offerImg
     * @return $this
     */
    public function setOfferImg($offerImg)
    {
        $this->offerImg = $offerImg;
        return $this;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getOfferImg()
    {
        return $this->offerImg;
    }

    /**
     * @param \DateTime $offerTo
     * @return $this
     */
    public function setOfferTo($offerTo)
    {
        $this->offerTo = $offerTo;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOfferTo()
    {
        return $this->offerTo;
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
     * @param float $amountPercentDiscount
     * @return $this
     */
    public function setAmountPercentDiscount($amountPercentDiscount)
    {
        $this->amountPercentDiscount = $amountPercentDiscount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountPercentDiscount()
    {
        return $this->amountPercentDiscount;
    }

    /**
     * @param float $numberExtraPercent
     * @return $this
     */
    public function setQuantityExtraPercent($numberExtraPercent)
    {
        $this->quantityExtraPercent = $numberExtraPercent;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantityExtraPercent()
    {
        return $this->quantityExtraPercent;
    }

    /**
     * @param boolean $localTime
     * @return $this
     */
    public function setLocalTime($localTime)
    {
        $this->localTime = $localTime;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getLocalTime()
    {
        return $this->localTime;
    }

    public function __clone()
    {
        if($this->id)
            $this->id = null;
    }

    /**
     * @param float $limitPerUser
     * @return $this
     */
    public function setLimitPerUser($limitPerUser)
    {
        $this->limitPerUser = $limitPerUser ?: null ;
        return $this;
    }

    /**
     * @return float
     */
    public function getLimitPerUser()
    {
        return $this->limitPerUser;
    }

    /**
     * @param float $limitPurchases
     * @return $this
     */
    public function setLimitPurchases($limitPurchases)
    {
        $this->limitPurchases = $limitPurchases ?: null;
        return $this;
    }

    /**
     * @return float
     */
    public function getLimitPurchases()
    {
        return $this->limitPurchases;
    }

    /**
     * @param boolean $prettyPrice
     * @return $this
     */
    public function setPrettyPrice($prettyPrice)
    {
        $this->prettyPrice = $prettyPrice;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPrettyPrice()
    {
        return $this->prettyPrice;
    }

    /**
     * @return $this
     */
    public function addTimesUsed()
    {
        $this->timesUsed++;
        return $this;
    }

    /**
     * @return float
     */
    public function getTimesUsed()
    {
        return $this->timesUsed;
    }

    /**
     * @param float $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return float
     */
    public function getOffset()
    {
        return $this->offset;
    }

    private function adjustDateWithOffset($date)
    {
        $dateCloned = $date;
        if ($date && $this->getOffset())
        {
            $dateCloned = clone $date;
            $dateCloned->add(\DateInterval::createFromDateString('-'.$this->getOffset(). ' seconds'));
        }

        return $dateCloned;
    }

    public function offerFromLocal()
    {
        return $this->adjustDateWithOffset($this->getOfferFrom());
    }

    public function offerToLocal()
    {
        return $this->adjustDateWithOffset($this->getOfferTo());
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
     * Set timesUsed
     *
     * @param integer $timesUsed
     *
     * @return OfferProgrammer
     */
    public function setTimesUsed($timesUsed)
    {
        $this->timesUsed = $timesUsed;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Add articlesExtra
     *
     * @param \AppBundle\Entity\Article $articlesExtra
     *
     * @return OfferProgrammer
     */
    public function addArticlesExtra(\AppBundle\Entity\Article $articlesExtra)
    {
        $this->articlesExtra[] = $articlesExtra;

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
     * @return Article[]
     */
    public function getArticlesExtra()
    {
        return $this->articlesExtra;
    }

    /**
     * Remove country
     *
     * @param \AppBundle\Entity\Country $country
     */
    public function removeCountry(\AppBundle\Entity\Country $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * Remove appShop
     *
     * @param \AppBundle\Entity\AppShop $appShop
     */
    public function removeAppShop(\AppBundle\Entity\AppShop $appShop)
    {
        $this->appShops->removeElement($appShop);
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * this weak algorithm is for shopping cart
     * @param $articleQuantity
     * @return bool
     */
    public function isValidFromShoppingCartByArticleQuantity($articleQuantity)
    {
        return $this->getArticlesRemainingByUser($articleQuantity) >= 0 && $this->getArticlesRemainingByPurchases($articleQuantity) >= 0;
    }

    private function getArticlesRemainingByPurchases($extraAdd = 0)
    {
        if (!$this->limitPurchases)
            return 99999;

        return $this->limitPurchases - ($this->timesUsed + $extraAdd);
    }

    /**
     * WARNING THIS METHOD IS FAKE only for primitive validation
     *
     * @param int $extraAdd
     * @return float|int
     */
    private function getArticlesRemainingByUser($extraAdd = 0)
    {
        if (!$this->getLimitPerUser())
            return 99999;

        return $this->getLimitPerUser() - $extraAdd;
    }

}
