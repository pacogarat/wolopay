<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LevelCategory
 *
 * @ORM\Table(name="level_category")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\LevelCategoryRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("level_category")
 */
class LevelCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public", "Basic", "ArticleFull"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Basic", "ArticleFull"})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_generic", type="boolean", nullable=false)
     */
    private $isGeneric=false;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="appLevels")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=true)
     */
    protected $app;


    function __construct($id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return LevelCategory
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


     /**
     * @return boolean
     */
    public function getIsGeneric()
    {
        return $this->isGeneric;
    }

    /**
     * @param boolean $isGeneric
     *
     * @return LevelCategory
     */
    public function setIsGeneric($isGeneric)
    {
        $this->isGeneric = $isGeneric;

        return $this;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     *
     * @return LevelCategory
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }


}
