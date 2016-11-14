<?php


namespace AppBundle\Controller\PaymentHosted;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractPaymentHosted extends Controller
{
    protected function addSpecialLogByPayMethod($idServicePaymentMethod, $action='in', $extraPath = '')
    {
        $logger = $this->get('logger');
        $logDir = $this->container->getParameter('kernel.logs_dir');
        $logDir.= '/pay_method_hosted'.$extraPath;

        if (!file_exists($logDir))
            mkdir($logDir, 0777, true);

        $file = $logDir.'/'.$idServicePaymentMethod.'_'.$action.'.log';

        $logger->pushHandler(new StreamHandler($file, Logger::INFO));
    }
} 