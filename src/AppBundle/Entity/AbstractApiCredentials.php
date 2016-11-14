<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

class AbstractApiCredentials implements UserInterface
{
    /**
     * @var string
     * @ORM\Column(name="code_key", type="string", length=45, nullable=false)
     */
    protected $codeKey;

    /**
     * @var string
     *
     * @ORM\Column(name="secret_key", type="string", length=100, nullable=false)
     */
    protected $secretKey;

    /**
     * @var string
     *
     * @ORM\Column(name="server_key", type="string", length=100, nullable=false)
     */
    protected $serverKey;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    const PREFIX_CODE_KEY = '';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codeKey = uniqid(static::PREFIX_CODE_KEY);
        $this->createdAt = new \DateTime('now');

        $this->secretKey = sha1(random_bytes(20));
        $this->serverKey = sha1(random_bytes(20));
    }

    public function  __toString()
    {
        return $this->getCodeKey();
    }

    /**
     * Set secretKey
     *
     * @param string $secretKey
     * @return AppApiCredentials
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * Get secretKey
     *
     * @return string 
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Set serverKey
     *
     * @param string $serverKey
     * @return AppApiCredentials
     */
    protected function setServerKey($serverKey)
    {
        $this->serverKey = $serverKey;

        return $this;
    }

    /**
     * Get serverKey
     *
     * @return string 
     */
    public function getServerKey()
    {
        return $this->serverKey;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return AppApiCredentials
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set codeKey
     *
     * @param string $codeKey
     * @return AppApiCredentials
     */
    public function setCodeKey($codeKey)
    {
        $this->codeKey = $codeKey;

        return $this;
    }

    /**
     * Get codeKey
     *
     * @return string
     */
    public function getCodeKey()
    {
        return $this->codeKey;
    }

    /**
     * @deprecated Used only for UsersProvider
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_API');
    }

    /**
     * @deprecated Used only for UsersProvider
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->secretKey;
    }

    /**
     * @deprecated Used only for UsersProvider
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @deprecated Used only for UsersProvider
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->codeKey;
    }

    /**
     * Removes sensitive data from the user.
     *
     * @deprecated Used only for UsersProvider
     */
    public function eraseCredentials()
    {
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    protected function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


}
