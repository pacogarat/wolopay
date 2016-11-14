<?php


namespace AppBundle\Command;

use AppBundle\Entity\Transaction;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Payment\Event\PaymentFailedEvent;
use AppBundle\Payment\Event\PaymentPendingEvent;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\Serializer\Serializer;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @Service("command.common.node_emit")
 * @Tag("console.command")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed", "priority"=-10})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.pending", "priority"=-10})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.failed", "priority"=-10})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.cancelled", "priority"=-10})
 */
class NodeJsCommand extends Command
{
    /** @var string */
    private $nodePort;

    /** @var string */
    private  $domainMain;

    /** @var Serializer */
    private  $serializer;

    /** @var Logger */
    private  $logger;

    /**
     * @InjectParams({
     *    "domainMain" = @Inject("%domain_main%"),
     *    "nodePort" = @Inject("%node_port%"),
     *    "serializer" = @Inject("serializer"),
     *    "logger" = @Inject("logger")
     * })
     */
    function __construct($domainMain, $nodePort, Serializer $serializer, Logger $logger)
    {
        $this->nodePort = $nodePort;
        $this->domainMain = UtilHelper::removePortFromUrlIfExist($domainMain);
        $this->serializer = $serializer;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('common:node:send')
            ->setDescription('Communicate with node')
            ->addArgument('event', InputArgument::REQUIRED, 'eventId')
            ->addArgument('data', InputArgument::IS_ARRAY, 'data')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $event = $input->getArgument('event');
        $data = $input->getArgument('data');
        $result=[];

        foreach ($data as $key=>$dat)
        {
            $tmp = explode('=>', $dat);
            $result[$tmp[0]]=$tmp[1];
        }

        $this->sendNotification($event, $result);
    }

    public function sendNotification($eventId, array $data)
    {
        $this->logger->addInfo("send node event, event: '$eventId', data: '".print_r($data, true));
        $client = new Client(new Version1X(UtilHelper::removePortFromUrlIfExist($this->domainMain).':'.$this->nodePort), $this->logger);

        $client->initialize();
        $client->emit($eventId, $data);
        $client->close();
    }

    public function notifyStatusUpdated($transactionId)
    {
        $this->sendNotification('response_transaction_status_updated_secure',[
                'transactionId' => $transactionId,
            ]);
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $this->sendEvent($paymentCompletedEvent->getPaymentProcess()->getPaymentDetail()->getTransaction());
    }

    public function onShopPaymentPending(PaymentPendingEvent $paymentPendingEvent)
    {
        $this->sendEvent($paymentPendingEvent->getPaymentProcess()->getPaymentDetail()->getTransaction());
    }

    public function onShopPaymentFailed(PaymentFailedEvent $paymentFailedEvent)
    {
        $this->sendEvent($paymentFailedEvent->getPaymentProcess()->getPaymentDetail()->getTransaction());
    }

    public function onShopPaymentCancelled(PaymentCancelledEvent $paymentCancelledEvent)
    {
        $this->sendEvent($paymentCancelledEvent->getPayment()->getPaymentDetail()->getTransaction());
    }

    private function sendEvent(Transaction $transaction)
    {
        try{
            $this->notifyStatusUpdated($transaction->getId());
        }catch (\Exception $e){
            $this->logger->addError("NodeJSCommand error:".$e->getMessage());
        }

    }

}
