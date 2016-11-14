<?php

namespace AppBundle\Controller\Api;


use AppBundle\Command\TransactionCreateCommand;
use AppBundle\Command\TransactionCreateValidateException;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\SinglePayment;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\TransactionTemp;
use AppBundle\Exception\NviaException;
use AppBundle\Form\Type\Api\TransactionApiType;
use AppBundle\Form\Type\Api\TransactionCustomApiType;
use AppBundle\Form\Type\Api\TransactionCustomArticlesApiType;
use AppBundle\Form\Type\Api\TransactionCustomWidgetApiType;
use AppBundle\Form\Type\Api\TransactionVirtualCurrencyApiType;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use AppBundle\Payment\Actions\PaymentCompleted;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use AppBundle\Service\BlacklistService;
use AppBundle\Service\CountryService;
use AppBundle\Traits\StopWatchTrait;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Util\Codes;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Monolog\Logger;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class TransactionController extends AbstractAPI
{
    use StopWatchTrait;

    /**
     * @DI\Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var PaymentProcessService
     * @DI\Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var TransactionCreateCommand
     * @DI\Inject("shop.command.transaction.create")
     */
    public $transactionCreateService;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     * @DI\Inject("session")
     */
    public $session;

    /**
     * @var PaymentCompleted
     * @DI\Inject("shop.payment.completed")
     */
    public $paymentCompletedService;

    /**
     * @var ContainerInterface
     * @DI\Inject("service_container")
     */
    public $container;

    /**
     * @var StreamHandlerDynamicFileHelper
     * @DI\Inject("shop.logger.transaction_helper")
     */
    public $transactionLogger;

    /**
     * @var ArticleService
     * @DI\Inject("shop_app.article")
     */
    public $articleService;

    /**
     * @var CountryService
     * @DI\Inject("country")
     */
    public $countryService;

    /**
     * @var Logger
     * @DI\Inject("logger")
     */
    public $logger;

    /**
     * @DI\Inject("app.blacklist")
     * @var BlacklistService
     */
    public $blacklistService;

    private $isConcurrency;

    /**
     * Get url to start payment process with wolopay.
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   input = "AppBundle\Form\Type\Api\TransactionApiType",
     *   output={
     *      "class"   = "AppBundle\Entity\Transaction",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   statusCodes = {
     *     201 = "return all conf transaction, to make purchase redirect with url object property"
     *   }
     * )
     *
     * @Post("/transaction")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $_format
     * @return array
     */
    public function createTransactionAction(Request $request, $_format)
    {
        $this->throwExceptionIfItsGrantedByJWT();
        $this->stopWatchStart('Create Transaction');

        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();

        $transaction = new Transaction();
        $form = $this->createForm(new TransactionApiType(), $transaction, ['em'=> $em, 'app' => $app] );

        $form->submit($request);

        if (!$form->isValid())
        {
            $this->logger->addInfo((string) $form->getErrors(true) . 'params '. http_build_query($request->request->all()));
            return $this->handleView($this->view(['form'=> $form], Codes::HTTP_BAD_REQUEST));
        }
        // If is null tutorial enabled first time
        if ($request->request->get('tutorial_enabled') === null)
            $transaction->setTutorialEnabled(null);

        try{
            $transaction = $this->get('shop.command.transaction.create')->createTransaction($transaction);

        }catch (TransactionCreateValidateException $e){
            return $this->handleView($this->view(['form'=> $e->errorList], Codes::HTTP_UNPROCESSABLE_ENTITY));
        }catch (DBALException $e){

            if ($this->isConcurrency)
                throw new $e;

            if (!$this->em->isOpen()) {
                $this->em = $this->em->create(
                    $this->em->getConnection(),
                    $this->em->getConfiguration()
                );
            }

            $this->isConcurrency = true;
            $this->createTransactionAction($request, $_format);
        }

        $this->transactionLogger->changeLogFileByTransaction($transaction);

        $view = $this->view($transaction, 201);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Public')));

        $this->stopWatchStop('Create Transaction');

        return $this->handleView($view);
    }

    /**
     * Create a direct payment to existing articles with specified payment method.
     *
     * **Response Format**
     *
     *     {
     *        "url":"https:\/\/wolopay.com\/shop\/payment\/begin\/simple_transaction\/WOT_553770f7a7674\/es\/3"
     *     }
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   input = "AppBundle\Form\Type\Api\TransactionCustomArticlesApiType",
     *   statusCodes = {
     *     200 = "OK"
     *   }
     * )
     *
     * @Post("/transaction_articles")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function createTransactionDirectArticlesAction(Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();
        $this->stopWatchStart('Create Transaction Direct Articles');
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();

        $transaction = new Transaction();
        $form = $this->createForm(new TransactionCustomArticlesApiType(), $transaction, ['em'=> $em, 'app' => $app] );

        $form->submit($request);

        if (!$form->isValid()){
            $this->logger->addInfo((string) $form->getErrors(true) . 'params '. http_build_query($request->request->all()));
            return $this->handleView($this->view(['form'=> $form], Codes::HTTP_BAD_REQUEST));
        }
        $this->transactionLogger->changeLogFileByTransaction($transaction);

        $pmps = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findByPayMethodIdAndCanBeCustomTransaction(
            $transaction->getCustomPayMethod()->getId(), true
        );
//        $transaction->removeFieldsUnnecessaryToBasic(); //deletes custom_pay_method

        // we assume that pmp has oly one pay_method for transaction simple with CanBeCustomTransaction
        $pmp = $pmps[0];

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $transaction->getCustomPayMethod()->getId(), $pmp->getProvider()->getId(), $transaction->getCustomCountry()->getId()
        );

        $articleIds = $request->get('articles');

        /*
         * @Route("/begin/{transaction_id}/{_locale}/{pmpc_id}/{article_ids}/{country}", name="payment_begin", options={"expose"=true})
         */
        $url = $this->container->getParameter('domain_main').
            $this->generateUrl('payment_begin',
                [
                    'transaction_id' => $transaction->getId(),
                    'pmpc_id'        => $pmpc->getId(),
                    'article_ids'    => $articleIds,
                    'country'        => $transaction->getCustomCountry()->getId(),
                    '_locale'        => $transaction->getCustomCountry()->getLanguage()->getId()
                ]);

        $transaction
            ->setStatusCategory($this->em->getRepository("AppBundle:TransactionStatusCategory")->find(
                TransactionStatusCategoryEnum::SHOPPING_ID
            ));

        $this->em->persist($transaction->getGamer());
        $this->em->persist($transaction);
        $this->em->flush();

        $view = $this->view(['url' => $url ], Codes::HTTP_OK);
        return $this->handleView($view);
    }


    /**
     * Create a simple transaction to dynamic products.
     *
     * **Response Format**
     *
     *     {
     *        "url":"https:\/\/wolopay.com\/shop\/payment\/begin\/simple_transaction\/WOT_553770f7a7674\/es\/3"
     *     }
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   input = "AppBundle\Form\Type\Api\TransactionCustomApiType",
     *   statusCodes = {
     *     200 = "OK"
     *   }
     * )
     *
     * @Post("/transaction_simple")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function createTransactionCustomAction(Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();

        $transaction = new Transaction();
        $form = $this->createForm(new TransactionCustomApiType(), $transaction, ['em'=> $em, 'app' => $app] );

        $form->submit($request);

        if (!$form->isValid())
            return $this->handleView($this->view(['form'=> $form], Codes::HTTP_BAD_REQUEST));

        $this->transactionLogger->changeLogFileByTransaction($transaction);
        $this->transactionCreateService->createTransactionCustom($transaction);
        $this->transactionLogger->changeLogFileByTransaction($transaction);

        $pmps = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findByPayMethodIdAndCanBeCustomTransaction(
            $transaction->getCustomPayMethod()->getId(), true
        );

        // we assume that pmp has oly one pay_method for transaction simple with CanBeCustomTransaction
        $pmp = $pmps[0];

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $transaction->getCustomPayMethod()->getId(), $pmp->getProvider()->getId(), $transaction->getCustomCountry()->getId()
        );

        $url = $this->container->getParameter('domain_main').
            $this->generateUrl('payment_begin_simple_transaction', [
                'transaction_id' => $transaction->getId(),
                'pmpc_id'        => $pmpc->getId(),
                '_locale'        => $transaction->getCustomCountry()->getLanguage()->getId()
            ]);

        $view = $this->view(['url' => $url ], Codes::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Create a simple transaction to dynamic products in a beautiful widget to choose your favourite pay_method
     *
     * **Response Format**
     *
     *     {
     *        "url":"https:\/\/wolopay.com\/shop\/payment\/begin\/simple_transaction\/WOT_553778b9b3f07\/es\/3"
     *     }
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   input = "AppBundle\Form\Type\Api\TransactionCustomWidgetApiType",
     *   statusCodes = {
     *     200 = "OK"
     *   }
     * )
     *
     * @Post("/transaction_widget")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function createTransactionCustomWidgetAction(Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();

        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();

        $transaction = new Transaction();
        $form = $this->createForm(new TransactionCustomWidgetApiType(), $transaction, ['em'=> $em, 'app' => $app] );

        $form->submit($request);

        if (!$form->isValid())
            return $this->handleView($this->view(['form'=> $form], Codes::HTTP_BAD_REQUEST));

        $tempData=new TransactionTemp($transaction);

        $this->em->persist($tempData);
        $this->em->flush();

        $url = $this->container->getParameter('domain_main');
        $url .= $this->generateUrl('widget_select_pmpc', [
                'transaction_id' => $tempData->getId(),
                'pmpc_id'        => null
            ]);

        $view = $this->view(['url' => $url ], 200);

        return $this->handleView($view);
    }

    /**
     * Get all info about a transaction
     *
     * @ApiDoc(
     *   section = "Basic usage",
     *   output={
     *      "class"   = "AppBundle\Entity\Transaction",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/transaction/{transaction_id}")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     *
     * @param Transaction $transaction
     * @return array
     */
    public function getTransactionAction(Transaction $transaction)
    {
        $view = $this->view($transaction, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Public')));

        return $this->handleView($view);
    }

    /**
     * Get all info about a transaction, payment details, ...
     *
     * @Get("/transaction_info/{transaction_id}")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     *
     * @param Transaction $transaction
     * @return array
     */
    public function getTransactionInfoAction(Transaction $transaction)
    {
        $paymentProcess = null;

        if ($payments = $this->getDoctrine()->getRepository("AppBundle:Purchase")->findByTransaction($transaction->getId()))
        {
            $pay = $payments[0]->getPayment();

            if ($pay instanceof SinglePayment)
                $paymentProcess = $pay;
            else if ($pay instanceof SubscriptionEventualityPayment)
                $paymentProcess = $pay->getSubscriptionEventuality()->getSubscription();
        }

        $view = $this->view(['transaction' => $transaction, 'payments' => $payments, 'payment_process' => $paymentProcess], 200);
        $view->setSerializationContext(
            SerializationContext::create()->setGroups(
                array(
                    'Default',
                    'ArticleOnlyName',
                    'PurchaseNotificationAddPaymentDetailArticlesHasGivenArticle',
                    'PaymentDetailHasArticlesAddPaymentDetailArticlesHasGivenArticles'
                )
            )
        );

        return $this->handleView($view);
    }

    /**
     * Virtual Currency exchange
     *
     * @ApiDoc(
     *   input = "AppBundle\Form\Type\Api\TransactionVirtualCurrencyApiType",
     *   output={
     *      "class"   = "AppBundle\Entity\Purchase",
     *      "groups"  = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   statusCodes = {
     *     201 = "return purchase object",
     *     200 = "Notification error with game"
     *   }
     * )
     *
     * @Post("/virtual_currency/exchange")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @throws \AppBundle\Exception\NviaException
     * @throws \Symfony\Component\Security\Core\Exception\BadCredentialsException
     * @return array
     */
    public function postVirtualCurrencyExchangeAction(Request $request)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();

        $transaction = new Transaction();

        $form = $this->createForm(new TransactionVirtualCurrencyApiType(), $transaction,
            [
                'em'=> $this->em,
                'app' => $appCredentials->getApp(),
                'countryService' => $this->countryService,
            ] );
        $form->submit($request);

        if (!$form->isValid())
            return $this->handleView($this->view(['form'=> $form], Codes::HTTP_BAD_REQUEST));

        if ($transaction->getApp()->getId() !== $appCredentials->getApp()->getId())
            throw new BadCredentialsException("u cant choose this notification, because is not from your app");

        if (!$payMethod = $this->em->getRepository("AppBundle:PayMethod")->findOneBy(['name' => PayMethodEnum::VIRTUAL_CURRENCY_NAME]))
            throw new NviaException("Pay Method Virtual Currency doesn't exist");

        try{

            $transaction->setCli(true);
            $ip = $form->get("gamer_ip")->getData();

//            if ($reason=$this->blacklistService->isForbiddenByBlackLists($transaction, null, $ip)) {
//                if ($reason==TransactionStatusCategoryEnum::BLACKLISTED_GAMER)
//                    throw new HttpException("403", "Blacklisted User");
//
//                if ($reason==TransactionStatusCategoryEnum::BLACKLISTED_IP)
//                    throw new HttpException("403", "Blacklisted IP");
//
//                if ($reason==TransactionStatusCategoryEnum::BLACKLISTED_COUNTRY)
//                    throw new HttpException("403", "Blacklisted Country");
//
//            }

            $this->get('shop.command.transaction.create')->createTransaction($transaction, $ip,false);

            $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdAndLevelCategory(CountryEnum::SPAIN,
                $transaction->getArticleVirtualCurrency()->getId(),
                $transaction->getLevelCategory()->getId()
            );

            $paymentProcess = $this->paymentProcessService->createPaymentProcessCLI(
                [$transaction->getArticleVirtualCurrency()],
                ArticleCategoryEnum::SINGLE_PAYMENT_ID,
                $transaction,
                $payMethod,
                $appShopHasArticle->getCurrentAmount(),
                $appShopHasArticle->getCountry()->getCurrency(),
                ProviderEnum::NVIA_NAME,
                LanguageEnum::ENGLISH,
                $ip
            );
            $purchase = $this->paymentCompletedService->execute($paymentProcess, 'VIRTUAL_'.time().rand(10,300000), null, null, true);

        } catch (TransactionCreateValidateException $e) {
            return $this->handleView($this->view(['form'=> $e->errorList], Codes::HTTP_UNPROCESSABLE_ENTITY));
        }

        $this->transactionLogger->changeLogFileByTransaction($transaction);


        $status = 201;
        if ($purchase->getWasCanceled())
            $status = 200;

        $view = $this->view($purchase, $status);

        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Public')));

        return $this->handleView($view);
    }

}
