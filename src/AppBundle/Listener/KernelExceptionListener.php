<?php


namespace AppBundle\Listener;

use AppBundle\Exception\NviaShowCustomResponseErrorException;
use AppBundle\Interfaces\SendCustomEmailOnErrorInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * @Service("app.kernel_exception")
 * @Tag("kernel.event_listener", attributes = {"event" = "kernel.exception"})
 */
class KernelExceptionListener
{
    /** @var TimedTwigEngine
     * @Inject("templating")
     */
    public $templating;

    /** @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var \Swift_Mailer
     * @Inject("mailer")
     */
    public $mailer;

    /**
     * @var String
     * @Inject("%email_app%")
     */
    public $emailApp;

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exceptionActions = function (\Exception $exception = null) use ($event)
        {
            if (!$exception)
                return null;

            $this->logger->addDebug("Exception in Kernel exception listener: ".get_class($exception));

            if ($exception instanceof NviaShowCustomResponseErrorException)
            {
                if ($exception->getNotifyError())
                    $this->logger->addError($exception->getMessage());

                //create response, set status code etc.
                //event will stop propagating here. Will not call other listeners.
                $event->setResponse(
                    new Response($this->templating->render(
                        $exception->getTemplateResponse(),
                        $exception->getTemplateArguments()
                    ))
                );
            }

            if ($exception instanceof SendCustomEmailOnErrorInterface)
            {
                if (!$exception->getEmailTo() || !$exception->getSubject() || !$exception->getContentHTML())
                    return;

                $this->logger->addDebug('Sending email to error to '.$exception->getEmailTo());

                $message = \Swift_Message::newInstance()
                    ->setSubject('WOLOPAY '.$exception->getSubject())
                    ->setFrom($this->emailApp)
                    ->setTo($exception->getEmailTo())
                    ->setBody($exception->getContentHTML(), 'text/html')
                ;

                $this->mailer->send($message);
                $this->logger->addNotice("Email was sent to ".$exception->getEmailTo().'<br><br>'.$exception->getContentHTML());

            }
        };

        $exception =  $event->getException();

        $exceptionActions($exception);
        $exceptionActions($exception->getPrevious());
    }

} 