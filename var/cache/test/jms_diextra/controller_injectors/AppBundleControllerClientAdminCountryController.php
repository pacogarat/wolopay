<?php

namespace AppBundle\Controller\ClientAdmin;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class CountryController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\ClientAdmin\CountryController();
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->serializer = $container->get('jms_serializer', 1);
        $instance->currencyService = $container->get('common.currency', 1);
        $instance->countryService = $container->get('country', 1);
        return $instance;
    }
}
