<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription_eventuality")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SubscriptionEventualityRepository")
 */
class SubscriptionEventuality
{
    const PREFIX = 'SUBPAY_';

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Subscription
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Subscription", inversedBy="subscriptionEventualities")
     * @ORM\JoinColumn(name="subscription_id", referencedColumnName="id", nullable=false)
     */
    private $subscription;

    /**
     * @var \AppBundle\Entity\SubscriptionEventualityPayment
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SubscriptionEventualityPayment", mappedBy="subscriptionEventuality")
     */
    private $subscriptionEventualityPayments;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_amount", type="float", type="float", scale=2, precision=10)
     */
    private $totalAmount=0;

    /**
     * @var String
     *
     * @ORM\Column(name="n_purchases", type="integer", nullable=false)
     */
    private $nPurchase=0;

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
     * @var \DateTime
     *
     * Used to Partial payments Not for regular payments be carefull. is null until next payment
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     */
    protected $endAt;

    public function __construct(Subscription $subscription=null)
    {
        $this->subscriptionEventualityPayments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = uniqid(self::PREFIX .date("YmdHi"));
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');

        if ($subscription)
        {
            $this->setSubscription($subscription);
        }
    }

    public function __toString()
    {
        return (string) $this->getId();
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
     * Set nPurchase
     *
     * @param integer $nPurchase
     * @return SubscriptionEventuality
     */
    public function setNPurchase($nPurchase)
    {
        $this->nPurchase = $nPurchase;

        return $this;
    }

    /**
     * Set nPurchase
     *
     * @param int $n
     * @return SubscriptionEventuality
     */
    public function addNPurchase($n=1)
    {
        $this->nPurchase += $n;

        return $this;
    }

    /**
     * Get nPurchase
     *
     * @return integer
     */
    public function getNPurchase()
    {
        return $this->nPurchase;
    }

    /**
     * Set subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     * @return SubscriptionEventuality
     */
    public function setSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription
     *
     * @return \AppBundle\Entity\Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     * @return SubscriptionEventuality
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     * @return SubscriptionEventuality
     */
    public function addTotalAmount($totalAmount)
    {
        $this->totalAmount += $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return float 
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return SubscriptionEventuality
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SubscriptionEventuality
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
     * @return SubscriptionEventuality
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
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return SubscriptionEventuality
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Set setEndAtNow
     *
     * @return $this
     */
    public function setEndAtNow()
    {
        $this->endAt = new \DateTime('now');

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime 
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Add subscriptionEventualityPayments
     *
     * @param \AppBundle\Entity\SubscriptionEventualityPayment $subscriptionEventualityPayments
     * @return SubscriptionEventuality
     */
    public function addSubscriptionEventualityPayment(\AppBundle\Entity\SubscriptionEventualityPayment $subscriptionEventualityPayments)
    {
        $this->subscriptionEventualityPayments[] = $subscriptionEventualityPayments;

        return $this;
    }

    /**
     * Remove subscriptionEventualityPayments
     *
     * @param \AppBundle\Entity\SubscriptionEventualityPayment $subscriptionEventualityPayments
     */
    public function removeSubscriptionEventualityPayment(\AppBundle\Entity\SubscriptionEventualityPayment $subscriptionEventualityPayments)
    {
        $this->subscriptionEventualityPayments->removeElement($subscriptionEventualityPayments);
    }

    /**
     * Get subscriptionEventualityPayments
     *
     * @return \AppBundle\Entity\SubscriptionEventualityPayment[]
     */
    public function getSubscriptionEventualityPayments()
    {
        return $this->subscriptionEventualityPayments;
    }
}
