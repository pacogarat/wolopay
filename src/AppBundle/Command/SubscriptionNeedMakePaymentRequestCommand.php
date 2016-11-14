<?php

namespace AppBundle\Command;


use AppBundle\Entity\Subscription;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use AppBundle\Payment\Actions\PaymentCompleted;
use AppBundle\Payment\PayMethod\Interfaces\SubscriptionNeedMakePaymentRequestExecutionInterface;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Service("command.need_make_payment_request")
 * @Tag("console.command")
 */
class SubscriptionNeedMakePaymentRequestCommand extends Command
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
     * @Inject("service_container")
     * @var Container
     */
    public $container;

    /**
     * @Inject("shop.payment.completed")
     * @var PaymentCompleted
     */
    public $paymentCompleted;

    /**
     * @var StreamHandlerDynamicFileHelper
     * @Inject("shop.logger.transaction_helper")
     */
    public $streamHelper;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    /**
     * @var StreamHandler
     */
    private $currentPayMethodLogger= null;


    protected function configure()
    {
        $this
            ->setName('shop:subscriptions:auto-renewing')
            ->setDescription('Search subscription that need make payment request to auto pay')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $subscriptions = $this->em->getRepository("AppBundle:Subscription")->findSubscriptionToRenewAndNeedMakePaymentRequest();

        $OK = $KO = [];
        foreach ($subscriptions as $subscription)
        {
            try{
                $this->streamHelper->changeLogFileByTransaction($subscription->getPaymentDetail()->getTransaction());
                $this->renewSubscription($subscription);
                $OK[] = $subscription;

            }catch (\Exception $e){
                $this->logger->addCritical("Invalid renew in subscriptionId: '".$subscription->getId(). "', msg:".$e->getMessage());
                $KO[] = $subscription;
            }

        }

        $output->writeln("\n---------------\n--- SUMMARY ---\n---------------");
        $output->writeln("Petitions OK : ".count($OK));
        $output->writeln("Petitions KO : ". count($KO));

        if (count($OK))
        {
            $output->writeln("\n---------------\nPetitions OK: \n---------------");

            foreach ($OK as $OKK)
                $output->writeln(" [-] ".$OKK->getId());
        }

        if (count($KO))
        {
            $output->writeln("\n---------------\nPetitions KO:\n---------------");

            foreach ($KO as $KOO)
                $output->writeln(" [-] ".$KOO->getId());
        }
    }

    public function renewSubscription(Subscription $subscription)
    {
        $paymentDetail = $subscription->getPaymentDetail();

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")
            ->findOneByPayMethodIdAndProviderIdAndCountryId(
                $paymentDetail->getPayMethod()->getId(),
                $paymentDetail->getProvider()->getId(),
                $paymentDetail->getCountry()->getId()
            )
        ;

        if (!$pmpc)
        {
            throw new \Exception("Subscription ".$subscription->getId()." trying to renew PMPC doesn't found ".
                "pm=".$paymentDetail->getPayMethod()->getId().", providerId".$paymentDetail->getProvider()->getId().
                ", country=".$paymentDetail->getCountry()->getId()
            );
        }

        $serviceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();
        $this->addSpecialLogByPayMethod($serviceId);
        $this->logger->addInfo("Trying to auto-renewing for the subscription: ".$subscription->getId()." n_payment: ".($subscription->getNCompletedPayments()+1). ", externalId: ".$subscription->getTransactionExternalId());

        $payMethodService = $this->container->get($serviceId);

        if (!$payMethodService instanceof SubscriptionNeedMakePaymentRequestExecutionInterface)
            throw new \Exception("Invalid pay method service '$payMethodService' need SubscriptionNeedMakePaymentRequestExecutionInterface ");

        $payMethodService->subscriptionNeedMakePaymentRequest($subscription);

        $this->logger->addInfo("COMPLETED auto-renewing for the subscription: ".$subscription->getId()." n_payment: ".($subscription->getNCompletedPayments()));
    }

    private function addSpecialLogByPayMethod($idServicePaymentMethod, $action='in')
    {
        $logDir = $this->container->getParameter('kernel.logs_dir');
        $logDir.= '/pay_methods';

        if (!file_exists($logDir))
            mkdir($logDir, 0777, true);

        $idServicePaymentMethod = str_replace('shop.payment.', '', $idServicePaymentMethod);
        $file = $logDir.'/'.$idServicePaymentMethod.'_'.$action.'.log';

        if ($this->currentPayMethodLogger)
            $this->currentPayMethodLogger->close();

        $this->currentPayMethodLogger = new StreamHandler($file, Logger::INFO);
        $this->logger->pushHandler($this->currentPayMethodLogger);

    }
} 