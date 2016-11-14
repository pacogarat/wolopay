<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Component\HttpFoundation\CsvResponse;
use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Repository\AbstractRepository;
use AppBundle\Logger\StreamHandlerDynamicFileTransaction;
use AppBundle\Payment\Util\PaymentProcessService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @Route("/api")
 */
class PurchasesController extends AbstractController
{
    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var StreamHandlerDynamicFileTransaction
     * @Inject("shop.logger.transaction_handler")
     */
    public $transactionStreamHandler;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @Route("/purchases/toCsv/{app}/{date_from}/{date_to}/{currency}", name="admin_purchases_toCsv")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function purchasesToCSVAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        if (!$clientUser){
            $offset = 2;
        }else{
            $offset = $clientUser->getTimeOffsetInHours();
        }


        $headerArr =array();
        $r2 = array();
        $appId = $app->getId();

        $change = ($currency == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currency == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur '));

        $sql="
            SELECT  p.id as purchaseId,
                    CASE WHEN p.createdAt < :dateFrom THEN
                        DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), '%Y-%m-%d')
                      ELSE
                        DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), '%Y-%m-%d')
                      END as purchaseDate,

                    CASE WHEN p.createdAt < :dateFrom THEN
                        DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), '%H:%i:%s')
                      ELSE
                        DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), '%H:%i:%s')
                      END as purchaseTime,

                    t.id as transaction,
                    DATE_FORMAT(DATE_ADD(t.beginAt, $offset, 'hour'),'%Y-%m-%d') as transactionDate,
                    DATE_FORMAT(DATE_ADD(t.beginAt, $offset, 'hour'),'%H:%i:%s') as transactionTime,
                    pm.name as payMethod, g.gamerExternalId as gamer,
                    c.id as countryId, c.name as countryName,
                    IDENTITY (p.currency) as currencyId,
                    CASE WHEN ((p.amountTaxPaidByProvider + p.amountTax) <>0) THEN
                      c.vat
                    ELSE
                      0
                    END as taxPercent,
                    ROUND( p.amountTotal, 2) as amountTotal,
                    ROUND( (p.amountTaxPaidByProvider + p.amountTax), 2) as amountTax,
                    ROUND( p.amountTax, 2)   as amountTaxReceived,
                    ROUND( p.amountTaxPaidByProvider, 2) as amountTaxPaidByProvider,
                    ROUND( p.amountProvider, 2)  as totalAmountProviderIncludingTaxes,
                    ROUND( p.amountProvider-p.amountTaxPaidByProvider, 2)  as totalAmountProviderWithoutTaxes,
                    ROUND( p.amountWolo, 2) as amountWolopay,
                    ROUND( p.amountGame, 2) as amountGame,
                    $change,
                    ROUND( p.amountTotal * $change, 2) as amountTotalEur,
                    ROUND( (p.amountTax+p.amountTaxPaidByProvider) * $change, 2)  as amountTaxEur,
                    ROUND( p.amountTax   * $change, 2)  as amount_taxReceivedEur,
                    ROUND( p.amountTaxPaidByProvider * $change, 2)  as amountTaxPaidByProviderEur,
                    ROUND( p.amountProvider * $change, 2)  as total_amountProviderIncludingTaxesEur,
                    ROUND( (p.amountProvider-p.amountTaxPaidByProvider)*$change, 2)  as totalAmountProviderWithoutTaxesEur,
                    ROUND( p.amountWolo  * $change, 2)  as amountWolopayEur,
                    ROUND( p.amountGame  * $change, 2)  as amountGameEur,
                    CONCAT(ABS(ROUND(((p.amountProvider-p.amountTaxPaidByProvider)/p.amountTotal)*100,2)),'%')  as finalPaymethodFeePercent
            FROM
              AppBundle:Purchase p
              JOIN p.transaction t
              JOIN p.gamer g
              JOIN t.countryDetected c
              JOIN p.payMethod pm
          WHERE
              t.app = :appId
              AND t.test=0
              AND p.test=0
              AND ( (p.createdAt between :dateFrom AND :dateTo) )
        ";

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $sqlResult = $em
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$date_from, 'dateTo'=>$date_to]))
            ->getArrayResult()
        ;

        $header = "purchaseId,purchaseDate,purchaseTime,transactionId,transactionDate,tranasctionTime,payMethod,gamer,countryId,countryName,currency,taxPercent,".
            "amountPaid,amountTax,amountTaxReceived,amountTaxPaidByProvider,amountProviderIncludingTaxes,amountProviderWithoutTaxes,amountWolopay,amountGame, exchangeRate,".
            "amountPaidEur,amountTaxEur,amountTaxReceivedEur,amountTaxPaidByProviderEur,amountProviderIncludingTaxesEur,amountProviderWithoutTaxesEur,amountWolopayEur,amountGameEur,".
            "finalPaymethodFeePercent";

        $headerArr = explode(",",$header);
        array_push($r2,$headerArr );

        foreach ($sqlResult as $key=>&$line){
            array_push($r2,$line);
        }
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset= $clientUser->getTimeOffsetInHours();

        return new CsvResponse($r2,200,[],"purchases_". str_replace(" ","-",$app->getName())."_".$date_from->modify("+".$offset." hour")->format('Y-m-d')."_". $date_to->modify($offset." Hour")->format('Y-m-d').".csv");
    }


    /**
     * @Route("/purchases/{app}/{date_from}/{date_to}/{currency}", name="admin_purchases")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function statsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $page = $request->get('page') ?: 0;
        $rows = $this->getRows($request);

        if ($date_from->getTimestamp() > $date_to->getTimestamp())
            throw new BadRequestHttpException("date from is higher than date to");

        if (!in_array(RoleEnum::ADMIN_PURCHASES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $serializer = $this->get('jms_serializer');

        $purchases = $em->getRepository("AppBundle:Purchase")->findByAppIdAndDateRange($app->getId(), $date_from, $date_to, false, $page*$rows, $rows,
            [
                'g.gamerExternalId' => $request->get('gamer_external_id'),
                'IDENTITY(t.countryDetected)' => $request->get('country_client_id'),
                't.id' => $request->get('transaction_id'),
                'p.id' => $request->get('purchase_id'),
                'p.wasCanceled' => $request->get('was_canceled'),
                'IDENTITY(p.country)' => $request->get('country_shop_id'),
                AbstractRepository::OPTION_INJECT_NO_PARAMS =>  ' AND p.extraCostFromParent is null',
                AbstractRepository::OPTION_SQL_INJECT =>  ! $request->get('subscription_id') ? '' :
                    [
                        'sql'=>'
                            AND p.id in (
                                Select puu.id
                                FROM AppBundle:Subscription sub
                                JOIN sub.subscriptionEventualities subEve
                                JOIN subEve.subscriptionEventualityPayments subEvePay
                                JOIN subEvePay.purchase puu
                                WHERE sub.id = :subscriptionIDD
                            )',
                        'parameters' => ['subscriptionIDD' => $request->get('subscription_id')]
                    ]
            ],
            'p, pay, t, g, pd, pdha'
        );

        foreach ($purchases as $purchase)
        {
            if ($currency->getId() === $purchase->getCurrency()->getId())
                continue;

            $convertToCurrency = function (Purchase &$purchase) use ($currency)
            {
                if ($currency->getId() === CurrencyEnum::DOLLAR)
                    $multiply= $purchase->getExchangeRateUsd();
                else if ($currency->getId() === CurrencyEnum::POUND_STERLING)
                    $multiply= $purchase->getExchangeRateGbp();
                else
                    $multiply= $purchase->getExchangeRateEur();

                $purchase->setCurrency($currency);
                $purchase->setAmountTotal(round($purchase->getAmountTotal()*$multiply,4));
                $purchase->setAmountWolo(round($purchase->getAmountWolo()*$multiply,4));
                $purchase->setAmountGame(round($purchase->getAmountGame()*$multiply,4));
                $purchase->setAmountProvider(round($purchase->getAmountProvider()*$multiply,4));
                $purchase->setAmountTaxPaidByProvider($purchase->getAmountTaxPaidByProvider()*$multiply,4);
                $purchase->setAmountTax(round($purchase->getAmountTax()*$multiply,4));
            };

            $convertToCurrency($purchase);

            foreach ($purchase->getExtraCostFromChildren() as $purchaseChild)
            {
                $convertToCurrency($purchaseChild);
            }

        }

        $context = SerializationContext::create()->setGroups(['Default', 'allTranslations', 'RealAmountFromParent', 'ExtraCost', 'PaymentDetailHasArticlesAddPaymentDetailArticlesHasGivenArticles', 'ArticleOnlyName', 'CountAllArticlesQuantities']);
        $context->enableMaxDepthChecks();

        return new Response($serializer->serialize($purchases, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app_id}/purchase/{purchase_id}/cancel", name="admin_purchase_cancel")
     * @ParamConverter("purchase", class="AppBundle:Purchase", options={"id" = "purchase_id"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function cancelPurchaseAction(App $app, Purchase $purchase, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $payment = $purchase->getPayment();

        if (!in_array(RoleEnum::ADMIN_PURCHASES_CANCELLATION, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($payment->getApp()->getId() != $app->getId())
            throw $this->createAccessDeniedException();

        $paymentDetails = $payment->getPaymentDetail();
        $transaction = $paymentDetails ->getTransaction();

        $this->transactionStreamHandler->changeLogByTransaction($transaction);
        $this->transactionStreamHandler->writeHeader($request);
        $reason = $request->get('reason', 'refund');

        $this->logger->addInfo("Merchant refund request in admin reason ". $request->get('reason'));

        $url = $this->generateUrl(
            'payment_refund',
            [
                'transaction_id'  => $transaction->getId(),
                'purchase_id'     => $purchase->getId(),
                'security_random' => $paymentDetails->getSecurityRandomRefund(),
                '_locale'         => $paymentDetails->getLanguage()->getId(),
                'reason'          => $reason
            ]
        );

        $guzzle = $this->get('guzzle.client');
        $requestToDo = $guzzle->get($this->container->getParameter('domain_main') . $url);
        $response = $requestToDo->send();
        $code = $response->getStatusCode();

        if ($code == 202)
        {
            $pmpc = $this->paymentProcessService->getPMPCFromPaymentDetail($paymentDetails);
            $purchase
                ->setCancelInProcess(true)
                ->setReason($reason)
            ;
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Cancel payment request by Merchant: '.$app->getName().', payment: '.$payment->getId())
                ->setFrom($this->container->getParameter('email_app'))
                ->setTo($this->container->getParameter('email_payment_manager'))
                ->setBody("
                    Application id:" .$app->getId()."
                    payment id: " .$payment->getId()."
                    external payment id: ".$payment->getTransactionExternalId()."
                    PayMethod: " .$pmpc->getPayMethod()->getName()."
                    Provider: " .$pmpc->getProvider()->getName()."
                    Reason: ".$request->request->get('reason')."
                    "
                )
            ;
            $this->get('mailer')->send($message);

            $this->logger->addInfo("Need to be cancelled via manual process");
        }

        return new JsonResponse([], $code);
    }


    /**
     * @Route("/app/{app_id}/purchase/{purchase_id}/reactivate", name="admin_purchase_reactivate")
     * @ParamConverter("purchase", class="AppBundle:Purchase", options={"id" = "purchase_id"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function reactivatePurchaseAction(App $app, Purchase $purchase, Request $request)
    {
        $this->transactionStreamHandler->changeLogByTransaction($purchase->getTransaction());
        $this->transactionStreamHandler->writeHeader($request);
        $this->logger->addInfo("Request to reactivate purchase ".$purchase->getId()." by Merchant");

        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $payment = $purchase->getPayment();

        if (!in_array(RoleEnum::ADMIN_PURCHASES_CANCELLATION, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($payment->getApp()->getId() != $app->getId())
            throw $this->createAccessDeniedException();

        if ($purchase->getWasCanceled())
            throw new UnprocessableEntityHttpException('this purchase was canceled before');

        $paymentDetails = $payment->getPaymentDetail();

        $pmpc = $this->paymentProcessService->getPMPCFromPaymentDetail($paymentDetails);

        $purchase
            ->setCancelInProcess(false)
            ->setReason(null)
        ;
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Reactivated payment by Merchant: '.$app->getName().', payment: '.$payment->getId())
            ->setFrom($this->container->getParameter('email_app'))
            ->setTo($this->container->getParameter('email_payment_manager'))
            ->setBody("
                Application id:" .$app->getId()."
                payment id: " .$payment->getId()."
                external payment id: ".$payment->getTransactionExternalId()."
                PayMethod: " .$pmpc->getPayMethod()->getName()."
                Provider: " .$pmpc->getProvider()->getName()."
                Reason: ".$request->request->get('reason')."
                "
            )
        ;
        $this->get('mailer')->send($message);

        $this->logger->addInfo("Purchase ".$purchase->getId()." was reactivated");

        return new JsonResponse();
    }

}
