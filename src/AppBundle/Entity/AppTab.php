<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="app_tab", uniqueConstraints={@ORM\UniqueConstraint(name="APP_HAS_TAB_UNIQUE", columns={"name_unique", "app_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppTabRepository")
 * @ExclusionPolicy("all")
 * @UniqueEntity({"nameUnique", "app"})
 */
class AppTab
{
    const SONATA_CONTEXT='app_tab';

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"AppTabFull", "Default"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppShop
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="appTabs")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     * @Groups({"AppTabFull"})
     * @Expose()
     * @MaxDepth(1)
     */
    private $app;

    /**
     * @var \AppBundle\Entity\AppShopHasAppTab
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AppShopHasAppTab", mappedBy="appTab")
     */
    private $appShopHasAppTabs;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @Groups({"AppTabFull", "Default","Public"})
     * @Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_unique", type="string", length=45, nullable=true)
     * @Expose()
     * @Groups({"AppTabFull", "Default","AppShopHasAppTabs&Tab"})
     */
    private $nameUnique;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=true)
     * @Groups({"AppTabFull", "Default", "Public"})
     * @Expose()
     */
    private $nameLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     * @Groups({"AppTabFull", "Default", "Public"})
     * @Expose()
     */
    private $descriptionLabel;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Groups({"AppTabFull", "Default"})
     * @Expose()
     */
    private $image;

    /**
     * @var \AppBundle\Entity\PayCategory[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PayCategory")
     * @ORM\JoinTable(name="app_tab_has_pay_categories")
     * @Groups({"AppTabFull"})
     * @Expose()
     */
    private $payCategories;

    /**
     * @var \AppBundle\Entity\ArticleCategory[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ArticleCategory")
     * @ORM\JoinTable(name="app_tab_has_article_categories")
     * @Groups({"AppTabFull"})
     * @Expose()
     */
    private $articleCategories;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     * @Groups({"AppTabFull"})
     * @Expose()
     */
    private $order=999;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime('now');

        $this->articleCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appShopHasAppTabs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set order
     *
     * @param integer $order
     * @return AppTab
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AppTab
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
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return AppTab
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image=null)
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
     * Set name
     *
     * @param string $name
     * @return AppTab
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setNameUnique($name);

        return $this;
    }

    /**
     * @param string $nameUnique
     * @return $this
     */
    protected function setNameUnique($nameUnique)
    {
        // if you modify this function u will need to modify also js
        $this->nameUnique = substr(str_replace(' ', '_', strtolower($nameUnique) ), 0, 45);
        return $this;
    }

    /**
     * @return string
     */
    public function getNameUnique()
    {
        return $this->nameUnique;
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
     * Set nameLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel
     * @return AppTab
     */
    public function setNameLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel=null)
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
     * @return AppTab
     */
    public function setDescriptionLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel=null)
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
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return AppTab
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
     * Add payCategories
     *
     * @param \AppBundle\Entity\PayCategory $payCategories
     * @return AppTab
     */
    public function addPayCategory(\AppBundle\Entity\PayCategory $payCategories)
    {
        $this->payCategories[] = $payCategories;

        return $this;
    }

    /**
     * Remove payCategories
     *
     * @param \AppBundle\Entity\PayCategory $payCategories
     */
    public function removePayCategory(\AppBundle\Entity\PayCategory $payCategories)
    {
        $this->payCategories->removeElement($payCategories);
    }

    /**
     * Get payCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayCategories()
    {
        return $this->payCategories;
    }

    /**
     * @param $payCategories
     * @internal param $articleCategories
     * @return $this
     */
    public function setPayCategories($payCategories)
    {
        $this->payCategories->clear();

        foreach ($payCategories as $payCategory)
            $this->payCategories[] = $payCategory;

        return $this;
    }

    /**
     * @param $articleCategories
     * @return $this
     */
    public function setArticleCategory($articleCategories)
    {
        $this->articleCategories->clear();

        foreach ($articleCategories as $articleCategory)
            $this->articleCategories[] = $articleCategory;

        return $this;
    }

    /**
     * Add articleCategories
     *
     * @param \AppBundle\Entity\ArticleCategory $articleCategories
     * @return AppTab
     */
    public function addArticleCategory(\AppBundle\Entity\ArticleCategory $articleCategories)
    {
        $this->articleCategories[] = $articleCategories;

        return $this;
    }

    /**
     * Remove articleCategories
     *
     * @param \AppBundle\Entity\ArticleCategory $articleCategories
     */
    public function removeArticleCategory(\AppBundle\Entity\ArticleCategory $articleCategories)
    {
        $this->articleCategories->removeElement($articleCategories);
    }

    /**
     * Get articleCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticleCategories()
    {
        return $this->articleCategories;
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
     * @param \AppBundle\Entity\AppShopHasAppTab $appShopHasAppTabs
     * @return $this
     */
    public function setAppShopHasAppTabs($appShopHasAppTabs)
    {
        $this->appShopHasAppTabs = $appShopHasAppTabs;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppShopHasAppTab
     */
    public function getAppShopHasAppTabs()
    {
        return $this->appShopHasAppTabs;
    }


}
