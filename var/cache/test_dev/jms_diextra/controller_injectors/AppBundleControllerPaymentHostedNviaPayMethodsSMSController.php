<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class SMSController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\PaymentHosted\NviaPayMethods\SMSController();
        $instance->translator = $container->get('translator', 1);
        $instance->em = $container->get('doctrine.orm.default_entity_manager', 1);
        $instance->logger = $container->get('logger', 1);
        return $instance;
    }
}
