<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Transaction
 *
 * @ORM\Table(name="payment_service_category")
 * @ORM\Entity
 * @XmlRoot("payment_service_category")
 * @ORM\Cache(usage="READ_ONLY", region="payment_service_region")
 */
class PaymentServiceCategory
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="string", nullable=true, length=75)
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
        return str_replace('shop.payment.', '', $this->id);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PaymentServiceCategory
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
     * Set name
     *
     * @param string $name
     * @return PaymentServiceCategory
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
     * Set id
     *
     * @param string $id
     * @return PaymentServiceCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


}
