<?php

namespace AppBundle\Command;

use GuzzleHttp\Exception\RequestException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Service("command.http_request.send")
 * @Tag("console.command")
 */
class HttpRequestCommand extends Command
{
    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @Inject("service_container")
     * @var Container $container
     */
    public $container;

    /**
     * @var \GuzzleHttp\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    private $url;
    private $method;
    private $body;

    protected function configure()
    {
        $this
            ->setName('http_request:send')
            ->setDescription('send http request')
            ->addArgument('url', InputArgument::REQUIRED, 'base URL (if get, includes path and querystring)', null)
            ->addArgument('method', InputArgument::REQUIRED, 'http method', null)
            ->addArgument('body', InputArgument::OPTIONAL, 'post raw body', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $headers=[];
        $options=[];
        $this->body = "";
        $this->url = $input->getArgument('url');
        $this->method = $input->getArgument('method');
        $this->body = $input->getArgument('body');

        $arrMethods = array('GET', 'POST', 'HEAD', 'PUT', 'DELETE', 'OPTIONS', 'PATCH');
        if (!in_array($this->method, $arrMethods))
            throw new \Exception("Invalid Method ($this->method) in httpRequest command.");

        $options['verify'] = false;
        // Send an asynchronous request.
        $client = new \GuzzleHttp\Client($options);
        $request = new \GuzzleHttp\Psr7\Request($this->method, $this->url, $headers,$this->body);

        $promise = $client->sendAsync($request)->then(
            function (\Psr\Http\Message\ResponseInterface $response) {
                $this->logger->addInfo("Async " . $this->method . " request to " . $this->url . " finished with answer: " . $response->getBody());
            },
            function (RequestException $e) {
                $this->logger->addError("Async " . $e->getRequest()->getMethod() . " request to " . $this->url . " FAILED with answer: " . $e->getMessage());
            }
        );
        $promise->wait();
    }
}
