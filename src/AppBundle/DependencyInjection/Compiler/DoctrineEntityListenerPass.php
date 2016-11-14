<?php
/**
 * Created by MGDSoftware. 15/07/2016
 */

namespace AppBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DoctrineEntityListenerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $ems = $container->getParameter('doctrine.entity_managers');
        foreach ($ems as $name => $em) {
            $container->getDefinition(sprintf('doctrine.orm.%s_configuration', $name))
                ->addMethodCall('setEntityListenerResolver', [new Reference('doctrine.orm.container_aware_entity_listener_resolver')])
            ;
        }

        $definition = $container->getDefinition('doctrine.orm.container_aware_entity_listener_resolver');

//        $services = $container->findTaggedServiceIds('doctrine.orm.entity_listener');

        foreach ($container->findTaggedServiceIds('doctrine.entity_listener') as $service => $attributes) {
            $definition->addMethodCall('addMapping', array($container->getDefinition($service)->getClass(), $service));
        }
    }
}