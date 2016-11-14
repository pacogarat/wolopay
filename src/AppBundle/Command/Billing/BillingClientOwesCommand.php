<?php


namespace AppBundle\Command\Billing;

use AppBundle\Controller\ClientAdmin\StatsController;
use AppBundle\Entity\App;
use AppBundle\Entity\Client;
use AppBundle\Entity\ClientDeposit;
use AppBundle\Entity\ClientDocument;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\FinInvoiceCategoryEnum;
use AppBundle\Entity\FinInvoice;
use AppBundle\Entity\FinMovement;
use AppBundle\Entity\MonthlyAppReport;
use AppBundle\Entity\NotPersisted\Money;
use AppBundle\Entity\NotPersisted\StorageCurrencyMoney;
use AppBundle\Entity\Purchase;
use AppBundle\Event\BillingInvoiceCreatedEvent;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\AppService;
use AppBundle\Service\CurrencyService;
use AppBundle\Tests\Functional\Controller\ClientAdmin\StatsControllerTest;
use AppBundle\Traits\ConsoleLog;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator;
use Monolog\Logger;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

/**
 * @Service("app.billing.client.owes_command")
 * @Tag("console.command")
 */
class BillingClientOwesCommand extends Command
{
    use ConsoleLog;
    use SonataMedia;

    const EXCHANGE_FEE_DEFAULT = 2.5;
    const FROM_CLIENT = 'Wolopay';

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
     * @Inject("common.currency")
     * @var CurrencyService
     */
    public $currencyService;

    /**
     * @Inject("knp_snappy.pdf")
     * @var LoggableGenerator
     */
    public $knpSnappyPdf;

    /**
     * @Inject("templating")
     * @var TimedTwigEngine
     */
    public $templating;

    /**
     * @Inject("event_dispatcher")
     * @var TraceableEventDispatcher
     */
    public $eventDispatcher;

    /**
     * @Inject("jms_serializer")
     * @var \JMS\Serializer\Serializer
     */
    public $serializer;

    /**
     * @Inject("%kernel.root_dir%")
     * @var TimedTwigEngine
     */
    public $rootDir;

    /**
     * @Inject("service_container")
     * @var ContainerInterface
     */
    public $container;


    private $tempFilesToClear = [];


    protected function configure()
    {
        $this
            ->setName('billing:client:owes')
            ->setDescription('Calculate billing from clients, BE CAREFUL WITH DEPOSIT STATES if you reload OLD INVOICE')
            ->addOption('attempt', null, InputOption::VALUE_OPTIONAL, 'Attempt', 1)
            ->addOption('dateUntil', null, InputOption::VALUE_OPTIONAL, 'Calculate date until')
            ->addOption('dateReference', null, InputOption::VALUE_OPTIONAL, 'Date', '-1 month')
            ->addOption('autoApprove', null, InputOption::VALUE_OPTIONAL, 'Auto approve', false)
            ->addOption('clients', null, InputOption::VALUE_OPTIONAL, 'ARRAY Clients')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outPut is declared in Trait
        $this->output = $output;

        $autoApprove = $input->getOption('autoApprove');
        $attempt = $input->getOption('attempt');
        $dateUntil = $input->getOption('dateUntil');

        $dateReference = new \DateTime($input->getOption('dateReference'));
        $dateReference->setDate((int) $dateReference->format('Y'), (int) $dateReference->format('m'), 1);
        $dateReference->setTime(0, 0, 0);

        if ($dateUntil)
        {
            $dateUntil = new \DateTime($dateUntil);
            $dateUntil->setDate((int) $dateUntil->format('Y'), (int) $dateUntil->format('m'), 1);
            $dateUntil->setTime(0, 0, 0);

            $this->addDebug('calculate Until detected: '.$dateUntil->format('Y m d, H:i:s'));
        }else{
            $dateUntil = clone $dateReference;
            $dateUntil->modify('+1 month');
        }




        if (!$clients = $input->getOption('clients'))
        {
            $query = $this->em->createQuery('SELECT i FROM AppBundle:Client i WHERE i.active = 1');
        }else{
            $query = $this->em->createQuery('SELECT i FROM AppBundle:Client i WHERE i.active=1 and i.id in (:ids) ')->setParameter('ids', $clients);
        }

        while ($dateReference < $dateUntil)
        {
            $this->addDebug('Date Reference: '.$dateReference->format('Y m d, H:i:s'));
            $iterator = $query->iterate();

            foreach ($iterator as $row)
            {
                $this->executeForClient($row[0], $dateReference, $attempt, $autoApprove);
                $this->em->clear();
            }

            $this->addCritical("Billing month ".$dateReference->format('m/Y')." was loaded");
            $dateReference->modify('+1 month');
        }

    }

    /**
     * @param Client $client
     * @param \DateTime $dateReference
     * @param int $attempt
     * @param bool $autoApprove
     * @param BillingClientOwesInjectConcept[] $clientOwesWolopayExtraConcepts
     * @param BillingClientOwesInjectConcept[] $wolopayOwesClientExtraConcepts
     * @return bool
     */
    public function executeForClient(
        Client $client,
        \DateTime $dateReference,
        $attempt = 1,
        $autoApprove = false,
        array $clientOwesWolopayExtraConcepts = [],
        array $wolopayOwesClientExtraConcepts = []
    )
    {
        $finInvoiceWoloToClient = $finInvoiceMerchantToWolo = null;

        try{
            $this->addDebug(' ------- [ '.$client->getNameCompany().' ] ------- ');

            if (count($this->em->getRepository("AppBundle:FinInvoice")->findWasExecutedAndSuccessFull($client->getId(), $dateReference)) > 0)
            {
                $this->addInfo("Was executed before, SKIPPED");
                return false;
            }

            $apps = $client->getActiveApps();
            $storageWoloOwesApp = new StorageCurrencyMoney();
            $storageWoloGatewayByProvider = new StorageCurrencyMoney();
            $storageWoloGatewayByCountry = [];

            // extraConcepts
            $wolopayOwesClientExtraConceptsMoney = $this->getMoneyFromExtraConcepts(
                $wolopayOwesClientExtraConcepts,
                $client->getCurrencyEarnings()
            );

            $clientOwesWolopayExtraConceptsMoney = $this->getMoneyFromExtraConcepts(
                $clientOwesWolopayExtraConcepts,
                $client->getCurrencyEarnings()
            );

            /** @var \DateTime $dateFrom **/
            /** @var \DateTime $dateTo **/
            list($dateFrom, $dateTo) = $this->calculateDateRange($client, $dateReference);

            // Delete old invoices is needed to restore state of deposit
            $deleted = $this->em->getRepository("AppBundle:FinInvoice")->removeUnApprovedInvoices($client, $dateFrom, $dateTo);
            $this->addInfo("Deleted old invoices $deleted");

            $interval = $dateFrom->diff($dateTo);
            $dateMonths = (int) $interval->format('%m');
            $this->addInfo("Date Range from: ".$dateFrom->format('Y/m/d H:i:s')." to ".$dateTo->format('Y/m/d H:i:s').", months: $dateMonths");

            foreach ($apps as $app)
            {
                $this->getHowManyWolopayOwesApp($app, $storageWoloOwesApp, $dateFrom, $dateTo, $storageWoloGatewayByCountry);
                $this->getHowManyAppOwesWolopay($app, $storageWoloGatewayByProvider, $storageWoloGatewayByCountry, $dateFrom, $dateTo);

                //For Monthly report
                /** @var AppService $appService */
                //$appService = $this->container->get('app.app');
                //$appService->getAppTransactionsPurchases($app, $dateFrom, $dateTo, $storageWoloOwesApp->getStorageAmounts()['currency'], 'days');
                //singleStatsAction($app, $dateFrom, $dateTo, $storageWoloOwesApp->getStorageAmounts()['currency']->getId(), 'days');
//
//                $arrayResult =
//                    $this->em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
//                        $app->getId(),
//                        $dateFrom,
//                        $dateTo,
//                        $storageWoloOwesApp->getStorageAmounts()['currency']->getId(),
//                        'days'
//                    );


                //$this->createPDFMonthlyAppReport($app,$storageWoloOwesApp, $dateFrom->format('Y'), $dateFrom->format('m'));
            }

            if($client->getPaysVAT()){
                $profit4App      = $this->getAllProfitFromStorageForAppWithTaxes($storageWoloOwesApp);
                $this->addDebug(" TOTAL PROFITS WITH TAXES for app $profit4App ".$client->getCurrencyEarnings()->getId());
            }else{
                $profit4App      = $this->getAllProfitFromStorageForApp($storageWoloOwesApp);
                $this->addDebug(" TOTAL PROFITS for app $profit4App ".$client->getCurrencyEarnings()->getId());
            }

            $gatewayTotalFee = $this->getAllProfitFromStorageForGateways($storageWoloGatewayByProvider);


            $this->addDebug(" TOTAL Gateway fee $gatewayTotalFee ".$client->getCurrencyEarnings()->getId());

            $profit4CalculateDeposit = ($profit4App - $gatewayTotalFee) / $dateMonths;

            /** @var ClientDeposit $deposit */
            // DepositExtraPay is in positive
            list($depositExtraPay, $deposit, $balanceRequirementAdded) = $this->calculateDeposit($client, $profit4CalculateDeposit);
            $depositCurrentDeposit = $deposit ?: $client->getDepositCurrent();

            $invoiceGeneratorId = $client->getSlug().$dateReference->format('mY').'_'.$attempt;

            // --- [ Wolopay to Client ] --- calculate data
            list($monthlyWoloFee, $wolopayExchangeSUMMonthly) = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $client->getWoloPack()->getAmountTotal(),
                $client->getWoloPack()->getCurrency(),
                $client->getCurrencyEarnings()->getId(),
                self::EXCHANGE_FEE_DEFAULT
            );

            $finInvoiceWoloToClientAmountNet = $monthlyWoloFee + $gatewayTotalFee + $clientOwesWolopayExtraConceptsMoney->getAmount();
            list($finInvoiceWoloToClientAmountTotal, $finInvoiceWoloToClientAmountIva) = $this->calculateTax($client->getCountry(), $finInvoiceWoloToClientAmountNet);

            // --- [ END Wolopay to Client ] ---
            // --- [   Client to wolopay   ] --- calculate data

            $finInvoiceClientToWoloAmountNet = $profit4App + $wolopayOwesClientExtraConceptsMoney->getAmount();

            if ($client->getCountry()->getId() === CountryEnum::SPAIN)
            {
                list($finInvoiceClientToWoloAmountTotal, $finInvoiceClientToWoloAmountIva) = $this->calculateTax($client->getCountry(), $finInvoiceClientToWoloAmountNet);

            }else{
                $finInvoiceClientToWoloAmountTotal = $finInvoiceClientToWoloAmountNet;
                $finInvoiceClientToWoloAmountIva = null;
            }

            // --- [ END Client to wolopay ] ---

            $finInvoiceWoloToClient = $this->createInvoiceWolopayToMerchantEntity(
                $invoiceGeneratorId,
                $client,
                $dateReference,
                $finInvoiceWoloToClientAmountTotal,
                $client->getCurrencyEarnings(),
                $attempt,
                $autoApprove,
                $clientOwesWolopayExtraConcepts
            );

            $finInvoiceMerchantToWolo = $this->createInvoiceMerchantToWolopayEntity(
                $invoiceGeneratorId,
                $client,
                $dateReference,
                $finInvoiceClientToWoloAmountTotal,
                $client->getCurrencyEarnings(),
                $attempt,
                $autoApprove,
                $wolopayOwesClientExtraConcepts
            );

            $realTotalForClient = $finInvoiceMerchantToWolo->getAmountTotal() - $finInvoiceWoloToClient->getAmountTotal() - $depositExtraPay;

            $this->createPDFClientToWolopay(
                $finInvoiceMerchantToWolo,
                $this->getInvoicesNotEqualToZero([$finInvoiceWoloToClient]),
                $storageWoloOwesApp,
                $profit4App,
                $finInvoiceClientToWoloAmountNet,
                $finInvoiceClientToWoloAmountIva,
                $depositCurrentDeposit,
                $depositExtraPay,
                $balanceRequirementAdded,
                $realTotalForClient,
                $dateFrom,
                $dateTo,
                $wolopayOwesClientExtraConcepts
            );
            $this->em->persist($finInvoiceMerchantToWolo);

            $invoicesRelated = $finInvoiceMerchantToWolo ? [$finInvoiceMerchantToWolo] : [];

            $this->createPDFWolopayToClient(
                $finInvoiceWoloToClient,
                $this->getInvoicesNotEqualToZero($invoicesRelated),
                $storageWoloGatewayByProvider,
                $monthlyWoloFee,
                $finInvoiceWoloToClientAmountTotal,
                $finInvoiceWoloToClientAmountIva,
                $depositCurrentDeposit,
                $depositExtraPay,
                $balanceRequirementAdded,
                $realTotalForClient,
                $gatewayTotalFee,
                $dateFrom,
                $dateTo,
                $clientOwesWolopayExtraConcepts
            );


            $clientDocument = $this->createPDFTaxesForDocument(
                $finInvoiceWoloToClient,
                $storageWoloGatewayByCountry,
                $client,
                $finInvoiceWoloToClient->getCompanyFrom(),
                $dateReference
            );


            $this->em->persist($finInvoiceWoloToClient);
            $this->em->flush();

            if ($deposit)
            {
                $deposit->setFinInvoice($finInvoiceWoloToClient);
                $this->em->persist($deposit);
            }

            $this->persistFinMovements($finInvoiceWoloToClient, $realTotalForClient);

            if ($clientDocument)
                $this->em->persist($clientDocument);

            $this->em->flush();

            $this->addDebug(' *** SUMMARY  ');
            $this->addDebug("Real amount: $realTotalForClient");

            $this->eventDispatcher->dispatch(BillingInvoiceCreatedEvent::EVENT, new BillingInvoiceCreatedEvent($finInvoiceWoloToClient, $finInvoiceMerchantToWolo));
            $this->clearTempFiles();

            return true;

        }catch (\Exception $e){

            $this->addError("CRASHED BY: ". $e->getMessage());
            $this->clearTempFiles();

            if (!$this->em->isOpen()) {
                $this->em = $this->em->create(
                    $this->em->getConnection(),
                    $this->em->getConfiguration()
                );
            }

            // restore old state

            if ($finInvoiceWoloToClient)
                $this->em->remove($finInvoiceWoloToClient);

            if ($finInvoiceMerchantToWolo)
                $this->em->remove($finInvoiceMerchantToWolo);

            $this->em->flush();

            $lastDeposit = $this->em->getRepository("AppBundle:ClientDeposit")->findLast($client->getId());
            $lastDeposit->setUsedUntilAt(null);

            $this->em->flush();
        }

        return false;
    }

    private function getAllProfitFromStorageForApp($storage)
    {
        $this->addDebug(' *** STORAGE Wolopay Owes -> App ');

        $profit = 0;

        /** @var Money $money */
        foreach ($storage as $money)
        {
            $money->extraData['exchange_ratio'] = $money->extraData['amount_total_in_client_currency'] / $money->extraData['amount_total'];

            $profit += $money->extraData['amount_game_in_client_currency'];

            $this->addDebug(' '.$money->getCurrency()->getId().': '.$money->getAmount().', '.$money->getCurrency()->getId());
        }

        $this->addDebug(' *** END STORAGE Wolopay Owes -> App');

        return $profit;
    }

    private function getAllProfitFromStorageForAppWithTaxes($storage)
    {
        $this->addDebug(' *** STORAGE Wolopay Owes -> App ');

        $profit = 0;

        /** @var Money $money */
        foreach ($storage as $money)
        {
            $money->extraData['exchange_ratio'] = $money->extraData['amount_total_in_client_currency'] / $money->extraData['amount_total'];

            $profit += $money->extraData['amount_game_with_taxes_in_client_currency'];

            $this->addDebug(' '.$money->getCurrency()->getId().': '.$money->getAmount().', '.$money->getCurrency()->getId());
        }

        $this->addDebug(' *** END STORAGE Wolopay Owes -> App');

        return $profit;
    }

    private function getAllProfitFromStorageForGateways(StorageCurrencyMoney $storage)
    {
        $gatewayFeeSum = 0;

        $this->addDebug(' *** GATEWAYS STORAGE App Owes -> Wolopay');

        foreach ($storage as $key => $money)
        {
            $gatewayFeeSum += $money->extraData['amount_wolo_in_client_currency'];

            $this->addDebug(' '.$key.': '.$money->extraData['amount_wolo_in_client_currency']);
        }

        $this->addDebug(' *** END');

        return $gatewayFeeSum;
    }

    private function calculateDateRange(Client $client, \DateTime $dateReference)
    {
        $dateFrom = clone $dateReference;

        $dateTo = clone $dateReference;
        $dateTo->modify('+1 month');

        return [$dateFrom, $dateTo];
    }

    /**
     * @param array $billingClientOwesInjectConcepts
     * @param Currency $currency
     * @return Money
     */
    private function getMoneyFromExtraConcepts(array $billingClientOwesInjectConcepts, Currency $currency)
    {
        $total = $this->getTotalFromExtraConcepts(
            $billingClientOwesInjectConcepts,
            $currency
        );

        return new Money($total, $currency);
    }

    private function getTotalFromExtraConcepts(array $billingClientOwesInjectConcepts, Currency $currency)
    {
        $tmp = 0;

        foreach ($billingClientOwesInjectConcepts as $billingClientOwesInjectConcept)
        {
            $tmp += $this->getTotalFromExtraConcept($billingClientOwesInjectConcept, $currency);
        }

        $tmp = round($tmp, 2);

        return $tmp;
    }

    private function getTotalFromExtraConcept(BillingClientOwesInjectConcept $billingsClientOweInjects, Currency $currency)
    {
        $money = $billingsClientOweInjects->getMoney();
        $val = $this->currencyService->getExchange($money->getAmount(), $money->getCurrency(), $currency->getId());
        $val = round($val, 2);
        $billingsClientOweInjects->setMoneyInClientCurrency(new Money($val, $currency));

        return $val;
    }

    protected function getHowManyWolopayOwesApp(App $app, StorageCurrencyMoney $storage, \DateTime $dateFrom, \DateTime $dateTo, &$storageWoloGatewayByCountry)
    {
        $this->addDebug(" - Searching Purchases for app ".$app->getName());
        if ($app->getClient()->getPaysVAT()){
            $iteratorPurchases = $this->em->getRepository("AppBundle:Purchase")->findAllValidPurchaseByClient($app->getId(), $dateFrom, $dateTo, false);

            foreach ($iteratorPurchases as $iteratorPurchaseRow)
            {
                /** @var Purchase $purchase */
                $purchase = $iteratorPurchaseRow[0];

                if ($purchase->getAmountTax() == 0 || in_array($purchase->getCountryGamer()->getId(), CountryEnum::$OTHERS_ALL))
                    continue;

                if (!isset($storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]))
                    $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()] = ['country' => $purchase->getCountry(), 'currencies' => []];

                if (!isset($storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()]))
                    $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()] = ['currency'=> $purchase->getCurrency(), 'value' => 0];

                $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()]['value'] += $purchase->getAmountTax();
            }
        }

        $array = $this->em->getRepository("AppBundle:Purchase")->arrayAllValidPurchaseByClientGroupByCurrency($app->getId(), $dateFrom, $dateTo, false);

        foreach ($array as $row)
        {
            $currency = $this->em->getRepository("AppBundle:Currency")->find($row['currency']);
            $appNetRevenue = $row['amountGame'];
            $amountTotal = $row['amountTotal'];
            $amountTax = $row['amountTax'];
            $amountProvider = $row['amountProvider'];
            $amountWolo = $row['amountWolo'];
            $transactions = $row['transactions'];

            $storage->sumMoney($appNetRevenue, $currency);
            $storage->sumExtraData($currency->getId(), 'amount_total', $amountTotal);
            $storage->sumExtraData($currency->getId(), 'amount_taxes', $amountTax);
            $storage->sumExtraData($currency->getId(), 'amount_game_with_taxes', $amountTax+$appNetRevenue);

            $clientCurrency = $app->getClient()->getCurrencyEarnings();

            list($appNetRevenueClientCurrency, $WoloExchangeFee) = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $appNetRevenue,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            );
            $total_client_currency = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $amountTotal,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            )[0];
            $tax_client_currency = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $amountTax,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            )[0];
            $amount_provider_client_currency = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $amountProvider,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            )[0];
            $amount_wolo_client_currency = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $amountWolo,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            )[0];
            $amount_app_with_taxes_client_currency = $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
                $amountTax+$appNetRevenue,
                $currency,
                $clientCurrency->getId(),
                self::EXCHANGE_FEE_DEFAULT
            )[0];

            if ($clientCurrency <> $currency){
                $storage->sumExtraData($clientCurrency->getId(), 'amount_total_in_client_currency',$total_client_currency);
                $storage->sumExtraData($clientCurrency->getId(), 'amount_tax_in_client_currency',$tax_client_currency);
                $storage->sumExtraData($clientCurrency->getId(), 'amount_provider_in_client_currency',$amount_provider_client_currency);
                $storage->sumExtraData($clientCurrency->getId(), 'amount_wolo_in_client_currency',$amount_wolo_client_currency );
                $storage->sumExtraData($clientCurrency->getId(), 'amount_game_in_client_currency', $appNetRevenueClientCurrency);
                $storage->sumExtraData($clientCurrency->getId(), 'wolo_exchange_fee', $WoloExchangeFee);
                $storage->sumExtraData($clientCurrency->getId(), 'amount_game_with_taxes_in_client_currency',$amount_app_with_taxes_client_currency);
                $storage->sumExtraData($clientCurrency->getId(), 'n_transactions', $transactions);
            }

            $amount_wolo_eur = $this->currencyService->getExchange(
                $amountWolo,
                $currency,
                CurrencyEnum::EURO
            );
            $storage->sumExtraData(CurrencyEnum::EURO, 'amount_wolo_eur',$amount_wolo_eur);



            //PER APP!!!!!!
            //USAR ESTO en lugar de "storage(abajo) per app

            /*
             *  return [
            'amounts_game[]'   ,
            'amounts_game_sum',
            'amounts_provider[]',
            'amounts_provider_sum' ,
            'amounts_total[]'        ,
            'amounts_total_sum'    ,
            'amounts_wolo[]'         ,
            'amounts_wolo_sum'     ,
        ];
            */


//            $storage->sumMoneyApp($appNetRevenueClientCurrency, $currency, $app);
//            $storage->sumExtraDataApp($app->getId(), 'amount_tax_in_client_currency',$tax_client_currency);
//            $storage->sumExtraDataApp($app->getId(), 'amount_provider_in_client_currency',$amount_provider_client_currency);
//            $storage->sumExtraDataApp($app->getId(), 'amount_wolo_in_client_currency',$amount_wolo_client_currency );
//            $storage->sumExtraDataApp($app->getId(), 'amount_game_in_client_currency', $appNetRevenueClientCurrency);
//            $storage->sumExtraDataApp($app->getId(), 'wolo_exchange_fee', $WoloExchangeFee);
//            $storage->sumExtraDataApp($app->getId(), 'amount_game_with_taxes_in_client_currency',$amount_app_with_taxes_client_currency);
//
//            $storage->sumExtraDataApp($app->getId(), 'n_transactions', $transactions);

        }

//        $this->addDebug(" - End search for app: ".$app->getName());
    }

    protected function getHowManyAppOwesWolopay(App $app, StorageCurrencyMoney &$storageWoloGatewayByProvider, &$storageWoloGatewayByCountry, \DateTime $dateFrom, \DateTime $dateTo)
    {
        $this->addDebug("Searching extracost by gateways Purchases for app ".$app->getName());

        $iteratorPurchases = $this->em->getRepository("AppBundle:Purchase")->findAllValidPurchaseByClient($app->getId(), $dateFrom, $dateTo, true);

        foreach ($iteratorPurchases as $iteratorPurchaseRow)
        {
            /** @var Purchase $purchase */
            $purchase = $iteratorPurchaseRow[0];

            $storageWoloGatewayByProvider->sumExtraData($purchase->getProvider()->getName(), 'amount_wolo_in_client_currency',
                $purchase->getAmountWolo() * $purchase->getExchangeRateEur()
            //              NOW Client currency is forced to EUR BE CAREFUL IN THE FUTURE

            //                $this->currencyService->getExchangeWithFeePercentIfNeedChangeCurrency(
            //                    $purchase->getAmountWolo(),
            //                    $purchase->getCurrency(),
            //                    $app->getClient()->getCurrencyEarnings()->getId(),
            //                    self::EXCHANGE_FEE_DEFAULT
            //                )[0]
            );

            $storageWoloGatewayByProvider->pushUniqueExtraData($purchase->getProvider()->getName(), 'transactions', $purchase->getTransactionId());

            if ($purchase->getAmountTax() == 0 || in_array($purchase->getCountryGamer()->getId(), CountryEnum::$OTHERS_ALL))
                continue;

            if (!isset($storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]))
                $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()] = ['country' => $purchase->getCountry(), 'currencies' => []];

            if (!isset($storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()]))
                $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()] = ['currency'=> $purchase->getCurrency(), 'value' => 0];

            $storageWoloGatewayByCountry[$purchase->getCountryGamer()->getId()]['currencies'][$purchase->getCurrency()->getId()]['value'] += $purchase->getAmountTax();
        }

    }

    private function calculateTax(Country $country, $profit)
    {
        $percent = 100;
        if ($country->getId() === CountryEnum::SPAIN)
            $percent = $country->getVat();

        $profitIva = $profit * $percent / 100;
        $profitNet = $profit + $profitIva;

        return [$profitNet, $profitIva];
    }

    /**
     * @param $invoiceGeneratorId
     * @param \AppBundle\Entity\Client $merchant
     * @param \DateTime $dateTime
     * @param $amount
     * @param \AppBundle\Entity\Currency $currency
     * @param $attemptOnCreateAValidInvoice
     * @param $autoApprove
     * @param BillingClientOwesInjectConcept[] $extraConcepts
     * @throws \Exception
     * @return FinInvoice
     */
    private function createInvoiceMerchantToWolopayEntity(
        $invoiceGeneratorId,
        Client $merchant,
        \DateTime $dateTime,
        $amount,
        Currency $currency,
        $attemptOnCreateAValidInvoice,
        $autoApprove,
        $extraConcepts
    ) {
        $clientFrom = $this->em->getRepository("AppBundle:Client")->findOneBy(['nameCompany' => self::FROM_CLIENT]);

        if (!$clientFrom)
            throw new \Exception('Wolopay Client doesn\'t exist');

        $finInvoice = new FinInvoice(null, $merchant, $clientFrom, $dateTime);
        $finInvoice
            ->setInvoiceGeneratorId($invoiceGeneratorId)
            ->generateInvoiceNumberFromCompanyTo($attemptOnCreateAValidInvoice)
            ->setFinInvoiceCategory($this->em->getRepository("AppBundle:FinInvoiceCategory")->find(FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID))
            ->setAmountTotal($amount)
            ->setCurrency($currency)
            ->setTitle('Generated Turnover, '.$dateTime->format('Y/m'))
            ->setRequireApproval(true)
            ->setExtraConcepts($extraConcepts, $this->serializer)
        ;

        if ($autoApprove)
        {
            $finInvoice
                ->setApprovedAt(new \DateTime())
                ->setRequireApproval(false)
            ;
        }

        return $finInvoice;
    }

    /**
     * @param $invoiceGeneratorId
     * @param \AppBundle\Entity\Client $merchant
     * @param \DateTime $dateTime
     * @param $amount
     * @param \AppBundle\Entity\Currency $currency
     * @param $attemptOnCreateAValidInvoice
     * @param $autoApprove
     * @param BillingClientOwesInjectConcept[] $extraConcepts
     * @return FinInvoice
     */
    private function createInvoiceWolopayToMerchantEntity(
        $invoiceGeneratorId,
        Client $merchant,
        \DateTime $dateTime,
        $amount,
        Currency $currency,
        $attemptOnCreateAValidInvoice,
        $autoApprove,
        $extraConcepts
    ) {
        $clientFrom = $this->em->getRepository("AppBundle:Client")->findOneBy(['nameCompany' => self::FROM_CLIENT]);
        $finInvoice = new FinInvoice(null, $clientFrom, $merchant, $dateTime);
        $finInvoice
            ->setInvoiceGeneratorId($invoiceGeneratorId)
            ->generateInvoiceNumberFromCompanyTo($attemptOnCreateAValidInvoice)
            ->setFinInvoiceCategory($this->em->getRepository("AppBundle:FinInvoiceCategory")->find(FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID))
            ->setAmountTotal($amount)
            ->setCurrency($currency)
            ->setTitle('Monthly Fees, '.$dateTime->format('Y/m'))
            ->setRequireApproval(true)
            ->setExtraConcepts($extraConcepts, $this->serializer)
        ;

        if ($autoApprove)
        {
            $finInvoice
                ->setApprovedAt(new \DateTime())
                ->setRequireApproval(false)
            ;
        }

        return $finInvoice;
    }

    /**
     * @param FinInvoice $finInvoice
     * @param $othersInvoices
     * @param StorageCurrencyMoney $storage
     * @param $profit4apps
     * @param $profitTotal
     * @param $profitIva
     * @param ClientDeposit $deposit
     * @param $depositExtraPay
     * @param $balanceRequirementAdded
     * @param $realTotalForClient
     * @param $dateFrom
     * @param $dateTo
     * @param BillingClientOwesInjectConcept[] $wolopayOwesClientExtraConcepts
     */
    private function createPDFClientToWolopay(
        FinInvoice $finInvoice,
        $othersInvoices,
        StorageCurrencyMoney $storage,
        $profit4apps,
        $profitTotal,
        $profitIva,
        ClientDeposit $deposit,
        $depositExtraPay,
        $balanceRequirementAdded,
        $realTotalForClient,
        $dateFrom,
        $dateTo,
        $wolopayOwesClientExtraConcepts
    )
    {
        $invoicePDF = $finInvoice->getInvoiceNumber()."_".$finInvoice->getReferenceDate()->format('Y-m').".pdf";

        $headerHtml = $this->templating->render(
            '@App/PDF/headers/standard.html.twig',
            [
                'title' => $finInvoice->getAmountTotal() > 0 ? 'INVOICE ' . $finInvoice->getCompanyTo()->getNameCompany()
                        : 'Generated turnover ' . $finInvoice->getReferenceDate()->format('M Y') . ' Summary'
            ]
        );

        $headerTempDir = sys_get_temp_dir().'/pdf_header_'.$finInvoice->getInvoiceNumber()."_".$finInvoice->getReferenceDate()->format('Y-m').".html";
        file_put_contents($headerTempDir, $headerHtml);
        $this->tempFilesToClear[] = $headerTempDir;

        $invoiceTempDir = sys_get_temp_dir().'/pdf_'.$invoicePDF;

        $this->knpSnappyPdf->generateFromHtml(
            $this->templating->render(
                '@App/PDF/billingClientOwes/invoice_monthly_client_to_wolopay.html.twig',
                [
                    'storageCurrencies' => $storage,
                    'profit'            => $finInvoice->getAmountTotal(),
                    'finInvoice'        => $finInvoice,

                    'client'      => $finInvoice->getCompanyFrom(),
                    'profitTotal'       => $profitTotal,
                    'profit4apps' => $profit4apps,
                    'profitIva'         => $profitIva,
                    'deposit'   => $deposit,
                    'balanceRequirementAdded'   => $balanceRequirementAdded,
                    'depositExtraPay' => $depositExtraPay,

                    'othersInvoices' => UtilHelper::parseIdEntitiesToCSV($othersInvoices, '', 'invoice_number'),
                    'realTotal'      => $realTotalForClient,
                    'extraConcepts'  => $wolopayOwesClientExtraConcepts
                ]
            ),
            $invoiceTempDir ,
            [
                'header-html' => $headerTempDir,
            ],
            true
        );


        $this->assocMediaWithInvoice($finInvoice, $invoiceTempDir);
        $this->tempFilesToClear[] = $invoiceTempDir;
    }

    /**
     * @param FinInvoice $finInvoice
     * @param $othersInvoices
     * @param StorageCurrencyMoney $storageCurrencyMoney
     * @param $monthlyWoloFee
     * @param $monthlyWoloNet
     * @param $monthlyWoloIva
     * @param ClientDeposit $deposit
     * @param $depositExtraPay
     * @param $balanceRequirementAdded
     * @param $realTotalForClient
     * @param $woloGatewayFeeSum
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param BillingClientOwesInjectConcept[] $clientOwesWolopayExtraConcepts
     */
    private function createPDFWolopayToClient(
        FinInvoice $finInvoice,
        $othersInvoices,
        StorageCurrencyMoney $storageCurrencyMoney,
        $monthlyWoloFee,
        $monthlyWoloNet,
        $monthlyWoloIva,
        ClientDeposit $deposit,
        $depositExtraPay,
        $balanceRequirementAdded,
        $realTotalForClient,
        $woloGatewayFeeSum,
        \DateTime $dateFrom,
        \DateTime $dateTo,
        array $clientOwesWolopayExtraConcepts
    )
    {
        $invoicePDF = $finInvoice->getInvoiceNumber()."_".$finInvoice->getReferenceDate()->format('Y-m').".pdf";

        $headerHtml = $this->templating->render(
            '@App/PDF/headers/standard.html.twig',
            [
                'title' => $finInvoice->getAmountTotal() > 0 ? 'INVOICE ' . $finInvoice->getCompanyTo()->getNameCompany()
                        : 'Monthly Fees ' . $finInvoice->getReferenceDate()->format('M Y') . ' Summary'
            ]
        );

        $headerTempDir = sys_get_temp_dir().'/pdf_header_'.$invoicePDF .'.html';
        file_put_contents($headerTempDir, $headerHtml);
        $this->tempFilesToClear[] = $headerTempDir;

        $invoiceTempDir = sys_get_temp_dir().'/pdf_'.$invoicePDF;

        $this->knpSnappyPdf->generateFromHtml(
            $this->templating->render(
                '@App/PDF/billingClientOwes/invoice_monthly_wolopay_to_client.html.twig',
                [
                    'monthlyWoloFee'  => $monthlyWoloFee,
                    'balanceRequirementAdded' => $balanceRequirementAdded,
                    'finInvoice'     => $finInvoice,
                    'deposit'        => $deposit,
                    'othersInvoices' => UtilHelper::parseIdEntitiesToCSV($othersInvoices, '', 'invoice_number'),
                    'realTotal'      => $realTotalForClient,
                    'monthlyWoloIvaOver' => $monthlyWoloNet,
                    'monthlyWoloIva' => $monthlyWoloIva,
                    'client'         => $finInvoice->getCompanyTo(),
                    'woloGatewayFeeSum' => $woloGatewayFeeSum,
                    'depositExtraPay' => $depositExtraPay,
                    'storageCurrencies' => $storageCurrencyMoney,
                    'extraConcepts' => $clientOwesWolopayExtraConcepts
                ]
            ),
            $invoiceTempDir ,
            [
                'header-html' => $headerTempDir,
            ],
            true
        );


        $this->assocMediaWithInvoice($finInvoice, $invoiceTempDir);
        $this->tempFilesToClear[] = $invoiceTempDir;
    }

    private function createPDFTaxesForDocument(
        FinInvoice $finInvoiceWoloToClient,
        $storageWoloGatewayByCountry,
        Client $client,
        Client $wolopay,
        \DateTime $referenceDate
    )
    {
        if (count($storageWoloGatewayByCountry) === 0)
        {
            $this->addDebug('Not gateways used to generate PDF taxes');
            return null;
        }

        $date = new \DateTime();
        $invoicePDF = $client->getId()."_tax_".$date->format('Y-m-d').".pdf";

        $headerHtml = $this->templating->render('@App/PDF/headers/standard.html.twig',['title' => 'Taxes for your gateways']);

        $headerTempDir = sys_get_temp_dir().'/pdf_header_'.$invoicePDF .'.html';
        file_put_contents($headerTempDir, $headerHtml);

        $taxesTempDir = sys_get_temp_dir().'/'.$invoicePDF;

        $this->knpSnappyPdf->generateFromHtml(
            $this->templating->render(
                '@App/PDF/billingClientOwes/document_for_client_taxes_for_gateways.html.twig',
                [
                    'client'  => $client,
                    'wolopay' => $wolopay,
                    'storageWoloGatewayByCountry' => $storageWoloGatewayByCountry,
                    'referenceDate' => $referenceDate
                ]
            ),
            $taxesTempDir,
            [
                'header-html' => $headerTempDir,

            ],
            true
        );

        $clientDocument = new ClientDocument();
        $clientDocument
            ->setTitle('Taxes for gateways, '.$referenceDate->format('F Y'))
            ->setDescription('')
            ->setClient($client)
            ->setFinInvoice($finInvoiceWoloToClient)
        ;

        $this->assocMediaWithInvoice($clientDocument, $taxesTempDir, ClientDocument::SONATA_CONTEXT);
        $this->tempFilesToClear[] = $taxesTempDir;
        $this->addInfo("Added ClientDocument with taxes for gateway");

        return $clientDocument;
    }

    private function assocMediaWithInvoice($finInvoice, $invoiceTempDir, $context = FinInvoice::SONATA_CONTEXT)
    {
        $media = $this->sonataCreateMediaImageFromDir(
            $invoiceTempDir,
            $context,
            null,
            'sonata.media.provider.file'
        );
        $finInvoice->setDocument($media);
    }

    protected function calculateDeposit(Client $client, $profits)
    {
        $deposit = $client->getDepositCurrent();

        if (!$deposit)
            throw new \Exception("Deposit is undefined from client ". $client->getNameCompany());

        $profitsOriginal = $profits;

        if ($profits < 0)
        {
            $newDeposit = $deposit->endThisAndCreateNew();

            $newDeposit->setDescription("Negative deposit, profits: ".number_format($profits, 2));
            $newDeposit->setAmountBalance($deposit->getAmountBalance() + $profits);

            return [-$profits, $newDeposit, 0];
        }

        if ($deposit->getAmountLimitCover() >= $profits)
        {
            // calculate previous debt balance amount
            if ($deposit->getAmountBalance() < $deposit->getAmountLimitCover())
            {
                $newDeposit = $deposit->endThisAndCreateNew();

                $newAmountBalance = $profits - ($deposit->getAmountLimitCover() - $deposit->getAmountBalance());

                if ($newAmountBalance < 0)
                    $newAmountBalance = $profits + $deposit->getAmountBalance();
                else
                    $newAmountBalance = $newDeposit->getAmountBalanceRequirement();

                $newDeposit->setDescription("To completed last deposit");
                $newDeposit->setAmountBalance($newAmountBalance);

                $extraPay = $newDeposit->getAmountBalance() - $deposit->getAmountBalance();

                return [$extraPay, $newDeposit, 0];
            }

            return [0, null, 0];
        }

        $newDeposit = $deposit->endThisAndCreateNew();

        $diff = $profits - $deposit->getAmountLimitCover();

        $newLimitCover = ceil(($profits / $newDeposit->getAmountIncreaseIfLimitExceed())) * $newDeposit->getAmountIncreaseIfLimitExceed();
        $newDeposit->setAmountLimitCover($newLimitCover);
        $newDeposit->setAmountBalanceRequirement($newLimitCover + $newDeposit->getAmountIncreaseIfLimitExceed());

        $newAmountBalance = $profits - ($newDeposit->getAmountBalanceRequirement() - $deposit->getAmountBalance());

        if ($newAmountBalance < 0)
            $newAmountBalance = $profits + $deposit->getAmountBalance();
        else
            $newAmountBalance = $newDeposit->getAmountBalanceRequirement();

        $newDeposit->setAmountBalance($newAmountBalance);
        $msg = "New deposit created, because profits are: ".number_format($profitsOriginal, 2).", with current cover diff was ".number_format($diff, 2)."";
        $newDeposit->setDescription($msg);
        $this->addDebug($msg);

        $extraPay = $newDeposit->getAmountBalance() - $deposit->getAmountBalance();
        $balanceRequirementExtra = $newDeposit->getAmountBalanceRequirement() - $deposit->getAmountBalanceRequirement();

        return [$extraPay , $newDeposit, $balanceRequirementExtra];
    }

    private function persistFinMovements(FinInvoice $finInvoiceWoloToClient, $realTotalForClient)
    {
        $basic = new FinMovement();
        $basic
            ->setCurrency($finInvoiceWoloToClient->getExternalCompanyNotWolopay()->getCurrencyEarnings())
        ;

        if ($realTotalForClient !== 0)
        {
            $finMovement = clone $basic;
            $finMovement
                ->setTitle($finInvoiceWoloToClient->getExternalCompanyNotWolopay()->getNameCompany().' '.
                    $finInvoiceWoloToClient->getReferenceDate()->format('m-Y').' '.$finInvoiceWoloToClient->getCompanyTo()->getNameCompany())
                ->setFinInvoice($finInvoiceWoloToClient)
            ;

            if ($realTotalForClient > 0 )
            {
                $finMovement
                    ->setAmountTotal($realTotalForClient)
                    ->setCompanyFrom($finInvoiceWoloToClient->getCompanyTo())
                    ->setCompanyTo($finInvoiceWoloToClient->getCompanyFrom())
                ;
            }else{
                $finMovement
                    ->setAmountTotal(-$realTotalForClient)
                    ->setCompanyFrom($finInvoiceWoloToClient->getCompanyFrom())
                    ->setCompanyTo($finInvoiceWoloToClient->getCompanyTo())
                ;
            }

            $this->em->persist($finMovement);
        }

    }

    private function clearTempFiles()
    {
        foreach ($this->tempFilesToClear as $fileDIr)
        {
            @unlink($fileDIr);
        }
    }

    /**
     * @param FinInvoice[] $invoices
     * @return FinInvoice[]
     */
    private function getInvoicesNotEqualToZero(array $invoices)
    {
        $result = [];
        foreach ($invoices as $invoice)
        {
            if (round($invoice->getAmountTotal(), 2) != 0)
            {
                $result []= $invoice;
            }
        }

        return $result;
    }


    /**
     * @param App $app
     * @param float $amountTotal
     * @param float $amountTaxes
     * @param float $amountProvider
     * @param float $amountWolo
     * @param float $amountApp
     * @param Currency $currency
     * @param int $year
     * @param int $month
     * @return MonthlyAppReport
     */
    private function  createMonthlyAppReportEntity(App $app, $amountTotal, $amountTaxes, $amountProvider, $amountWolo, $amountApp,$currency,$year,$month){
        $reportNumber = $year . $month."_". $app->getId();
        $monthlyAppReportEntity = new MonthlyAppReport($app,$reportNumber);

        $monthlyAppReportEntity
            ->setCreatedAt(new \DateTime)
            ->setTitle($app->getName() . ". Monthly Report of $year/$month")
            ->setAmountTotal($amountTotal)
            ->setAmountTaxes($amountTaxes)
            ->setamountProvider($amountProvider)
            ->setAmountWolo($amountWolo)
            ->setAmountApp($amountApp)
            ->setCurrency($currency)
            ->setDescription($app->getName() . ". Auto-generated Monthly Report of $year/$month, ")
        ;

        return $monthlyAppReportEntity;
    }

    /**
     * @param App $app
     * @param StorageCurrencyMoney $storage
     * @param $year
     * @param $month
     */
    private function createPDFMonthlyAppReport(
        App $app,
        StorageCurrencyMoney $storage,
        $year,
        $month
    ){
        /*
        //PER APP!!!!!!
        $storage->sumMoneyApp($appNetRevenueClientCurrency, $currency, $app);
        $storage->sumExtraDataApp($app->getId(), 'amount_tax_in_client_currency',$tax_client_currency);
        $storage->sumExtraDataApp($app->getId(), 'amount_wolo_in_client_currency',$amount_wolo_client_currency );
        $storage->sumExtraDataApp($app->getId(), 'amount_game_in_client_currency', $appNetRevenueClientCurrency);
        $storage->sumExtraDataApp($app->getId(), 'wolo_exchange_fee', $WoloExchangeFee);
        $storage->sumExtraDataApp($app->getId(), 'amount_game_with_taxes_in_client_currency',$amount_app_with_taxes_client_currency);
        $storage->sumExtraDataApp($app->getId(), 'amount_provider_in_client_currency',$amount_provider_client_currency);
        $storage->sumExtraDataApp($app->getId(), 'n_transactions', $transactions);
        */
        $currency = $storage[$app->getId()]->getCurrency();
        $amountTotal = $storage[$app->getId()]->getAmount();
        $amountTaxes = $storage[$app->getId()]->extraData['amount_tax_in_client_currency'];
        $amountWolo = $storage[$app->getId()]->extraData['amount_wolo_in_client_currency'];
        $amountProvider = $storage[$app->getId()]->extraData['amount_provider_in_client_currency'];
        $amountAppNet = $storage[$app->getId()]->extraData['amount_game_in_client_currency'];

        $monthlyAppReport = $this->createMonthlyAppReportEntity($app, $amountTotal, $amountTaxes, $amountProvider, $amountWolo, $amountAppNet, $currency, $year, $month);

        $reportPDF = $monthlyAppReport->getReportNumber() ."_".$monthlyAppReport->getApp()->getId() .".pdf";

        $headerHtml = $this->templating->render(
            '@App/PDF/headers/standard.html.twig',
            [
                'title' => $monthlyAppReport->getTitle()
            ]
        );

        $headerTempDir = sys_get_temp_dir().'/pdf_header_'.$reportPDF .'.html';
        file_put_contents($headerTempDir, $headerHtml);
        $this->tempFilesToClear[] = $headerTempDir;

        $invoiceTempDir = sys_get_temp_dir().'/pdf_'.$reportPDF;

        $this->knpSnappyPdf->generateFromHtml(
            $this->templating->render(
                '@App/PDF/billingClientOwes/monthly_report_wolopay_to_app.html.twig',
                [
                    'app' => $monthlyAppReport->getApp(),
                    'monthlyAppReport'     => $monthlyAppReport,
                    'storageCurrencies' => $storage,
                ]
            ),
            $invoiceTempDir ,
            [
                'header-html' => $headerTempDir,
            ],
            true
        );


        $this->assocMediaWithInvoice($monthlyAppReport, $invoiceTempDir);
        $this->tempFilesToClear[] = $invoiceTempDir;
    }

}
