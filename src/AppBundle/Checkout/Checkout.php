<?php

namespace AppBundle\Entity;

use AppBundle\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * Class Checkout
 * @Assert/CheckoutGeneral()
 */
class Checkout implements GroupSequenceProviderInterface{

    /** @var  Transaction $transaction */
    private $transaction;


    /**
     * @var AppShop $appShop
     */
    private $appShop;

    /**
     * @var Article[] $articles
     */
    private $articles;

    /**
     * @var PayMethod
     */
    private $payMethod;

    /** @var  int */
    private $smsId;
    /** @var  int  */
    private $voiceId;

    /**
     * Constructor
     * @param Transaction $transaction
     * @param ArrayCollection $articles
     * @param AppShop $appShop
     * @param PayMethod $payMethod
     * @param int $smsId
     * @param int $voiceId
     */
    public function __consruct(Transaction $transaction, $articles, AppShop $appShop=null,PayMethod $payMethod=null, $smsId=null, $voiceId=null)
    {
        $this->transaction  = $transaction;
        $this->articles = $articles;
        $this->appShop  = $appShop;
        $this->payMethod= $payMethod;
        $this->smsId    = $smsId;
        $this->voiceId  = $voiceId;
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param Transaction $transaction
     * @return $this
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }



    /**
     * @return AppShop
     */
    public function getAppShop()
    {
        return $this->appShop;
    }

    /**
     * @param AppShop $appShop
     * @return $this
     */
    public function setAppShop($appShop)
    {
        $this->appShop = $appShop;
        return $this;
    }

    /**
     * @return Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param Article[] $articles
     * @return $this
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
        return $this;
    }

    /**
     * @return PayMethod
     */
    public function getPayMethod()
    {
        return $this->payMethod;
    }

    /**
     * @param PayMethod $payMethod
     * @return $this
     */
    public function setPayMethod($payMethod)
    {
        $this->payMethod = $payMethod;
        return $this;
    }

    /**
     * @return int
     */
    public function getSmsId()
    {
        return $this->smsId;
    }

    /**
     * @param int $smsId
     * @return $this
     */
    public function setSmsId($smsId)
    {
        $this->smsId = $smsId;
        return $this;
    }

    /**
     * @return int
     */
    public function getVoiceId()
    {
        return $this->voiceId;
    }

    /**
     * @param int $voiceId
     * @return $this
     */
    public function setVoiceId($voiceId)
    {
        $this->voiceId = $voiceId;
        return $this;
    }





    public function getGroupSequence()
    {
        $groups = array('CheckoutGeneral');

        if ($this->appShop !== null && $this->gamer_level == null) {
            $groups[] = 'onlyAppShop';
        }

        if ($this->gamer_level !== null && $this->appShop == null) {
            $groups[] = 'onlyGamerLevel';
        }

        if ($this->gamer_level !== null && $this->appShop !== null) {
            $groups[] = 'appShop&GamerLevel';
        }

        if ($this->pmpc !== null) {
            $groups[] = 'payMethod';
        }

        return $groups;
    }

}