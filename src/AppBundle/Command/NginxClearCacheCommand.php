<?php

namespace AppBundle\Command;


use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;


/**
 * @Service("command.nginx_clear_cache")
 * @Tag("console.command")
 */
class NginxClearCacheCommand extends Command
{
    /**
     * @var string
     * @Inject("%kernel.environment%"),
     */
    public $env;

    /** **
     * @var string
     * @Inject("%kernel.root_dir%")
     */
    public $rootDir;

    protected function configure()
    {
        $this
            ->setName('nginx:cache:clear')
            ->setDescription('Nginx clear cache')
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
        $this->clearCache();
        $output->writeln("<info>NGINX cache was cleared</info>");
    }

    public function clearCache()
    {
        $exe = "find $this->rootDir/../var/cache/nginx -type f -delete";
        $process = new Process($exe);
        $process->run();
    }

} 