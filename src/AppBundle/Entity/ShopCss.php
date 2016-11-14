<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Util\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Item
 *
 * @ORM\Table(name="shop_css")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ShopCssRepository")
 * @XmlRoot("shop_css")
 */
class ShopCss
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"ArticleFull"})
     */
    private $id;

    /**
     * @var String
     *
     * @ORM\Column(name="css_url", type="string", length=255, nullable=false)
     */
    private $cssUrl;

    /**
     * @var String
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="product_rows", type="smallint", nullable=false)
     */
    private $productRows=1;

    /**
     * @var int
     *
     * @ORM\Column(name="pay_method_rows", type="smallint", nullable=false)
     */
    private $payMethodRows=1;

    /**
     * It can switch order of payMethod -> Products
     * @var boolean
     *
     * @ORM\Column(name="modular", type="boolean", nullable=false)
     */
    private $modular=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_categories", type="boolean", nullable=false)
     */
    private $hasCategories=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_cart", type="boolean", nullable=false)
     */
    private $hasCart=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean", nullable=false)
     */
    private $public=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active=true;

    /**
     * Exclusive to apps
     *
     * @var \AppBundle\Entity\App[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\App")
     * @ORM\JoinTable(name="shop_css_has_apps")
     */
    private $apps;

    /**
     * @var String
     *
     * @ORM\Column(name="products_img_format", type="string", length=50, nullable=true)
     */
    private $productsImgFormat=null;

    /**
     * @var String
     *
     * @ORM\Column(name="pay_methods_img_format", type="string", length=50, nullable=true)
     */
    private $payMethodsImgFormat=null;

    /**
     * @var String
     *
     * @ORM\Column(name="template_layout", type="string", length=50, nullable=true)
     */
    private $templateLayout=null;

    /**
     * @var String
     *
     * @ORM\Column(name="template_products", type="string", length=50, nullable=true)
     */
    private $templateProducts=null;

    /**
     * @var String
     *
     * @ORM\Column(name="template_pay_methods", type="string", length=50, nullable=true)
     */
    private $templatePayMethods=null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');

        $this->apps = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Set cssUrl
     *
     * @param string $cssUrl
     * @return ShopCss
     */
    public function setCssUrl($cssUrl)
    {
        $this->cssUrl = $cssUrl;

        return $this;
    }

    /**
     * Get cssUrl
     *
     * @return string 
     */
    public function getCssUrl()
    {
        return $this->cssUrl;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ShopCss
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
     * @return ShopCss
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
     * Set active
     *
     * @param boolean $active
     * @return ShopCss
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
     * @param boolean $public
     * @return $this
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }



    /**
     * Add apps
     *
     * @param \AppBundle\Entity\App $apps
     * @return ShopCss
     */
    public function addApp(\AppBundle\Entity\App $apps)
    {
        $this->apps[] = $apps;

        return $this;
    }

    /**
     * Remove apps
     *
     * @param \AppBundle\Entity\App $apps
     */
    public function removeApp(\AppBundle\Entity\App $apps)
    {
        $this->apps->removeElement($apps);
    }

    /**
     * Get apps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApps()
    {
        return $this->apps;
    }

    /**
     * @param boolean $modular
     * @return $this
     */
    public function setModular($modular)
    {
        $this->modular = $modular;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getModular()
    {
        return $this->modular;
    }

    /**
     * @param int $payMethodRows
     * @return $this
     */
    public function setPayMethodRows($payMethodRows)
    {
        $this->payMethodRows = $payMethodRows;
        return $this;
    }

    /**
     * @return int
     */
    public function getPayMethodRows()
    {
        return $this->payMethodRows;
    }

    /**
     * @param int $productRows
     * @return $this
     */
    public function setProductRows($productRows)
    {
        $this->productRows = $productRows;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductRows()
    {
        return $this->productRows;
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

    /**
     * @param String $templateLayout
     * @return $this
     */
    public function setTemplateLayout($templateLayout)
    {
        $this->templateLayout = $templateLayout;
        return $this;
    }

    /**
     * @return String
     */
    public function getTemplateLayout()
    {
        return $this->templateLayout;
    }

    /**
     * @param String $templateProducts
     * @return $this
     */
    public function setTemplateProducts($templateProducts)
    {
        $this->templateProducts = $templateProducts;
        return $this;
    }

    /**
     * @return String
     */
    public function getTemplateProducts()
    {
        return $this->templateProducts;
    }

    /**
     * @param String $templatePayMethods
     * @return $this
     */
    public function setTemplatePayMethods($templatePayMethods)
    {
        $this->templatePayMethods = $templatePayMethods;
        return $this;
    }

    /**
     * @return String
     */
    public function getTemplatePayMethods()
    {
        return $this->templatePayMethods;
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
     * @param String $payMethodsImgFormat
     * @return $this
     */
    public function setPayMethodsImgFormat($payMethodsImgFormat)
    {
        $this->payMethodsImgFormat = $payMethodsImgFormat;
        return $this;
    }

    /**
     * @return String
     */
    public function getPayMethodsImgFormat()
    {
        return $this->payMethodsImgFormat;
    }

    /**
     * @param String $productsImgFormat
     * @return $this
     */
    public function setProductsImgFormat($productsImgFormat)
    {
        $this->productsImgFormat = $productsImgFormat;
        return $this;
    }

    /**
     * @return String
     */
    public function getProductsImgFormat()
    {
        return $this->productsImgFormat;
    }

}
