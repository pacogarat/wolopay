<?php

namespace AppBundle\Command;

use AppBundle\Entity\Transaction;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use AppBundle\Payment\Actions\PaymentCompleted;
use AppBundle\Payment\Actions\SubscriptionStarted;
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
 * @Service("command.shop.simulate_payment_complete")
 * @Tag("console.command")
 */
class SimulatePaymentCompleteProcessCommand extends Command
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
     * @Inject("shop.payment.completed")
     * @var PaymentCompleted
     */
    public $paymentCompleted;

    /**
     * @Inject("shop.subscription.started")
     * @var SubscriptionStarted
     */
    public $subscriptionStarted;

    /**
     * @var StreamHandlerDynamicFileHelper
     * @Inject("shop.logger.transaction_helper")
     */
    public $streamHelper;

    protected function configure()
    {
        $this
            ->setName('shop:simulate:payment_complete')
            ->setDescription('Complete transaction for tests')
            ->addArgument('transactionId', InputArgument::REQUIRED, 'transaction Id')
            ->addArgument('paymentProcessType', InputArgument::OPTIONAL, '[subscription|single]', 'single')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $transactionId = $input->getArgument('transactionId');
        $paymentProcessType = $input->getArgument('paymentProcessType');
        $this->completePayment($transactionId, $paymentProcessType);
        $output->writeln("Transaction $transactionId ended");
    }

    /**
     * @param Transaction $transactionId
     * @param $paymentProcessType
     * @throws \Exception
     */
    public function completePayment($transactionId, $paymentProcessType)
    {
        if (!$transaction = $this->em->getRepository("AppBundle:Transaction")->find($transactionId))
            throw new \Exception("transaction doesn't exist");

        $this->streamHelper->changeLogFileByTransaction($transaction);

        $this->logger->addInfo("Simulate payment execution command");

        if ($paymentProcessType=='single')
            $repo = $this->em->getRepository("AppBundle:SinglePayment");
        else
            $repo = $this->em->getRepository("AppBundle:Subscription");

        $paymentProcess = $repo->findLast($transactionId);

        if (!$paymentProcess)
            throw new \Exception("Require a paymentProcess, $paymentProcessType");

        if ($paymentProcessType=='subscription')
            $this->subscriptionStarted->execute($paymentProcess, 'COMMAND_SUB_'.uniqid());

        $this->paymentCompleted->execute($paymentProcess, 'COMAND_'.uniqid(), null);
    }


} 