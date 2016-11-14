<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\CurrencyEnum;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription", uniqueConstraints={@ORM\UniqueConstraint(name="subscription_transaction_external_id_UNIQUE", columns={"transaction_external_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SubscriptionRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("subscription")
 */
class Subscription implements PaymentProcessInterface
{
    const PREFIX = 'SUB_';
    /**
     * @var integer $id
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
     * @var integer
     *
     * @ORM\Column(name="periodicity", type="integer", nullable=false)
     */
    private $periodicity;

    /**
     * Subscription external ID
     *
     * @var float
     *
     * @ORM\Column(name="transaction_external_id", type="string", nullable=true)
     */
    protected $transactionExternalId;

    /**
     * @var \AppBundle\Entity\paymentDetail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetail", cascade={"all"})
     * @ORM\JoinColumn(name="payment_detail_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $paymentDetail;

    /**
     * @var \AppBundle\Entity\SubscriptionEventuality
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SubscriptionEventuality", mappedBy="subscription")
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    private $subscriptionEventualities;

    /**
     * @var array
     *
     * @ORM\Column(name="request", type="json_array", nullable=false)
     */
    protected $request=[];

    /**
     * @var array
     *
     * @ORM\Column(name="responses", type="json_array", nullable=false)
     */
    protected $responses=[];

    /**
     * @var float
     *
     * @ORM\Column(name="amount_for_each_payment", type="float", type="float", scale=2, precision=10, nullable=false)
     */
    private $amountForEachPayment;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount_for_each_payment_to_complete", type="float", type="float", scale=2, precision=10, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amountForEachPaymentToComplete;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_pn_complete_payments", type="integer", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $nCompletedPayments=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="need_make_request_payment", type="boolean", nullable=true)
     */
    private $needMakeRequestPayment = false;

    /** @var  $totalAmount float
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $totalAmount;

    // To serlize in custom currency
    private $amountTotalInTempCurrency;
    private $amountGameInTempCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable("UPDATE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     */
    protected $endAt;


    public function __construct($ip = 'CLI', $country = null)
    {
        $this->id = uniqid(self::PREFIX . date('YmdHi'));
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->ip = $ip;
        $this->country = $country;
        $this->subscriptionEventualities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set paymentDetail
     *
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return Subscription
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
     * Set nCompletedPayments
     *
     * @param integer $nCompletedPayments
     * @return Subscription
     */
    public function setNCompletedPayments($nCompletedPayments)
    {
        $this->nCompletedPayments = $nCompletedPayments;

        return $this;
    }

    /**
     * Set nCompletedPayments
     *
     * @param integer $nCompletedPayments
     * @return Subscription
     */
    public function addNCompletedPayments($nCompletedPayments = 1)
    {
        $this->nCompletedPayments += $nCompletedPayments;

        return $this;
    }
    /**
     * Get nCompletedPayments
     *
     * @return integer
     */
    public function getNCompletedPayments()
    {
        return $this->nCompletedPayments;
    }

    /**
     * @VirtualProperty()
     * @Groups("SubscriptionAddAmountsTotal")
     */
    public function getAmountTotal($currencyId=null)
    {
        if (!$currencyId)
            $currencyId = $this->amountTotalInTempCurrency;

        $totalAmount = 0;
        foreach($this->getSubscriptionEventualities() as $subEve)
        {
            foreach ($subEve->getSubscriptionEventualityPayments() as $subEvePay)
            {
                $purchase = $subEvePay->getPurchase();
                if (!$purchase || $purchase->getTest())
                    continue;

                switch($currencyId){
                    case CurrencyEnum::EURO:
                        $totalAmount += ($purchase->getRealAmountTotalFromParentPurchase() * $purchase->getExchangeRateEur()) ;
                        break;
                    case CurrencyEnum::POUND_STERLING:
                        $totalAmount += ($purchase->getRealAmountTotalFromParentPurchase() * $purchase->getExchangeRateGbp()) ;
                        break;
                    case CurrencyEnum::DOLLAR;
                        $totalAmount += ($purchase->getRealAmountTotalFromParentPurchase() * $purchase->getExchangeRateUsd()) ;
                        break;
                    default:
                        $totalAmount += ($purchase->getRealAmountTotalFromParentPurchase() ) ;
                        break;
                }
            }
        }

        return $totalAmount;
    }

    /**
     * @VirtualProperty()
     * @Groups("SubscriptionAddAmounts")
     */
    public function getAmountGame($currencyId=null)
    {
        if (!$currencyId)
            $currencyId = $this->amountGameInTempCurrency;

        $gameAmount = 0;
        foreach($this->getSubscriptionEventualities() as $subEve)
        {
            foreach ($subEve->getSubscriptionEventualityPayments() as $subEvePay)
            {
                $purchase = $subEvePay->getPurchase();
                if (!$purchase || $purchase->getTest())
                    continue;

                switch($currencyId){
                    case CurrencyEnum::EURO:
                        $gameAmount += $purchase->getRealAmountGameFromParentPurchase() * $purchase->getExchangeRateEur() ;
                        break;
                    case CurrencyEnum::POUND_STERLING:
                        $gameAmount += $purchase->getRealAmountGameFromParentPurchase() * $purchase->getExchangeRateGbp() ;
                        break;
                    case CurrencyEnum::DOLLAR;
                        $gameAmount += $purchase->getRealAmountGameFromParentPurchase() * $purchase->getExchangeRateUsd() ;
                        break;
                    default:
                        $gameAmount += $purchase->getRealAmountGameFromParentPurchase()  ;
                        break;
                }

            }
        }

        return $gameAmount;
    }


    /**
     * @param float $totalAmount
     */
    public function setAmountTotalInTempCurrency($currencyId)
    {
        $this->amountTotalInTempCurrency = $currencyId;
    }

    /**
     * @param float $totalAmountGame
     */
    public function setAmountGameInTempCurrency($currencyId)
    {
        $this->amountGameInTempCurrency = $currencyId;
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
     * Set request
     *
     * @param $url
     * @param array $params
     * @param null $subRequest
     * @return $this
     */
    public function setRequest($url, $params = [], $subRequest = null)
    {
        $this->request = ['url' => $url, 'params' => $params, 'subRequest' => $subRequest];

        return $this;
    }

    /**
     * Get request
     *
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set responses
     *
     * @param array $responses
     * @return $this
     */
    public function addResponse($responses)
    {
        $this->responses[] = $responses;

        return $this;
    }

    /**
     * Get responses
     *
     * @return array
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param int $amountForEachPayment
     * @return $this
     */
    public function setAmountForEachPayment($amountForEachPayment)
    {
        $this->amountForEachPayment = $amountForEachPayment;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmountForEachPayment()
    {
        return $this->amountForEachPayment;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Subscription
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set responses
     *
     * @param array $responses
     * @return Subscription
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;

        return $this;
    }

    /**
     * Set amountForEachPaymentToComplete
     *
     * @param float $amountForEachPaymentToComplete
     * @return Subscription
     */
    public function setAmountForEachPaymentToComplete($amountForEachPaymentToComplete)
    {
        $this->amountForEachPaymentToComplete = $amountForEachPaymentToComplete;

        return $this;
    }

    /**
     * Get amountForEachPaymentToComplete
     *
     * @return float
     */
    public function getAmountForEachPaymentToComplete()
    {
        return $this->amountForEachPaymentToComplete;
    }

    /**
     * Set endAt
     *
     * @return Subscription
     */
    public function setEndAtNow()
    {
        $this->endAt = new \DateTime('now');;

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
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Subscription
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Add subscriptionEventualities
     *
     * @param \AppBundle\Entity\SubscriptionEventuality $subscriptionEventualities
     * @return Subscription
     */
    public function addSubscriptionEventuality(\AppBundle\Entity\SubscriptionEventuality $subscriptionEventualities)
    {
        $this->subscriptionEventualities[] = $subscriptionEventualities;

        return $this;
    }

    /**
     * Remove subscriptionEventualities
     *
     * @param \AppBundle\Entity\SubscriptionEventuality $subscriptionEventualities
     */
    public function removeSubscriptionEventuality(\AppBundle\Entity\SubscriptionEventuality $subscriptionEventualities)
    {
        $this->subscriptionEventualities->removeElement($subscriptionEventualities);
    }

    /**
     * Get subscriptionEventualities
     *
     * @return \AppBundle\Entity\SubscriptionEventuality[]
     */
    public function getSubscriptionEventualities()
    {
        return $this->subscriptionEventualities;
    }

    /**
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
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
     * @VirtualProperty()
     * @return string
     */
    public function getType()
    {
        return 'subscription';
    }

    /**
     * @VirtualProperty()
     * @return string
     */
    public function getGamerExternalId()
    {
        return $this->getPaymentDetail()->getTransaction()->getGamer()->getGamerExternalId();
    }

    /**
     * @VirtualProperty()
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getPaymentDetail()->getTransaction()->getId();
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
     * @param int $periodicity
     * @return $this
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * @param boolean $needMakeRequestPayment
     * @return $this
     */
    public function setNeedMakeRequestPayment($needMakeRequestPayment)
    {
        $this->needMakeRequestPayment = $needMakeRequestPayment;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNeedMakeRequestPayment()
    {
        return $this->needMakeRequestPayment;
    }

    /**
     * Set responses
     *
     * @param array $response
     * @return $this
     */
    public function addResponseSubRequestLast($response)
    {
        $this->responses[count($this->responses )- 1]['subRequest'] = $response;

        return $this;
    }

    public function isAPartialPayment()
    {
        return $this->getAmountForEachPayment() !== $this->getAmountForEachPaymentToComplete();
    }

}
