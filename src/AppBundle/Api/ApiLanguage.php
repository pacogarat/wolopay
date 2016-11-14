<?php


namespace AppBundle\Api;

use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * @Service("app.api_language")
 * @Tag("kernel.event_listener", attributes = {"event" = "kernel.request"})
 */
class ApiLanguage
{
    /**
     * @var array
     * @Inject("%locale_available%")
     */
    public $localesAvailable;

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ((strpos($request->getPathInfo(), '/api/v') === FALSE) && (strpos($request->getPathInfo(), '/admin/api/')===false))
            return;

        $preferredLanguage = $request->getPreferredLanguage($this->localesAvailable);

        if ($preferredLanguage)
        {
            $request->setLocale($preferredLanguage);
        }
    }
} 