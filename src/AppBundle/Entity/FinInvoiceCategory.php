<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FinancialBills
 *
 * @ORM\Table(name="fin_invoice_category")
 * @ORM\Entity
 */
class FinInvoiceCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", length=25)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=300, nullable=false)
     */
    private $name;


    function __construct($id)
    {
        $this->id = $id;
    }

    function __toString()
    {
        return $this->name;
    }

    /**
     * @return int
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

