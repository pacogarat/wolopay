<?php

namespace AppBundle\Controller\Others;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class DemoController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\Others\DemoController();
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Others\\DemoController', 'router');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('router', 1));
        $instance->guzzle = $container->get('guzzle.client', 1);
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        return $instance;
    }
}