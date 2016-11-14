<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Util\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Item
 *
 * @ORM\Table(name="item_tab", uniqueConstraints={@ORM\UniqueConstraint(name="ITEM_TAB_NAME_UNIQUE", columns={"name_unique", "app_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ItemTabRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("item")
 * @UniqueEntity({"nameUnique", "app"})
 */
class ItemTab
{
    const SONATA_CONTEXT='item_tab';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"Default", "ItemTabDefault"})
     * @Expose()
     */
    private $id;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="itemTabs")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @Groups({"Default", "ItemTabDefault"})
     * @Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_unique", type="string", length=45, nullable=true)
     * @Groups({"Default", "ItemTabDefault"})
     * @Expose()
     */
    private $nameUnique;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="name_label_id", referencedColumnName="id", nullable=true)
     * @Groups({"Default"})
     * @Expose()
     */
    private $nameLabel;

    /**
     * Not used at this moment
     *
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="description_label_id", referencedColumnName="id", nullable=true)
     * @Groups({"Default"})
     * @Expose()
     */
    private $descriptionLabel;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Groups({"Default"})
     * @Expose()
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="`order`", type="integer")
     * @Groups({"Default"})
     * @Expose()
     */
    private $order=999;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param MediaInterface $image
     * @return $this
     */
    public function setImage(MediaInterface $image = null)
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
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setNameUnique($name);
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
     * @param string $nameUnique
     * @return $this
     */
    public function setNameUnique($nameUnique)
    {
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

}
