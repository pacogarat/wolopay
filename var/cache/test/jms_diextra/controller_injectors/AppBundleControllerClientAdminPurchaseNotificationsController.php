<?php

namespace AppBundle\Controller\ClientAdmin;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class PurchaseNotificationsController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ClientAdmin\PurchaseNotificationsController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        return $instance;
    }
}