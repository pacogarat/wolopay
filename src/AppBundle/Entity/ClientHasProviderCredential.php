<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClientHasProviderCredential
 *
 * @ORM\Table(name="client_has_provider_credentials")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientHasProviderCredentialRepository")
 * @ExclusionPolicy("all")
 */
class ClientHasProviderCredential
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Provider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provider")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     * @Expose()
     */
    private $provider;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="clientHasProviderCredentials")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinTable(name="client_provider_credential_has_apps")
     * @Expose()
     */
    private $apps;

    /**
     * @var array
     *
     * @ORM\Column(name="details", type="json_array", nullable=false)
     * @Expose()
     */
    private $details=[];

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable("UPDATE")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * Constructor
     */
    public function __construct(Client $client = null, Provider $provider = null)
    {
        if ($client)
            $this->client = $client;

        if ($provider)
            $this->provider = $provider;

        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->apps = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @param \AppBundle\Entity\App $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\App
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param array $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \AppBundle\Entity\Provider $provider
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \AppBundle\Entity\App
     */
    public function getApps()
    {
        return $this->apps;
    }




    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ClientHasProviderCredential
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ClientHasProviderCredential
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setApps($apps)
    {
        $this->apps->clear();

        foreach ($apps as $app)
            $this->apps[] = $app;

        return $this;
    }

    /**
     * Add app
     *
     * @param \AppBundle\Entity\App $app
     *
     * @return ClientHasProviderCredential
     */
    public function addApp(\AppBundle\Entity\App $app)
    {
        $this->apps[] = $app;

        return $this;
    }

    /**
     * Remove app
     *
     * @param \AppBundle\Entity\App $app
     */
    public function removeApp(\AppBundle\Entity\App $app)
    {
        $this->apps->removeElement($app);
    }
}
