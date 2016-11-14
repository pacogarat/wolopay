<?php

namespace AppBundle\Controller\ClientAdmin;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class ArticleController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ClientAdmin\ArticleController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->serializer = $container->get('jms_serializer', 1);
        $instance->currencyService = $container->get('common.currency', 1);
        $instance->countryService = $container->get('country', 1);
        $instance->offerCommand = $container->get('command.shop.offer.sync', 1);
        $instance->appShopHasArticleService = $container->get('app_shop_has_article', 1);
        $instance->logger = $container->get('logger', 1);
        return $instance;
    }
}
