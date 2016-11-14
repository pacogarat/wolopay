<?php


namespace AppBundle\Logger\Util;


use AppBundle\Entity\Transaction;
use AppBundle\Logger\StreamHandlerDynamicFile;
use AppBundle\Logger\StreamHandlerDynamicFileTransaction;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Service("shop.logger.transaction_helper")
 */
class StreamHandlerDynamicFileHelper
{
    private $logger;

    /**
     * @InjectParams()
     */
    public function __construct(Logger $logger)
    {
        $this->logger  = $logger;
    }

    public function changeLogFileByTransaction(Transaction $transaction, $showTitle=true)
    {
        $handlers = $this->logger->getHandlers();

        foreach ($handlers as $handler)
        {
            if ($handler instanceof StreamHandlerDynamicFile)
            {
                $handler->changeLogByTransaction($transaction);

                if ($showTitle)
                    $this->writeInitMessage();
            }
        }

    }

    private function writeInitMessage()
    {
        $url  = 'CLI Execution';
        $post = '';
        $get  = '';

        if (isset($_SERVER['HTTP_HOST']))
        {
            $url  = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $post = urldecode(http_build_query($_POST));
            $get  = urldecode(http_build_query($_GET));
        }

        foreach ($this->logger->getHandlers() as $handlers)
        {
            if ($handlers instanceof StreamHandlerDynamicFileTransaction)
            {
                $handlers->write(['formatted' => "--------------------- app.HEADER: new page $url\n"]);
                $handlers->write(['formatted' => "--------------------- app.HEADER: GET: $get, Post: $post\n"]);
            }
        }


    }
} 