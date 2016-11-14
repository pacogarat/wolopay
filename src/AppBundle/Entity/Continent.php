<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Country
 *
 * @ORM\Table(name="continent")
 * @ORM\Entity()
 * @ExclusionPolicy("all")
 * @ORM\Cache(usage="READ_ONLY", region="continent_region")
 */
class Continent
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Exclude
     */
    private $createdAt;


    function __construct($name)
    {
        $this->createdAt = new \DateTime('now');
        $this->id = str_replace(' ', '_', strtolower($name));
        $this->name = $name;
    }

    public  function __toString()
    {
        return $this->name;
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
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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



}
