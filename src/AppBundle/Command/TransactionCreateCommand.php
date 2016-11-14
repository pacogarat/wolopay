<?php

namespace AppBundle\Command;

use AppBundle\Entity\AppTab;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ExternalStoreEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Language;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\ShopCss;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaApiPublicException;
use AppBundle\Exception\NviaException;
use AppBundle\Service\IPInfoService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Service("shop.command.transaction.create")
 * @Tag("console.command")
 */
class TransactionCreateCommand extends Command
{
    const SECONDS_TO_JOIN_TRANSACTIONS = 30;

    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("common.ip_info")
     * @var IPInfoService
     */
    public $ipInfoService;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @Inject("validator")
     * @var ValidatorInterface
     */
    public $validator;

    /**
     * @Inject("event_dispatcher")
     * @var ContainerAwareEventDispatcher event_dispatcher
     */
    public $eventDispatcher;


    /** @Inject("%transaction.life_time%")   */
    public $transactionLifeTime;

    /** @Inject("%is_production%")   */
    public $isProduction;


    protected function configure()
    {
        $this
            ->setName('shop:transaction:create')
            ->setDescription('Create transaction')
            ->addArgument('credentialCodeKey', InputArgument::OPTIONAL, 'AppApiCrendentials:codeKey', 'demo')
            ->addArgument('gamerExternalId', InputArgument::OPTIONAL, 'Gamer external id', 1)
            ->addArgument('gamerCurrentLevel', InputArgument::OPTIONAL, 'Level Category', 1)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $credentialsCodeKey = $input->getArgument('credentialCodeKey');
        $gamerExternalId = $input->getArgument('gamerExternalId');
        $gamerCurrentLevel = $input->getArgument('gamerCurrentLevel');
        $filterFastRequests = $input->getArgument('filterFastRequests');

        if ($credentialsCodeKey=='demo')
        {
            $credentials = $this->em->getRepository("AppBundle:AppApiCredentials")->findDemo();
            $credentialsCodeKey = $credentials->getCodeKey();
        }

        $transaction = $this->createTransactionParams($credentialsCodeKey, $gamerExternalId, $gamerCurrentLevel,
            true, null, [], [],null, false, [], [], null, null, null, null, false,null,null,$filterFastRequests);

        $output->writeln("Transaction ".$transaction->getId()." was created");
    }

    /**
     * @param $credentialsCodeKey
     * @param $gamerExternalId
     * @param $gamerCurrentLevel
     * @param bool $isCLI
     * @param \AppBundle\Entity\Language $defaultLanguage
     * @param Country[] $countriesAvailable
     * @param array $appTabsAvailable
     * @param \AppBundle\Entity\ShopCss $theme
     * @param bool $fixedCountry
     * @param PayMethod[] $payMethods
     * @param array $articlesAvailable
     * @param \AppBundle\Entity\Article $selectedArticle
     * @param $customParam
     * @param null $return
     * @param \AppBundle\Entity\AppTab $selectedAppTab
     * @param bool $test
     * @param $tutorialEnabled
     * @param $gamerEmail
     * @param $filterFastRequests
     * @param $url_notification
     * @throws \AppBundle\Exception\NviaApiPublicException
     * @return Transaction
     */
    public function createTransactionParams($credentialsCodeKey, $gamerExternalId, $gamerCurrentLevel , $isCLI=false, Language $defaultLanguage=null
        , $countriesAvailable=array(), $appTabsAvailable= array(), ShopCss $theme= null, $fixedCountry=false, array $payMethods= array()
        , $articlesAvailable=array(), Article $selectedArticle = null, $customParam=null, $return=null
        , AppTab $selectedAppTab=null, $test=false, $tutorialEnabled=null, $gamerEmail=null, $filterFastRequests=true
        , $url_notification = null
    )
    {
        if (! $appApiCredentials = $this->em->getRepository("AppBundle:AppApiCredentials")->findByCodeKeyAndActive($credentialsCodeKey))
            throw new NviaApiPublicException("App codeKey doesn't exist", NviaException::API_CODE_KEY_DOESNT_EXIST);

        $app = $appApiCredentials->getApp();
        $appId = $app->getId();

        if (!$gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($appId, $gamerExternalId)){
            $gamer = new Gamer($app, $gamerExternalId);
        }

        if ($gamerEmail)
            $gamer->setEmail($gamerEmail);

        $transaction = new Transaction($gamer, null, $gamerCurrentLevel);

        $transaction
            ->setApiCrendetials($appApiCredentials)
            ->setApp($app)
            ->setGamer($gamer)
            ->setValueCurrent($gamerCurrentLevel)
            ->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::BEGIN_ID)
            )
            ->setLanguageDefault($defaultLanguage)
            ->setFixedCountry($fixedCountry)
            ->setSelectedArticle($selectedArticle)
            ->setArticlesAvailable($articlesAvailable)
            ->setPayMethodsAvailable($payMethods)
            ->setCustomParam($customParam)
            ->setReturn($return)
            ->setCli($isCLI)
            ->setSelectedAppTab($selectedAppTab)
            ->setTest($test)
            ->setTutorialEnabled($tutorialEnabled)
        ;

        if ($theme)
            $transaction->setCss($theme);

        if ($countriesAvailable)
            $transaction->setCountriesAvailable($countriesAvailable);

        if ($appTabsAvailable)
            $transaction->setAppTabsAvailable($appTabsAvailable);

        if ($url_notification)
            $transaction->setUrlNotification($url_notification);

        $ip="";
        return $this->createTransaction($transaction,$ip, $filterFastRequests);
    }

    public function createTransaction(Transaction $transaction, $ip="", $filterFastRequests=true)
    {
        $secondsToJoinTransactions = self::SECONDS_TO_JOIN_TRANSACTIONS;
        $lastTransaction = $this->em->getRepository("AppBundle:Transaction")
            ->findLastByAppIdAndGamerId($transaction->getApp()->getId(),$transaction->getGamer()->getId());
        $a=new \DateTime();

        $stateNotAllowedForLastTransactions = [
            TransactionStatusCategoryEnum::COMPLETED_ID,
            TransactionStatusCategoryEnum::PENDING_PAYMENT_ID,
            TransactionStatusCategoryEnum::FAILED_ID,
            TransactionStatusCategoryEnum::BLOCKED_ID,
        ];


        if ($transaction->getApp()->getSecondsToJoinTransactions()
            && ($transaction->getApp()->getSecondsToJoinTransactions()>=0))
            $secondsToJoinTransactions = $transaction->getApp()->getSecondsToJoinTransactions();


        if (
            $this->isProduction
            && (!($transaction->getStatusCategory() && in_array($transaction->getStatusCategory()->getId(), $stateNotAllowedForLastTransactions)))
            && $filterFastRequests && $lastTransaction && (!$lastTransaction->getTest())
            && (($a->getTimestamp() - $lastTransaction->getBeginAt()->getTimestamp()) < $secondsToJoinTransactions )
        ) {
            $this->logger->addInfo("Not created transaction, because: we use a last transaction from this user, created at ".$lastTransaction->getBeginAt()->format(DATE_ISO8601));

            return $lastTransaction;
        }

        $transaction
            ->setExpireAt(new \DateTime('+'.$this->transactionLifeTime.' seconds'))
            ->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::BEGIN_ID)
            )
        ;

        $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelGamer(
            $transaction->getApp()->getId(), $transaction->getValueCurrent()
        );

        $shopCssTemp = $transaction->getCss();

        if ($appShop)
        {
            $transaction
                ->setAppShopMapped($appShop)
                ->setCss($shopCssTemp ?: $appShop->getCss())
                ->setHasCategories($transaction->getCss()->getHasCategories())
            ;

            if (!$transaction->getCss()->getHasCart())
                $transaction->setHasCart(false);

            $previousTransaction = $this->em->getRepository("AppBundle:Transaction")->findBy(['gamer' => $transaction->getGamer()]);

            // Add Tutorial in first transaction if shop has configure it
            if ($appShop->getTutorialEnabled() && $transaction->getTutorialEnabled() === null && !$previousTransaction)
                $transaction->setTutorialEnabled(true);

            if ($transaction->getTutorialEnabled())
            {
                // in first Transaction give a article gift
                if ($appShop->getTutorialPromoCode() && !$previousTransaction)
                {
                    $transaction
                        ->setTutorialPromoCode($appShop->getTutorialPromoCode())
                    ;
                }
            }
        }

        if ($transaction->getExternalStore())
        {
            $this->configureTransactionByExternalStore($transaction, $transaction->getExternalStore());
        }

        if ($transaction->getSelectedArticle() && $transaction->getSelectedAppTab() == null)
        {
            $appShopHasAppTabs = $this->em->getRepository("AppBundle:AppShopHasAppTab")
                ->findByAppIdAndCountryAndLevelCategoryAndLevelCategoryIdAndStatus(
                    $transaction->getApp()->getId(),
                    null,
                    null,
                    $transaction->getLevelCategory()->getId(),
                    $transaction->getAppTabsAvailable()->toArray(),
                    [$transaction->getSelectedArticle()],
                    $transaction->getPayMethodsAvailable()->toArray(),
                    $transaction->getExternalStore()
                );

            if (count($appShopHasAppTabs) > 0)
            {
                $transaction->setSelectedAppTab($appShopHasAppTabs[0]->getAppTab());
            }
        }

        if ($transaction->getGamer()->isForTesting())
            $transaction->setTest(true);

        if ($ip){
            $transaction->setCountryDetected( $this->ipInfoService->getCountryFromIp($ip) );
            $transaction->setGamerIp($ip);
        }


        $this->validate($transaction, 'transactionBasic');

        $this->em->persist($transaction->getGamer());

        $this->em->persist($transaction);
        $this->logger->addInfo("Transaction created id:".$transaction->getId());
        $this->em->flush();

        return $transaction;
    }

    public function createTransactionCLI($credentialsCodeKey, $gamerExternalId, $lang = null, $customParam=null, $test=false, $filterFastRequests=true, $url_notification=null)
    {
        $appApiCredentials = $this->em->getRepository("AppBundle:AppApiCredentials")->findByCodeKeyAndActive($credentialsCodeKey);
        $level = $appApiCredentials->getApp()->getappShops()[0]->getValueLower();

        $transaction = $this->createTransactionParams($credentialsCodeKey, $gamerExternalId, $level, true, $lang, [], [],
            null, false, [], [], null, $customParam, null, null, $test,null,null,$filterFastRequests, $url_notification);

        $transaction
            ->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
                    TransactionStatusCategoryEnum::SHOPPING_ID
                ))
            ->setCli(true)
        ;

        $this->em->flush();

        return $transaction;
    }

    protected function validate(Transaction $transaction, $extraValidate = 'custom')
    {
        $errorList = $this->validator->validate($transaction, null, ['Default', $extraValidate]);

        if ($errorList->count() > 0 )
        {
            $this->em->detach($transaction->getGamer());
            $this->em->detach($transaction);

            $this->logger->addError("Error validation Transaction" . $errorList);

            throw new TransactionCreateValidateException($errorList);
        }
    }

    public function createTransactionCustom(Transaction $transaction)
    {
        $transaction
            ->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
                    TransactionStatusCategoryEnum::SHOPPING_ID
                ))->removeFieldsUnnecessaryToCustom()
        ;

        $this->validate($transaction, 'custom');

        $this->em->persist($transaction->getGamer());
        $this->em->persist($transaction);

        $this->em->flush();
    }

    /**
     * @param \AppBundle\Entity\Transaction $transaction
     * @param string $externalStore
     * @return $this
     */
    private function configureTransactionByExternalStore(Transaction $transaction, $externalStore)
    {
        $transaction->setExternalStore($externalStore);

        // custom configuration
        switch ($externalStore)
        {
            case ExternalStoreEnum::FACEBOOK:

                $transaction
                    ->setHasPayMethodsSection(false)
                    ->setForceGenericPMPC(ExternalStoreEnum::FACEBOOK)
                    ->setHasCart(false)
                ;

                break;
            case ExternalStoreEnum::STEAM_WEB:
                $transaction
                    ->setHasPayMethodsSection(false)
                    ->setForceGenericPMPC(ExternalStoreEnum::STEAM_WEB)
                    ->setHasCart(true)
                ;
                break;
            case ExternalStoreEnum::STEAM:

                $transaction
                    ->setHasPayMethodsSection(false)
                    ->setForceGenericPMPC(ExternalStoreEnum::STEAM)
                    ->setHasCart(true)
                ;

                break;
        }

        return $this;
    }
}
