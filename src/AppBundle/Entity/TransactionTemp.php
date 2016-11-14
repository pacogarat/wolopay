<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * PayMethodVoice
 *
 * @ORM\Table(name="transaction_temp")
 * @ORM\Entity()
 */
class TransactionTemp
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
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App", inversedBy="appShops")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     */
    protected $app;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\Column(name="gamer_id", type="string", nullable=false)
     */
    private $gamerId;

    /**
     * @var float
     *
     * @ORM\Column(name="custom_amount", type="float", scale=2, precision=10, nullable=false)
     */
    protected $customAmount=null;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="custom_currency_id", referencedColumnName="id", nullable=false)
     */
    private $customCurrency=null;

    /**
     * @var \AppBundle\Entity\PayMethod
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PayMethod")
     * @ORM\JoinColumn(name="custom_pay_method_id", referencedColumnName="id", nullable=true)
     */
    private $customPayMethod=null;

    /**
     * @var \AppBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(name="custom_country_id", referencedColumnName="id", nullable=true)
     */
    private $customCountry=null;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_article_title", type="string", nullable=true)
     */
    protected $customArticleTitle=null;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_article_description", type="text", nullable=true)
     */
    protected $customArticleDescription=null;

    /**
     * @var String
     *
     * @ORM\Column(name="custom_param", type="string", length=125, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $customParam;

    /**
     * @var boolean
     *
     * @ORM\Column(name="test", type="boolean", nullable=false)
     */
    private $test=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Expose()
     */
    private $createdAt;

    function __construct(Transaction $transaction = null)
    {
        $this->createdAt = new \DateTime('now');

        if ($transaction)
            $this->parseFromTransaction($transaction);
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    private function setCreatedAt($createdAt)
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

    /**
     * @param int $id
     * @return $this
     */
    private function setId($id)
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
     * @param float $customAmount
     * @return $this
     */
    public function setCustomAmount($customAmount)
    {
        $this->customAmount = $customAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getCustomAmount()
    {
        return $this->customAmount;
    }

    /**
     * @param String $customArticleDescription
     * @return $this
     */
    public function setCustomArticleDescription($customArticleDescription)
    {
        $this->customArticleDescription = $customArticleDescription;
        return $this;
    }

    /**
     * @return String
     */
    public function getCustomArticleDescription()
    {
        return $this->customArticleDescription;
    }

    /**
     * @param String $customArticleTitle
     * @return $this
     */
    public function setCustomArticleTitle($customArticleTitle)
    {
        $this->customArticleTitle = $customArticleTitle;
        return $this;
    }

    /**
     * @return String
     */
    public function getCustomArticleTitle()
    {
        return $this->customArticleTitle;
    }

    /**
     * @param \AppBundle\Entity\Country $customCountry
     * @return $this
     */
    public function setCustomCountry(\AppBundle\Entity\Country $customCountry=null)
    {
        $this->customCountry = $customCountry;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCustomCountry()
    {
        return $this->customCountry;
    }

    /**
     * @param \AppBundle\Entity\Currency $customCurrency
     * @return $this
     */
    public function setCustomCurrency(\AppBundle\Entity\Currency $customCurrency=null)
    {
        $this->customCurrency = $customCurrency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getCustomCurrency()
    {
        return $this->customCurrency;
    }

    /**
     * @param \AppBundle\Entity\PayMethod $customPayMethod
     * @return $this
     */
    public function setCustomPayMethod(\AppBundle\Entity\PayMethod $customPayMethod = null)
    {
        $this->customPayMethod = $customPayMethod;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PayMethod
     */
    public function getCustomPayMethod()
    {
        return $this->customPayMethod;
    }

    /**
     * @param boolean $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param string $gamerId
     * @return $this
     */
    public function setGamerId($gamerId)
    {
        $this->gamerId = $gamerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getGamerId()
    {
        return $this->gamerId;
    }

    /**
     * @param String $customParam
     * @return $this
     */
    public function setCustomParam($customParam)
    {
        $this->customParam = $customParam;
        return $this;
    }

    /**
     * @return String
     */
    public function getCustomParam()
    {
        return $this->customParam;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return AppShop
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

    public function parseFromTransaction(Transaction $transaction)
    {
        $this
            ->setApp($transaction->getApp())
            ->setGamerId($transaction->getGamer()->getGamerExternalId())
            ->setCustomCountry($transaction->getCustomCountry())
            ->setCustomAmount($transaction->getCustomAmount())
            ->setCustomCurrency($transaction->getCustomCurrency())
            ->setCustomArticleDescription($transaction->getCustomArticleDescription())
            ->setCustomArticleTitle($transaction->getCustomArticleTitle())
            ->setCustomParam($transaction->getCustomParam())
            ->setTest($transaction->getTest())
        ;
    }
}
