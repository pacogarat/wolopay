<?php

namespace AppBundle\Command;


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
 * @Service("shop.command.transaction_temp.expire")
 * @Tag("console.command")
 */
class TransactionTempExpiredCommand extends Command
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
            ->setName('shop:transaction_temp:expire')
            ->setDescription('Expire temporal transactions used in widget')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $results = $this->searchAndExpire();

        $output->writeln("Transaction Temp deleted: $results");
    }

    /**
     * @return Transaction[]
     */
    public function searchAndExpire()
    {
        $day = new \DateTime();
        $day->add(\DateInterval::createFromDateString('-20 days'));

        $qb = $this->em
            ->createQuery('delete from AppBundle:TransactionTemp t where t.createdAt < :createdAt')
            ->setParameters(['createdAt'=>$day])
        ;
        return $qb->execute();
    }
} 