<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * PayMethod
 *
 * @ORM\Table(name="pay_method_has_provider", uniqueConstraints={@ORM\UniqueConstraint(name="PMP_UNIQUE", columns={"pay_method_id", "provider_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PayMethodHasProviderRepository")
 * @UniqueEntity({"payMethod", "provider"})
 * @ExclusionPolicy("all")
 */
class PayMethodHasProvider
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\PayMethod
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethod", inversedBy="payMethodHasProvider", fetch="EAGER")
     * @ORM\JoinColumn(name="pay_method_id", referencedColumnName="id", nullable=false)
     * @Inline()
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $payMethod;

    /**
     * @var \AppBundle\Entity\Provider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provider", inversedBy="payMethodHasProviders")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default"})
     */
    private $provider;

    /**
     * @var \AppBundle\Entity\PayMethodProviderHasCountry[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\PayMethodProviderHasCountry", mappedBy="payMethodHasProvider", cascade={"all"})
     * @Expose()
     * @Groups({"Admin"})
     */
    private $payMethodProviderHasCountries;

    /** @var boolean
     *
     * @ORM\Column(name="price_sent_net", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $priceSentNet = false;//payMethod may need to receive net price and THEY add the taxes

    /** @var boolean
     *
     * @ORM\Column(name="fee_calculated_with_net", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $feeCalculatedWithNet = false; //payMethod may calculate fee over price without taxes.

    /**
     * @var integer
     *
     * @ORM\Column(name="fee_provider_percent", type="float", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $feeProviderPercent;

    /**
     * @var float
     *
     * @ORM\Column(name="fee_provider_fixed", type="float", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $feeProviderFixed;

    /**
     * @var float
     *
     * @ORM\Column(name="fee_provider_minimal", type="float", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $feeProviderMinimal;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="fee_currency_id", referencedColumnName="id", nullable=true)
     */
    private $feeCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="external_store", type="string", length=45, nullable=true)
     */
    private $externalStore;

    /**
     * @var \AppBundle\Entity\PaymentServiceCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentServiceCategory")
     * @ORM\JoinColumn(name="payment_service_category_id", referencedColumnName="id", nullable=false)
     */
    private $paymentServiceCategory;

    /**
     * When somebody click continue in the shop use ajax, iframe or new window
     *
     * @var boolean
     *
     * @ORM\Column(name="is_iframe", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "externalStore"})
     */
    private $isIframe=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_be_custom_transaction", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Admin"})
     */
    private $canBeCustomTransaction=false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="need_make_request_payment", type="boolean", nullable=true)
     */
    private $needMakeRequestPayment = false;

    /**
     * SMS or Voice that need a pre process to make the purchase like SMS or Voice in Nvia or Fortuno
     *
     * @var boolean
     *
     * @ORM\Column(name="is_our_implementation", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Admin"})
     */
    private $isOurImplementation=false;

    /**
     * When somebody click continue in the shop use ajax, iframe or new window
     *
     * @var boolean
     *
     * @ORM\Column(name="is_ajax", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "externalStore"})
     */
    private $isAjax=false;

    /**
     * When somebody click continue in the shop use ajax, iframe or new window, or NOTHING! (server2server)
     *
     * @var boolean
     *
     * @ORM\Column(name="is_server2server", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public", "externalStore"})
     */
    private $isServer2Server;

    /**
     * @var string
     *
     * @ORM\Column(name="`order`", type="integer", length=3, nullable=false)
     */
    private $order;

    /**
     * @var array
     *
     * @ORM\Column(name="extra_options", type="json_array", nullable=false)
     */
    private $extraOptions=[];

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->payMethodProviderHasCountries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function __toString()
    {
        return $this->getPayMethod().' '.$this->getProvider();
    }

    /**
     * Set payMethod
     *
     * @param \AppBundle\Entity\PayMethod $payMethod
     * @return PayMethodHasProvider
     */
    public function setPayMethod(\AppBundle\Entity\PayMethod $payMethod)
    {
        $this->payMethod = $payMethod;

        return $this;
    }

    /**
     * Get payMethod
     *
     * @return \AppBundle\Entity\PayMethod
     */
    public function getPayMethod()
    {
        return $this->payMethod;
    }

    /**
     * Set provider
     *
     * @param \AppBundle\Entity\Provider $provider
     * @return PayMethodHasProvider
     */
    public function setProvider(\AppBundle\Entity\Provider $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \AppBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PayMethodHasProvider
     */
    public function setCreatedAt($createdAt)
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
     * Add payMethodProviderHasCountries
     *
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountries
     * @return PayMethodHasProvider
     */
    public function addPayMethodProviderHasCountry(\AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountries)
    {
        $this->payMethodProviderHasCountries[] = $payMethodProviderHasCountries;
        $payMethodProviderHasCountries->setPayMethodHasProvider($this);

        return $this;
    }

    /**
     * Remove payMethodProviderHasCountries
     *
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountries
     */
    public function removePayMethodProviderHasCountry(\AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountries)
    {
        $this->payMethodProviderHasCountries->removeElement($payMethodProviderHasCountries);
    }

    /**
     * Get payMethodProviderHasCountries
     *
     * @return \AppBundle\Entity\PayMethodProviderHasCountry[]
     */
    public function getPayMethodProviderHasCountries()
    {
        return $this->payMethodProviderHasCountries;
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
     * @return boolean
     */
    public function isPriceSentNet()
    {
        return $this->priceSentNet;
    }

    /**
     * @param boolean $priceSentNet
     * @return $this
     */
    public function setPriceSentNet($priceSentNet)
    {
        $this->priceSentNet = $priceSentNet;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFeeCalculatedWithNet()
    {
        return $this->feeCalculatedWithNet;
    }

    /**
     * @param boolean $feeCalculatedWithNet
     * @return $this
     */
    public function setFeeCalculatedWithNet($feeCalculatedWithNet)
    {
        $this->feeCalculatedWithNet = $feeCalculatedWithNet;
        return $this;
    }

    /**
     * Set feeProviderPercent
     *
     * @param integer $feeProviderPercent
     * @return PayMethodHasProvider
     */
    public function setFeeProviderPercent($feeProviderPercent)
    {
        $this->feeProviderPercent = $feeProviderPercent;

        return $this;
    }

    /**
     * Get feeProviderPercent
     *
     * @return integer 
     */
    public function getFeeProviderPercent()
    {
        return $this->feeProviderPercent;
    }

    /**
     * Set feeExtraEachPayment
     *
     * @param float $feeProviderFixed
     * @return PayMethodHasProvider
     */
    public function setFeeProviderFixed($feeProviderFixed)
    {
        $this->feeProviderFixed = $feeProviderFixed;

        return $this;
    }

    /**
     * Get feeExtraEachPayment
     *
     * @return float 
     */
    public function getFeeProviderFixed()
    {
        return $this->feeProviderFixed;
    }

    /**
     * Set feeProviderMinimal
     *
     * @param float $feeProviderMinimal
     * @return PayMethodHasProvider
     */
    public function setFeeProviderMinimal($feeProviderMinimal)
    {
        $this->feeProviderMinimal = $feeProviderMinimal;

        return $this;
    }

    /**
     * Get feeProviderMinimal
     *
     * @return float 
     */
    public function getFeeProviderMinimal()
    {
        return $this->feeProviderMinimal;
    }

    /**
     * @param \AppBundle\Entity\Currency $feeCurrency
     * @return $this
     */
    public function setFeeCurrency($feeCurrency)
    {
        $this->feeCurrency = $feeCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getFeeCurrency()
    {
        return $this->feeCurrency;
    }

    /**
     * Set paymentServiceCategory
     *
     * @param \AppBundle\Entity\PaymentServiceCategory $paymentServiceCategory
     * @return PayMethodHasProvider
     */
    public function setPaymentServiceCategory(\AppBundle\Entity\PaymentServiceCategory $paymentServiceCategory)
    {
        $this->paymentServiceCategory = $paymentServiceCategory;

        return $this;
    }

    /**
     * Get paymentServiceCategory
     *
     * @return \AppBundle\Entity\PaymentServiceCategory
     */
    public function getPaymentServiceCategory()
    {
        return $this->paymentServiceCategory;
    }

    /**
     * Set isIframe
     *
     * @param boolean $isIframe
     * @return PayMethodHasProvider
     */
    public function setIsIframe($isIframe)
    {
        $this->isIframe = $isIframe;

        return $this;
    }

    /**
     * Get isIframe
     *
     * @return boolean 
     */
    public function getIsIframe()
    {
        return $this->isIframe;
    }

    /**
     * @param boolean $isAjax
     * @return $this
     */
    public function setIsAjax($isAjax)
    {
        $this->isAjax = $isAjax;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsAjax()
    {
        return $this->isAjax;
    }

    /**
     * @param string $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $extraOptions
     * @return $this
     */
    public function setExtraOptions($extraOptions)
    {
        $this->extraOptions = $extraOptions;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraOptions()
    {
        return $this->extraOptions;
    }

    /**
     * @param boolean $isOurImplementation
     * @return $this
     */
    public function setIsOurImplementation($isOurImplementation)
    {
        $this->isOurImplementation = $isOurImplementation;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsOurImplementation()
    {
        return $this->isOurImplementation;
    }

    /**
     * @param boolean $canBeCustomTransaction
     * @return $this
     */
    public function setCanBeCustomTransaction($canBeCustomTransaction)
    {
        $this->canBeCustomTransaction = $canBeCustomTransaction;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCanBeCustomTransaction()
    {
        return $this->canBeCustomTransaction;
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
     * @param boolean $needMakeRequestPayment
     * @return $this
     */
    public function setNeedMakeRequestPayment($needMakeRequestPayment)
    {
        $this->needMakeRequestPayment = $needMakeRequestPayment;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNeedMakeRequestPayment()
    {
        return $this->needMakeRequestPayment;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (($this->feeCurrency || $this->feeProviderFixed || $this->feeProviderMinimal) && !$this->feeCurrency )
        {
            $context
                ->buildViolation('Fee currency must be settled')
                ->atPath('feeCurrency')
                ->addViolation();
        }
    }

    /**
     * @param string $externalStore
     * @return $this
     */
    public function setExternalStore($externalStore)
    {
        $this->externalStore = $externalStore;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalStore()
    {
        return $this->externalStore;
    }

    /**
     * @return boolean
     */
    public function isIsServer2Server()
    {
        return $this->isServer2Server;
    }

    /**
     * @param boolean $isServer2Server
     * @return $this
     */
    public function setIsServer2Server($isServer2Server)
    {
        $this->isServer2Server = $isServer2Server;
        return $this;
    }


}
