<?php

namespace AppBundle\Controller\Api;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class ArticleController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\Api\ArticleController();
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Api\\ArticleController', 'em');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('doctrine.orm.default_entity_manager', 1));
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\Api\\ArticleController', 'articleTempPriceService');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('app.article_temp_price', 1));
        return $instance;
    }
}