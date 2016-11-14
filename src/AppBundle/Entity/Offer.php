<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 * @XmlRoot("offer")
 */
class Offer
{
    /**
     * @var \AppBundle\Entity\AppShopHasArticle
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AppShopHasArticle", inversedBy="offer")
     * @ORM\JoinColumn(name="app_shop_has_article_id", referencedColumnName="id", nullable=false)
     */
    private $appShopHasArticle;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true)
     */
    private $image;

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
     * @var \AppBundle\Entity\OfferProgrammer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfferProgrammer")
     * @ORM\JoinColumn(name="offer_programmer_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"OfferAddOfferProgrammer"})
     * @MaxDepth(4)
     */
    private $offerProgrammer;

    /**
     * @var float
     *
     * @ORM\Column(name="items_quantity", type="float", precision=10, scale=0, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $itemsQuantity;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amount;

    /** @var float|null Used when extraCost are related  */
    private $tempForcePrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Accessor(getter="getOfferTo")
     */
    private $offerTo;


    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function __toString()
    {
        return "quantity: $this->itemsQuantity, price: $this->amount";
    }

    /**
     * Set descriptionLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel
     * @return Offer
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
     * Set percentDiscount
     *
     * @param float $percentDiscount
     * @return Offer
     */
    public function setPercentDiscount($percentDiscount)
    {
        $this->percentDiscount = $percentDiscount;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticle
     * @return $this
     */
    public function setAppShopHasArticle($appShopHasArticle)
    {
        $this->appShopHasArticle = $appShopHasArticle;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppShopHasArticle
     */
    public function getAppShopHasArticle()
    {
        return $this->appShopHasArticle;
    }

    /**
     * @param \AppBundle\Entity\OfferProgrammer $offerProgrammer
     * @return $this
     */
    public function setOfferProgrammer($offerProgrammer)
    {
        $this->offerProgrammer = $offerProgrammer;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\OfferProgrammer
     */
    public function getOfferProgrammer()
    {
        return $this->offerProgrammer;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return $this
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
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
     * @param float $quantity
     * @return $this
     */
    public function setItemsQuantity($quantity)
    {
        $this->itemsQuantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getItemsQuantity()
    {
        return $this->itemsQuantity;
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

    public function getOfferTo()
    {
        return $this->offerProgrammer->getOfferTo();
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
     * @param float|null $tempForcePrice
     * @return $this
     */
    public function setTempForcePrice($tempForcePrice)
    {
        $this->tempForcePrice = $tempForcePrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTempForcePrice()
    {
        return $this->tempForcePrice;
    }

}
