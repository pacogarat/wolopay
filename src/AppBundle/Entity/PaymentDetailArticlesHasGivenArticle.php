<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * This class is created because ManyToMany cant allow duplicate elements, because primary key is a composite of fields
 *
 * @ORM\Table(name="payment_detail_article_has_given_articles")})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PaymentDetailArticlesHasGivenArticleRepository")
 * @ExclusionPolicy("all")
 */
class PaymentDetailArticlesHasGivenArticle
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @var integer $id
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\PaymentDetail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetailHasArticles", inversedBy="paymentDetailArticlesHasGivenArticles")
     * @ORM\JoinColumn(name="payment_detail_has_article_id", referencedColumnName="id", nullable=false)
     */
    protected $paymentDetailHasArticle;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     */
    protected $article;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PurchaseNotification", mappedBy="paymentDetailArticlesHasGivenArticle")
     * @Expose()
     */
    protected $purchaseNotifications;

    /**
     * @var array
     *
     * @ORM\Column(name="remaining_for_user_history", type="json_array", nullable=false)
     * @Expose()
     */
    private $remainingForUserHistory=[];

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gacha_initial_date", type="datetime", nullable=true)
     */
    protected $gachaInitialDate;

    /**
     * @ORM\Column(name="gacha_step", type="integer")
     */
    protected $gachaStep=0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    function __construct($article = null, $paymentDetailHasArticle= null, $remainingForUserHistory = null, $gachaInitialDate = null, $nStep)
    {
        $this->article                 = $article;
        $this->paymentDetailHasArticle = $paymentDetailHasArticle;
        $this->remainingForUserHistory = $remainingForUserHistory;
        $this->purchaseNotifications   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gachaInitialDate        = $gachaInitialDate;
        $this->gachaStep               = $nStep;

        $this->createdAt               = new \DateTime();
    }

    /**
     * @param \AppBundle\Entity\Article $article
     * @return $this
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \AppBundle\Entity\PaymentDetail $paymentDetailHasArticle
     * @return $this
     */
    public function setPaymentDetailHasArticle($paymentDetailHasArticle)
    {
        $this->paymentDetailHasArticle = $paymentDetailHasArticle;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\PaymentDetailHasArticles
     */
    public function getPaymentDetailHasArticle()
    {
        return $this->paymentDetailHasArticle;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
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
     * Add purchaseNotification
     *
     * @param \AppBundle\Entity\PurchaseNotification $purchaseNotification
     *
     * @return PaymentDetailArticlesHasGivenArticle
     */
    public function addPurchaseNotification(\AppBundle\Entity\PurchaseNotification $purchaseNotification)
    {
        $this->purchaseNotifications[] = $purchaseNotification;

        return $this;
    }

    /**
     * Remove purchaseNotification
     *
     * @param \AppBundle\Entity\PurchaseNotification $purchaseNotification
     */
    public function removePurchaseNotification(\AppBundle\Entity\PurchaseNotification $purchaseNotification)
    {
        $this->purchaseNotifications->removeElement($purchaseNotification);
    }

    /**
     * Get purchaseNotifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchaseNotifications()
    {
        return $this->purchaseNotifications;
    }

    /**
     * @param array $remainingForUserHistory
     * @return $this
     */
    public function setRemainingForUserHistory($remainingForUserHistory)
    {
        $this->remainingForUserHistory = $remainingForUserHistory;
        return $this;
    }

    /**
     * @return array
     */
    public function getRemainingForUserHistory()
    {
        return $this->remainingForUserHistory;
    }

    /**
     * @param \DateTime $gachaInitialDate
     * @return $this
     */
    public function setGachaInitialDate($gachaInitialDate)
    {
        $this->gachaInitialDate = $gachaInitialDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getGachaInitialDate()
    {
        return $this->gachaInitialDate;
    }

    /**
     * @return mixed
     */
    public function getGachaStep()
    {
        return $this->gachaStep;
    }

    /**
     * @param mixed $gachaStep
     * @return $this
     */
    public function setGachaStep($gachaStep)
    {
        $this->gachaStep = $gachaStep;
        return $this;
    }

}
