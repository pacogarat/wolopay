<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\DoctrineEntityListenerPass;
use AppBundle\DependencyInjection\Compiler\LazyServiceCompilerPass;
use AppBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;
use AppBundle\Security\Factory\STransactionFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new STransactionFactory());

        $container->addCompilerPass(new DoctrineEntityListenerPass());
        $container->addCompilerPass(new OverrideServiceCompilerPass());
        $container->addCompilerPass(new LazyServiceCompilerPass());
    }
}
