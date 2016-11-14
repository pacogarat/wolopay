<?php

namespace AppBundle\Command;


use AppBundle\Traits\ConsoleLog;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("command.nginx_call_routes_with_cache")
 * @Tag("console.command")
 */
class NginxCallRoutesWithCacheCommand extends Command
{
    use ConsoleLog;

    /**
     * @var string
     * @Inject("%domain_main%"),
     */
    public $domainMain;

    /**
     * @Inject("router")
     * @var Router
     */
    public $router;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    protected function configure()
    {
        $this
            ->setName('nginx:call:routes_with_cache')
            ->setDescription('Nginx recache all pages')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $output->writeln("<info>Searching urls to recache</info>");
        $this->cacheAllCachedPages();
        $output->writeln("<info>NGINX recached all pages</info>");
    }

    public function cacheAllCachedPages()
    {
        foreach ($this->router->getRouteCollection()->all() as $name => $route)
        {
            if (!$route->getOption('url_call_to_cache_after_deploy')) {
                continue;
            }

            $url = $this->domainMain. $this->router->generate($name);
            $this->addInfo("Calling to $url");
            $this->guzzle->get($url)->send();
        }
    }

} 