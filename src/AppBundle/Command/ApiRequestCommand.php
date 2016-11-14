<?php

namespace AppBundle\Command;



use AppBundle\Api\ApiRequestClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ApiRequestCommand
 * @Deprecated to test use testing test/functional/
 * @package AppBundle\Command
 */
class ApiRequestCommand extends Command
{
    /** @var ApiRequestClient */
    private $apiRequestClient;

    /**
     * @param ApiRequestClient $apiRequestClient
     */
    public function __construct(ApiRequestClient $apiRequestClient)
    {
        $this->apiRequestClient = $apiRequestClient;

        //$this->logger = $logger;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('api:request:create')
            ->setDescription('Create Api Request')
            ->addArgument('codeKey', InputArgument::REQUIRED, 'Code key')
            ->addArgument('secretKey',InputArgument::REQUIRED, 'Secret key')
            ->addArgument('path_name', InputArgument::REQUIRED, 'Url path name where make request')
            ->addArgument('method', InputArgument::OPTIONAL, 'Method GET/POST ...', 'GET')
            ->addArgument('parametersString', InputArgument::OPTIONAL, 'Parameters', '')
            ->addArgument('parametersPath', InputArgument::IS_ARRAY, 'Parameters', array('_format'=>'json'))
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $codeKey    = $input->getArgument('codeKey');
        $secretKey  = $input->getArgument('secretKey');
        $pathName   = $input->getArgument('path_name');
        $method     = $input->getArgument('method');
        $parametersString = $input->getArgument('parametersString');
        $parametersPath = $input->getArgument('parametersPath');

        $result = $this->apiRequestClient->makeRequestFinal($codeKey, $secretKey, $pathName, $parametersString, $method);

        $output->writeln("\n\n $result");
    }

} 