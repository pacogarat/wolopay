<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Operator
 *
 * @ORM\Table(name="sms_operator", uniqueConstraints={@ORM\UniqueConstraint(name="SMS_OPERATOR_UNIQUE_", columns={"country_id", "short_name"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SMSOperatorRepository")
 * @ExclusionPolicy("all")
 * @UniqueEntity({"country", "shortName"})
 */
class SMSOperator
{
    const SONATA_CONTEXT = 'sms_operator';

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false))
     */
    private $country;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="img_icon", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Inline()
     */
    private $imgIcon;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=2, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $shortName;

    public function __toString()
    {
        return $this->name.($this->getCountry() ? ' ('.$this->getCountry()->getId() .')' : '');
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
     * Set name
     *
     * @param string $name
     * @return SMSOperator
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     * @return SMSOperator
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return SMSOperator
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

    /**
     * Set imgIcon
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imgIcon
     * @return SMSOperator
     */
    public function setImgIcon(\Application\Sonata\MediaBundle\Entity\Media $imgIcon)
    {
        $this->imgIcon = $imgIcon;

        return $this;
    }

    /**
     * Get imgIcon
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImgIcon()
    {
        return $this->imgIcon;
    }
}
