<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction_status_category")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 * @XmlRoot("transaction_status_category")
 * @ORM\Cache(usage="READ_ONLY", region="transaction_status_category_region")
 */
class TransactionStatusCategory
{
    /**
     * Values available: 1 = Begin, 25 = Shopping, 50 = Processing, 100 = Pending, 200 = Completed, 500 = Failed, 700 = Blocked, 1000 = Expired
     *
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="integer")
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="string", nullable=false, length=75)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * Constructor
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->createdAt = new \DateTime('now');
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
     * Set name
     *
     * @param string $name
     * @return StateCategory
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
     * @return StateCategory
     */
    private function setCreatedAt($createdAt)
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
     * Set id
     *
     * @param integer $id
     * @return StateCategory
     */
    private  function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
