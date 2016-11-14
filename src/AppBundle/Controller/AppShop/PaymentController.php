<?php

namespace AppBundle\Controller\AppShop;

use AppBundle\Controller\Api\AbstractAPI;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Language;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaException;
use AppBundle\Exception\NviaHackSecurityException;
use AppBundle\Exception\NviaShowCustomResponseErrorException;
use AppBundle\Logger\StreamHandlerDynamicFile;
use AppBundle\Payment\PayMethod\Exceptions\AbstractItemRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\IntermediateStepExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodExecutionInUrlCancel;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodExecutionInUrlOK;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodOnlyOneStepExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use AppBundle\Payment\PayMethod\Interfaces\SubscriptionCancelInterface;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Payment\Util\PaymentRedirect;
use AppBundle\Security\Authentication\Token\STransactionShopToken;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Lexik\Bundle\TranslationBundle\Translation\Translator;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

/**
 * @Route("/payment")
 */
class PaymentController extends AbstractAPI
{
    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var TraceableEventDispatcherInterface
     * @Inject("event_dispatcher")
     */
    public $eventDispatcher;

    /**
     * @var Translator
     * @Inject("translator")
     */
    public $translator;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    public static $loggerInit=false;
    /** @var StreamHandlerDynamicFile */
    public static $loggerStatic;

    /**
     * Transaction with only price currency
     *
     * @Route("/begin/simple_transaction/{transaction_id}/{_locale}/{pmpc_id}", name="payment_begin_simple_transaction", options={"expose"=false}, defaults={"article_title" = "", "article_description" = ""})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("payMethodProviderHasCountry", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pmpc_id"})
     * @ParamConverter("language", class="AppBundle:Language", options={"id" = "_locale"})
     */
    public function beginSimpleTransactionAction(Language $language, Transaction $transaction,
        PayMethodProviderHasCountry $payMethodProviderHasCountry, Request $request)
    {
        $paymentService = $payMethodProviderHasCountry->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();
        $service = $this->getPayMethodService($paymentService);

        $this->addSpecialLogByPayMethod($request, $paymentService, 'i');

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_TRANSACTION_PAYMENT_CHECK_IN'))
            throw new AccessDeniedException('haven\'t role "ROLE_TRANSACTION_PAYMENT_CHECK_IN"');

        if (!$transaction->getCustomAmount() || !$transaction->getCustomCurrency())
            throw new BadRequestHttpException('Invalid Transaction');

        // validate and redirect if payment is completed
        if (true !== $response = $this->transactionIsFinished($transaction) )
            return $response;

        $this->translator->setLocale($language->getId());

        $previousStep = $this->executePreviousStep(
            $service,
            new PaymentPreviousStepsInteract([], $language, $payMethodProviderHasCountry, $transaction, $request)
        );

        if ($previousStep instanceof Response)
            return $previousStep;

        $price = $this->currencyService->getExchangeSimple(
            $transaction->getCustomAmount(), $transaction->getCustomCurrency(), $payMethodProviderHasCountry->getCurrency()->getId()
        );

        /** @var SingleCustomPayment $paymentProcess */
        $paymentProcess = $this->paymentProcessService->createPaymentProcessCLI(
            [], // Empty articles because only need amount and currency
            ArticleCategoryEnum::CUSTOM_PAYMENT_ID,
            $transaction,
            $payMethodProviderHasCountry->getPayMethod(),
            $price,
            $payMethodProviderHasCountry->getCurrency()->getId(),
            $payMethodProviderHasCountry->getProvider()->getName(),
            $language->getId(),
            $request->getClientIp()
        );

        $paymentProcess
            ->setArticleTitle($transaction->getCustomArticleTitle())
            ->setArticleDescription($transaction->getCustomArticleDescription())
        ;

        $this->em->flush();

        list($ipnUrl, $doneUrl, $cancelUrl) = $this->generateFinalUrls($paymentProcess, $language->getId());

        $this->logger->addInfo("Created ipn url: '$ipnUrl'");

        $paymentPrepare = new PaymentPrepareInteract(
            $paymentProcess,
            [],
            $request,
            $this->get('translator'),
            $ipnUrl,
            $doneUrl,
            $cancelUrl,
            $this->logger
        );

        $this->logger->addInfo("Created ipn url: '$ipnUrl'");

        // prepare to generate new provider url
        $service->executePaymentPrepare($paymentPrepare);

        $paymentProcess
            ->setRequest($paymentPrepare->getRequestToDo()->getUri(), $paymentPrepare->getRequestToDo()->request->all(), $paymentPrepare->getSubRequestDone())
        ;
        $this->em->flush();

        $image = $transaction->getApp()->getLogo();
        $provider = $this->container->get($image->getProviderName());
        $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'shop'));

        $response = PaymentRedirect::getResponse($paymentPrepare->getRequestToDo(), $url);

        $this->logger->addInfo("Created new payment '".$paymentProcess->getId()."' and redirecting ".
            $paymentPrepare->getRequestToDo()->getUri()
        );

        return $response;
    }

    /**
     * @Route("/begin/{transaction_id}/{_locale}/{pmpc_id}/{article_ids}/{country}", name="payment_begin", options={"expose"=true})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("language", class="AppBundle:Language", options={"id" = "_locale"})
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     */
    public function beginAction(Language $language, Transaction $transaction,
        $pmpc_id, $article_ids, Request $request, Country $country)
    {
        try{
            $country = $this->verifyValidCountry($transaction, $country);

            if ($transaction->getCustomAmount() !== null)
                throw new BadRequestHttpException('Is a invalid transaction (CustomAmount) only valid on directPayment');

            if (!$payMethodProviderHasCountry = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByGeneralPMPCOrId($pmpc_id, $country->getId()))
                throw new BadRequestHttpException("pmpc $pmpc_id is not valid for country " . $country->getId() );

            $paymentServiceId = $payMethodProviderHasCountry->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();
            $service = $this->getPayMethodService($paymentServiceId);

            $this->addSpecialLogByPayMethod($request, $paymentServiceId, 'i');

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_TRANSACTION_PAYMENT_CHECK_IN'))
                return $this->redirectToRoute("shop_finished", ['transaction_id' => $transaction->getId()]);

            if (true !== $response = $this->transactionIsFinished($transaction) )
                return $response;

            $this->translator->setLocale($language->getId());

            $previousStep = $this->executePreviousStep(
                $service,
                new PaymentPreviousStepsInteract([], $language, $payMethodProviderHasCountry, $transaction, $request)
            );

            if ($previousStep instanceof Response)
                return $previousStep;

            $appShop = $this->getDoctrine()->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory(
                $transaction->getApp()->getId(),
                $transaction->getLevelCategory()->getId()
            );

            $appShopHasArticles = $this->parseArticleIdsToObject($article_ids, $payMethodProviderHasCountry, $appShop, $country);

            /** @var ArticleService $articleService */
            $articleService = $this->get("shop_app.article");
            $smsId = $request->get('sms_id');
            $voiceId = $request->get('voice_id');
            $articleService->verifyArticlesAndPayMethodAreOk($appShopHasArticles, $payMethodProviderHasCountry, $transaction, $smsId, $voiceId);

            $previousStep = $this->executePreviousStep(
                $service,
                new PaymentPreviousStepsInteract($appShopHasArticles, $language, $payMethodProviderHasCountry, $transaction, $request)
            );

            if ($previousStep instanceof Response)
                return $previousStep;


            $paymentProcess = $this->paymentProcessService->createPaymentProcess(
                $appShopHasArticles, $payMethodProviderHasCountry, $transaction, $request, $language
            );

            $transaction->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID)
            );

            $this->em->flush();

            list($ipnUrl, $doneUrl, $cancelUrl) = $this->generateFinalUrls($paymentProcess, $language->getId());

            if ($service instanceof PayMethodOnlyOneStepExecutionInterface)
            {
                $service->executeOnlyOneStep(new PaymentIpnInteract($paymentProcess, $request, $this->container, $paymentServiceId));
                return new RedirectResponse($doneUrl);
            }
            $this->logger->addInfo("Created cancel url: '$cancelUrl'");
            $paymentPrepare = new PaymentPrepareInteract(
                $paymentProcess,
                $appShopHasArticles,
                $request,
                $this->get('translator'),
                $ipnUrl,
                $doneUrl,
                $cancelUrl,
                $this->logger
            );

            $this->logger->addInfo("Created ipn url: '$ipnUrl'");

            // prepare to generate new provider url
            $service->executePaymentPrepare($paymentPrepare);

            if (!$paymentPrepare->getRequestToDo() && !$paymentPrepare->getResponseToDo())
            {
                $paymentProcess
                    ->setRequest('not available', [], $paymentPrepare->getSubRequestDone())
                    ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")->find(PaymentStatusCategoryEnum::FAILED_ID)
                );
                $this->em->flush();
                $this->logger->addCritical("Could not create the request for payment, transaction id: ". $transaction->getId().", service: $paymentServiceId");

                throw new NviaException(NviaException::MESSAGE_STANDARD, NviaException::PAYMENT_CANT_GENERATE_PAYMENT);
            }

            if ($paymentPrepare->getRequestToDo())
            {
                $url = $paymentPrepare->getRequestToDo()->getUri();
                $params = $paymentPrepare->getRequestToDo()->request->all();
            }

            if ($paymentPrepare->getResponseToDo())
            {
                $url = $paymentPrepare->getResponseToDo()->getContent();
                $params = [];
            }

            $paymentProcess
                ->setRequest($url, $params, $paymentPrepare->getSubRequestDone())
                ->setStatusCategory($this->em->getRepository("AppBundle:PaymentStatusCategory")
                    ->find(PaymentStatusCategoryEnum::PROCESSING_ID)
                )
            ;
            $this->em->flush();
            $this->logger->addInfo("Created new payment '".$paymentProcess->getId());

            if ($paymentPrepare->getResponseToDo())
            {
//                $this->logger->addInfo("Response To Do:".$paymentPrepare->getResponseToDo());
//                $this->logger->addInfo("Response Contents".$paymentPrepare->getResponseToDo()->getContent());
                return $paymentPrepare->getResponseToDo();
            }

            $image = $transaction->getApp()->getLogo();
            $provider = $this->container->get($image->getProviderName());
            $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'shop'));

            $response = PaymentRedirect::getResponse($paymentPrepare->getRequestToDo(), $url);
            $this->logger->addInfo("redirecting ".$paymentPrepare->getRequestToDo()->getUri());

        }catch (\Exception $e){

            $this->logger->addError(get_class($e). '('.$e->getLine().'): ' . $e->getMessage());

            if ($this->container->getParameter('kernel.environment') === 'prod')
                throw new NviaShowCustomResponseErrorException('@App/AppShop/Error/begin_payment_error.html.twig', [], $e->getMessage(), $e->getCode());
            else
                throw $e;
        }

        return $response;
    }

    /**
     * @param $service
     * @param \AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract $paymentPreviousStepsInteract
     * @return null|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function executePreviousStep($service, PaymentPreviousStepsInteract $paymentPreviousStepsInteract)
    {
        if ($service instanceof PreviousStepInterface)
        {
            try{

                $result = $service->executePreviousStep($paymentPreviousStepsInteract);

                if ($result instanceof Response)
                    return $result;

            }catch (AbstractItemRequiredPayMethodException $e){

                $request = $paymentPreviousStepsInteract->getRequest();
                $request->getSession()->set('url_to_pay', $request->getUri());

                return new RedirectResponse($this->generateUrl(
                    $e->getUrlAlias(),
                    [
                        '_locale'        => $paymentPreviousStepsInteract->getLanguage()->getId(),
                        'transaction_id' => $paymentPreviousStepsInteract->getTransaction()->getId(),
                        'pmpc_id'        => $paymentPreviousStepsInteract->getPayMethodProviderHasCountry()->getId(),
                        'groups'         => $e->getGroups()
                    ]
                ));
            }
        }

        return null;
    }



    private function generateFinalUrls(PaymentProcessInterface $paymentProcess, $locale)
    {
        $paymentDetail = $paymentProcess->getPaymentDetail();

        $commonParams = [
            'payment_process_id' => $paymentProcess->getId(),
            'transaction_id'     => $paymentDetail->getTransaction()->getId(),
            '_locale'            => strtolower($locale),
        ];

        return
            [
                $this->router->generate('payment_ipn',    array_merge($commonParams, ['security_random' => $paymentDetail->getSecurityRandomIpn()]), true),
                $this->router->generate('payment_done',   array_merge($commonParams, ['security_random' => $paymentDetail->getSecurityRandomDone()]), true),
                $this->router->generate('payment_cancel', array_merge($commonParams, ['security_random' => $paymentDetail->getSecurityRandomCancel()]), true),
            ]
        ;

    }

    /**
     * @Route("/ipn/cancel/{transaction_id}/subscription/{subscription_id}/{security}", name="cancel_subscription", options={"expose"=false})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("subscription", class="AppBundle:Subscription", options={"id" = "subscription_id"})
     */
    public function ipnCancelSubscription(Transaction $transaction, Subscription $subscription, Request $request, $security)
    {
        $paymentDetail = $subscription->getPaymentDetail();

        if ($transaction->getId() !== $subscription->getTransactionId())
            throw new BadCredentialsException("Not same transaction Id");

        if ($security !== $paymentDetail->getSecurityRandomIpn())
            throw new BadCredentialsException("Bad Security");

        if ($subscription->getStatusCategory()->getId() !== PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID)
            throw new BadRequestHttpException("Subscription is not active");

        $pmpc = $this->paymentProcessService->getPMPCFromPaymentProcess($subscription);

        $paymentServiceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();
        $this->addSpecialLogByPayMethod($request, $paymentServiceId, 'in');

        $service = $this->getPayMethodService($paymentServiceId);
        if ($service instanceof SubscriptionCancelInterface)
        {
            try{
                $service->cancelSubscription($subscription);
                $subscriptionFinishedService = $this->get('shop.subscription.finished');
                $subscriptionFinishedService->execute($subscription);

                return new Response();

            }catch (\Exception $e){
                $this->logger->addError($e->getMessage());
            }
        }

        return new Response('', 202);
    }

    /**
     * This url is a bridge to ipn because some providers can be a static callback url
     * is required transaction_id like xsolla, rixty ...
     *
     * @Route("/ipn_static/{service_id}/", defaults={"_format" = "json" }, name="payment_ipn_static")
     */
    public function ipnStaticAction(Request $request, $service_id)
    {
        $this->addSpecialLogByPayMethod($request, $service_id);
        $this->logger->addInfo(" === IPN STATIC ===");

        $obj = $this->container->get('shop.payment.'.$service_id, ContainerInterface::IGNORE_ON_INVALID_REFERENCE);

        if (!$obj instanceof PayMethodIpnStaticExecutionInterface)
            throw new BadRequestHttpException("Trying to call this service: 'shop.payment.$service_id'");

        try{
            $paymentProcess = $obj->ipnStaticWhichPaymentIsIt($request);

        }catch (\Exception $e){
            $this->logger->addError($e->getMessage());
            throw $e;
        }

        // fast exit to ignore request
        if ($paymentProcess && $paymentProcess instanceof Response)
        {
            $this->logger->addInfo("Status: ".$paymentProcess->getStatusCode(). ", content: ".$paymentProcess->getContent());
            return $paymentProcess;
        }

        if (!$paymentProcess || !$paymentProcess instanceof PaymentProcessInterface)
        {
            $this->logger->addError("can't know which payment is it, response was: ".gettype($paymentProcess));
            throw new BadRequestHttpException();
        }

        $transaction = $paymentProcess->getPaymentDetail()->getTransaction();
        $this->logger->addInfo("Payment process detected, transaction ".$transaction->getId()." linked, service: $service_id");
        $this->get('shop.logger.transaction_helper')->changeLogFileByTransaction($transaction);

        // Create User Session dynamic to internal redirect
        $authenticatedToken = new STransactionShopToken($transaction->getRoles());
        $authenticatedToken->setUser($transaction);

        $this->get('security.token_storage')->setToken($authenticatedToken);
        // internal redirect if provider haven't follow redirect it hasn't a trouble :)
        return $this->forward('AppBundle:AppShop/Payment:ipn',
            [
                'payment_process_id' => $paymentProcess->getId(),
                '_locale' => $paymentProcess->getPaymentDetail()->getLanguage()->getId(),
                'transaction_id' => $paymentProcess->getPaymentDetail()->getTransaction()->getId(),
                'security_random' =>$paymentProcess->getPaymentDetail()->getSecurityRandomIpn(),
            ],
            array_merge($request->query->all(), $request->request->all())
        );
    }

    /**
     * @Route("/ipn/{payment_process_id}/{_locale}/{transaction_id}/{security_random}", name="payment_ipn")
     */
    public function ipnAction(Request $request, $payment_process_id, $security_random)
    {
        $paymentProcess = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);
        $paymentProcess->addResponse(['GET' => $request->query->all(), 'POST' => $request->request->all() ]);
        $this->em->flush();

        $paymentDetail = $paymentProcess->getPaymentDetail();
        $pmpc = $this->paymentProcessService->getPMPCFromPaymentProcess($paymentProcess);

        $paymentServiceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();

        $this->addSpecialLogByPayMethod($request, $paymentServiceId, 'in');
        // Add info especially to payMethod
        $this->logger->addInfo(" === IPN NORMAL ===");

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_TRANSACTION_PAYMENT_CHECK_OUT'))
            throw new AccessDeniedException('haven\'t role "ROLE_TRANSACTION_PAYMENT_CHECK_OUT"');

        if ($paymentDetail->getSecurityRandomIpn() != $security_random)
            throw new NviaHackSecurityException(NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

        $paymentIpnInteract = new PaymentIpnInteract($paymentProcess, $request, $this->container, $paymentServiceId);

        try{

            $service = $this->getPayMethodService($paymentServiceId);
            $service->executePaymentIpn($paymentIpnInteract);

            if ($paymentIpnInteract->getSubRequestDone())
            {
                $paymentProcess->addResponseSubRequestLast($paymentIpnInteract->getSubRequestDone());
            }

            $this->em->flush();

        }catch (\Exception $e){

            if ($paymentIpnInteract->getSubRequestDone()){
                $r=$paymentProcess->getResponses();
                $arr= end($r);
                $arr['subRequest'] = $paymentIpnInteract->getSubRequestDone();
            }

            $this->logger->addCritical($e->getMessage());

            $paymentProcess->getPaymentDetail()->getTransaction()->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::FAILED_ID)
            );
            $this->em->flush();

            throw $e;
        }

        $this->logger->addInfo("Our Response code: '".$paymentIpnInteract->getResponseResult()->getStatusCode().
            "', Our content: '" . $paymentIpnInteract->getResponseResult()->getContent() . "'"
        );

        return $paymentIpnInteract->getResponseResult();
    }

    /**
     * @Route("/intermediate-step/{payment_process_id}/{_locale}/{transaction_id}/{security_random}", name="intermediate_step")
     */
    public function intermediateStepAction(Request $request, $payment_process_id, $security_random)
    {
        $paymentProcess = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);
        $paymentProcess->addResponse(['GET' => $request->query->all(), 'POST' => $request->request->all() ]);
        $this->em->flush();

        $paymentDetail = $paymentProcess->getPaymentDetail();
        $pmpc = $this->paymentProcessService->getPMPCFromPaymentProcess($paymentProcess);

        $paymentServiceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();

        $this->addSpecialLogByPayMethod($request, $paymentServiceId, 'in');
        // Add info especially to payMethod
        $this->logger->addInfo(" === IPN PAYMENT HOSTED ===");

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_TRANSACTION_PAYMENT_CHECK_IN'))
            throw new AccessDeniedException('haven\'t role "ROLE_TRANSACTION_PAYMENT_CHECK_IN"');

        if ($paymentDetail->getSecurityRandomIpn() != $security_random)
            throw new NviaHackSecurityException(NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

        try{

            $service = $this->getPayMethodService($paymentServiceId);
            if (!$service instanceof IntermediateStepExecutionInterface)
                throw new \Exception('Service object is not a instance of PaymentHostedIntermediateStepExecutionInterface');

            $service->intermediateStep($request , $paymentProcess);

            $this->em->flush();

        }catch (\Exception $e){

            $this->logger->addCritical($e->getMessage());

            $paymentProcess->getPaymentDetail()->getTransaction()->setStatusCategory(
                $this->em->getRepository("AppBundle:TransactionStatusCategory")->find(TransactionStatusCategoryEnum::FAILED_ID)
            );
            $this->em->flush();

            throw $e;
        }
    }

    /**
     * @Route("/refund/{purchase_id}/{_locale}/{transaction_id}/{security_random}", name="payment_refund")
     */
    public function RefundAction(Request $request, $purchase_id, $security_random)
    {
        if (!$purchase = $this->em->getRepository("AppBundle:Purchase")->find($purchase_id))
            throw new NotFoundHttpException('purchase not found');

        $this->logger->addInfo("REFUND REQUEST ACTION, reason ". $request->get('reason'));

        $payment = $purchase->getPayment();
        $paymentDetail = $payment->getPaymentDetail();
        $pmpc = $this->paymentProcessService->getPMPCFromPaymentDetail($paymentDetail);

        $paymentServiceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();

        $this->addSpecialLogByPayMethod($request, $paymentServiceId, 'refund');

        if (!$this->get('security.authorization_checker')->isGranted(RoleEnum::TRANSACTION_PAYMENT_REFUND))
            throw new AccessDeniedException('haven\'t role "'.RoleEnum::TRANSACTION_PAYMENT_REFUND.'"');

        if ($paymentDetail->getSecurityRandomRefund() != $security_random)
            throw new NviaHackSecurityException(NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

        if (!$purchase->getRefundEnabled())
            throw new BadRequestHttpException('This purchase cant make a refund');

        $service = $this->getPayMethodService($paymentServiceId);

        if (!$service instanceof PayMethodRefundExecutionInterface)
        {
            $this->logger->addInfo("Trying to make a refund but this pay method has not refund implemented");
            return new Response('', 202);
        }

        try{

            if($service->executeRefund($payment, $request->get('reason', 'refund'), true))
            {
                $this->logger->addInfo("Refund success");
                return new Response();
            }

            $this->logger->addError("executeRefund: return false");

        }catch (\Exception $e){
            $this->logger->addError($e->getMessage());
        }

        return new Response('', 202);
    }

     /**
     * @Route("/done/{transaction_id}/{_locale}/{payment_process_id}/{security_random}", name="payment_done")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function doneAction(Request $request, $payment_process_id, Transaction $transaction, $security_random, $_locale)
    {
        return $this->getFinalView($payment_process_id, $security_random, $request, 'done');
    }

    /**
     * @Route("/done_static/{serviceId}/", name="payment_done_static")
     */
    public function doneStaticAction(Request $request, $serviceId)
    {
        return $this->render('AppBundle:AppShop/Payment/done:default.html.twig', ['state' => 'done']);
    }

    /**
     * @Route("/cancel_static/{serviceId}/", name="payment_cancel_static")
     */
    public function cancelStaticAction(Request $request, $serviceId)
    {
        return $this->render('AppBundle:AppShop/Payment/cancel:default.html.twig', ['state' => 'cancel']);
    }

    /**
     * @Route("/cancel/{transaction_id}/{_locale}/{payment_process_id}/{security_random}", name="payment_cancel")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Security("has_role('ROLE_TRANSACTION_PAYMENT_CANCELLED')")
     */
    public function cancelAction(Request $request, $payment_process_id, Transaction $transaction, $security_random)
    {
        return $this->getFinalView($payment_process_id, $security_random, $request, 'cancel');
    }

    /**
     * @param $paymentProcessId
     * @param $securityRandom
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $folderView
     * @throws \AppBundle\Exception\NviaHackSecurityException
     * @return Response
     */
    private function getFinalView($paymentProcessId, $securityRandom, Request $request, $folderView='done')
    {
        $paymentProcess = $this->paymentProcessService->getPaymentProcessObjectById($paymentProcessId);
        $paymentDetail = $paymentProcess->getPaymentDetail();

        if (($folderView == 'done' && $paymentDetail->getSecurityRandomDone() != $securityRandom) || ($folderView =='cancel' && $paymentDetail->getSecurityRandomCancel() != $securityRandom) )
            throw new NviaHackSecurityException(NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::TRYING_TO_MANIPULATE_URLS);

        $pmpc = $this->paymentProcessService->getPMPCFromPaymentProcess($paymentProcess);
        $serviceId = $pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();
        $service = $this->get($serviceId);

        if ($folderView === 'done' && $service instanceof PayMethodExecutionInUrlOK)
        {
            $this->logger->addInfo("execute executeInUrlOK");
            $service->executeInUrlOK($paymentProcess, $request);
        }

        if ($folderView === 'cancel' && $service instanceof PayMethodExecutionInUrlCancel)
        {
            $this->logger->addInfo("execute executeInUrlCANCEL");
            $execution = $service->executeInUrlCancel($paymentProcess, $request);

            if ($execution instanceof Response)
                return $execution;
        }

        $folder= 'AppBundle:AppShop/Payment/'.$folderView;

        $templateToLoad=$folder.":default.html.twig";

        $serviceTemplate = $folder.":$serviceId.html.twig";

        $engine = $this->get('templating');

        // Override default template if exist
        if ($engine->exists($serviceTemplate))
            $templateToLoad = $serviceTemplate;

        return new Response($engine->render($templateToLoad, ['state' => $folderView]));
    }

    /**
     * @param Transaction $transaction
     * @return bool|RedirectResponse
     * @throws \AppBundle\Exception\NviaException
     */
    private function transactionIsFinished(Transaction $transaction)
    {
        if (in_array($transaction->getStatusCategory()->getId(), [TransactionStatusCategoryEnum::COMPLETED_ID,
            TransactionStatusCategoryEnum::PENDING_PAYMENT_ID]) )
        {
            if (!$payment = $this->em->getRepository("AppBundle:Payment")->findByTransactionIdAndState($transaction->getId()))
                throw new NviaException(NviaException::MESSAGE_STANDARD, NviaException::TRANSACTION_HAVE_STATE_COMPLETE_BUT_DOESNT_PAYMENT);

            return new RedirectResponse($this->router->generate('payment_done', ['payment_id' => $payment[0]->getId()]));
        }

        return true;
    }

    /**
     * @param $articleIds
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @param \AppBundle\Entity\AppShop $appShop
     * @param \AppBundle\Entity\Country $countryConfigured
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     * @return AppShopHasArticle[]
     */
    private function parseArticleIdsToObject($articleIds, PayMethodProviderHasCountry $payMethodProviderHasCountry, AppShop $appShop, Country $countryConfigured)
    {
        $articleIds= explode(',', $articleIds);
        $appShopHasArticles = [];

        foreach ($articleIds as $articleId)
        {
            $appShopHasArticle = $this->getDoctrine()->getRepository("AppBundle:AppShopHasArticle")
                ->findOneById($countryConfigured->getId(), $appShop->getId(), $articleId);

            if (!$appShopHasArticle)
            {
                throw new UnprocessableEntityHttpException("Article search with id $articleId, country ".
                    $payMethodProviderHasCountry->getCountry()->getId().", appShopId: ".$appShop->getId().", doesn't exist");
            }

            $appShopHasArticles[] = $appShopHasArticle;
        }

        return $appShopHasArticles;
    }

    /**
     * @param $paymentService
     * @return PayMethodIpnInterface
     * @throws \AppBundle\Exception\NviaException
     */
    private function getPayMethodService($paymentService)
    {
        if (!$service = $this->container->get($paymentService, ContainerInterface::NULL_ON_INVALID_REFERENCE))
        {
            $this->logger->addCritical("service '$paymentService' doesn't exist");
            throw new NviaException(NviaException::MESSAGE_STANDARD, NviaException::SERVICE_DOESNT_EXIST);
        }

        return $service;
    }

    private function addSpecialLogByPayMethod(Request $request, $idServicePaymentMethod, $action='in')
    {
        if (static::$loggerInit == $idServicePaymentMethod)
            return;

        $idServicePaymentMethod = str_replace('shop.payment.', '', $idServicePaymentMethod);
        $fileName = $idServicePaymentMethod.'_'.$action.'.log';

        if (!static::$loggerStatic)
        {
            static::$loggerStatic = $this->get('shop.logger.dynamic_handler');
            $this->logger->pushHandler(static::$loggerStatic);
        }

        static::$loggerStatic->changeByPath('pay_methods', $fileName);
        static::$loggerInit = $idServicePaymentMethod;

        static::$loggerStatic->writeHeader($request);
    }

}
