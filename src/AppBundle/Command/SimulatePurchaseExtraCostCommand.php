<?php

namespace AppBundle\Command;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Payment\Actions\PurchaseExtraCost;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("command.shop.simulate_extra_cost")
 * @Tag("console.command")
 */
class SimulatePurchaseExtraCostCommand extends Command
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
     * @Inject("shop.payment.purchase_extra_cost")
     * @var PurchaseExtraCost
     */
    public $purchaseExtraCost;

    protected function configure()
    {
        $this
            ->setName('shop:simulate:extra_cost')
            ->setDescription('Create extra cost from a purchase')
            ->addArgument('purchaseId', InputArgument::REQUIRED, 'purchase Id')
            ->addArgument('currency', InputArgument::OPTIONAL, 'Currency', CurrencyEnum::EURO)
            ->addArgument('amountTotal', InputArgument::OPTIONAL, 'value', -5)
            ->addArgument('amountGame', InputArgument::OPTIONAL, 'value', -5)
            ->addArgument('amountProvider', InputArgument::OPTIONAL, 'value', -5)
            ->addArgument('amountWolo', InputArgument::OPTIONAL, 'value', 0)
            ->addArgument('reason', InputArgument::OPTIONAL, 'reason', 'WoloTax')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $purchase = $this->em->getRepository("AppBundle:Purchase")->find($input->getArgument('purchaseId'));
        $currency = $this->em->getRepository("AppBundle:Currency")->find($input->getArgument('currency'));

        if (!$purchase || !$currency)
            throw new \Exception("Invalid request");

        $newPurchase = $this->purchaseExtraCost->purchaseExtraCost(
            new PurchaseExtraCostBean($currency, $input->getArgument('amountTotal'), $input->getArgument('amountGame'), $input->getArgument('amountProvider'), 0, $input->getArgument('amountWolo')),
            $purchase,
            $input->getArgument('reason')
        );

        $output->writeln("Extra cost Purchase created '".$newPurchase->getId()."' ");
    }

}