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
 * @ORM\Table(name="article_has_random_articles", uniqueConstraints={@ORM\UniqueConstraint(name="RAND_HAS_ARTICLE_", columns={"article_id", "possible_article_id"})})
 * @ORM\Entity
 * @UniqueEntity({"article", "possibleArticle"})
 * @ExclusionPolicy("all")
 */
class ArticleRandomHasArticle {
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="articlesRandom")
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
     * @ORM\JoinColumn(name="possible_article_id", referencedColumnName="id", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     * @Inline()
     */
    protected $possibleArticle;

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
    public function getPossibleArticle()
    {
        return $this->possibleArticle;
    }

    /**
     * @param Article $possibleArticle
     */
    public function setPossibleArticle($possibleArticle)
    {
        $this->possibleArticle = $possibleArticle;
    }


}