<?php

namespace AppBundle\Controller\ClientAdmin;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class ArticleCategoryController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ClientAdmin\ArticleCategoryController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->serializer = $container->get('jms_serializer', 1);
        return $instance;
    }
}
