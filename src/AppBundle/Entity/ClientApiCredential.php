<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * ClientApiCredential
 *
 * @ORM\Table(name="client_api_credential", uniqueConstraints={@ORM\UniqueConstraint(name="CLIENT_API_CREDENTIALS_UNIQUE_", columns={"code_key"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientApiCredentialsRepository")
 * @UniqueEntity({"codeKey"})
 */
class ClientApiCredential extends AbstractApiCredentials implements UserInterface
{
    const PREFIX_CODE_KEY = 'clie_';

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Client", inversedBy="clientApiCredential")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * Constructor
     */
    public function __construct(Client $client = null)
    {
        if ($client)
            $this->client = $client;

        parent::__construct();
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

    public function getRoles()
    {
        return array_merge(parent::getRoles(), ['ROLE_CLIENT_OWNER_API']);
    }
}
