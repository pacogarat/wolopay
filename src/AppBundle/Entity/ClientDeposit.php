<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Deposit with history
 *
 * @ORM\Table(name="client_deposit")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientDepositRepository")
 */
class ClientDeposit
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
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="deposits")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FinInvoice", )
     * @ORM\JoinColumn(name="fin_invoice_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $finInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_balance", type="float", precision=10, scale=4, nullable=false)
     */
    private $amountBalance;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_balance_requirement", type="float", precision=10, scale=4, nullable=false)
     */
    private $amountBalanceRequirement;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_limit_cover", type="float", precision=10, scale=4, nullable=false)
     */
    private $amountLimitCover;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_increase_if_limit_exceed", type="float", precision=10, scale=4, nullable=false)
     */
    private $amountIncreaseIfLimitExceed = 200;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="used_at", type="datetime", nullable=false)
     */
    private $usedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="used_until_at", type="datetime", nullable=true)
     */
    private $usedUntilAt;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Constructor
     */
    public function __clone()
    {
        $this->id = null;
        $this->setUsedAt(new \DateTime());
        $this->setUsedUntilAt(null);
        $this->setDescription(null);
    }

    /**
     * @param \AppBundle\Entity\Client $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $usedAt
     * @return $this
     */
    public function setUsedAt($usedAt)
    {
        $this->usedAt = $usedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUsedAt()
    {
        return $this->usedAt;
    }

    /**
     * @param \DateTime $usedUntilAt
     * @return $this
     */
    public function setUsedUntilAt($usedUntilAt)
    {
        $this->usedUntilAt = $usedUntilAt;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\ClientDeposit
     */
    public function endThisAndCreateNew()
    {
        $this->setUsedUntilAt(new \DateTime());

        return clone $this;
    }

    /**
     * @return \DateTime
     */
    public function getUsedUntilAt()
    {
        return $this->usedUntilAt;
    }

    /**
     * @param float $amountLimitCover
     * @return $this
     */
    public function setAmountLimitCover($amountLimitCover)
    {
        $this->amountLimitCover = $amountLimitCover;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountLimitCover()
    {
        return $this->amountLimitCover;
    }

    /**
     * @param float $amountIncreaseIfLimitExceed
     * @return $this
     */
    public function setAmountIncreaseIfLimitExceed($amountIncreaseIfLimitExceed)
    {
        $this->amountIncreaseIfLimitExceed = $amountIncreaseIfLimitExceed;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountIncreaseIfLimitExceed()
    {
        return $this->amountIncreaseIfLimitExceed;
    }

    /**
     * @param \AppBundle\Entity\Client $finInvoice
     * @return $this
     */
    public function setFinInvoice($finInvoice)
    {
        $this->finInvoice = $finInvoice;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getFinInvoice()
    {
        return $this->finInvoice;
    }

    /**
     * @param float $amountBalance
     * @return $this
     */
    public function setAmountBalance($amountBalance)
    {
        $this->amountBalance = $amountBalance;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountBalance()
    {
        return $this->amountBalance;
    }

    /**
     * @param float $amountBalanceRequirement
     * @return $this
     */
    public function setAmountBalanceRequirement($amountBalanceRequirement)
    {
        $this->amountBalanceRequirement = $amountBalanceRequirement;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountBalanceRequirement()
    {
        return $this->amountBalanceRequirement;
    }


}
