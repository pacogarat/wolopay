<?php
/**
 * Created by MGDSoftware. 20/11/2015
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Inline;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="article_pack_has_articles", uniqueConstraints={@ORM\UniqueConstraint(name="PACK_HAS_ARTICLE_", columns={"article_id", "included_article_id"})})
 * @ORM\Entity
 * @UniqueEntity({"article", "includedArticle"})
 * @ExclusionPolicy("all")
 */
class ArticlePackHasArticle {
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="articlesPack")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Inline()
     */
    protected $article;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumn(name="included_article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Inline()
     */
    protected $includedArticle;

    /**
     * @var int
     * @ORM\Column(name="give_n_times", type="integer", nullable=false)
     */
    protected $giveNTimes=1;

    /**
     * Only if give_n_times>1
     * @var int
     * @ORM\Column(name="give_every_n_days", type="integer", nullable=true)
     */
    protected $giveEveryNDays=0;

    /**
     * give things in order. NULL=order doesn't matter
     * @var int
     * @ORM\Column(name="`order`", type="integer", nullable=true)
     */
    protected $order=0;

    /**
     * give the first time after a delay of N days
     * @var int
     * @ORM\Column(name="delay_n_days_before_first", type="integer", nullable=true)
     */
    protected $delayNDaysBeforeFirst=0;




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
     */
    public function getIncludedArticle()
    {
        return $this->includedArticle;
    }

    /**
     * @param Article $includedArticle
     * @return $this
     */
    public function setIncludedArticle($includedArticle)
    {
        $this->includedArticle = $includedArticle;
        return $this;
    }

    /**
     * @return int
     */
    public function getGiveNTimes()
    {
        return $this->giveNTimes;
    }

    /**
     * @param int $giveNTimes
     * @return $this
     */
    public function setGiveNTimes($giveNTimes)
    {
        $this->giveNTimes = $giveNTimes;
        return $this;
    }

    /**
     * @return int
     */
    public function getGiveEveryNDays()
    {
        return $this->giveEveryNDays;
    }

    /**
     * @param int $giveEveryNDays
     * @return $this
     */
    public function setGiveEveryNDays($giveEveryNDays)
    {
        $this->giveEveryNDays = $giveEveryNDays;
        return $this;
    }
}