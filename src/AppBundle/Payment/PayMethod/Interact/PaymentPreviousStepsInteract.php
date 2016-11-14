<?php


namespace AppBundle\Payment\PayMethod\Interact;


use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Language;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Transaction;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interact class is used like event, his main function is to pass information from controller to services.
 * but it can also be used to avoid the repetition of basic logic
 *
 * Class PaymentPrepareInteract
 * @package AppBundle\Payment\PayMethod\Interact
 */
class PaymentPreviousStepsInteract
{
    /** @var Transaction */
    protected $transaction;

    /** @var Language */
    protected $language;

    /** @var PayMethodProviderHasCountry  */
    protected  $payMethodProviderHasCountry;

    /** @var AppShopHasArticle[] */
    protected  $appShopHasArticles;

    /** @var  Request  */
    protected  $request;

    function __construct(array $appShopHasArticles, $language, $payMethodProviderHasCountry, $transaction, $request)
    {
        $this->appShopHasArticles          = $appShopHasArticles;
        $this->language                    = $language;
        $this->payMethodProviderHasCountry = $payMethodProviderHasCountry;
        $this->request                     = $request;
        $this->transaction                 = $transaction;
    }

    /**
     * @return \AppBundle\Entity\AppShopHasArticles[]
     */
    public function getAppShopHasArticles()
    {
        return $this->appShopHasArticles;
    }

    /**
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return \AppBundle\Entity\PayMethodProviderHasCountry
     */
    public function getPayMethodProviderHasCountry()
    {
        return $this->payMethodProviderHasCountry;
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


} 