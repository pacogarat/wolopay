<?php


namespace AppBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Not used
 */
class LazyServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        foreach ($container->getDefinitions() as $serviceName => $definition)
        {
            $prefix = // 'shop.payment\.'. // our prefix
                      'nelmio_api_doc\.formatter\.html_formatter|nelmio_api_doc\.extractor\.api_doc_extractor' // third parties (removed sonata because it crash)
            ;

            if (preg_match("/^($prefix)/", $serviceName) )
            {
                $class = $definition->getClass();

                if (preg_match('/^\%.*\%$/', $class))  // is a parameter?
                {
                    $parameter = str_replace('%', '', $class);

                    if ($container->hasParameter($parameter))
                        $class = $container->getParameter($parameter);
                    else
                        $class = $container->getParameterBag()->resolveValue( $container->getParameter( $parameter ));

                    if (!$class)
                        continue;
                }

                if (!class_exists($class))
                    continue;

                $reflection = new \ReflectionClass($class);

                if ($reflection->isFinal() === false)
                {
//                    echo "$serviceName set to lazy\n";
                    $definition->setLazy(true);
                }
            }
        }
    }
}
