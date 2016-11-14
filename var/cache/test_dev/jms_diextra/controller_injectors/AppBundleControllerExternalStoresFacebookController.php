<?php

namespace AppBundle\Controller\ExternalStores;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class FacebookController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ExternalStores\FacebookController();
        $instance->logger = $container->get('logger', 1);
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->articleService = $container->get('shop_app.article', 1);
        $instance->paymentProcessService = $container->get('shop.payment.payment_process', 1);
        $instance->currencyService = $container->get('common.currency', 1);
        return $instance;
    }
}
