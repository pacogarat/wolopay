<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Util\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ItemRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("item")
 */
class Item
{
    const SONATA_CONTEXT='item';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Expose()
     * @Groups({"Public", "Default", "ItemFull"})
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
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=false)
     * @Groups({"ItemFull&Translations"})
     * @Expose()
     */
    private $nameLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_short_label_id", referencedColumnName="id", nullable=true)
     * @Groups({"ItemFull&Translations"})
     * @Expose()
     */
    private $descriptionShortLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=false)
     * @Groups({"ItemFull&Translations"})
     * @Expose()
     */
    private $descriptionLabel;

    /**
     * @var String
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * Gacha, pack and random are exclusive
     * @var \AppBundle\Entity\ArticleSpecialType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArticleSpecialType")
     * @ORM\JoinColumn(name="special_type_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull", "ItemFull"})
     */
    private $specialType;

    /**
     * @var String
     *
     * @ORM\Column(name="external_item_id", type="string", length=45, nullable=true)
     * @Groups({"Default", "Public", "ArticleFull", "ItemFull"})
     * @Expose()
     */
    private $externalItemId;

    /**
     * @var float
     *
     * @ORM\Column(name="unitary_price", type="float", precision=10, scale=4, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    private $unitaryPrice;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="unitary_price_country_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "ItemFull"})
     */
    private $unitaryPriceCountry;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Public", "Default", "ItemFull"})
     */
    private $image;

    /**
     * @var Article[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", cascade={"persist"}, mappedBy="item")
     * @ORM\OrderBy({"itemsQuantity" = "ASC"})
     * @Expose()
     * @Groups({"ItemFull"})
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ItemTab")
     * @ORM\JoinTable(name="item_has_categories")
     * @Expose()
     * @Groups({"ItemFull"})
     */
    private $itemTabs;

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
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->itemTabs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function __clone()
    {
        if($this->id)
        {
            $this->id = null;
        }
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
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return Item
     */
    public function setApp(\AppBundle\Entity\App $app)
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
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getDescriptionLabel()
    {
        return $this->descriptionLabel;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Item
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Item
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
     * Set image
     *
     * @param MediaInterface $image
     * @return Item
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
     * @param float $unitaryPrice
     * @return $this
     */
    public function setUnitaryPrice($unitaryPrice)
    {
        $this->unitaryPrice = $unitaryPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitaryPrice()
    {
        return $this->unitaryPrice;
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
     * Add articles
     *
     * @param \AppBundle\Entity\Article $articles
     * @return Item
     */
    public function addArticle(\AppBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \AppBundle\Entity\Article $articles
     */
    public function removeArticle(\AppBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param \AppBundle\Entity\Country $unitaryPriceCountry
     * @return $this
     */
    public function setUnitaryPriceCountry(\AppBundle\Entity\Country $unitaryPriceCountry=null)
    {
        $this->unitaryPriceCountry = $unitaryPriceCountry;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getUnitaryPriceCountry()
    {
        return $this->unitaryPriceCountry;
    }

    /**
     * @param String $externalItemId
     * @return $this
     */
    public function setExternalItemId($externalItemId)
    {
        $this->externalItemId = $externalItemId;
        return $this;
    }

    /**
     * @return String
     */
    public function getExternalItemId()
    {
        return $this->externalItemId;
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
     * Add itemTab
     *
     * @param $itemTabs
     * @return Item
     */
    public function setItemTabs($itemTabs)
    {
        $this->itemTabs->clear();

        foreach ($itemTabs as $itemTab)
            $this->itemTabs[] = $itemTab;

        return $this;
    }

    /**
     * Add itemTab
     *
     * @param \AppBundle\Entity\ItemTab $itemTab
     *
     * @return Item
     */
    public function addItemTab(\AppBundle\Entity\ItemTab $itemTab)
    {
        $this->itemTabs[] = $itemTab;

        return $this;
    }

    /**
     * Remove itemTab
     *
     * @param \AppBundle\Entity\ItemTab $itemTab
     */
    public function removeItemTab(\AppBundle\Entity\ItemTab $itemTab)
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
     * @param \AppBundle\Entity\ArticleSpecialType $specialType
     * @return $this
     */
    public function setSpecialType($specialType)
    {
        $this->specialType = $specialType;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\ArticleSpecialType
     */
    public function getSpecialType()
    {
        return $this->specialType;
    }

}
