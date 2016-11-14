<?php

namespace AppBundle\Command;


use AppBundle\DataFixtures\ORM\LoadVoice;
use Doctrine\ORM\EntityManager;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("command.shop.simulate_send_ipn_voice")
 * @Tag("console.command")
 */
class SimulateSendIpnVoiceProcessCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Inject("router")
     * @var Router
     */
    public $router;

    /**
     * @Inject("%domain_main%")
     * @var string
     */
    public $domainMain;


    protected function configure()
    {
        $this
            ->setName('shop:simulate:voice_ipn')
            ->setDescription('Receive sms for tests')
            ->addArgument('number',InputArgument::OPTIONAL, 'Phone number', LoadVoice::NUMBER_1)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument('number');

        $voice = $this->executeProcess($number);
        $output->writeln("Code generated ".$voice->getCode()." for amount ".$voice->getAmount());
    }

    public function executeProcess($number=LoadVoice::NUMBER_1)
    {
        $params = [
            'action'  => 'start',
            'llamado' => $number,
        ];

        $request   = $this->guzzle->get($this->domainMain . $this->router->generate('voice_ipn', $params));
        $response  = $request->send();

        $code = $response->getBody(true);
        if (!is_numeric($code))
            throw new \Exception("Unexpected result '$code'");

        $params = [
            'action'  => 'end',
            'llamado' => $number,
//            'numero'  => $code
        ];

        $request   = $this->guzzle->get($this->domainMain . $this->router->generate('voice_ipn', $params));
        $response  = $request->send();

        return $this->em->getRepository("AppBundle:VoiceCode")->findBy([], ['createdAt'=> 'desc'], 1)[0];
    }

} 