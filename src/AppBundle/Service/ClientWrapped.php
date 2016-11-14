<?php


namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\Client as BaseClient;

class ClientWrapped extends Client
{
    protected function doRequest($request)
    {
        return BaseClient::doRequest($request);
    }
} 