<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Company
 *
 * @ORM\Table(name="company", uniqueConstraints={@ORM\UniqueConstraint(name="CIF_UNIQUE", columns={"cif"})})
 * @ORM\InheritanceType("JOINED")
 * @ORM\Entity
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"client" = "\AppBundle\Entity\Client", "provider" = "\AppBundle\Entity\Provider", "company" = "AppBundle\Entity\Company"})
 * @UniqueEntity("cif")
 * @ExclusionPolicy("all")
 */
class Company
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Expose()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_company", type="string", length=45, nullable=false)
     */
    protected $nameCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="cif", type="string", length=45, nullable=false)
     */
    protected $cif;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function  __toString()
    {
        return $this->nameCompany;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set nameCompany
     *
     * @param string $nameCompany
     * @return Company
     */
    public function setNameCompany($nameCompany)
    {
        $this->nameCompany = $nameCompany;

        return $this;
    }

    /**
     * Get nameCompany
     *
     * @return string 
     */
    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * Set cif
     *
     * @param string $cif
     * @return $this
     */
    public function setCif($cif)
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * Get cif
     *
     * @return string 
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Company
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
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return $this
     */
    public function setCountry(\AppBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }



}
