<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClientUser
 *
 * @ORM\Table(name="client_user_has_apps")
 * @ORM\Entity
 */
class ClientUserHasApp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\ClientUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClientUser", inversedBy="clientUserHasApps")
     * @ORM\JoinColumn(name="client_user_id", referencedColumnName="id", nullable=false)
     */
    private $clientUser;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="clientUsersHasApps")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RoleAdminCategory")
     * @ORM\JoinColumn(name="role_admin_category", referencedColumnName="id", nullable=false)
     */
    private $roleAdminCategory;

    function __construct(App $app=null, ClientUser $clientUser=null, RoleAdminCategory $role=null)
    {
        $this->app        = $app;
        $this->clientUser = $clientUser;
        $this->roleAdminCategory       = $role;
    }

    function  __toString(){
        return $this->app.' '.$this->role;
    }

    public function __clone()
    {
        if($this->id)
            $this->id = null;
    }


    /**
     * @param \AppBundle\Entity\App $app
     *
     * @return $this
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param \AppBundle\Entity\Client $clientUser
     * @return $this
     */
    public function setClientUser($clientUser)
    {
        $this->clientUser = $clientUser;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\ClientUser
     */
    public function getClientUser()
    {
        return $this->clientUser;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * Set roleAdminCategory
     *
     * @param \AppBundle\Entity\RoleAdminCategory $roleAdminCategory
     * @return ClientUserHasApp
     */
    public function setRoleAdminCategory(\AppBundle\Entity\RoleAdminCategory $roleAdminCategory)
    {
        $this->roleAdminCategory = $roleAdminCategory;

        return $this;
    }

    /**
     * Get roleAdminCategory
     *
     * @return \AppBundle\Entity\RoleAdminCategory 
     */
    public function getRoleAdminCategory()
    {
        return $this->roleAdminCategory;
    }

    public function getRolesAdmin()
    {
        return $this->getClientUser()->getRolesAdmin($this->app);
    }
}
