<?php

namespace AppBundle\Controller\Others;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class DefaultController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\Others\DefaultController();
        $instance->guzzle = $container->get('guzzle.client', 1);
        return $instance;
    }
}