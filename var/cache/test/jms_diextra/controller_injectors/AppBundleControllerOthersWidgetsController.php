<?php

namespace AppBundle\Controller\Others;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class WidgetsController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\Others\WidgetsController();
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Others\\WidgetsController', 'logger');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('logger', 1));
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Others\\WidgetsController', 'guzzle');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('guzzle.client', 1));
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Others\\WidgetsController', 'ipInfoService');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('common.ip_info', 1));
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Others\\WidgetsController', 'em');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('doctrine.orm.default_entity_manager', 1));
        return $instance;
    }
}