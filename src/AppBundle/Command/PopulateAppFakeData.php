<?php

namespace AppBundle\Command;

use AppBundle\Entity\App;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Language;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaApiPublicException;
use AppBundle\Service\ApiRequestClient;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @Service("command.app_fakedata_populate")
 * @Tag("console.command")
 */
class PopulateAppFakeData  extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger $logger
     */
    public $logger;


    /**
     * @Inject("%domain_main%")
     * @var string $domainMain
     */
    public $domainMain;

    /**
     * @Inject("%is_production%"),
     * @var bool $isProduction
     */
    public $isProduction;

    /**
     * @var ApiRequestClient $apiClient
     * @Inject("api.make_request")
     */
    public $apiClient;

    /**
     * @var TransactionCreateCommand
     * @Inject("shop.command.transaction.create")
     */
    public $transactionCreateService;

    /**
     * @var SimulatePaymentCompleteProcessCommand
     * @Inject("command.shop.simulate_payment_complete")
     */
    public $simulatePaymentCompleteService;

    protected function configure()
    {
        $this
            ->setName('app:fakedata:populate')
            ->setDescription('Populate Database with fake data (gamers, transaction and payments)')
            ->addArgument('clientId', InputArgument::REQUIRED, 'Id of the Client')
            ->addArgument('howMany', InputArgument::OPTIONAL, 'How many transactions/purchases to populate with. default 1. Min=1. Max=25',10)
            ->addArgument('appId', InputArgument::OPTIONAL, 'AppId to put data in; set to "null" for all')
            ->addArgument('debug',  InputArgument::OPTIONAL, 'set 1 to output info about insertions',false)
            ->addArgument('forcePayment',  InputArgument::OPTIONAL, 'set 1 to force transactions to end in payments ',false)
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
        $app=null;
        $numApps=1;
        $debug = $input->getArgument('debug');
        $clientId = $input->getArgument('clientId');
        $appId = $input->getArgument('appId');
        $howMany = $input->getArgument('howMany');
        /** @var bool $forcePayment */
        $forcePayment = $input->getArgument('forcePayment');
        if ($howMany<0) $howMany=1;
        if ($howMany>25) $howMany=25;


        if(!($client = $this->em->getRepository("AppBundle:Client")->find($clientId))){
            $output->writeln("End of process. Client does not exist");
            $this->logger->addError("End of process. Client does not exist");
            exit;
        }

        $faker = \Faker\Factory::create();
        $msg="Config: ClientId=$clientId; howMany=".$howMany.";appId: $appId; debug=" . $input->getArgument('debug') . "; forcePayment=" . $input->getArgument('forcePayment');
        $output->writeln($msg);
        $this->logger->addInfo($msg);
        $apps = $client->getApps();

        if (($appId<>"") && ($appId<>"null")){
            $app = $this->em->getRepository("AppBundle:App")->findOneByAppIdAndClientId($appId,$clientId);
            if (!$app){
                $output->writeln("End of process. Strange error, app $appId belongs to Client $clientId, but not found?");
                $this->logger->addError("End of process. Strange error, app belongs to Client, but not found?");
                exit;
            }
        }else{
            $numApps = count(array_keys($apps->toArray()));
        }

        $i=0;
        while (($i<$howMany) && ($numApps>0)){
            if (($appId=="null") && ($apps))
                $app = $apps[$faker->numberBetween(0,$numApps-1)];

            try{
                $output->write("Going to populate app " . $app->getId());
                $this->logger->addInfo("Going to populate app " . $app->getId());
                $this->populate($app, $output, $debug, $forcePayment);
            }catch(\Exception $exception){
                $this->logger->addError("Exception: ". $exception->getTraceAsString() );
            }

            $i++;
            if (($howMany>1) ) {
                $secs=$faker->numberBetween(30,120);
                if ($debug) $this->logger->addInfo("Going to sleep $secs seconds");
                sleep($secs);
                if (($faker->numberBetween(1,100)) < 16) $i++;
            }
        }
        $this->logger->addError("Done.");
        exit;
    }

    /**
     * @param App $app
     * @param OutputInterface $output
     * @param bool  $debug
     * @param bool $forcePayment
     * @throws \Exception
     */
    public function populate($app, $output ,$debug=false, $forcePayment=false){
        if ($debug) $this->logger->addInfo("Starting new fake data for app " . $app->getId() . "(" . $forcePayment. ")");

        $this->em->getConnection()->close();
        $this->em->getConnection()->connect();
        $faker = \Faker\Factory::create();

        $appId = $app->getId();
        $countries = $app->getCountries();
        $numCountries = count(array_keys($countries->toArray()));
        $appCredentials = $app->getAppApiHasCredential();

        if (($faker->randomDigitNotNull>7) && ($numCountries>0)){
            $externalId = $faker->unique()->userName;
            $gamer_level = $faker->numberBetween(1,66);
            $gamer_email = $externalId . "@" . $faker->safeEmailDomain;
            $country = $countries[$faker->numberBetween(0,$numCountries-1)];
            $countries = [$country];
        }else{
            /** @var Gamer $gamer */
            $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndNotDemoAndHadBought($appId);
            if (!$gamer) return;
            $externalId = $gamer->getGamerExternalId();
            if ( (!$gamer->getExternalAffiliateId()) && ( ($gamer->getId()%3)!==0)) {
                $pathUrl =  "/api/v1/gamer/$externalId.json";
                $parameters = array("affiliate_id"=> "net".$faker->numberBetween(1,3));
                if ($debug) $this->logger->addInfo($pathUrl);
                try {
                    $this->apiClient->makeRequest($app, $pathUrl, $parameters, "PATCH")->getBody();
                }catch(\Exception $e){
                    $this->logger->addInfo($e->getTraceAsString());
                    return;
                }

            }
            $lastTransaction = $this->em->getRepository("AppBundle:Transaction")->findOneBy(array('gamer'=>$gamer->getId()),array('beginAt' => 'desc'));
            if (!$lastTransaction) return;
            $lastLevel = $lastTransaction->getValueCurrent();
            if (!$lastLevel) $lastLevel=1;
            $gamer_level = $lastLevel++;
            $gamer_email = $gamer->getEmail();
            $country = ($lastTransaction->getCountriesAvailable()->first())?:$this->em->getRepository("AppBundle:Country")->find("ES");
            $countries = [$country];
        }

        $countryId = $country->getId();
        /** @var Language $lang */
        $lang = $country->getLanguage();
        if ($debug) $this->logger->addInfo("Gamer External ID:$externalId ;gamer_level=$gamer_level; country=$countryId");




        try {
            //meto mas componente aleatorio por hora local del dia y dia de la semana
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone($country->getTimeZone()));
            $date->setTimestamp(time());


            if ((!$forcePayment) && ($date->format('G')<2) && $faker->randomDigitNotNull<8)  return;
            elseif ((!$forcePayment) && ($date->format('G')<6) && $faker->randomDigitNotNull<5)  return;
            elseif ((!$forcePayment) && ($date->format('G')<8) && $faker->randomDigitNotNull<3)  return;

            if ((!$forcePayment) && ($date->format('G')==19) && $faker->randomDigitNotNull<3)  return;
            elseif ((!$forcePayment) && ($date->format('G')==22) && $faker->randomDigitNotNull<2)  return;

            if ((!$forcePayment) && ($date->format('N')==1) && $faker->randomDigitNotNull<3)  return;


            /** @var Transaction $transaction */
            $transaction = $this->transactionCreateService->createTransactionParams(
                $appCredentials->getCodeKey(), $externalId, $gamer_level, false, $lang, array(), array(), null, false, array(), array(), null, null, null, null, false, false, $gamer_email,false);
            $transactionId = $transaction->getId();
            $countryDetected = $country;
            if ($faker->randomDigitNotNull>6)
                $countryDetected = $this->em->getRepository("AppBundle:Country")->find($faker->countryCode);
            $transaction->setCountryDetected($countryDetected);
        }catch(NviaApiPublicException $exception){
            $output->writeln($exception->getTraceAsString());
            return;
        }
        if ($debug) $this->logger->addInfo("Created Fake Transaction: " . $transactionId );
        $baseUrl = $this->domainMain;

        if ((!$forcePayment) && $faker->randomDigitNotNull<8){
            $transaction->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::SHOPPING_ID));
            return;
        }

        //https://wolopay.com/api/v1/tab.json?&transaction_id=WOT_5620e20fd059d&country=ES
        //[{"id":3313,"app_shop":{...},"app_tab":{"id":58,,"app":{...},"name":"Ounces","name_unique":"ounces","
        $pathUrl =  "/api/v1/tab.json?&transaction_id=$transactionId&country=$countryId";
        if ($debug) $this->logger->addInfo($pathUrl);
        try{
            $tabs = json_decode($this->apiClient->makeRequest($app, $pathUrl)->getBody(),true);
        }catch(\Exception $e){
            $this->logger->addInfo($e->getTraceAsString());
            return;
        }
        $tabId = $tabs[$faker->numberBetween(0,count(array_keys($tabs)) - 1)]['app_tab']['name_unique'];

        //https://wolopay.com/api/v1/article.json?&transaction_id=WOT_5620e20fd059d&country=ES&tab_category_id=ounces
        //[{"amount_range":null,"current_amount_without_offer":74.99,"current_items_quantity":2200,"local_currency":{"id":"EUR"...},"articles_extra":[],"article":{"remaining_units":-12,"id":"30f73f28-18e9-11e5-aed9-00259068f82e",
        $pathUrl =  "/api/v1/article.json?&transaction_id=$transactionId&country=$countryId&tab_category_id=$tabId";
        if ($debug) $this->logger->addInfo($pathUrl);
        try{
            $articles = json_decode($this->apiClient->makeRequest($app, $pathUrl)->getBody(),true);
        }catch(\Exception $e){
            $this->logger->addInfo($e->getTraceAsString());
            return;
        }
        $n = $faker->numberBetween(0,count(array_keys($articles)) - 1);
        $articleId = $articles[$n]['article']['id'];
        $articlesCSV = $articleId;

        $inOffer = $articles[$n]['offer']<>null;
        $pType = $articles[$n]['article']['article_category']['id']; //subscription|single
        $pType == "subscription"? $paymentProcessType="subscription" : $paymentProcessType="single";

        $carro = $faker->numberBetween(1,5); //rand # of articles. rand if >1. rand for each article.
        while (($carro> 1) && ($faker->randomDigitNotNull<5))
        {
            $n = $faker->numberBetween(0,count(array_keys($articles)) - 1);
            $pType2 = $articles[$n]['article']['article_category']['id']; //subscription|single
            $pType2 == "subscription"? $paymentProcessType2="subscription" : $paymentProcessType2="single";
            if ($paymentProcessType=="single" && $paymentProcessType2=="single" && $faker->randomDigitNotNull<6){
                $articlesCSV .= "," .$articles[$n]['article']['id'];
            }
            $carro--;
        }

        //https://wolopay.com/api/v1/paymethod.json?&transaction_id=WOT_5620e20fd059d&country=ES&tab_category_id=ounces&article_id=30f73f28-18e9-11e5-aed9-00259068f82e
        //[{"id":108, name:"PayPal",...
        $pathUrl = "/api/v1/paymethod.json?&transaction_id=$transactionId&country=$countryId&tab_category_id=$tabId&article_id=$articleId";
        if ($debug) $this->logger->addInfo($pathUrl);
        try{
            $payMethods = json_decode($this->apiClient->makeRequest($app, $pathUrl)->getBody(),true);
        }catch(\Exception $e){
            $this->logger->addInfo($e->getTraceAsString());
            return;
        }
        $n = $faker->numberBetween(0,count(array_keys($payMethods)) - 1); //n se usa abajo
        $payMethodId = $payMethods[$n]['id'];
        if (($payMethods[$n]['name']=='Promo') || ($payMethods[$n]['name']=='Sms') || ($payMethods[$n]['name']=='Voice'))
            return;


        $url = $baseUrl . "/shop/" . $transactionId;
        if ($debug) $this->logger->addInfo($url);
        try{
            $client = new Client();
            $request = $client->get($url);
            $request->send();
        }catch (\Exception $e){
            return;
        }

        $url = $baseUrl . "/shop/payment/begin/$transactionId/".$lang->getId()."/$payMethodId/$articlesCSV/". $countryDetected->getId();
        if ($debug) $this->logger->addInfo($url);
        try{
            $client2 = new Client();
            $request = $client2->get($url);
            $request->send();
        }catch (\Exception $e){
            return;
        }

        $probability = 17;
        if (is_numeric(substr($app->getName(), -1))){
            $last = (int) substr($app->getName(), -1);
            $probability -= $last;
            if ($last === 4) $probability -= 3;
        }
        if ($paymentProcessType=="subscription") $probability -= 7;
        if ($inOffer)$probability += 7;
        if ($debug) $this->logger->addInfo("probability of converting click into purchase: $probability.");

        //simulate payment % of clicks
        if (($forcePayment) || $faker->numberBetween(0,100)<=$probability)  {
            if ($debug) $this->logger->addInfo("simulate payment complete for transaction $transactionId and payment process type $paymentProcessType .");
            try {
                $this->simulatePaymentCompleteService->completePayment($transactionId, $paymentProcessType);
            }catch (\Exception $e){
                return;
            }

        }
    }
}