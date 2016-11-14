<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\Country;
use AppBundle\Entity\Transaction;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class TransactionStartedEvent extends Event
{
    const EVENT = 'shop.transaction.started';

    /** @var Transaction*/
    protected $transaction;

    /** @var Request*/
    protected $request;

    /** @var Country*/
    protected $countryDefault;

    function __construct(Transaction $transaction, Request $request, Country $countryDefault = null)
    {
        $this->request        = $request;
        $this->transaction    = $transaction;
        $this->countryDefault = $countryDefault;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \AppBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @return \AppBundle\Entity\Country
     */
    public function getCountryDefault()
    {
        return $this->countryDefault;
    }


} 