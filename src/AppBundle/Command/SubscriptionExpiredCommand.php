<?php

namespace AppBundle\Command;


use AppBundle\Entity\Subscription;
use AppBundle\Payment\Actions\SubscriptionFinished;
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
 * @Service("shop.command.subscription.expire")
 * @Tag("console.command")
 */
class SubscriptionExpiredCommand extends Command
{
    private $em;
    private $logger;
    private $subscriptionFinished;

    /**
     * @InjectParams({
     *      "em" = @Inject("doctrine.orm.default_entity_manager"),
     *      "logger" = @Inject("logger"),
     *      "subscriptionFinished" = @Inject("shop.subscription.finished"),
     * })
     */
    public function __construct(EntityManager $em, Logger $logger, SubscriptionFinished $subscriptionFinished)
    {
        $this->em                  = $em;
        $this->logger              = $logger;
        $this->subscriptionFinished = $subscriptionFinished;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('shop:subscription:expire')
            ->setDescription('Expire Subscription')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $results = $this->searchAndExpire();

        $output->writeln("Nº Subscription expired: ".count($results));

        foreach ($results as $result)
        {
            $output->writeln(" - Subscription ".$result->getId()." Provider: ".$result->getPaymentDetail()->getProvider()->getName().
                ", NPayments: ".$result->getNCompletedPayments()
            );
        }
    }

    /**
     * @return Subscription[]
     */
    public function searchAndExpire()
    {
        $subscriptions = $this->em->getRepository("AppBundle:Subscription")->findSubscriptionToExpire();

        foreach ($subscriptions as $subscription)
            $this->subscriptionFinished->execute($subscription);

        $this->em->flush();

        return $subscriptions;
    }
} 