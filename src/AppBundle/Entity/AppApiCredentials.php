<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AppApiCredentials
 *
 * @ORM\Table(name="app_api_credentials", uniqueConstraints={@ORM\UniqueConstraint(name="APP_API_CREDENTIALS_UNIQUE_", columns={"code_key"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AppApiCredentialsRepository")
 * @UniqueEntity({"codeKey"})
 */
class AppApiCredentials extends AbstractApiCredentials implements UserInterface
{
    const PREFIX_CODE_KEY = 'app_';

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\App", inversedBy="appApiHasCredential")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * Constructor
     */
    public function __construct(App $app = null)
    {
        if ($app)
            $this->app = $app;

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
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return AppApiCredentials
     */
    public function setApp(\AppBundle\Entity\App $app)
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

    public function getRoles()
    {
        return parent::getRoles() + ['ROLE_APP_ADMIN_API'];
    }
}
