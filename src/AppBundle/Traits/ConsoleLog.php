<?php


namespace AppBundle\Traits;


use Symfony\Component\Console\Output\OutputInterface;

Trait ConsoleLog
{
    /** @var OutputInterface  */
    protected $output;

    protected function addError($msg)
    {
        $this->logger->addError($msg);

        if ($this->output)
            $this->output->writeln("<error>$msg</error>");
    }

    protected function addDebug($msg)
    {
        $this->logger->addDebug($msg);

        if ($this->output)
            $this->output->writeln("$msg");
    }

    protected function addInfo($msg)
    {
        $this->logger->addInfo($msg);

        if ($this->output)
            $this->output->writeln("<info>$msg</info>");
    }

    protected function addCritical($msg)
    {
        $this->logger->addCritical($msg);

        if ($this->output)
            $this->output->writeln("<question>$msg</question>");
    }
} 