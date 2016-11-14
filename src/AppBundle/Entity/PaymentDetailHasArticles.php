<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="payment_detail_has_articles", uniqueConstraints={@ORM\UniqueConstraint(name="PAYMENT_DET_UNIQUE_", columns={"article_id", "payment_detail_id", "offer_programmer_id"})})
 * @ORM\Entity
 * @UniqueEntity({"article", "paymentDetail", "offerProgrammer"})
 * @ExclusionPolicy("all")
 * @XmlRoot("payment_detail_has_articles")
 */
class PaymentDetailHasArticles
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\PaymentDetail
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentDetail", inversedBy="paymentDetailHasArticles")
     * @ORM\JoinColumn(name="payment_detail_id", referencedColumnName="id", nullable=false)
     */
    protected $paymentDetail;

    /**
     * @var \AppBundle\Entity\PurchaseNotification[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PurchaseNotification", mappedBy="paymentDetailHasArticle")
     */
    protected $purchaseNotifications;

    /**
     * We store the name because the tab can be deleted easily, or renamed.
     * We'll show the name as it was when the purchase was done
     * @var String tabName
     * @ORM\Column(name="tab_name", type="string",  nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $tabName;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     * @Inline()
     */
    protected $article;

    /**
     * To special articles like gacha
     *
     * @var \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PaymentDetailArticlesHasGivenArticle", mappedBy="paymentDetailHasArticle", cascade={"ALL"})
     * @Expose()
     * @Groups({"Default", "PaymentDetailHasArticlesAddPaymentDetailArticlesHasGivenArticles"})
     */
    protected $paymentDetailArticlesHasGivenArticles;

    /**
     * Nullable yes because all necessary data is saved
     *
     * @var \AppBundle\Entity\AppShopHasArticle
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppShopHasArticle")
     * @ORM\JoinColumn(name="app_shop_has_article_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $appShopHasArticle;

    /**
     * @var int
     *
     * @ORM\Column(name="items_quantity", type="integer")
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    private $itemsQuantity;

    /**
     * @var int
     *
     * @ORM\Column(name="articles_quantity", type="integer")
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    private $articlesQuantity=1;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", scale=2, precision=10)
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    private $amount;

    /**
     * @var float
     * @Expose()
     * @Groups({"Default", "Public", "CartPrice"})
     */
    private $amountEur;



    /**
     * @var \AppBundle\Entity\OfferProgrammer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfferProgrammer", inversedBy="paymentDetailHasArticles" )
     * @ORM\JoinColumn(name="offer_programmer_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     * @Expose()
     * @MaxDepth(2)
     * @Groups({"Default", "Public"})
     */
    private $offerProgrammer;


    function __construct(AppShopHasArticle $appShopHasArticle = null, PaymentDetail $paymentDetail= null, $tabName=null, $quantity = 1)
    {
        $this->paymentDetailArticlesHasGivenArticles = new \Doctrine\Common\Collections\ArrayCollection();

        if ($appShopHasArticle)
        {
            $this->amount            = $appShopHasArticle->getCurrentAmount($quantity);
            $this->itemsQuantity     = $appShopHasArticle->getCurrentItemsQuantity($quantity);
            $this->article           = $appShopHasArticle->getArticle();
            $this->appShopHasArticle = $appShopHasArticle;

            if ($appShopHasArticle->getOffer($quantity))
                $this->offerProgrammer   = $appShopHasArticle->getOffer($quantity)->getOfferProgrammer();
        }

        if ($paymentDetail)
            $this->paymentDetail = $paymentDetail;

        if ($tabName)
            $this->tabName = $tabName;
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
     * @param float $itemsQuantity
     * @return $this
     */
    public function setItemsQuantity($itemsQuantity)
    {
        $this->itemsQuantity = $itemsQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getItemsQuantity()
    {
        return $this->itemsQuantity;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return PaymentDetailHasArticles
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
     * Set appShopHasArticle
     *
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticle|null
     * @return PaymentDetailHasArticles
     */
    public function setAppShopHasArticle(\AppBundle\Entity\AppShopHasArticle $appShopHasArticle = null)
    {
        $this->appShopHasArticle = $appShopHasArticle;

        return $this;
    }

    /**
     * Get appShopHasArticle
     *
     * @return \AppBundle\Entity\AppShopHasArticle|null
     */
    public function getAppShopHasArticle()
    {
        return $this->appShopHasArticle;
    }

    /**
     * @param float $articlesQuantity
     * @return $this
     */
    public function setArticlesQuantity($articlesQuantity)
    {
        $this->articlesQuantity = $articlesQuantity;
        return $this;
    }

    /**
     * @param int $articlesQuantity
     * @return $this
     */
    public function addArticlesQuantity($articlesQuantity=1)
    {
        $this->articlesQuantity += $articlesQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getArticlesQuantity()
    {
        return $this->articlesQuantity;
    }


    /**
     * Set paymentDetails
     *
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return PaymentDetailHasArticles
     */
    public function setPaymentDetails(\AppBundle\Entity\PaymentDetail $paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;

        return $this;
    }

    /**
     * Get paymentDetails
     *
     * @return \AppBundle\Entity\PaymentDetail
     */
    public function getPaymentDetail()
    {
        return $this->paymentDetail;
    }

    /**
     * @VirtualProperty()
     */
    public function getName()
    {
        if ($this->getPaymentDetail()->getTransaction()->getCli())
            return $this->getArticle()->getNameCurrentLabel();

        return $this->getNameCurrentLabel();
    }

    /**
     * Set paymentDetail
     *
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return PaymentDetailHasArticles
     */
    public function setPaymentDetail(\AppBundle\Entity\PaymentDetail $paymentDetail)
    {
        $this->paymentDetail = $paymentDetail;

        return $this;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $amount = round($amount, 2);
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \AppBundle\Entity\OfferProgrammer $offerProgrammer
     * @return $this
     */
    public function setOfferProgrammer($offerProgrammer)
    {
        $this->offerProgrammer = $offerProgrammer;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\OfferProgrammer
     */
    public function getOfferProgrammer()
    {
        return $this->offerProgrammer;
    }

    /**
     * @return String
     */
    public function getTabName()
    {
        return $this->tabName;
    }

    /**
     * @param String $tabName
     */
    public function setTabName($tabName)
    {
        $this->tabName = $tabName;
    }

    public function getNameCurrentLabel()
    {
        if ($this->appShopHasArticle)
            return $this->appShopHasArticle->getNameCurrentLabel();

        return $this->article->getNameCurrentLabel();
    }

    public function getDescriptionCurrentLabel()
    {
        if ($this->appShopHasArticle)
            return $this->appShopHasArticle->getDescriptionCurrentLabel();

        return $this->article->getDescriptionCurrentLabel();
    }

    public function getImageClosest()
    {
        if ($this->getAppShopHasArticle())
            return $this->getAppShopHasArticle()->getImageCurrent();

        return $this->article->getImageCurrent();
    }
    /**
     * @return PaymentDetailArticlesHasGivenArticle[]
     */
    public function getPaymentDetailArticlesHasGivenArticles()
    {
        return $this->paymentDetailArticlesHasGivenArticles;
    }

    /**
     * Get givenArticle
     *
     * @param $index
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGivenArticle($index)
    {
        if (!$val = $this->paymentDetailArticlesHasGivenArticles->get($index))
            return null;

        return $val->getArticle();
    }

    /**
     * Add purchaseNotification
     *
     * @param \AppBundle\Entity\PurchaseNotification $purchaseNotification
     *
     * @return PaymentDetailHasArticles
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
     * Add paymentDetailArticlesHasGivenArticle
     *
     * @param \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle
     *
     * @return PaymentDetailHasArticles
     */
    public function addPaymentDetailArticlesHasGivenArticle(\AppBundle\Entity\PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle)
    {
        $this->paymentDetailArticlesHasGivenArticles[] = $paymentDetailArticlesHasGivenArticle;

        return $this;
    }

    /**
     * Remove paymentDetailArticlesHasGivenArticle
     *
     * @param \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle
     */
    public function removePaymentDetailArticlesHasGivenArticle(\AppBundle\Entity\PaymentDetailArticlesHasGivenArticle $paymentDetailArticlesHasGivenArticle)
    {
        $this->paymentDetailArticlesHasGivenArticles->removeElement($paymentDetailArticlesHasGivenArticle);
    }

    /**
     * @param $articleId
     * @param int $lap
     * @return \AppBundle\Entity\PaymentDetailArticlesHasGivenArticle
     */
    public function getPaymentDetailArticlesHasGivenArticlesByArticleId($articleId, $lap = 1)
    {
        $found =1;

        foreach ($this->paymentDetailArticlesHasGivenArticles as $pdahga)
        {
            if ($pdahga->getArticle()->getId() == $articleId)
            {
                if ($lap == $found)
                    return $pdahga;

                $found++;
            }
        }

        return null;
    }

    public function getArticleUnitaryAmount()
    {
        return $this->getAmount() / $this->getArticlesQuantity();
    }

    /**
     * @return float
     */
    public function getAmountEur()
    {
        return $this->amountEur;
    }

    /**
     * @param float $amountEur
     * @return $this
     */
    public function setAmountEur($amountEur)
    {
        $this->amountEur = $amountEur;
        return $this;
    }


}
