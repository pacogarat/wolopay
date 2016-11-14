<?php


namespace AppBundle\Exception;


use FOS\RestBundle\Controller\ExceptionController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class TwigException extends ExceptionController
{
    /**
     * Converts an Exception to a Response.
     *
     * @param Request                                       $request   Request
     * @param HttpFlattenException|DebugFlattenException    $exception A HttpFlattenException|DebugFlattenException instance
     * @param DebugLoggerInterface                          $logger    A DebugLoggerInterface instance
     * @param string                                        $format    The format to use for rendering (html, xml, ...)
     *
     * @return Response Response instance
     */
    public function showAction(Request $request, $exception, DebugLoggerInterface $logger = null, $format = 'html')
    {
        if (strpos($request->getPathInfo(), '/shop/payment/ipn') !== false)
            return new Response($this->getExceptionMessage($exception), $this->getStatusCode($exception));

        return parent::showAction($request, $exception, $logger, $format);
    }
} 