<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\RoleAdminEnum;
use AppBundle\Entity\Enum\RoleEnum;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClientUser
 *
 * @ORM\Table(name="client_user", uniqueConstraints={@ORM\UniqueConstraint(name="CLIENT_USER_U_UNIQUE_", columns={"username"}), @ORM\UniqueConstraint(name="CLIENT_USER_E_UNIQUE_", columns={"email"})})
 * @ORM\Entity
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class ClientUser extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"AppTabFull"})
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="clientUsers")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=true)
     */
    private $client;

    /**
     * @var \AppBundle\Entity\ClientUserHasApp[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientUserHasApp", mappedBy="clientUser", cascade={"Persist"})
     */
    private $clientUserHasApps;

    /**
     * @var \AppBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     */
    private $language;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name='not defined';

    function __construct()
    {
        parent::__construct();
        $this->clientUserHasApps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->enabled = true;
    }

    function __toString()
    {
        return ($this->client ? $this->client->getNameCompany() : '' ). " " .$this->name;
    }

    /**
     * clone is used by symfony by /symfony/symfony/src/Symfony/Component/Security/Core/Authentication/Token/AbstractToken.php
     */
    public function setValuesOnCloneManually()
    {
        if($this->id)
            $this->id = null;

        $this->username = null;
        $this->name = null;
        $this->password = null;
        $this->email = null;

        $temp = $this->clientUserHasApps;

        $objs=[];

        foreach ($temp as $hasApp)
        {
            $objs[] = clone($hasApp);
        }

        $this->setClientUserHasApps($objs);
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return ClientUser
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ClientUser
     */
    private function setCreatedAt($createdAt)
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
     * Set name
     *
     * @param string $name
     * @return ClientUser
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
     * @return \AppBundle\Entity\ClientUserHasApp[]
     */
    public function getClientUserHasApps()
    {
        return $this->clientUserHasApps;
    }

    /**
     * Add payMethodProviderHasCountries
     *
     * @param ClientUserHasApp[] $clientUserHasApps
     * @return $this
     */
    public function setClientUserHasApps($clientUserHasApps = [])
    {
        $this->clientUserHasApps->clear();

        foreach ($clientUserHasApps as $clientUserHasApp)
            $this->addClientUserHasApp($clientUserHasApp);

        return $this;
    }

    /**
     * Add payMethodProviderHasCountries
     *
     * @param ClientUserHasApp $clientUserHasApp
     * @return $this
     */
    public function addClientUserHasApp(\AppBundle\Entity\ClientUserHasApp $clientUserHasApp)
    {
        $this->clientUserHasApps[] = $clientUserHasApp;
        $clientUserHasApp->setClientUser($this);

        return $this;
    }

    /**
     * Remove payMethodProviderHasCountries
     *
     * @param ClientUserHasApp $clientUserHasApp
     */
    public function removeClientUserHasApp(\AppBundle\Entity\ClientUserHasApp $clientUserHasApp)
    {
        $this->clientUserHasApps->removeElement($clientUserHasApp);
    }

    public function getRoleAdminFromApp(App $app)
    {
        foreach ($this->clientUserHasApps as $hap)
        {
            if ($hap->getApp()->getId() === $app->getId())
                return $hap->getRoleAdminCategory()->getId();
        }

        return null;
    }

    public function getRolesAdmin(App $app)
    {
        $roleAdminType = $this->getRoleAdminFromApp($app);
//        die($roleAdminType);
        $roles = [];

        if (in_array(RoleEnum::SUPER_ADMIN, $this->roles))
        {
            $roles = [
                RoleEnum::ADMIN_ANALITYCS, RoleEnum::ADMIN_TRANSACTIONS, RoleEnum::ADMIN_TRANSACTIONS,
                RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_PURCHASES_CANCELLATION, RoleEnum::ADMIN_NOTIFICATIONS, RoleEnum::ADMIN_CREDENTIALS, RoleEnum::ADMIN_CLIENT_ADMIN,
                RoleEnum::ADMIN_DASHBOARD, RoleEnum::ADMIN_SUBSCRIPTIONS, RoleEnum::ADMIN_SUBSCRIPTIONS_CANCELLATION, RoleEnum::ADMIN_CONFIGURE,
                RoleEnum::ADMIN_MANAGE_PROJECTS, RoleEnum::ADMIN_PROMO_CODES, RoleEnum::ADMIN_INVOICES, RoleEnum::ADMIN_TEST_SHOP,
            ];
        }elseif ($roleAdminType === RoleAdminEnum::OWNER)
        {
            $roles = [
                RoleEnum::ADMIN_ANALITYCS, RoleEnum::ADMIN_TRANSACTIONS, RoleEnum::ADMIN_TRANSACTIONS,
                RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_PURCHASES_CANCELLATION, RoleEnum::ADMIN_NOTIFICATIONS, RoleEnum::ADMIN_CREDENTIALS, RoleEnum::ADMIN_CLIENT_ADMIN,
                RoleEnum::ADMIN_DASHBOARD, RoleEnum::ADMIN_SUBSCRIPTIONS, RoleEnum::ADMIN_SUBSCRIPTIONS_CANCELLATION, RoleEnum::ADMIN_CONFIGURE,
                RoleEnum::ADMIN_MANAGE_PROJECTS, RoleEnum::ADMIN_PROMO_CODES, RoleEnum::ADMIN_INVOICES, RoleEnum::ADMIN_TEST_SHOP,
            ];
        }elseif ($roleAdminType === RoleAdminEnum::CONFIG){
            $roles = [
                RoleEnum::ADMIN_CONFIGURE, RoleEnum::ADMIN_MANAGE_PROJECTS, RoleEnum::ADMIN_PROMO_CODES, RoleEnum::ADMIN_TEST_SHOP,
                RoleEnum::ADMIN_CLIENT_ADMIN,
            ];

        }elseif ($roleAdminType === RoleAdminEnum::SUPPORT){
            $roles = [
                RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_PURCHASES_CANCELLATION, RoleEnum::ADMIN_TRANSACTIONS,
                RoleEnum::ADMIN_SUBSCRIPTIONS, RoleEnum::ADMIN_SUBSCRIPTIONS_CANCELLATION, RoleEnum::ADMIN_NOTIFICATIONS,
                RoleEnum::ADMIN_TEST_SHOP,
            ];

        }elseif ($roleAdminType === RoleAdminEnum::MARKETING){
            $roles = [
                RoleEnum::ADMIN_DASHBOARD, RoleEnum::ADMIN_ANALITYCS, RoleEnum::ADMIN_CLIENT_ADMIN,
                ];

        }elseif ($roleAdminType === RoleAdminEnum::ACCOUNTING){
            $roles = [RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_INVOICES, RoleEnum::ADMIN_TEST_SHOP];

        }elseif ($roleAdminType === RoleAdminEnum::DEVELOPER){
            $roles = [RoleEnum::ADMIN_CREDENTIALS, RoleEnum::ADMIN_TEST_SHOP];
        }elseif ($roleAdminType === RoleAdminEnum::DEMO_GENERAL){
            $roles = [
                RoleEnum::ADMIN_ANALITYCS, RoleEnum::ADMIN_TRANSACTIONS, RoleEnum::ADMIN_TRANSACTIONS,
                RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_NOTIFICATIONS, RoleEnum::ADMIN_CLIENT_ADMIN,
                RoleEnum::ADMIN_DASHBOARD, RoleEnum::ADMIN_SUBSCRIPTIONS,
                RoleEnum::ADMIN_PROMO_CODES, RoleEnum::ADMIN_INVOICES, RoleEnum::ADMIN_TEST_SHOP,
            ];
        }
//        die($roles);

        return $roles;
    }

    public function getRoles()
    {
        $rolesParent = parent::getRoles();

        if (in_array(RoleEnum::SUPER_ADMIN, $this->roles))
        {
            $roles = [RoleEnum::ADMIN_ANALITYCS, RoleEnum::ADMIN_TRANSACTIONS, RoleEnum::ADMIN_TRANSACTIONS,
                RoleEnum::ADMIN_PURCHASES, RoleEnum::ADMIN_NOTIFICATIONS, RoleEnum::ADMIN_MANAGE_PROJECTS
            ];
        }

        $roles []= RoleEnum::ADMIN_CLIENT_ADMIN;

        $roles = array_unique(array_merge($rolesParent, $roles));

        return $roles;
    }

    /**
     * @return App[]
     */
    public function getAllApps()
    {
        $apps = [];

        foreach ($this->getClientUserHasApps() as $hap)
            $apps[] =  $hap->getApp();

        return $apps;
    }

    public function hasApp(App $app)
    {
        foreach ($this->getClientUserHasApps() as $hap)
        {
            if ($hap->getApp()->getId() == $app->getId())
                return true;
        }

        return false;
    }

    /**
     * @param \AppBundle\Entity\Language $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param \AppBundle\Entity\Country $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getTimeOffsetInHours()
    {
        $timeUser = new \DateTime("now", new \DateTimeZone($this->getCountry()->getTimeZone()));
        return round($timeUser->getOffset()/60/60);
    }

}
