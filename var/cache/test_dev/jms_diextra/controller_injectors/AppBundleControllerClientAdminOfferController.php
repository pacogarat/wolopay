<?php

namespace AppBundle\Controller\ClientAdmin;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class OfferController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ClientAdmin\OfferController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->serializer = $container->get('jms_serializer', 1);
        $instance->offerService = $container->get('shop_app.offer', 1);
        return $instance;
    }
}
