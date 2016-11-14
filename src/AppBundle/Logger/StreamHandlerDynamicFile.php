<?php

namespace AppBundle\Logger;

use AppBundle\Entity\Transaction;
use Monolog\Handler\StreamHandler;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class StreamHandlerDynamicFile extends StreamHandler
{
    private $kernelLogsDir;
    private $active;

    public function __construct($kernelLogsDir, $level = Logger::DEBUG, $bubble = true, $filePermission = null)
    {
        $streamDefault = 'undefined';
        $this->kernelLogsDir=$kernelLogsDir;
        parent::__construct($streamDefault, $level , $bubble , $filePermission );
    }

    public function write(array $record)
    {
        if ($this->active)
            parent::write($record);
    }

    public function close()
    {
        if ($this->active)
            parent::close();
    }

    public function changeByPath($subFolder, $fileName)
    {
        $stream = $this->kernelLogsDir . '/' . $subFolder;

        if (!file_exists($stream))
            mkdir($stream, 0777, true);

        $stream .= '/' . $fileName;

        $this->close();
        $this->stream = fopen($stream, 'a');
        $this->active = true;
    }

    /**
     * @param Transaction $transaction
     */
    public function changeLogByTransaction(Transaction $transaction)
    {
        $this->changeByPath($transaction->getLogsFolder(), $transaction->getId() . '.log');
    }

    public function writeHeader(Request $request)
    {
        $this->write(
            [
                'formatted' => '--------------------- app.HEADER: ' . "New Request " . $request->getUri(
                    ) . ", GET: " . urldecode(http_build_query($request->query->all())) . ', POST: ' . urldecode(
                        http_build_query($request->request->all())
                    ) . "\n"
            ]
        );
    }
} 