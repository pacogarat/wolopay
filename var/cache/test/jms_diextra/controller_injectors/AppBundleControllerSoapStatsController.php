<?php

namespace AppBundle\Controller\Soap;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class StatsController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\Soap\StatsController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->logger = $container->get('logger', 1);
        return $instance;
    }
}
