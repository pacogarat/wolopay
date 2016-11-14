<?php

namespace AppBundle\Exception;

class NviaShowCustomResponseErrorException extends NviaException
{
    private $templateResponse;
    private $templateArguments;
    private $notifyError;

    public function __construct($templateResponse = null, $templateArguments= [], $message = "", $code = 0, $notifyError = true, $previousException = null)
    {
        $this->templateResponse = $templateResponse ?: ':Error:custom.html.twig';
        $this->templateArguments = $templateArguments ?: ['error_message' => $message];
        $this->notifyError = $notifyError;


        parent::__construct($message, $code, $previousException);
    }

    /**
     * @return array
     */
    public function getTemplateArguments()
    {
        return $this->templateArguments;
    }

    /**
     * @return string
     */
    public function getTemplateResponse()
    {
        return $this->templateResponse;
    }

    /**
     * @return boolean
     */
    public function getNotifyError()
    {
        return $this->notifyError;
    }



}