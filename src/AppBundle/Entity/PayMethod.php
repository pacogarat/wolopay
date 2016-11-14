<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;

/**
 * PayMethod
 *
 * @ORM\Table(name="pay_method", indexes={ @Index (name="pay_method_id_pay_category", columns={"id","article_category_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PayMethodRepository")
 * @ExclusionPolicy("all")
 */
class PayMethod
{
    const SONATA_CONTEXT='pay_method';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"Admin", "PayMethodList"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\PayCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayCategory")
     * @ORM\JoinColumn(name="pay_category_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "PayMethodList"})
     */
    private $payCategory;

    /**
     * @var \AppBundle\Entity\ArticleCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArticleCategory")
     * @ORM\JoinColumn(name="article_category_id", referencedColumnName="id", nullable=false)
     */
    private $articleCategory;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PayMethodHasProvider", mappedBy="payMethod")
     * @Expose()
     * @Groups({"Admin"})
     */
    private $payMethodHasProvider;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "PayMethodList"})
     */
    private $name;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="img_icon", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "PayMethodList"})
     * @Inline()
     */
    private $imgIcon;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $descriptionLabel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function  __toString()
    {
        return $this->getName();
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
     * @return PayMethod
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
     * Set payCategory
     *
     * @param \AppBundle\Entity\PayCategory $payCategory
     * @return PayMethod
     */
    public function setPayCategory(\AppBundle\Entity\PayCategory $payCategory)
    {
        $this->payCategory = $payCategory;

        return $this;
    }

    /**
     * Get payCategory
     *
     * @return \AppBundle\Entity\PayCategory
     */
    public function getPayCategory()
    {
        return $this->payCategory;
    }

    /**
     * Add payMethodHasProvider
     *
     * @param \AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider
     * @return PayMethod
     */
    public function addPayMethodHasProvider(\AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider)
    {
        $this->payMethodHasProvider[] = $payMethodHasProvider;

        return $this;
    }

    /**
     * Remove payMethodHasProvider
     *
     * @param \AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider
     */
    public function removePayMethodHasProvider(\AppBundle\Entity\PayMethodHasProvider $payMethodHasProvider)
    {
        $this->payMethodHasProvider->removeElement($payMethodHasProvider);
    }

    /**
     * Get payMethodHasProvider
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayMethodHasProvider()
    {
        return $this->payMethodHasProvider;
    }

    /**
     * Set imgIcon
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imgIcon
     * @return PayMethod
     */
    public function setImgIcon(\Application\Sonata\MediaBundle\Entity\Media $imgIcon)
    {
        $this->imgIcon = $imgIcon;

        return $this;
    }

    /**
     * Get imgIcon
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImgIcon()
    {
        return $this->imgIcon;
    }

    /**
     * Set descriptionLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel
     * @return PayMethodHasProvider
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
     * @param \AppBundle\Entity\ArticleCategory $articleCategory
     * @return $this
     */
    public function setArticleCategory($articleCategory)
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

}
