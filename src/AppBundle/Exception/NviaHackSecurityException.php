<?php

namespace AppBundle\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;

class NviaHackSecurityException extends \RuntimeException implements ExceptionInterface
{
    const MESSAGE_STANDARD = 'SECURITY ACTIVATED';

    const PAYMENT_VALIDATION_CHANGE_PRICE = 10010;

    const TRYING_TO_MANIPULATE_URLS = 11020;
}