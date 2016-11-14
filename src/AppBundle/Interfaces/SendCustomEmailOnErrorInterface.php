<?php


namespace AppBundle\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * If some exception has this interface it will be send a custom email to anybody
 */
interface SendCustomEmailOnErrorInterface
{
    /**
     * @return string|array
     */
    public function getEmailTo();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return string
     */
    public function getContentHTML();
} 