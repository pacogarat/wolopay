<?php


namespace AppBundle\Traits;


use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Parent class require container
 */
Trait StopWatchTrait
{
    /**
     * @param string|array $title
     */
    protected function stopWatchStart($title)
    {
        /** @var ContainerInterface $container */
        $container = $this->container;

        if ($container->has('debug.stopwatch')) {
            /** @var \Symfony\Component\Stopwatch\Stopwatch $stopWatch */
            $stopWatch = $container->get('debug.stopwatch');

            if (is_array($title))
            {
                foreach ($title as $t)
                    $stopWatch->start($t);
            }else{
                $stopWatch->start($title);
            }

        }
    }

    /**
     * @param string|array $title
     */
    protected function stopWatchStop($title)
    {
        /** @var ContainerInterface $container */
        $container = $this->container;

        if ($container->has('debug.stopwatch')) {
            /** @var \Symfony\Component\Stopwatch\Stopwatch  $stopWatch */
            $stopWatch = $container->get('debug.stopwatch');

            if (is_array($title))
            {
                foreach ($title as $t)
                    $stopWatch->stop($t);
            }else{
                $stopWatch->stop($title);
            }
        }
    }
} 