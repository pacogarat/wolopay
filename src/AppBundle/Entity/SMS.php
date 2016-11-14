<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * SMS
 *
 * @ORM\Table(name="sms", uniqueConstraints={@ORM\UniqueConstraint(name="SMS_UNIQUE_", columns={"pay_method_provider_country_id", "short_number", "operator_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SMSRepository")
 * @UniqueEntity({"payMethodProviderHasCountry", "shortNumber", "operator"})
 * @ExclusionPolicy("all")
 */
class SMS
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $id;

    /**
     * @var \AppBundle\Entity\PayMethodProviderHasCountry
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethodProviderHasCountry", inversedBy="SMSs")
     * @ORM\JoinColumn(name="pay_method_provider_country_id", referencedColumnName="id", nullable=false)
     */
    private $payMethodProviderHasCountry;

    /**
     * @var \AppBundle\Entity\SMSAlias
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\SMSAlias")
     * @ORM\JoinTable(name="sms_has_sms_alias",
     *      joinColumns={@ORM\JoinColumn(name="sms_alias_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="sms", referencedColumnName="id")}
     * )
     */
    private $smsAlias;

    /**
     * @var string
     *
     * @ORM\Column(name="alias_default", type="string", length=20, nullable=false)
     */
    private $aliasDefault='WOLOPAY';

    /**
     * @var string
     *
     * @ORM\Column(name="short_number", type="string", length=10, nullable=false)
     */
    private $shortNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=4, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $amount;

    /**
     * @var \AppBundle\Entity\SMSOperator
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SMSOperator")
     * @ORM\JoinColumn(name="operator_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $operator;

    /**
     * @var \AppBundle\Entity\SMSLogicCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SMSLogicCategory")
     * @ORM\JoinColumn(name="sms_logic_category_id", referencedColumnName="id", nullable=false)
     */
    private $smsLogicCategory;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="mobile_text_sing_up_label_id", referencedColumnName="id", nullable=true)
     */
    private $mobileTextSingUpLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="legal_text_label_id", referencedColumnName="id", nullable=true)
     */
    private $legalTextLabel;

    /**
     * @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit")
     * @ORM\JoinColumn(name="check_box_label_id", referencedColumnName="id", nullable=true)
     */
    private $checkBoxLabel;

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
    }

    function __toString()
    {
        return ($this->payMethodProviderHasCountry ? $this->payMethodProviderHasCountry->getCountry().' '.
            $this->payMethodProviderHasCountry->getProvider()->getName() : '').' '.$this->operator.' ('.$this->amount.')';
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
     * Set shortNumber
     *
     * @param string $shortNumber
     * @return SMS
     */
    public function setShortNumber($shortNumber)
    {
        $this->shortNumber = $shortNumber;

        return $this;
    }

    /**
     * Get shortNumber
     *
     * @return string 
     */
    public function getShortNumber()
    {
        return $this->shortNumber;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return SMS
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }


    /**
     * Set payMethodProviderHasCountry
     *
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @return SMS
     */
    public function setPayMethodProviderHasCountry(\AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry)
    {
        $this->payMethodProviderHasCountry = $payMethodProviderHasCountry;

        return $this;
    }

    /**
     * Get payMethodProviderHasCountry
     *
     * @return \AppBundle\Entity\PayMethodProviderHasCountry
     */
    public function getPayMethodProviderHasCountry()
    {
        return $this->payMethodProviderHasCountry;
    }

    /**
     * Set smsLogicCategory
     *
     * @param \AppBundle\Entity\SMSLogicCategory $smsLogicCategory
     * @return SMS
     */
    public function setSmsLogicCategory(\AppBundle\Entity\SMSLogicCategory $smsLogicCategory)
    {
        $this->smsLogicCategory = $smsLogicCategory;

        return $this;
    }

    /**
     * Get smsLogicCategory
     *
     * @return \AppBundle\Entity\SMSLogicCategory
     */
    public function getSmsLogicCategory()
    {
        return $this->smsLogicCategory;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SMS
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
     * Set operator
     *
     * @param \AppBundle\Entity\SMSOperator $operator
     * @return SMS
     */
    public function setOperator(\AppBundle\Entity\SMSOperator $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return \AppBundle\Entity\SMSOperator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set checkBoxLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $checkBoxLabel
     * @return SMS
     */
    public function setCheckBoxLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $checkBoxLabel = null)
    {
        $this->checkBoxLabel = $checkBoxLabel;

        return $this;
    }

    /**
     * Get checkBoxLabel
     *
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit 
     */
    public function getCheckBoxLabel()
    {
        return $this->checkBoxLabel;
    }



    /**
     * Set aliasDefault
     *
     * @param string $aliasDefault
     * @return SMS
     */
    public function setAliasDefault($aliasDefault)
    {

        $this->aliasDefault = trim(strtoupper($aliasDefault));

        return $this;
    }

    /**
     * Get aliasDefault
     *
     * @return string 
     */
    public function getAliasDefault()
    {
        return $this->aliasDefault;
    }

    /**
     * Add smsAlias
     *
     * @param \AppBundle\Entity\SMSAlias $smsAlias
     * @return SMS
     */
    public function addSmsAlia(\AppBundle\Entity\SMSAlias $smsAlias)
    {
        $this->smsAlias[] = $smsAlias;

        return $this;
    }

    /**
     * Remove smsAlias
     *
     * @param \AppBundle\Entity\SMSAlias $smsAlias
     */
    public function removeSmsAlia(\AppBundle\Entity\SMSAlias $smsAlias)
    {
        $this->smsAlias->removeElement($smsAlias);
    }

    /**
     * Get smsAlias
     *
     * @return \AppBundle\Entity\SMSAlias[]
     */
    public function getSmsAlias()
    {
        return $this->smsAlias;
    }

    public function getSmsAliasValid($smsAliasOverride)
    {
        $configuredAlias = false;
        foreach ($this->getSmsAlias() as $alias)
        {
            if ($alias->getAlias() === $smsAliasOverride)
            {
                return $smsAliasOverride;
            }
        }

        return $this->getAliasDefault();
    }


    /**
     * Set mobileTextSingUpLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $mobileTextSingUpLabel
     * @return SMS
     */
    public function setMobileTextSingUpLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $mobileTextSingUpLabel = null)
    {
        $this->mobileTextSingUpLabel = $mobileTextSingUpLabel;

        return $this;
    }

    /**
     * Get mobileTextSingUpLabel
     *
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit 
     */
    public function getMobileTextSingUpLabel()
    {
        return $this->mobileTextSingUpLabel;
    }

    /**
     * Set legalTextLabel
     *
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $legalTextLabel
     * @return SMS
     */
    public function setLegalTextLabel(\Lexik\Bundle\TranslationBundle\Entity\TransUnit $legalTextLabel = null)
    {
        $this->legalTextLabel = $legalTextLabel;

        return $this;
    }

    /**
     * Get legalTextLabel
     *
     * @return \Lexik\Bundle\TranslationBundle\Entity\TransUnit 
     */
    public function getLegalTextLabel()
    {
        return $this->legalTextLabel;
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


}
