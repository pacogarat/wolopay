<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class AbstractSMSController__JMSInjector
{
    public static function inject($container) {
        $instance = new \AppBundle\Controller\PaymentHosted\NviaPayMethods\AbstractSMSController();
        $refProperty = new \ReflectionProperty('AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\AbstractSMSController', 'translator');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('translator', 1));
        return $instance;
    }
}
