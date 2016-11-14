<?php


namespace AppBundle\Command;

use AppBundle\Entity\Purchase;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Entity\Transaction;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Service("app.business_intelligent_sync")
 * @Tag("console.command")
 */
class BusinessIntelligentSyncCommand extends BusinessIntelligentCommand
{
    /**
     * @Inject("shop_app.business_intelligent")
     * @var BusinessIntelligentCommand
     */
    public $businessIntelligentCommand;

    protected function configure()
    {
        $this
            ->setName('shop:business_intelligent:sync')
            ->setDescription('Update business intelligent')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        die("NOT AVAILABLE");

        $dateFrom = new \DateTime('2015-10-01 00:00:00');
        $dateTo = new \DateTime('2015-10-26 16:00:00');

        $apps = ['DEMO5464b32e3b8c8', 'BERSER546a24f03e5ae', 'TEST5527fbc60f802', 'TESTD556ed99524fdd'];

        $result = $this->em->createQuery("

            SELECT t
            FROM AppBundle:Transaction t
            JOIN t.gamer g
            WHERE
                t.test <> :test
                AND t.app NOT IN (:apps)
                AND t.id like '".Transaction::PREFIX."%'
                AND t.beginAt BETWEEN :dateFrom AND :dateTo
                AND g.gamerExternalId NOT LIKE 'DEMO_%'

          ")
            ->setParameters(['test'=> true, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo, 'apps' => $apps])
            ->iterate()
        ;
        $i=0;
        $nTransactionsSent = $nPurchaseSent = 0;

        foreach ($result as $row)
        {
            $i++;
            $transaction=$row[0];
            $output->writeln($transaction->getId());

            if ($i % 100 === 0)
                $this->em->clear();

            $msg = $this->businessIntelligentCommand->createMessageToTransactionStarted($transaction, new Request());
            $nTransactionsSent++;
            $output->writeln($msg);
            $this->businessIntelligentCommand->sendBusinessIntelligence($msg);
        }

        $this->em->clear();

        $result = $this->em->createQuery("

            SELECT p
            FROM AppBundle:Purchase p
            JOIN p.gamer g
            WHERE
                p.test <> :test
                AND p.app NOT IN (:apps)
                AND p.id like '".Purchase::PREFIX."%'
                AND p.createdAt BETWEEN :dateFrom AND :dateTo
                AND g.gamerExternalId NOT LIKE 'DEMO_%'

          ")
            ->setParameters(['test'=> true, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo, 'apps' => $apps])
            ->iterate()
        ;

        foreach ($result as $row)
        {
            $i++;
            /** @var Purchase $purchase */
            $purchase=$row[0];
            $output->writeln($purchase->getId());

            $transaction = $purchase->getTransaction();
            $payment = $purchase->getPayment();

            if (!$payment)
                continue;

            $paymentProcess = $payment;
            $paymentDetail = $payment->getPaymentDetail();

            if ($payment instanceof SubscriptionEventualityPayment)
                $paymentProcess = $payment->getSubscriptionEventuality()->getSubscription();

            $msg = $this->businessIntelligentCommand->createMessageOnPurchase($payment, $paymentProcess, $paymentDetail, $transaction);
            $output->writeln($msg);
            $this->businessIntelligentCommand->sendBusinessIntelligence($msg);
            $nPurchaseSent++;

            if ($i % 100 === 0)
                $this->em->clear();
        }

        $output->writeln("TRANSACTIONS SENT: $nTransactionsSent, PURCHASES SENT: $nPurchaseSent");
    }
} 