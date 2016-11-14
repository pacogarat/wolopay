<?php

namespace AppBundle\Command;


use AppBundle\Entity\Enum\CountryEnum;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("command.shop.simulate_send_ipn_sms")
 * @Tag("console.command")
 */
class SimulateSendIpnSMSProcessCommand extends Command
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
     * @Inject("logger")
     * @var Logger
     */
    public $log;

    /**
     * @Inject("%domain_main%")
     * @var string
     */
    public $domainMain;


    protected function configure()
    {
        $this
            ->setName('shop:simulate:sms_ipn')
            ->setDescription('Receive sms for tests')
            ->addArgument('mobile_text', InputArgument::OPTIONAL, 'Mobile text', 'WOLOPAY')
            ->addArgument('country', InputArgument::OPTIONAL, 'Country', CountryEnum::SPAIN)
            ->addArgument('operator', InputArgument::OPTIONAL, 'Operator', 'YO')
            ->addArgument('mobile',InputArgument::OPTIONAL, 'Mobile', '66666666')
            ->addArgument('host',InputArgument::OPTIONAL, 'SMS Short number', '7755')
            ->addArgument('transaction_id',InputArgument::OPTIONAL, 'Id Transaction', rand(8888,999999))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $country       = $input->getArgument('country');
        $mobileText    = $input->getArgument('mobile_text');
        $mobile        = $input->getArgument('mobile');
        $operator      = $input->getArgument('operator');
        $host          = $input->getArgument('host');
        $transactionId = $input->getArgument('transaction_id');

        $smsCode = $this->executeProcess($operator, $mobile, $host, $country, $mobileText, $transactionId);
        $output->writeln("Code generated ".$smsCode->getCode()." for amount ".$smsCode->getAmount());
    }

    public function executeProcess($operator='YO', $mobile='66666666', $host='7755', $country=CountryEnum::SPAIN, $mobileText='WOLOPAY', $transactionId='ExternaltransactionId')
    {
        $params = [
            'operadora' => $operator,
            'movil'     => $mobile,
            'host'      => $host,
            'country'   => $country,
            'texto'     => $mobileText,
            'id_mensaje' => $transactionId,
        ];
        try{
            $request   = $this->guzzle->get($this->domainMain . $this->router->generate('sms_ipn', $params));
            $response  = $request->send();
        } catch (ClientErrorResponseException $exception) {
            $this->log->addError("Error ".$exception->getResponse()->getBody(true));
            throw $exception;
        }

        return $this->em->getRepository("AppBundle:SMSCode")->findBy([], ['createdAt'=> 'desc'], 1)[0];
    }

} 