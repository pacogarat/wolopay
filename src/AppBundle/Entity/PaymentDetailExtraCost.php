<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="payment_detail_extra_cost")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class PaymentDetailExtraCost
{
    /**
     * @var \AppBundle\Entity\PaymentDetail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetail", inversedBy="paymentDetailExtraCosts")
     * @ORM\JoinColumn(name="payment_detail_id", referencedColumnName="id", nullable=false)
     * @ORM\Id
     */
    private $paymentDetail;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CartPrice"})
     * @ORM\Id
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", scale=2, precision=10, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CartPrice"})
     */
    protected $amount=null;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Admin", "CartPrice"})
     */
    protected $currency;

    function __construct($amount, $currency, $name)
    {
        $this->amount        = $amount;
        $this->currency      = $currency;
        $this->name          = $name;
    }


    public function  __toString()
    {
        return $this->name;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
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

    /**
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return $this
     */
    public function setPaymentDetail($paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PaymentDetail
     */
    public function getPaymentDetail()
    {
        return $this->paymentDetail;
    }

}
