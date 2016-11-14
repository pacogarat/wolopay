<?php


namespace AppBundle\Payment\PayMethod\Exceptions;


class SteamIdRequiredPayMethodException extends AbstractItemRequiredPayMethodException
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        $this->urlAlias = 'payment_steam_id_required_form';
    }
} 