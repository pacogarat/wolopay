<?php


namespace AppBundle\Entity\Listener;

use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Process\Process;

class GamerListener
{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function postPersist(Gamer $gamer, LifecycleEventArgs $event) {
        $event->getEntityManager()->flush();
        $this->notifyNewGamer($gamer->getApp(), $gamer);
    }

    public function notifyNewGamer(App $app, Gamer $gamer){

        $appId = $app->getId();
        $gamerExternalId = $gamer->getGamerExternalId();
        $baseUrl = $app->getUrlNotificationNewGamer();

        if ($baseUrl){
            /**newGamerNotification/{app}/{gamer} **/
            $baseUrl .= "/$appId/$gamerExternalId";
            $phpExePath=$this->container->getParameter('php_exe_path');
            $rootDir=$this->container->getParameter('kernel.root_dir');
            $env=$this->container->getParameter('kernel.environment');

            $exec = $phpExePath.' '.$rootDir.'/../bin/console http_request:send '.  $baseUrl .' GET --env='.$env;
            $this->container->get('logger')->addInfo("exec: $exec");
            $process = new Process($exec);
            $process->start();
        }
        else
        {
            $this->container->get('logger')->addWarning(" NO BASE URL to update gamer");
        }
    }
} 