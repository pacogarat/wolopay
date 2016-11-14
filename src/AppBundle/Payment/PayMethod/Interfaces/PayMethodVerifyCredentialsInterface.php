<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface PayMethodVerifyCredentialsInterface
{
    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray);

    /** @return array */
    public function getShapeProviderClientCredentials();

} 