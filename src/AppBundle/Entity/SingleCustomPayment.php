<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @ORM\Table(name="single_custom_payment")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SinglePaymentRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("single_custom_payment")
 */
class SingleCustomPayment extends SinglePayment
{
    const PREFIX = 'SINCUSTPAY_';

    /**
     * @var String
     *
     * @ORM\Column(name="article_title", type="string", nullable=true)
     */
    protected $articleTitle;

    /**
     * @var String
     *
     * @ORM\Column(name="article_description", type="text", nullable=true)
     */
    protected $articleDescription;

    public function getType()
    {
        return 'single_custom_payment';
    }

    /**
     * @param String $articleTitle
     * @return $this
     */
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
        return $this;
    }

    /**
     * @return String
     */
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    /**
     * @param String $articleDescription
     * @return $this
     */
    public function setArticleDescription($articleDescription)
    {
        $this->articleDescription = $articleDescription;
        return $this;
    }

    /**
     * @return String
     */
    public function getArticleDescription()
    {
        return $this->articleDescription;
    }


}
