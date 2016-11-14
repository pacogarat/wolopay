<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Validator\Constraints\SameApp;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Table(name="promo_code", uniqueConstraints={@ORM\UniqueConstraint(name="PROMO_CODE_UNIQUE_", columns={"code", "app_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PromoCodeRepository")
 * @UniqueEntity({"code","app"})
 * @ExclusionPolicy("all")
 * @XmlRoot("promo_code")
 */
class PromoCode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"PromoCodeFull"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=15)
     */
    private $code;

    /**
     * @var \AppBundle\Entity\Promo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promo", inversedBy="promoCodes", cascade={"persist"})
     * @ORM\JoinColumn(name="promo_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Assert\NotBlank()
     */
    private $promo;

    /**
     * @var \AppBundle\Entity\App
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\App")
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $app;

    /**
     * @var \AppBundle\Entity\Gamer
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Gamer", cascade={"all"})
     * @ORM\JoinTable(name="promo_code_has_gamers",
     *      joinColumns={@ORM\JoinColumn(name="promo_code_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="gamer_id", referencedColumnName="id", onDelete="cascade")})
     * @Expose()
     * @Groups({"Default", "Public"})
     * @SameApp()
     */
    private $gamers;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @MaxDepth(1)
     * @SameApp()
     * @Assert\NotBlank()
     */
    private $article;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_n_time_used", type="integer", nullable=false)
     * @Expose()
     */
    private $countNTimeUsed=0;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float", precision=10, scale=4, nullable=true)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPercent", type="boolean", nullable=true)
     */
    private $isPercent;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_uses_per_user", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $nUsesPerUser=1;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_total_uses", type="integer", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $nTotalUses=1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public","PromoCodeFull"})
     */
    private $beginAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public","PromoCodeFull"})
     */
    private $endAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"PromoCodeFull"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable("UPDATE")
     * @Expose()
     * @Groups({"PromoCodeFull"})
     */
    protected $updatedAt;

    public function __clone() {
        $this->id = null;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');

        $this->gamers =  new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return PromoCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set countNTimeUsed
     *
     * @param integer $countNTimeUsed
     * @return PromoCode
     */
    public function setCountNTimeUsed($countNTimeUsed)
    {
        $this->countNTimeUsed = $countNTimeUsed;

        return $this;
    }

    /**
     * Get countNTimeUsed
     *
     * @return integer 
     */
    public function getCountNTimeUsed()
    {
        return $this->countNTimeUsed;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return PromoCode
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set isPercent
     *
     * @param boolean $isPercent
     * @return PromoCode
     */
    public function setIsPercent($isPercent)
    {
        $this->isPercent = $isPercent;

        return $this;
    }

    /**
     * Get isPercent
     *
     * @return boolean 
     */
    public function getIsPercent()
    {
        return $this->isPercent;
    }

    /**
     * Set nUsesPerUser
     *
     * @param integer $nUsesPerUser
     * @return PromoCode
     */
    public function setNUsesPerUser($nUsesPerUser)
    {
        $this->nUsesPerUser = $nUsesPerUser;

        return $this;
    }

    /**
     * Get nUsesPerUser
     *
     * @return integer 
     */
    public function getNUsesPerUser()
    {
        return $this->nUsesPerUser;
    }

    /**
     * Set nTotalUses
     *
     * @param integer $nTotalUses
     * @return PromoCode
     */
    public function setNTotalUses($nTotalUses=null)
    {
        $this->nTotalUses = $nTotalUses;

        return $this;
    }

    /**
     * Set nTotalUses
     *
     * @param integer $sumCountNTimeUsed
     * @return PromoCode
     */
    public function sumCountNTimeUsed($sumCountNTimeUsed=1)
    {
        $this->countNTimeUsed += $sumCountNTimeUsed;

        return $this;
    }

    /**
     * Get nTotalUses
     *
     * @return integer 
     */
    public function getNTotalUses()
    {
        return $this->nTotalUses;
    }

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
     * @return PromoCode
     */
    public function setBeginAt($beginAt=null)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime 
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return PromoCode
     */
    public function setEndAt($endAt=null)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime 
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PromoCode
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return PromoCode
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set promo
     *
     * @param \AppBundle\Entity\Promo $promo
     * @return PromoCode
     */
    public function setPromo(\AppBundle\Entity\Promo $promo = null)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \AppBundle\Entity\Promo
     */
    public function getPromo()
    {
        return $this->promo;
    }


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return PromoCode
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set app
     *
     * @param \AppBundle\Entity\App $app
     * @return PromoCode
     */
    public function setApp(\AppBundle\Entity\App $app = null)
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

    /**
     * Add gamers
     *
     * @param \AppBundle\Entity\Gamer $gamers
     * @return PromoCode
     */
    public function addGamer($gamers)
    {
        $this->gamers[] = $gamers;

        return $this;
    }

    /**
     * Remove gamers
     *
     * @param \AppBundle\Entity\Gamer $gamers
     */
    public function removeGamer(\AppBundle\Entity\Gamer $gamers)
    {
        $this->gamers->removeElement($gamers);
    }

    /**
     * Get gamers
     *
     * @return Gamer[]
     */
    public function getGamers()
    {
        return $this->gamers;
    }

    /**
     * Get gamers
     *
     * @param $gamers
     * @return $this
     */
    public function setGamers($gamers)
    {
        $this->gamers->clear();

        foreach ($gamers as $gamer)
            $this->gamers[] = $gamer;

        return $this;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return PromoCode
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->article && $this->article->getArticleCategory()->getId() !== ArticleCategoryEnum::FREE_PAYMENT_ID)
        {
            $context->buildViolation('Invalid article because need to be FREE')
                ->atPath('article')
                ->addViolation();
        }
    }


}
