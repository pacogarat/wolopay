<?php


namespace AppBundle\Payment\PayMethod\Exceptions;


class EmailRequiredPayMethodException extends AbstractItemRequiredPayMethodException
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $this->urlAlias = 'payment_email_required_form';
    }
} 