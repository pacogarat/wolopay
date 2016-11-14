<?php


namespace AppBundle\Payment\Event;


use AppBundle\Entity\PurchaseNotification;
use Guzzle\Http\Message\RequestInterface;
use Symfony\Component\EventDispatcher\Event;

class NotificationFailedEvent extends Event
{
    const EVENT = 'payment.notification.failed';

    /** @var PurchaseNotification */
    protected $purchaseNotification;

    /** @var string */
    protected $url;

    /**
     * @var string
     */
    protected $params;

    /**
     * @var string
     */
    protected $headers;

    /** @var string */
    protected $wasLastAttemptAndNoMore;

    function __construct(PurchaseNotification $purchaseNotification, RequestInterface $request, $lostUrl=null, $lostParams=null, $wasLastAttemptAndNoMore = false)
    {
        $this->purchaseNotification = $purchaseNotification;
        if ($lostUrl)  $this->url = $lostUrl;
        else $this->url = $request->getUrl();

        if ($lostParams) $this->params = $lostParams;
        else $this->params = http_build_query($request->getParams()->toArray());

        $this->headers = $request->getRawHeaders();
        $this->wasLastAttemptAndNoMore = $wasLastAttemptAndNoMore;
    }

    /**
     * @return PurchaseNotification
     */
    public function getPurchaseNotification()
    {
        return $this->purchaseNotification;
    }

    /**
     * @return string
     */
    public function getUrl(){
        return $this->url;
    }

    /**
     * @return string
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * @return string
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getWasLastAttemptAndNoMore()
    {
        return $this->wasLastAttemptAndNoMore;
    }



} 