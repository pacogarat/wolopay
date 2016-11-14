<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FinancialMovements
 *
 * @ORM\Table(name="fin_movement")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 */
class FinMovement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \AppBundle\Entity\FinInvoiceCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FinInvoice", cascade={"all"}, inversedBy="finMovements")
     * @ORM\JoinColumn(name="fin_invoice_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $finInvoice;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_from_id", referencedColumnName="id", nullable=false)
     */
    private $companyFrom;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_to_id", referencedColumnName="id", nullable=false)
     */
    private $companyTo;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_total", type="decimal", scale=2, nullable=false)
     */
    private $amountTotal;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     */
    private $currency;

    /**
     * @ORM\Column(name="exchangeToEur", type="float", precision=10, scale=4, nullable=false)
     */
    private $exchangeToEur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="remember_until_order_done", type="boolean", nullable=true)
     */
    private $rememberUntilOrderDone=false;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_at", type="datetime", nullable=true)
     */
    private $orderAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordered_at", type="datetime", nullable=true)
     */
    private $orderedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * @param float $amountTotal
     * @return $this
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    /**
     * @param \AppBundle\Entity\Client $companyFrom
     * @return $this
     */
    public function setCompanyFrom($companyFrom)
    {
        $this->companyFrom = $companyFrom;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getCompanyFrom()
    {
        return $this->companyFrom;
    }

    /**
     * @param \AppBundle\Entity\Client $companyTo
     * @return $this
     */
    public function setCompanyTo($companyTo)
    {
        $this->companyTo = $companyTo;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getCompanyTo()
    {
        return $this->companyTo;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
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
     * @param \DateTime $orderedAt
     * @return $this
     */
    public function setOrderedAt($orderedAt)
    {
        $this->orderedAt = $orderedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderedAt()
    {
        return $this->orderedAt;
    }

    /**
     * @param \AppBundle\Entity\Currency $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $exchangeToEur
     * @return $this
     */
    public function setExchangeToEur($exchangeToEur)
    {
        $this->exchangeToEur = $exchangeToEur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExchangeToEur()
    {
        return $this->exchangeToEur;
    }

    /**
     * @param \AppBundle\Entity\FinInvoiceCategory $finInvoice
     * @return $this
     */
    public function setFinInvoice($finInvoice)
    {
        $this->finInvoice = $finInvoice;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\FinInvoice
     */
    public function getFinInvoice()
    {
        return $this->finInvoice;
    }

    /**
     * @param \DateTime $orderAt
     * @return $this
     */
    public function setOrderAt($orderAt)
    {
        $this->orderAt = $orderAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderAt()
    {
        return $this->orderAt;
    }

    /**
     * @param boolean $rememberUntilOrderDone
     * @return $this
     */
    public function setRememberUntilOrderDone($rememberUntilOrderDone)
    {
        $this->rememberUntilOrderDone = $rememberUntilOrderDone;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRememberUntilOrderDone()
    {
        return $this->rememberUntilOrderDone;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate()
     */
    public function onPrePersistOrPreUpdate()
    {
        $this
            ->setExchangeToEur(
                $this->getCurrency()->getExchangeRateEur()
            )
        ;

        if ($this->rememberUntilOrderDone && $this->orderedAt)
            $this->rememberUntilOrderDone = false;
    }

    public function isFromWolopay()
    {
        if (strpos($this->companyFrom->getNameCompany(), 'Wolop') === false )
            return false;

        return true;
    }

}

