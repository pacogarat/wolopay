<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Gamer
 *
 * @ORM\Table(name="gamer", uniqueConstraints={@ORM\UniqueConstraint(name="GAMER_UNIQUE_", columns={"gamer_external_id", "app_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\GamerRepository")
 * @ORM\EntityListeners({"AppBundle\Entity\Listener\GamerListener"})
 * @ORM\HasLifecycleCallbacks()
 * @ExclusionPolicy("all")
 * @XmlRoot("gamer")
 * @UniqueEntity({"gamerExternalId", "app"})
 */
class Gamer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @NotBlank()
     * @ORM\Column(name="gamer_external_id", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $gamerExternalId;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="gamers")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="tigo_mobile_number", type="string", length=8, nullable=true)
     * @Groups({"CanBeUpdatedByUser"})
     * @Assert\NotBlank(groups={"tigo"})
     */
    private $tigoMobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=true)
     * @Email()
     * @Expose()
     * @Groups({"Default", "Public","CanBeUpdatedByUser"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public","CanBeUpdatedByUser"})
     * @Assert\NotBlank(groups={"tigo"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=200, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public","CanBeUpdatedByUser"})
     * @Assert\NotBlank(groups={"tigo"})
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="steam_id", type="string", length=20, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $steamId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $birthdate;

    /**
     * @var \AppBundle\Entity\Enum\GenderEnum
     *
     * @ORM\Column(name="gender", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public","CanBeUpdatedByUser"})
     */
    private $gender;

    /**
     * @var \DateTime
     * @ORM\Column(name="registration_date_in_game", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $registrationDateInGame;


    /**
     * @var \AppBundle\Entity\Affiliate
     *
     * @ORM\Column(name="external_affiliate_id", type="string", length=200, nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Affiliate")
     * @ORM\JoinColumn(name="external_affiliate_id", referencedColumnName="affiliateId", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $externalAffiliateId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blacklisted", type="boolean", nullable=true)
     */
    private $blacklisted=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="for_testing", type="boolean", nullable=true)
     */
    private $forTesting=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $updatedAt;

    function __construct(App $app, $gamerExternalId)
    {
        $this->app = $app;
        $this->gamerExternalId = $gamerExternalId;

        $this->created = new \DateTime('now');
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get id
     *
     * @deprecated only use for test
     * @param $id
     * @return \AppBundle\Entity\App
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return Gamer
     */
    public function setApp(\AppBundle\Entity\App $app = null)
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
     * Set gamerExternalId
     *
     * @param string $gamerExternalId
     * @return Gamer
     */
    public function setGamerExternalId($gamerExternalId)
    {
        $this->gamerExternalId = $gamerExternalId;

        return $this;
    }

    /**
     * Get gamerExternalId
     *
     * @return string 
     */
    public function getGamerExternalId()
    {
        return $this->gamerExternalId;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Gamer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Gamer
     */
    private function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Gamer
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
     * Set surname
     *
     * @param string $surname
     * @return Gamer
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    public function fromArray(array $array)
    {
        foreach ($array as $key => $value)
        {
            switch ($key)
            {
                case 'email':
                    $this->email = $value;
                    break;
                case 'name':
                    $this->name = $value;
                    break;
                case 'surname':
                    $this->surname = $value;
                    break;
            }
        }
    }


    /**
     * @return boolean
     */
    public function isBlacklisted()
    {
        return $this->blacklisted;
    }

    /**
     * @return $this
     */
    public function setBlacklisted($val = true)
    {
        $this->blacklisted = $val;
        return $this;
    }
    /**
     * @return $this
     */
    public function setNotBlacklisted()
    {
        $this->blacklisted = false;
        return $this;
    }

    public function unsetBlacklisted()
    {
        $this->blacklisted = false;
    }

    /**
     * @return boolean
     */
    public function isForTesting()
    {
        return $this->forTesting;
    }

    /**
     * @return $this
     */
    public function setForTesting($test = true)
    {
        $this->forTesting = $test;
        return $this;
    }

    /**
     * @return $this
     */
    public function unsetForTesting()
    {
        $this->forTesting = false;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalAffiliateId()
    {
        return $this->externalAffiliateId;
    }

    /**
     * @param string $externalAffiliateId
     * @return Gamer
     */
    public function setExternalAffiliateId($externalAffiliateId)
    {
        $this->externalAffiliateId = $externalAffiliateId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     * @return Gamer
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return Enum\GenderEnum
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param Enum\GenderEnum $gender
     * @return Gamer
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $steamId
     * @return $this
     */
    public function setSteamId($steamId)
    {
        $this->steamId = $steamId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * @param string $tigoMobileNumber
     * @return $this
     */
    public function setTigoMobileNumber($tigoMobileNumber)
    {
        $this->tigoMobileNumber = $tigoMobileNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getTigoMobileNumber()
    {
        return $this->tigoMobileNumber;
    }

    /**
     * @return \DateTime
     */
    public function getRegistrationDateInGame()
    {
        return $this->registrationDateInGame;
    }

    /**
     * @param \DateTime $registrationDateInGame
     * @return $this
     */
    public function setRegistrationDateInGame(\DateTime $registrationDateInGame)
    {
        $this->registrationDateInGame = $registrationDateInGame;
        return $this;
    }


}