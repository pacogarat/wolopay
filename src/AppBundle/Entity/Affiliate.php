<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Affiliate
 *
 * @ORM\Table(name="affiliate", uniqueConstraints={@ORM\UniqueConstraint(name="AFFILIATE_UNIQUE_", columns={"affiliate_id", "client_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AffiliateRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ExclusionPolicy("all")
 * @UniqueEntity({"affiliateId", "client"})
 */
class Affiliate {
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
     * @ORM\Column(name="affiliate_id", type="string", length=255, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "Basic"})
     */
    private $affiliateId;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="affiliates")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_paymethod", type="boolean", nullable=true)
     */
    private $hasPaymethod=false;

    /**
     * @var \AppBundle\Entity\PayMethodHasProvider[]
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\PayMethodHasProvider", fetch="EAGER")
     * @ORM\JoinTable(name="affiliate_has_pmp")
     */
    private $payMethodProviders;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $updatedAt;

    function __construct(Client $client = null, $appAffiliateId = null)
    {
        $this->client = $client;
        $this->affiliateId = $appAffiliateId;
        $this->payMethodProviders = new \Doctrine\Common\Collections\ArrayCollection();

        $this->createdAt = new \DateTime('now');
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
     * Set id
     *
     * @deprecated only use for test
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }



    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set created
     *
     * @param \DateTime $createdAt
     * @return $this
     */
    private function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Affiliate
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }


    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->createdAt;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
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
     * @return string
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * @param string $affiliateId
     * @return Affiliate
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasPaymethod()
    {
        return $this->hasPaymethod;
    }

    /**
     * @param boolean $hasPaymethod
     * @return Affiliate
     */
    public function setHasPaymethod($hasPaymethod)
    {
        $this->hasPaymethod = $hasPaymethod;
        return $this;
    }



    /**
     * @return PayMethodHasProvider[]
     */
    public function getPayMethodProviders()
    {
        return $this->payMethodProviders;
    }

    /**
     * @param PayMethodHasProvider[] $affiliateHasPayMethodProvider
     */
    public function setPayMethodProviders($affiliateHasPayMethodProvider)
    {
        $this->payMethodProviders = $affiliateHasPayMethodProvider;
    }

    /**
     * @param /AppBundle/Entity/PayMethodHasProvider $pmp
     * @return boolean
     */
    public function hasPayMethodProvider(PayMethodHasProvider $pmp)
    {
        foreach ($this->payMethodProviders as $affiliateHasPMP)
        {
            if ($pmp->getId() == $affiliateHasPMP->getId())
                return true;
        }
        return false;
    }

    /**
     * Remove PMP
     *
     * @param \AppBundle\Entity\PayMethodHasProvider $pmp
     * @return $this
     */
    public function removePayMethodProvider(\AppBundle\Entity\PayMethodHasProvider $pmp)
    {
        $this->payMethodProviders->removeElement($pmp);
        return $this;
    }

    /**
     * Remove all pmps
     * @return $this
     */
    public function removeAllPayMethodProviders()
    {
        $this->payMethodProviders->clear();
        return $this;
    }


    /**
     * @param Gamer $gamer
     * @return App
     */
    public function addPayMethodProvider(PayMethodHasProvider $pmp)
    {
        if (!$this->payMethodProviders->contains($pmp))
            $this->payMethodProviders[] = $pmp;

        return $this;
    }




}