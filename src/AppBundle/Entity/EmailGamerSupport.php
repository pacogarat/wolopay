<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AppShop
 *
 * @ORM\Table(name="email_gamer_support")
 * @ORM\Entity()
 */
class EmailGamerSupport
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
     * @var \AppBundle\Entity\Transaction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transaction")
     * @ORM\JoinColumn(name="transation_id", referencedColumnName="id", nullable=false)
     *
     */
    private $transaction;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=45, nullable=false)
     * @Assert\NotBlank()
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=45, nullable=false)
     * @Assert\NotBlank()
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=145, nullable=false)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $comment;




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
     * Set subject
     *
     * @param string $subject
     * @return EmailGamerSupport
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EmailGamerSupport
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return EmailGamerSupport
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return EmailGamerSupport
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     * @return EmailGamerSupport
     */
    public function setTransaction(\AppBundle\Entity\Transaction $transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \AppBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EmailGamerSupport
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
