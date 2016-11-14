<?php


namespace AppBundle\Logger;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;


/**
 * @Service("app.user_details")
 * @Tag("kernel.event_listener", attributes = {"event" = "kernel.exception"})
 */
class UserDetails
{
    /** @var  Logger */
    private $logger;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();
        $path = 'CLI';
        if (isset($_SERVER['REQUEST_URI']))
            $path = $_SERVER['REQUEST_URI'];

        $this->logger->addInfo("--- Request info PATH: $path, GET: ".urldecode(http_build_query($request->query->all())).
            ", POST: ". urldecode(http_build_query($request->request->all())));
        $this->logger->addInfo("--- Summary User info, ip:". $request->getClientIp().", Browser: ".$request->headers->get('User-Agent').' ---');
    }



} 