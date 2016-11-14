<?php
/**
 * Created by MGDSoftware. 20/11/2015
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="article_gacha_has_articles", uniqueConstraints={@ORM\UniqueConstraint(name="GACHA_HAS_ARTICLE_", columns={"article_id", "possible_article_id"} )})
 * @ORM\Entity
 * @UniqueEntity({"article", "possibleArticle"})
 * @ExclusionPolicy("all")
 */
class ArticleGachaHasArticle {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="articlesGacha")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $article;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="possible_article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public", "ArticleFull"})
     */
    protected $possibleArticle;

    /**
     * This parameter is used only for visualization, values (1-2-3-null)
     *
     * @ORM\Column(name="best_article", type="integer", nullable=true)
     * @Expose()
     * @Groups({"SpecialTypeFull", "Default"})
     *
     * @var integer $id
     */
    protected $bestArticle;

    /**
     * @var int
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     * @Groups({"SpecialTypeFull"})
     */
    protected $order;

    /**
     * One article can be given away more than one time (this increases probability!)
     * @var int
     * @ORM\Column(name="amount_to_give", type="integer", nullable=false)
     * @Expose()
     * @Groups({"SpecialTypeFull", "Default"})
     */
    protected $amountToGive=1;

    /**
     * @var int
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $remainingForUser;

    function __construct(Article $article=null)
    {
        $this->article = $article;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return Article
     *
     */
    public function getPossibleArticle()
    {
        return $this->possibleArticle;
    }

    /**
     * @param Article $possibleArticle
     * @return $this
     */
    public function setPossibleArticle($possibleArticle)
    {
        $this->possibleArticle = $possibleArticle;
        return $this;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getAmountToGive()
    {
        return $this->amountToGive;
    }

    /**
     * @param int $amountToGive
     * @return $this
     */
    public function setAmountToGive($amountToGive)
    {
        $this->amountToGive = $amountToGive;
        return $this;
    }

    /**
     * @return int
     */
    public function getRemainingForUser()
    {
        return $this->remainingForUser;
    }

    /**
     * @param int $remainingForUser
     * @return $this
     */
    public function setRemainingForUser($remainingForUser)
    {
        $this->remainingForUser = $remainingForUser;
        return $this;
    }

    /**
     * @param int $bestArticle
     * @return $this
     */
    public function setBestArticle($bestArticle)
    {
        $this->bestArticle = $bestArticle;
        return $this;
    }

    /**
     * @return int
     */
    public function getBestArticle()
    {
        return $this->bestArticle;
    }

}