<?php


namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @Service("command.date_to_utc")
 * @Tag("console.command")
 */
class DatesChangeToUTCCommand extends Command
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
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {
        $this
            ->setName('app:utc_change')
            ->setDescription('Change dates to utc')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        die("THIS COMMAND IS INACTIVE");

        $this->output = $output;
        date_default_timezone_set('Europe/Madrid');
        set_time_limit(0);
        $transactions = $this->em->createQuery('select t from AppBundle\Entity\Transaction t')->iterate();
        ini_set('memory_limit', '512M');
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

        $dateWhere = new \DateTime('2015-07-01 12:00:00');

//        foreach ($transactions as $iterate)
//        {
//            $transaction = $iterate[0];
//            $transaction
//                ->setBeginAt($this->changeToUTC($transaction->getBeginAt()))
//                ->setEndAt($this->changeToUTC($transaction->getEndAt()))
//                ->setExpireAt($this->changeToUTC($transaction->getExpireAt()))
//                ->setExpiredAt($this->changeToUTC($transaction->getExpiredAt()))
//            ;
//
//            $this->save();
//        }
//        die;
        $this->output->writeln("<info>Purchases</info>");
        $purchases = $this->em->createQuery('select t from AppBundle\Entity\Purchase t WHERE t.createdAt < :date')->setParameter('date', $dateWhere)->iterate();

        foreach ($purchases as $iterate)
        {
            $purchase = $iterate[0];
            $purchase
                ->setCreatedAt($this->changeToUTC($purchase->getCreatedAt()))
            ;

            $this->save();
        }
        $this->output->writeln("<info>Payments</info>");
        $payments = $this->em->createQuery('select t from AppBundle\Entity\Payment t WHERE t.createdAt < :date')->setParameter('date', $dateWhere)->iterate();

        foreach ($payments as $iterate)
        {
            $payment = $iterate[0];

            $payment
                ->setCreatedAt($this->changeToUTC($payment->getCreatedAt()))
                ->setUpdatedAt($this->changeToUTC($payment->getUpdatedAt()))
            ;

            $this->save();
        }
        $this->output->writeln("<info>OfferProgrammers</info>");
        $offerProgrammers = $this->em->createQuery('select t from AppBundle\Entity\OfferProgrammer t')->iterate();

        foreach ($offerProgrammers as $iterate)
        {
            $oP = $iterate[0];

            $oP
                ->setOfferFrom($this->changeToUTC($oP->getOfferFrom()))
                ->setOfferTo($this->changeToUTC($oP->getOfferTo()))
            ;

            $this->save();
        }

        $this->save(true);
    }

    private function changeToUTC(\DateTime $date = null)
    {
        if (!$date)
            return $date;

        $date->setTimezone(new \DateTimeZone('UTC'));

        return clone($date);
    }

    private $n=0;

    private function save($force = false)
    {
        if ($this->n==30 || $force)
        {
            date_default_timezone_set('UTC');
            $this->em->flush();
            date_default_timezone_set('Europe/Madrid');
            $this->n = 0;
            $this->em->clear();
            gc_collect_cycles();
            $this->output->writeln("Saved");
        }
        $this->n++;
    }

}
