<?php

namespace AppBundle\Command;


use AppBundle\Entity\Purchase;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use AppBundle\Payment\Other\InternalPaymentNotificationService;
use AppBundle\Traits\ConsoleLog;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Service("command.internal_payment_notification")
 * @Tag("console.command")
 */
class InternalPaymentNotificationCommand extends Command
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
     * @var InternalPaymentNotificationService
     * @Inject("app.internal_payment_notification")
     */
    public $internalPaymentNotification;

    use ConsoleLog;

    protected function configure()
    {
        $this
            ->setName('shop:internal_payment_notification:send')
            ->setDescription('send payment notification to app')
            ->addArgument('appId', InputArgument::REQUIRED, 'appId')
            ->addArgument('purchases', InputArgument::IS_ARRAY, 'Purchases:id', [])
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $appId = $input->getArgument('appId');

        if (!$app = $this->em->getRepository("AppBundle:App")->find($appId))
            throw new \Exception("Invalid app");

        $purchasesIds = $input->getArgument('purchases');

        foreach ($purchasesIds as $purchaseId)
        {
            $purchase = $this->em->getRepository("AppBundle:Purchase")->find($purchaseId);

            if (!$purchase)
            {
                $this->addError("Purchase id '$purchaseId' not found' ");
                continue;
            }

            if ($purchase->getApp()->getId() !== $app->getId())
            {
                $this->addError("Purchase ".$purchase->getApp()->getId().", is not related with app");
                continue;
            }

            $result = $this->internalPaymentNotification->onShopPaymentCompleted(
                new PaymentCompletedEvent(null, null, $purchase->getPayment(), $purchase)
            );

            if ($result)
                $this->addInfo("Purchase $purchaseId - OK");
            else
                $this->addInfo("Purchase $purchaseId - EE - KO");
        }
    }

} 