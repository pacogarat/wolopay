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
 * @ORM\Table(name="payment_status_category")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 * @XmlRoot("payment_status_category")
 * @ORM\Cache(usage="READ_ONLY", region="payment_status_category")
 */
class PaymentStatusCategory
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="integer")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="string", nullable=false, length=75)
     * @Expose()
     * @Groups({"Default", "Public"})
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
     * @return PaymentDetailStatusCategory
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
     * @return PaymentDetailStatusCategory
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
     * @return PaymentDetailStatusCategory
     */
    private  function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
