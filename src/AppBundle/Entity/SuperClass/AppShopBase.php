<?php

namespace AppBundle\Entity\SuperClass;

use AppBundle\Entity\AppShop;
use AppBundle\Entity\Enum\ShopOrderTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AppShop
 *
 * @ORM\MappedSuperclass
 * @ExclusionPolicy("all")
 */
abstract class AppShopBase
{
    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="appShops")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    protected $app;

    /**
     * @var \AppBundle\Entity\LevelCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\LevelCategory")
     * @ORM\JoinColumn(name="level_category_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Basic", "ArticleFull"})
     * @Assert\NotBlank(groups={"transactionBasic"})
     */
    protected $levelCategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="value_lower", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default"})
     * @Assert\NotBlank(groups={"transactionBasic"})
     */
    protected $valueLower=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="value_higher", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default"})
     * @Assert\NotBlank(groups={"transactionBasic"})
     */
    protected $valueHigher=999999999;

    /**
     * @var \AppBundle\Entity\ShopCss
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShopCss")
     * @ORM\JoinColumn(name="shop_css_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"AppShopFull"})
     * @Assert\NotBlank(groups={"transactionBasic"})
     */
    protected $css;

    /**
     * @var boolean
     *
     * @ORM\Column(name="first_offer", type="boolean", nullable=true)
     */
    protected $firstOffers=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_cart", type="boolean", nullable=true)
     */
    protected $hasCart=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_categories", type="boolean", nullable=true)
     */
    protected $hasCategories=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paymethods_default_order", type="boolean", nullable=true)
     */
    protected $payMethodsDefaultOrder=true;

    /**
     * @var bool
     *
     * @ORM\Column(name="tutorial_eanbled", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default"})
     */
    protected $tutorialEnabled=false;

    /**
     * @var \AppBundle\Entity\PromoCode
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PromoCode")
     * @ORM\JoinColumn(name="tutorial_promo_code_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $tutorialPromoCode;

    /**
     * Values available: by_price_asc, by_price_desc, by_database
     *
     * @var ShopOrderTypeEnum;
     *
     * @ORM\Column(name="order_type", type="string", nullable=true)
     * @Expose()
     * @Groups({"Default"})
     */
    private $orderType = ShopOrderTypeEnum::ORDER_BY_DATABASE_VALUES;


    function __construct()
    {

    }

    function __toString()
    {
        return ($this->getLevelCategory() ? $this->getLevelCategory()->getName() : '' ) .' - '. $this->getValueLower().' - '.$this->getValueHigher();
    }

    /**
     * This are created to can delete appShop or modify
     * @param AppShop $appShop
     * @return $this
     */
    public function setAppShopMapped(AppShop $appShop)
    {
        $this
            ->setApp($appShop->getApp())
            ->setHasCategories($appShop->getCss()->getHasCategories())
            ->setCss($appShop->getCss())
            ->setValueHigher($appShop->getValueHigher())
            ->setValueLower($appShop->getValueLower())
            ->setLevelCategory($appShop->getLevelCategory())
            ->setFirstOffers($appShop->getFirstOffers())
            ->setPayMethodsDefaultOrder($appShop->getPayMethodsDefaultOrder())
        ;

        return $this;
    }

    /**
     * Set valueLower
     *
     * @param integer $valueLower
     * @return AppShop
     */
    public function setValueLower($valueLower)
    {
        $this->valueLower = $valueLower;

        return $this;
    }

    /**
     * Get valueLower
     *
     * @return integer 
     */
    public function getValueLower()
    {
        return $this->valueLower;
    }

    /**
     * Set valueHigher
     *
     * @param integer $valueHigher
     * @return AppShop
     */
    public function setValueHigher($valueHigher)
    {
        $this->valueHigher = $valueHigher;

        return $this;
    }

    /**
     * Get valueHigher
     *
     * @return integer 
     */
    public function getValueHigher()
    {
        return $this->valueHigher;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return $this
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
     * Set levelCategory
     *
     * @param \AppBundle\Entity\LevelCategory $levelCategory
     * @return $this
     */
    public function setLevelCategory(\AppBundle\Entity\LevelCategory $levelCategory)
    {
        $this->levelCategory = $levelCategory;

        return $this;
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

    /**
     * Set firstOffers
     *
     * @param boolean $firstOffers
     * @return $this
     */
    public function setFirstOffers($firstOffers)
    {
        $this->firstOffers = $firstOffers;

        return $this;
    }

    /**
     * Get firstOffers
     *
     * @return boolean 
     */
    public function getFirstOffers()
    {
        return $this->firstOffers;
    }

    /**
     * Set cssUrl
     *
     * @param \AppBundle\Entity\ShopCss $cssUrl
     * @return $this
     */
    public function setCss(\AppBundle\Entity\ShopCss $cssUrl)
    {
        $this->css = $cssUrl;

        return $this;
    }

    /**
     * Get cssUrl
     *
     * @return \AppBundle\Entity\ShopCss
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param \AppBundle\Entity\PromoCode $tutorialPromo
     * @return $this
     */
    public function setTutorialPromoCode(\AppBundle\Entity\PromoCode $tutorialPromo=null)
    {
        $this->tutorialPromoCode = $tutorialPromo;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PromoCode
     */
    public function getTutorialPromoCode()
    {
        return $this->tutorialPromoCode;
    }

    /**
     * @param $tutorialEnabled
     * @return $this
     */
    public function setTutorialEnabled($tutorialEnabled)
    {
        $this->tutorialEnabled = $tutorialEnabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getTutorialEnabled()
    {
        return $this->tutorialEnabled;
    }

    /**
     * @param boolean $payMethodsDefaultOrder
     * @return $this
     */
    public function setPayMethodsDefaultOrder($payMethodsDefaultOrder)
    {
        $this->payMethodsDefaultOrder = $payMethodsDefaultOrder;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPayMethodsDefaultOrder()
    {
        return $this->payMethodsDefaultOrder;
    }

    /**
     * @return ShopOrderTypeEnum
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param ShopOrderTypeEnum $orderType
     *
     * @return AppShop
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * @param boolean $hasCart
     * @return $this
     */
    public function setHasCart($hasCart)
    {
        $this->hasCart = $hasCart;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasCart()
    {
        return $this->hasCart;
    }

    /**
     * @param boolean $hasCategories
     * @return $this
     */
    public function setHasCategories($hasCategories)
    {
        $this->hasCategories = $hasCategories;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasCategories()
    {
        return $this->hasCategories;
    }

}
