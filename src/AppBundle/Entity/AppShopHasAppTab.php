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
 * @ORM\Table(name="app_shop_has_app_tabs", uniqueConstraints={@ORM\UniqueConstraint(name="APP_SHOP_HAS_TAB_UNIQUE", columns={"app_shop_id", "app_tab_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppShopHasAppTabRepository")
 * @ExclusionPolicy("all")
 * @UniqueEntity({"appShop", "appTab"})
 */
class AppShopHasAppTab
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppShop
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppShop", inversedBy="appShopHasAppTabs")
     * @ORM\JoinColumn(name="app_shop_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Admin"})
     * @MaxDepth(2)
     */
    private $appShop;

    /**
     * @var \AppBundle\Entity\AppTab
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppTab", inversedBy="appShopHasAppTabs")
     * @ORM\JoinColumn(name="app_tab_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @Expose()
     * @Groups({"Default", "Admin","AppShopHasAppTabs&Tab"})
     */
    private $appTab;

    /**
     * @var \AppBundle\Entity\Article[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Article", inversedBy="appShopHasAppTab")
     * @ORM\JoinTable(name="app_shop_app_tab_has_articles")
     * @Groups({"Admin", "AppShopHasAppTabFull"})
     * @Expose()
     * @MaxDepth(2)
     */
    private $articles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payCategories = new \Doctrine\Common\Collections\ArrayCollection();

        $this->createdAt = new \DateTime('now');
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
     * Add articles
     *
     * @param \AppBundle\Entity\Article $articles
     * @return AppTab
     */
    public function setArticle($articles)
    {
        $this->articles->clear();

        foreach ($articles as $article)
            $this->articles[] = $article;

        return $this;
    }

    /**
     * Add articles
     *
     * @param Article $article
     * @return AppTab
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        if (!$this->articles->contains($article))
            $this->articles[] = $article;

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
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
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
        $this->nameUnique = str_replace(' ', '_', strtolower($nameUnique) );
        return $this;
    }

    /**
     * @param \AppBundle\Entity\AppShop $appShop
     * @return $this
     */
    public function setAppShop(\AppBundle\Entity\AppShop $appShop)
    {
        $this->appShop = $appShop;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppShop
     */
    public function getAppShop()
    {
        return $this->appShop;
    }

    /**
     * @param \AppBundle\Entity\AppTab $appTab
     * @return $this
     */
    public function setAppTab(\AppBundle\Entity\AppTab $appTab)
    {
        $this->appTab = $appTab;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\AppTab
     */
    public function getAppTab()
    {
        return $this->appTab;
    }


}
