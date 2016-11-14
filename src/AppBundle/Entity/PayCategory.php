<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * PayCategory
 * this class is informative and it does not affect the logic
 *
 * @ORM\Table(name="pay_catergory")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 * @ORM\Cache(usage="READ_ONLY", region="pay_category_region")
 */
class PayCategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public", "Admin"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "PayCategoryName"})
     */
    private $name;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function  __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PayCategory
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
     * Set id
     *
     * @param integer $id
     * @return PayCategory
     */
    private  function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
