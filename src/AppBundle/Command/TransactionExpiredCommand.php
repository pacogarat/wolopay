<?php

namespace AppBundle\Command;


use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Transaction;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("shop.command.transaction.expire")
 * @Tag("console.command")
 */
class TransactionExpiredCommand extends Command
{
    private $em;
    private $logger;
    private $transactionLifeTime;
    private $streamHelper;
    /** @var \AppBundle\Command\NodeJsCommand  */
    private $nodejs;

    /**
     * @InjectParams({
     *      "em" = @Inject("doctrine.orm.default_entity_manager"),
     *      "logger" = @Inject("logger"),
     *      "nodejs" = @Inject("command.common.node_emit"),
     *      "transactionLifeTime" = @Inject("%transaction.life_time%"),
     *      "streamHelper"= @Inject("shop.logger.transaction_helper")
     * })
     */
    public function __construct(EntityManager $em, Logger $logger, $transactionLifeTime, StreamHandlerDynamicFileHelper  $streamHelper, NodeJsCommand $nodejs)
    {
        $this->em                  = $em;
        $this->logger              = $logger;
        $this->transactionLifeTime = $transactionLifeTime;
        $this->streamHelper        = $streamHelper;
        $this->nodejs              = $nodejs;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('shop:transaction:expire')
            ->setDescription('Expire transactions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $results = $this->searchAndExpire();

        $output->writeln("Nº transactions expired: ".count($results));

        foreach ($results as $result)
            $output->writeln(" - Transaction ".$result->getId());
    }

    /**
     * @return Transaction[]
     */
    public function searchAndExpire()
    {
        $transactions = $this->em->getRepository("AppBundle:Transaction")->findExpired();
        $transactionExpired = $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
            TransactionStatusCategoryEnum::EXPIRED_ID
        );
        /** @var Transaction[] $transactionExpiredResult */
        $transactionExpiredResult = [];

        foreach ($transactions as $transaction)
        {
            $this->streamHelper->changeLogFileByTransaction($transaction);

            $transaction->setStatusCategory($transactionExpired);

            $transaction->setEndAtNow();
            $transaction->setExpiredAtNow();

            $this->logger->addInfo("Transaction was expired ");
            $transactionExpiredResult[] = $transaction;
        }

        $this->em->flush();

        foreach ($transactionExpiredResult as $trans)
        {
            try{
                $this->nodejs->notifyStatusUpdated($trans->getId());

            }catch (\Exception $e){
                $this->logger->addError('Error: '.$e->getMessage());
            }

        }

        return $transactionExpiredResult;
    }
} 