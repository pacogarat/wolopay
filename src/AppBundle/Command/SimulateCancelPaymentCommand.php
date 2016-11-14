<?php

namespace AppBundle\Command;

use AppBundle\Payment\Actions\PaymentCancelled;
use Doctrine\ORM\EntityManager;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("command.shop.simulate_payment_cancel")
 * @Tag("console.command")
 */
class SimulateCancelPaymentCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

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

    /**
     * @Inject("shop.payment.cancelled")
     * @var PaymentCancelled
     */
    public $paymentCancelled;


    protected function configure()
    {
        $this
            ->setName('shop:simulate:payment_cancel')
            ->setDescription('Cancel Payment')
            ->addArgument('paymentId', InputArgument::REQUIRED, 'payment Id')
            ->addArgument('reason', InputArgument::OPTIONAL, 'reason', 'test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $paymentId = $input->getArgument('paymentId');
        if (!$payment = $this->em->getRepository("AppBundle:Payment")->find($paymentId))
            throw new \Exception("Payment not exist $paymentId");

        $this->paymentCancelled->execute($payment, $input->getArgument('reason'));
        $output->writeln("Payment cancelled");
    }

} 