<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="purchase_notification")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PurchaseNotificationRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("purchase_notification")
 */
class PurchaseNotification
{
    const PREFIX = 'WONOT_';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * Can be empty because some payments like CustomPayments haven't articles
     *
     * @var \AppBundle\Entity\PurchaseNotification
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetailHasArticles", inversedBy="purchaseNotifications")
     * @ORM\JoinColumn(name="payment_detail_has_article_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @MaxDepth(2)
     */
    private $paymentDetailHasArticle;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amount;

    /**
     * @var int
     *
     * @ORM\Column(name="attempts", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $attempts=0;

    /**
     * each articleQuantity in paymentDetailHasArticle 0, 1, 2 ....
     *
     * @var int
     *
     * @ORM\Column(name="number_of_payment_detail_has_article", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $numberOfPaymentDetailHasArticle=0;

    /**
     * Can be empty because some payments like CustomPayments haven't articles
     *
     * @var \AppBundle\Entity\PurchaseNotification
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetailArticlesHasGivenArticle", inversedBy="purchaseNotifications")
     * @ORM\JoinColumn(name="payment_detail_article_has_given_article_id", referencedColumnName="id", nullable=true)
     * @Expose()
     * @MaxDepth(2)
     * @Groups({"PurchaseNotificationAddPaymentDetailArticlesHasGivenArticle"})
     */
    private $paymentDetailArticlesHasGivenArticle;

    /**
     * @var float
     *
     * @ORM\Column(name="event", type="string", length=30, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $event;

    /**
     * @var float
     *
     * @ORM\Column(name="transaction_suffix", type="string", length=10, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $transactionSuffix='';

    /**
     * @var boolean
     *
     * @ORM\Column(name="was_received", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $wasReceived = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_ready_to_notify", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $isReadyToNotify = false;

    /**
     * Extra url from App
     *
     * @var boolean
     *
     * @ORM\Column(name="is_extra", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $isExtra = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="force_to_notify", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $forceToNotify = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_subscription", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $isSubscription = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_only_one_attempt", type="boolean", nullable=true)
     */
    private $hasOnlyOneAttempt = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancel_payment_if_notification_fail", type="boolean", nullable=true)
     */
    private $cancelPaymentIfNotificationFail = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_async", type="boolean", nullable=true)
     */
    private $isAsync = true;

    /**
     * @var \AppBundle\Entity\Purchase[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Purchase", inversedBy="purchaseNotification")
     * @ORM\JoinTable(name="purchase_has_purchase_notification")
     * @Expose()
     * @MaxDepth(3)
     * @Groups({"Default", "Public"})
     */
    private $purchases;

    /**
     * @var array
     *
     * @ORM\Column(name="requests", type="json_array", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Type("array")
     */
    private $requests=[];

    /**
     * is used by special articles with gatcha
     *
     * @var \DateTime
     * @Expose()
     * @Groups({"Default"})
     * @ORM\Column(name="min_delay", type="datetime", nullable=true)
     */
    private $minDelay;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable("UPDATE")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->purchases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id        = uniqid(self::PREFIX);
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    public function __toString()
    {
        return $this->getId().' '.$this->getWasReceived();
    }

    /**
     * Set attempts
     *
     * @param integer $attempts
     * @return PurchaseNotification
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;

        return $this;
    }

    /**
     * Add 1 attempt
     *
     * @return PurchaseNotification
     */
    public function addAttempt()
    {
        $this->attempts++;

        return $this;
    }

    /**
     * Get attempts
     *
     * @return integer 
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PurchaseNotification
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
     * @return PurchaseNotification
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
     * Set requests
     *
     * @param array $requests
     * @return PurchaseNotification
     */
    public function setRequests($requests)
    {
        $this->requests = $requests;

        return $this;
    }

    /**
     * Get requests
     *
     * @return array 
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param array $request
     * @param null|integer $attemp
     */
    public function addRequestResponse(array $request, $attemp = null)
    {
        if (!$attemp)
            $attemp= $this->attempts;

        $this->requests[$attemp]['response']=$request;
    }

    /**
     * @param array $request
     * @param null|integer $attemp
     */
    public function addRequestRequest(array $request, $attemp = null)
    {
        if (!$attemp)
            $attemp= $this->attempts;

        $this->requests[$attemp]['request']=$request;
    }

    /**
     * @param null|integer $attemp
     * @return array
     */
    public function getRequestExact( $attemp = null)
    {
        if (!$attemp)
            $attemp= $this->attempts;

        return $this->requests[$attemp];
    }

    /**
     * Set id
     *
     * @param string $id
     * @return PurchaseNotification
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set amount
     *
     * @param float $amount
     * @return PurchaseNotification
     */
    public function setAmount($amount)
    {
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
     * Set wasReceived
     *
     * @param boolean $wasReceived
     * @return PurchaseNotification
     */
    public function setWasReceived($wasReceived)
    {
        $this->wasReceived = $wasReceived;

        return $this;
    }

    /**
     * Get wasReceived
     *
     * @return boolean 
     */
    public function getWasReceived()
    {
        return $this->wasReceived;
    }

    /**
     * Set isReadyToNotify
     *
     * @param boolean $isReadyToNotify
     * @return PurchaseNotification
     */
    public function setIsReadyToNotify($isReadyToNotify)
    {
        $this->isReadyToNotify = $isReadyToNotify;

        return $this;
    }

    /**
     * Get isReadyToNotify
     *
     * @return boolean 
     */
    public function getIsReadyToNotify()
    {
        return $this->isReadyToNotify;
    }

    /**
     * Set transactionSuffix
     *
     * @param string $transactionSuffix
     * @return PurchaseNotification
     */
    public function setTransactionSuffix($transactionSuffix)
    {
        $this->transactionSuffix = $transactionSuffix;

        return $this;
    }

    /**
     * Get transactionSuffix
     *
     * @return string 
     */
    public function getTransactionSuffix()
    {
        return $this->transactionSuffix;
    }

    /**
     * Set isSubscription
     *
     * @param boolean $isSubscription
     * @return PurchaseNotification
     */
    public function setIsSubscription($isSubscription)
    {
        $this->isSubscription = $isSubscription;

        return $this;
    }

    /**
     * Get isSubscription
     *
     * @return boolean 
     */
    public function getIsSubscription()
    {
        return $this->isSubscription;
    }

    /**
     * Add purchases
     *
     * @param \AppBundle\Entity\Purchase $purchases
     * @return PurchaseNotification
     */
    public function addPurchase(\AppBundle\Entity\Purchase $purchases)
    {
        /** @var \Doctrine\Common\Collections\Collection  $collection */
        $collection=$this->purchases;

        if (!$collection->contains($purchases))
        {
            $this->purchases[] = $purchases;
            $purchases->addPurchaseNotification($this);
        }

        return $this;
    }

    /**
     * Add purchases
     *
     * @param \AppBundle\Entity\Purchase $purchases
     * @return PurchaseNotification
     */
    public function setPurchases($purchases)
    {
        $this->purchases = $purchases;

        return $this;
    }

    /**
     * Remove purchases
     *
     * @param \AppBundle\Entity\Purchase $purchases
     */
    public function removePurchase(\AppBundle\Entity\Purchase $purchases)
    {
        $this->purchases->removeElement($purchases);
    }

    /**
     * Get purchases
     *
     * @return Purchase[]
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Set paymentDetailHasArticle
     *
     * @param \AppBundle\Entity\PaymentDetailHasArticles $paymentDetailHasArticle
     * @return PurchaseNotification
     */
    public function setPaymentDetailHasArticle(\AppBundle\Entity\PaymentDetailHasArticles $paymentDetailHasArticle)
    {
        $this->paymentDetailHasArticle = $paymentDetailHasArticle;

        return $this;
    }

    /**
     * Get paymentDetailHasArticle
     *
     * @return \AppBundle\Entity\PaymentDetailHasArticles
     */
    public function getPaymentDetailHasArticle()
    {
        return $this->paymentDetailHasArticle;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return PurchaseNotification
     */
    public function setApp(\AppBundle\Entity\App $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return \AppBundle\Entity\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param boolean $forceToNotify
     * @return $this
     */
    public function setForceToNotify($forceToNotify)
    {
        $this->forceToNotify = $forceToNotify;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getForceToNotify()
    {
        return $this->forceToNotify;
    }

    /**
     * @param boolean $isExtra
     * @return $this
     */
    public function setIsExtra($isExtra)
    {
        $this->isExtra = $isExtra;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsExtra()
    {
        return $this->isExtra;
    }

    public function __clone()
    {
        $this->id .= '_EXTRA';

    }

    /**
     * @param boolean $hasOnlyOneAttempt
     * @return $this
     */
    public function setHasOnlyOneAttempt($hasOnlyOneAttempt)
    {
        $this->hasOnlyOneAttempt = $hasOnlyOneAttempt;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasOnlyOneAttempt()
    {
        return $this->hasOnlyOneAttempt;
    }

    /**
     * @param boolean $isAsync
     * @return $this
     */
    public function setIsAsync($isAsync)
    {
        $this->isAsync = $isAsync;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsAsync()
    {
        return $this->isAsync;
    }

    /**
     * @param boolean $cancelPaymentIfNotificationFail
     * @return $this
     */
    public function setCancelPaymentIfNotificationFail($cancelPaymentIfNotificationFail)
    {
        $this->cancelPaymentIfNotificationFail = $cancelPaymentIfNotificationFail;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCancelPaymentIfNotificationFail()
    {
        return $this->cancelPaymentIfNotificationFail;
    }

    public function getArticlesString()
    {
        $articlesStr = '';

        foreach ($this->purchases as $pu)
            $articlesStr .= $pu->getArticlesString();

        return $articlesStr;
    }

    public function getRemainingAttempts()
    {
        return $this->app->getNotificationRetriesOnFailure() - $this->getAttempts();
    }

    /**
     * @param \DateTime $minDelay
     * @return $this
     */
    public function setMinDelay($minDelay)
    {
        $this->minDelay = $minDelay;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMinDelay()
    {
        return $this->minDelay;
    }

    /**
     * @param int $numberOfPaymentDetailHasArticle
     * @return $this
     */
    public function setNumberOfPaymentDetailHasArticle($numberOfPaymentDetailHasArticle)
    {
        $this->numberOfPaymentDetailHasArticle = $numberOfPaymentDetailHasArticle;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfPaymentDetailHasArticle()
    {
        return $this->numberOfPaymentDetailHasArticle;
    }

    /**
     * @param \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle
     * @return $this
     */
    public function setPaymentDetailArticlesHasGivenArticle($paymentDetailArticlesHasGivenArticle)
    {
        $this->paymentDetailArticlesHasGivenArticle = $paymentDetailArticlesHasGivenArticle;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle
     */
    public function getPaymentDetailArticlesHasGivenArticle()
    {
        return $this->paymentDetailArticlesHasGivenArticle;
    }

    /**
     * @param float $event
     * @return $this
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return float
     */
    public function getEvent()
    {
        return $this->event;
    }



}
