<?php

namespace AppBundle\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;

class NodeException extends \RuntimeException implements ExceptionInterface
{
    // Generic error
    const SERVICE_NOT_AVAILABLE= 500;



    const MESSAGE_STANDARD = 'Service not available';

}