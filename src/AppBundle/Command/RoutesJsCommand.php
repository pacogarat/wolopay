<?php

/*
 * This file is part of the FOSJsRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Command;;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;

/**
 * Dumps routes to the filesystem.
 *
 * @author Benjamin Dulau <benjamin.dulau@anonymation.com>
 */
class RoutesJsCommand extends ContainerAwareCommand
{
    private $targetPath;

    protected function configure()
    {
        $this
            ->setName('shop:js-routing:dump')
            ->setDescription('Dumps exposed routes to the filesystem')

            ->addOption(
                'target',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override the target directory to dump routes in.'
            )
            ->addOption(
                'locale',
                null,
                InputOption::VALUE_OPTIONAL,
                'Set locale to be used with JMSI18nRoutingBundle.',
                ''
            )
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->targetPath = $input->getOption('target') ?:
            sprintf('%s/../web/js_glob/fos_js_routes.js', $this->getContainer()->getParameter('kernel.root_dir'));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Dumping exposed routes.');
        $output->writeln('');

        $this->doDump($input, $output);
    }

    /**
     * @return \FOS\JsRoutingBundle\Extractor\ExposedRoutesExtractorInterface
     */
    protected function getExposedRoutesExtractor()
    {
        return $this->getContainer()->get('fos_js_routing.extractor');
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    protected function getSerializer()
    {
        return $this->getContainer()->get('fos_js_routing.serializer');
    }

    /**
     * Performs the routes dump.
     *
     * @param InputInterface  $input  The command input
     * @param OutputInterface $output The command output
     */
    private function doDump(InputInterface $input, OutputInterface $output)
    {
        if (!is_dir($dir = dirname($this->targetPath))) {
            $output->writeln('<info>[dir+]</info>  ' . $dir);
            if (false === @mkdir($dir, 0777, true)) {
                throw new \RuntimeException('Unable to create directory ' . $dir);
            }
        }

        $output->writeln('<info>[file+]</info> ' . $this->targetPath);

        $baseUrl = $this->getContainer()->hasParameter('fos_js_routing.request_context_base_url') ?
            $this->getContainer()->getParameter('fos_js_routing.request_context_base_url') :
            $this->getExposedRoutesExtractor()->getBaseUrl()
        ;

        $result=array();
        /** @var Route $route */
        foreach ($this->getExposedRoutesExtractor()->getExposedRoutes() as $key => $route)
        {
            $result [$key] = $route->getPath();
        }

        $content = $this->getSerializer()->serialize(

                $result
            ,
            'json'
        );

        $content = sprintf("var Routing=%s;", $content);

        if (false === @file_put_contents($this->targetPath, $content)) {
            throw new \RuntimeException('Unable to write file ' . $this->targetPath);
        }
    }
}
