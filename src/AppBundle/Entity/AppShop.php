<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SuperClass\AppShopBase;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * AppShop
 *
 * @ORM\Table(name="app_shop")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppShopRepository")
 * @XmlRoot("app_shop")
 * @ExclusionPolicy("all")
 */
class AppShop extends AppShopBase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @Expose()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppShopHasArticle[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AppShopHasArticle", mappedBy="appShop", orphanRemoval=true)
     * @ORM\OrderBy({"order" = "ASC"})
     */
    private $appShopHasArticles;

    /**
     * @var \AppBundle\Entity\AppShopHasAppTab[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AppShopHasAppTab", mappedBy="appShop", orphanRemoval=true)
     * @Expose()
     */
    private $appShopHasAppTabs;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "AppShopHasArticleFull"})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active=true;

    function __toString()
    {
        return ($this->getLevelCategory() ? $this->getLevelCategory()->getName() : '' ) .' - '. $this->getValueLower().' - '.$this->getValueHigher();
    }

    public function __construct()
    {
        parent::__construct();

        $this->appShopHasArticles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appShopHasAppTabs  = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return AppShop
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
     * Add appShopHasArticles
     *
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticles
     * @return AppShop
     */
    public function addAppShopHasArticle(\AppBundle\Entity\AppShopHasArticle $appShopHasArticles)
    {
        $this->appShopHasArticles[] = $appShopHasArticles;

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
     * Get appShopHasArticles
     *
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function getAppShopHasArticles()
    {
        return $this->appShopHasArticles;
    }

    /**
     * @param $articleId
     * @param $countryId
     * @return AppShopHasArticle|null
     * @deprecated DB cost is high
     */
    public function getAppShopHasArticleByArticleIdAndCountry($articleId, $countryId)
    {
        foreach ($this->getAppShopHasArticles() as $appShopHasArticle)
        {
            if ($appShopHasArticle->getArticle()->getId() == $articleId && $appShopHasArticle->getCountry()->getId() == $countryId)
                return $appShopHasArticle;
        }

        return null;
    }

    /**
     * @param $articleId
     * @return AppShopHasArticle[]
     */
    public function getAppShopHasArticleByArticleId($articleId)
    {
        $result = [];

        foreach ($this->getAppShopHasArticles() as $appShopHasArticle)
        {
            if ($appShopHasArticle->getArticle()->getId() == $articleId)
                $result[]= $appShopHasArticle;
        }

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
     * @param \AppBundle\Entity\AppShopHasAppTab[] $appShopHasAppTabs
     * @return $this
     */
    public function setAppShopHasAppTabs($appShopHasAppTabs)
    {
        $this->appShopHasAppTabs = $appShopHasAppTabs;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppShopHasAppTab[]
     */
    public function getAppShopHasAppTabs()
    {
        return $this->appShopHasAppTabs;
    }

}
