<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client extends Company
{
    const SONATA_CONTEXT = 'client';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description='';

    /**
     * @var \AppBundle\Entity\ClientUser[]
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientUser", mappedBy="client", cascade={"all"})
     */
    private $clientUsers;

    /**
     * @var \AppBundle\Entity\App[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\App", mappedBy="client", fetch="EXTRA_LAZY")
     */
    private $apps;

    /**
     * @var \AppBundle\Entity\ClientApiCredential[]
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\ClientApiCredential", mappedBy="client")
     */
    private $clientApiCredential;

    /**
     * @var \AppBundle\Entity\Affiliate[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Affiliate", mappedBy="client", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    private $affiliates;

    /**
     * @var \AppBundle\Entity\Affiliate[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\ClientDeposit", mappedBy="client", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    private $deposits;

    /*
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="portal_app_id", referencedColumnName="id", nullable=true)
     */
    private $portalApp;

    /*
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="owned_currency", referencedColumnName="id", nullable=true)
     */
    private $ownedCurrencyLabel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_create_app_active_by_default", type="boolean", nullable=true)
     */
    private $onCreateAppActiveByDefault=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_create_app_can_customize_app_tabs", type="boolean", nullable=true)
     */
    private $onCreateAppCanCustomizeAppTabs=false;

    /**
     * @var \AppBundle\Entity\ClientHasProviderCredential[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\ClientHasProviderCredential", mappedBy="client", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    private $clientHasProviderCredentials;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_earnings", referencedColumnName="id", nullable=false)
     */
    private $currencyEarnings;

    /**
     * @var string
     *
     * @ORM\Column(name="vat_number", type="string", length=60, nullable=true)
     */
    private $vatNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pays_vat", type="boolean", nullable=true)
     */
    private $paysVAT=true;


    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=150, nullable=true)
     */
    private $address;

    /**
     * @Gedmo\Slug(fields={"nameCompany"}, updatable=true, unique=true, style="upper")
     * @ORM\Column(length=5, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="finance_email", type="string", length=255, nullable=false)
     */
    private $financeEmail;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="logo", referencedColumnName="id", nullable=false)
     */
    private $logo;

    /**
     * @var \AppBundle\Entity\WoloPack
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\WoloPack")
     * @ORM\JoinColumn(name="wolo_pack", referencedColumnName="id", nullable=false)
     */
    private $woloPack;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clientUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->apps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientHasProviderCredentials = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deposits = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    public function __toString()
    {
        $countryString = '';
        if ($this->currencyEarnings)
            $countryString = $this->currencyEarnings ->getId();

        return $this->getNameCompany().' '.$countryString;
    }

    public function __clone()
    {
        $this->id = null;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Client
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     * @return Client
     */
    public function setCompany(\AppBundle\Entity\Company $company)
    {
        $this->company = $company;

        return $this;
    }



    /**
     * Add clientUsers
     *
     * @param \AppBundle\Entity\ClientUser $clientUsers
     * @return Client
     */
    public function addClientUser(\AppBundle\Entity\ClientUser $clientUsers)
    {
        $this->clientUsers[] = $clientUsers;
        $clientUsers->setClient($this);

        return $this;
    }

    /**
     * Remove clientUsers
     *
     * @param \AppBundle\Entity\ClientUser $clientUsers
     */
    public function removeClientUser(\AppBundle\Entity\ClientUser $clientUsers)
    {
        $this->clientUsers->removeElement($clientUsers);
    }

    /**
     * Get clientUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientUsers()
    {
        return $this->clientUsers;
    }

    /**
     * @param \AppBundle\Entity\App $portalApp
     * @return $this
     */
    public function setPortalApp($portalApp)
    {
        $this->portalApp = $portalApp;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\App
     */
    public function getPortalApp()
    {
        return $this->portalApp;
    }

    /**
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $ownedCurrencyLabel
     * @return $this
     */
    public function setOwnedCurrencyLabel($ownedCurrencyLabel)
    {
        $this->ownedCurrencyLabel = $ownedCurrencyLabel;
        return $this;
    }

    /**
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getOwnedCurrencyLabel()
    {
        return $this->ownedCurrencyLabel;
    }

    /**
     * @param boolean $onCreateAppActiveByDefault
     * @return $this
     */
    public function setOnCreateAppActiveByDefault($onCreateAppActiveByDefault)
    {
        $this->onCreateAppActiveByDefault = $onCreateAppActiveByDefault;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getOnCreateAppActiveByDefault()
    {
        return $this->onCreateAppActiveByDefault;
    }

    /**
     * @param boolean $onCreateAppCanCustomizeAppTabs
     * @return $this
     */
    public function setOnCreateAppCanCustomizeAppTabs($onCreateAppCanCustomizeAppTabs)
    {
        $this->onCreateAppCanCustomizeAppTabs = $onCreateAppCanCustomizeAppTabs;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getOnCreateAppCanCustomizeAppTabs()
    {
        return $this->onCreateAppCanCustomizeAppTabs;
    }

    /**
     * @return Affiliate[]
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    /**
     * @param Affiliate[] $affiliates
     */
    public function setAffiliates($affiliates)
    {
        $this->affiliates = $affiliates;
    }



    //----------------------


    /**
     * Add clientHasProviderCredential
     *
     * @param \AppBundle\Entity\ClientHasProviderCredential $clientHasProviderCredential
     *
     * @return Client
     */
    public function addClientHasProviderCredential(\AppBundle\Entity\ClientHasProviderCredential $clientHasProviderCredential)
    {
        $this->clientHasProviderCredentials[] = $clientHasProviderCredential;

        return $this;
    }

    /**
     * Remove clientHasProviderCredential
     *
     * @param \AppBundle\Entity\ClientHasProviderCredential $clientHasProviderCredential
     */
    public function removeClientHasProviderCredential(\AppBundle\Entity\ClientHasProviderCredential $clientHasProviderCredential)
    {
        $this->clientHasProviderCredentials->removeElement($clientHasProviderCredential);
    }

    /**
     * Get clientHasProviderCredentials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClientHasProviderCredentials()
    {
        return $this->clientHasProviderCredentials;
    }

    /**
     * @param Provider $provider
     * @param $app
     * @return ClientHasProviderCredential
     */
    public function getProviderClientCredentialsForApp(Provider $provider, $app)
    {
        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria
            ->where(
                Criteria::expr()->eq('provider', $provider)
            )
        ;

        /** @var LazyCriteriaCollection $lazyCriteria */
        $lazyCriteria = $this->clientHasProviderCredentials->matching($criteria);

        if ($lazyCriteria->count() == 0)
            return null;

        $general = null;
        $specific = null;

        /** @var ClientHasProviderCredential $clientHasProviderCredentials */
        foreach ($lazyCriteria->getValues() as $clientHasProviderCredentials)
        {
            if ($clientHasProviderCredentials->getApps()->isEmpty())
                $general = $clientHasProviderCredentials;

            if ($clientHasProviderCredentials->getApps()->contains($app))
                $specific = $clientHasProviderCredentials;
        }

        return $specific ?: $general;
    }

    /**
     * Add app
     *
     * @param \AppBundle\Entity\App $app
     *
     * @return Client
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

    /**
     * Get apps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApps()
    {
        return $this->apps;
    }

    /**
     * Get Active apps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActiveApps()
    {
        $criteria = Criteria::create();
        $criteria
            ->where(Criteria::expr()->eq('client', $this))
            ->andWhere(Criteria::expr()->eq('active', 1));

        $result = $this->apps->matching($criteria);
        return $result ;
    }



    /**
     * @param \AppBundle\Entity\Currency $currencyEarnings
     * @return $this
     */
    public function setCurrencyEarnings($currencyEarnings)
    {
        $this->currencyEarnings = $currencyEarnings;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getCurrencyEarnings()
    {
        return $this->currencyEarnings;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @deprecated DON'T USE
     * @param mixed $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param string $vatNumber
     * @return $this
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @return boolean
     */
    public function getPaysVAT()
    {
        return $this->paysVAT;
    }

    /**
     * @param boolean $paysVAT
     * @return Client
     */
    public function setPaysVAT($paysVAT)
    {
        $this->paysVAT = $paysVAT;
        return $this;
    }



    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $financeEmail
     * @return $this
     */
    public function setFinanceEmail($financeEmail)
    {
        $this->financeEmail = $financeEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getFinanceEmail()
    {
        return $this->financeEmail;
    }

    /**
     * @param \AppBundle\Entity\Affiliate[] $deposits
     * @return $this
     */
    public function setDeposits($deposits)
    {
        $this->deposits = $deposits;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Affiliate[]
     */
    public function getDeposits()
    {
        return $this->deposits;
    }

    /**
     * @return ClientDeposit|null
     */
    public function getDepositCurrent()
    {
        $criteria = Criteria::create();
        $criteria
            ->where(Criteria::expr()->eq('client', $this))
            ->andWhere(Criteria::expr()->eq('usedUntilAt', null))
            ->orderBy(['usedAt' =>  'desc' ])
            ->setMaxResults(1)
        ;

        $result = $this->deposits->matching($criteria);
        return $result->count() >= 1 ? $result->offsetGet(0) : null;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param \AppBundle\Entity\WoloPack $woloPack
     * @return $this
     */
    public function setWoloPack($woloPack)
    {
        $this->woloPack = $woloPack;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\WoloPack
     */
    public function getWoloPack()
    {
        return $this->woloPack;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param \AppBundle\Entity\ClientApiCredential $clientApiCredential
     * @return $this
     */
    public function setClientApiCredential(\AppBundle\Entity\ClientApiCredential $clientApiCredential)
    {
        $this->clientApiCredential = $clientApiCredential;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\ClientApiCredential[]
     */
    public function getClientApiCredential()
    {
        return $this->clientApiCredential;
    }


}
