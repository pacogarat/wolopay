<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="wolo_pack")
 * @ORM\Entity
 */
class WoloPack
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    protected $name;

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
     * @ORM\JoinColumn(name="currency", referencedColumnName="id", nullable=false)
     */
    private $currency;

    function __construct($id)
    {
        $this->id = $id;
    }

    function __toString()
    {
        return $this->name;
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


}
