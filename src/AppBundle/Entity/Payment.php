<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="payment", uniqueConstraints={@ORM\UniqueConstraint(name="transaction_external_id_UNIQUE", columns={"transaction_external_id"})})
 * @ORM\InheritanceType("JOINED")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PaymentRepository")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"subscription" = "\AppBundle\Entity\SubscriptionEventualityPayment", "single_payment" = "\AppBundle\Entity\SinglePayment" , "single_free_payment" = "\AppBundle\Entity\SingleFreePayment", "single_custom_payment" = "\AppBundle\Entity\SingleCustomPayment", "unknown" = "\AppBundle\Entity\Payment"})
 * @UniqueEntity("transactionExternalId")
 * @ExclusionPolicy("all")
 * @XmlRoot("payment")
 */
class Payment
{
    /**
     * @var string $id
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\PaymentStatusCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentStatusCategory")
     * @ORM\JoinColumn(name="state_category_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $statusCategory;

    /**
     * @var \AppBundle\Entity\Purchase
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Purchase", mappedBy="payment")
     */
    private $purchase;

    /**
     * @var \AppBundle\Entity\PaymentDetail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetail", cascade={"all"}, inversedBy="payment")
     * @ORM\JoinColumn(name="payment_detail_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $paymentDetail;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gamer")
     * @ORM\JoinColumn(name="gamer_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $gamer;

    /**
     * Only show when payment was completed, if u haven't amount go to paymentDetail->getAmount
     * @var float
     *
     * @ORM\Column(name="amount", type="float", scale=2, precision=10, nullable=true)
     */
    protected $amount=null;

    /**
     * @var float
     *
     * @ORM\Column(name="transaction_external_id", type="string", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $transactionExternalId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable("UPDATE")
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set statusCategory
     *
     * @param \AppBundle\Entity\PaymentStatusCategory $statusCategory
     * @return $this
     */
    public function setStatusCategory(\AppBundle\Entity\PaymentStatusCategory $statusCategory)
    {
        $this->statusCategory = $statusCategory;

        return $this;
    }

    /**
     * Get statusCategory
     *
     * @return \AppBundle\Entity\PaymentStatusCategory
     */
    public function getStatusCategory()
    {
        return $this->statusCategory;
    }

    /**
     * Set transactionExternalId
     *
     * @param string $transactionExternalId
     * @return $this
     */
    public function setTransactionExternalId($transactionExternalId)
    {
        $this->transactionExternalId = $transactionExternalId;

        return $this;
    }

    /**
     * Get transactionExternalId
     *
     * @return string 
     */
    public function getTransactionExternalId()
    {
        return $this->transactionExternalId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return $this
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set paymentDetail
     *
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return Payment
     */
    public function setPaymentDetail(\AppBundle\Entity\PaymentDetail $paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;

        return $this;
    }

    /**
     * Get paymentDetail
     *
     * @return \AppBundle\Entity\PaymentDetail
     */
    public function getPaymentDetail()
    {
        return $this->paymentDetail;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $amount = round($amount, 2);
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Payment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set purchase
     *
     * @param \AppBundle\Entity\Purchase $purchase
     * @return Payment
     */
    public function setPurchase(\AppBundle\Entity\Purchase $purchase = null)
    {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * Get purchase
     *
     * @return \AppBundle\Entity\Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @param \AppBundle\Entity\App $app
     * @return $this
     */
    public function setApp(App $app)
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
     * Set gamer
     *
     * @param \AppBundle\Entity\Gamer $gamer
     * @return $this
     */
    public function setGamer(\AppBundle\Entity\Gamer $gamer)
    {
        $this->gamer = $gamer;

        return $this;
    }

    /**
     * Get gamer
     *
     * @return \AppBundle\Entity\Gamer
     */
    public function getGamer()
    {
        return $this->gamer;
    }

    /**
     * @return PaymentProcessInterface
     */
    public function getPaymentProcess()
    {
        return $this;
    }
}
