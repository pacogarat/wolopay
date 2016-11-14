<?php
/**
 * Created by MGDSoftware. 08/10/2015
 */

namespace AppBundle\Command;


use AppBundle\Entity\Gamer;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;


/**
 * @Service("command.IDCGames.import.gamerAffiliateIds")
 * @Tag("console.command")
 */
class IDCGamesGamerAffiliateImport extends Command {
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("guzzle.client")
     * @var Client $guzzle
     */
    public $guzzle;

    /**
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {
        $this
            ->setName('IDCGames:importGamerAffiliateIds')
            ->setDescription('Call IDCGames WebService for each existing user to get the affiliateId ')
            ->addArgument('app', InputArgument::OPTIONAL, 'App ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $i=0;
        $apps=[];
        $clients = array(10,31,33); /* IDCGames, Spritted, PortalIDC */

        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        set_time_limit (0);
        $em   = $this->em;
        $appId = $input->getArgument('app');

        if ($appId){
            $app = $em->getRepository("AppBundle:App")->find($appId);
            if (in_array($app->getClient()->getId(),$clients)){
                $apps=[$app];
                $clients = [$app->getClient()->getId()];
            }else{
                $output->writeln("Invalid AppId");
                return;
            }
        }

        foreach($clients as $clientId){
            if (!$apps){
                $apps = $em->getRepository("AppBundle:App")->findByAppAppClientId($clientId);
            }

            foreach($apps as $app){
                $this->em->getConnection()->close();
                $this->em->getConnection()->connect();

                $output->writeln("Processing App " . $app->getName());

                $gamers = $em->getRepository("AppBundle:Gamer")->findByAppIdAndNotDemo($app->getId());

                /** @var Gamer $gamer */
                foreach ($gamers as $gamer) {
                    if (UtilHelper::startsWith($gamer->getGamerExternalId(), "DEMO_")){
                        $output->writeln("Skipping demo user " . $gamer->getGamerExternalId());
                        continue;
                    }


                    if ($gamer->getExternalAffiliateId()){
                        $output->writeln("Skipping user " . $gamer->getGamerExternalId(). "as already has affiliateId " . $gamer->getExternalAffiliateId());
                        continue;
                    }
                    $i++;
                    $output->writeln("Processing User " . $gamer->getGamerExternalId());

                    try {
                        $url = $app->getUrlNotificationNewGamer();
                        if ($url) {
                            $output->writeln("trying:" . $url . "/" . $app->getId() . "/" . $gamer->getGamerExternalId());
                            $request = $this->guzzle->get(
                                $url . "/" . $app->getId() . "/" . $gamer->getGamerExternalId());
                            $response = $request->send();
                            $output->writeln("Answered " . $response->getBody(true));

                        }

                    }catch (ClientErrorResponseException $exception){
                        $r = json_decode($exception->getResponse()->getBody(true));
                        $output->writeln($r);
                    } catch (\Exception $exception) {
                        $r = json_decode($exception->getResponse()->getBody(true));
                        $output->writeln($r);
                    }
                }
            }
        }
        $output->writeln("Processed users:" . $i);
    }
}