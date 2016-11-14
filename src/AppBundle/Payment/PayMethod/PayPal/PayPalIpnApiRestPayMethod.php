<?php

namespace AppBundle\Payment\PayMethod\PayPal;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Payment\Bean\PaymentExtraCostBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodExecutionInUrlOK;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use PayPal\Api as ApiPaypal;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.paypal_ipn_pay_method")
 */
class PayPalIpnApiRestPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface,
    PayMethodIpnStaticExecutionInterface, PayMethodVerifyCredentialsInterface, PayMethodExecutionInUrlOK, PayMethodRefundExecutionInterface
{
    /** @var string  */
    protected $providerlive;

    /** @var string  */
    protected $providerEmail;

    /** @var string */
    protected $rootDir;

    // IPN
    const URL_SANDBOX = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    const URL_LIVE    = 'https://www.paypal.com/cgi-bin/webscr';

    const PREFIX_EXTERNAL_TRANSACTION = 'PAYPAL_';

    const API_CLIENT_ID_SANDBOX = 'AXum-D13Sf4SrCSdIBT8LIOGqJa-GOIKPF9x9JJG8VsIF8LIZ6Gg1pX5ZnFHa6t8UPzi9nKx91CFmDHw';
    const API_SECRET_SANDBOX = 'EEbDsGMnK54EJvbb0T7z4hY4q33nE9TT8boCD7IS6d_-a1XQ7yV0LLoNkF_b5KDShhRvTO5yB9ASpq26';

    const API_CLIENT_ID_LIVE = 'ATSyZCO6xG6yyiSAnQ6Z5mkk4mONRsw-2jDsKkBr343i8H2pCOcIkF-hjbtdWd7miw52hoeF5mus6drW';
    const API_SECRET_LIVE = 'EHMcXCnG83i6X9ROR6h34w-GCaN5LBdGG9bAF_UrF5OPksIz6AiIl_NtBed2jR0h0Q1RB6bGvLf9FHFM';

    public static $availableLanguages = [ 'AU','AT','BE','BR','CA','CH','CN','DE','ES','GB','FR','IT','NL','PL','PT','RU','US'];

    /**
     * @InjectParams({
     *    "rootDir" = @Inject("%kernel.root_dir%"),
     *    "live"   = @Inject("%payments.paypal.live%"),
     *    "email"  = @Inject("%payments.paypal.email%"),
     * })
     */
    function __construct(
        $live,
        $email,
        $rootDir
    )
    {
        $this->rootDir = $rootDir;

        $this->providerEmail   = $email;
        $this->providerlive    = $live;
    }

    protected function createApiContext($apiUser = null, $apiSecret = null)
    {
        if ($this->providerlive)
            $oAuth=  new OAuthTokenCredential($apiUser ?: self::API_CLIENT_ID_LIVE, $apiSecret ?: self::API_SECRET_LIVE);
        else
            $oAuth=  new OAuthTokenCredential(self::API_CLIENT_ID_SANDBOX, self::API_SECRET_SANDBOX);

        $apiContext = new ApiContext( $oAuth );

        // Comment this line out and uncomment the PP_CONFIG_PATH
        // 'define' block if you want to use static file
        // based configuration

        $apiContext->setConfig(
            array(
                'mode' => $this->providerlive ? 'live' : 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => $this->rootDir.'/../var/logs/pay_methods/pay_pal_lib.log',
                'cache.FileName' => $this->rootDir.'/../var/paypal_auth.cache',
                'log.LogLevel' => 'FINE', //  PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'validation.level' => 'log',
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            )
        );

        return $apiContext;
    }

    protected function createItemList(PaymentProcessInterface $paymentProcess)
    {
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $itemList = new ApiPaypal\ItemList();

        if ($paymentProcess instanceof SingleCustomPayment)
        {
            $item = new ApiPaypal\Item();
            $item->setName($paymentProcess->getArticleTitle())
                ->setCurrency($paymentDetails->getCurrency()->getId())
                ->setQuantity(1)
                //                ->setSku("123123") // Similar to `item_number` in Classic API
                ->setPrice($paymentProcess->getPaymentDetail()->getAmount());

            $itemList->addItem($item);

        }else{

            foreach ($paymentDetails->getPaymentDetailHasArticles() as $ppdha)
            {
                $item = new ApiPaypal\Item();
                $item->setName($this->getNameTranslation($paymentProcess, $ppdha))
                    ->setCurrency($paymentDetails->getCurrency()->getId())
                    ->setQuantity($ppdha->getArticlesQuantity())
                    ->setPrice($ppdha->getAmount());
                $itemList->addItem($item);
            }
        }

        return $itemList;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $payer = new ApiPaypal\Payer();
        $payer->setPaymentMethod("paypal");

        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $itemList = $this->createItemList($paymentProcess);

        $amount = new ApiPaypal\Amount();
        $amount
            ->setCurrency($paymentDetails->getCurrency()->getId())
            ->setTotal($paymentDetails->getAmount())
        ;

        if (!$paymentDetails->getPaymentDetailExtraCosts()->isEmpty())
        {
            $extraCosts = $paymentDetails->getSumExtraCosts();
            $details = new ApiPaypal\Details();
            $details
                ->setShipping($extraCosts)
                ->setSubtotal($paymentDetails->getAmount() - $extraCosts);
            ;

            $amount->setDetails($details);
        }

        $transaction = new ApiPaypal\Transaction();
        $transaction
            ->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber($paymentProcess->getId())
//            ->setNotifyUrl($paymentInteract->getUrlIpn()) // Not used by PAYPAL.....
        ;

        $redirectUrls = new ApiPaypal\RedirectUrls();
        $redirectUrls
            ->setReturnUrl($paymentInteract->getUrlOk())
            ->setCancelUrl($paymentInteract->getUrlKo())
        ;

        $payment = new ApiPaypal\Payment();
        $payment
            ->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction))
        ;

        try {
            $paymentInteract->setSubRequestDone("/v1/payments/payment", $payment->toArray());
            $payment->create( $this->getApiContext($paymentProcess) );
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            $paymentInteract->setSubRequestDoneResponse('ERROR: '.$ex->getCode().$ex->getData());
            throw $ex;
        } catch (\Exception $ex) {
            $paymentInteract->setSubRequestDoneResponse('ERROR: '.$ex->getMessage());
            throw $ex;
        }
        $paymentInteract->setSubRequestDoneResponse($payment->getApprovalLink());
        $paymentInteract->setRequestResult($payment->getApprovalLink());
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        return $this->genericIpnStaticWhichPaymentIsIt($request->get('invoice', $request->get('recurring_payment_id')));
    }

    /**
     * Not using webhooks at this moment
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsItWebHook(Request $request)
    {
        $credentials = $this->ipnStaticGetCredentialsForSpecialProviders($request, ProviderEnum::PAYPAL_NAME);
        $apiContext = $this->createApiContext($credentials['api_user'], $credentials['api_password']);
        $payment = ApiPaypal\Payment::get($request->get('resource[parent_payment]', null, true), $apiContext);
        $paymentProcessId = $payment->getTransactions()[0]->getInvoiceNumber();

        return $this->genericIpnStaticWhichPaymentIsIt($paymentProcessId);
    }

    protected function getApiContext(PaymentProcessInterface $paymentProcess)
    {
        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerlive,
            $paymentProcess->getPaymentDetail(),
            $this->getShapeProviderClientCredentials()
        );
        return $this->createApiContext($credentialsDetailsArr['client_id'], $credentialsDetailsArr['secret']);
    }



    /**
     * @param \AppBundle\Entity\PaymentProcessInterface $paymentProcess
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function executeInUrlOK(PaymentProcessInterface $paymentProcess, Request $request)
    {
        if (in_array($paymentProcess->getStatusCategory()->getId(), [PaymentStatusCategoryEnum::COMPLETED_ID, PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID]))
            return;


        $paymentId = $request->get('paymentId');
        $apiContext = $this->getApiContext($paymentProcess);
        $payment = ApiPaypal\Payment::get($paymentId, $apiContext);

        $execution = new ApiPaypal\PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        $paymentDetails = $paymentProcess->getPaymentDetail();

        try{
            $payment->execute($execution, $apiContext);
        }catch (\Exception $e){
            $this->logger->addInfo('Payment is incompleted '.$e->getMessage());
            return;
        }

        $extraData = $paymentDetails->getExtraData();
        $extraData['paypal_payment_id'] = $payment->getId();
        $paymentDetails->setExtraData($extraData);
        $this->em->flush();

        $this->logger->addInfo("Paypal confirmed payment to paypal to send webhook/ipn");
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        if (!$this->verifyPaymentWasSentByPayPalIPN($paymentInteract))
            return ;

        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $status = trim(strtolower($request->get('payment_status')));
        $this->logger->addInfo("Payment status by PayPal: ". $status);

        $this->processInSpecialCases($paymentInteract, $request, $paymentProcess);

        if ($status === "completed" ){

            if ($paymentInteract->validatePrice($request->get('mc_gross'), $request->get('mc_currency'), $paymentProcess))
            {
                $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->request->get('txn_id'),
                    new PaymentFeeBean(
                        $request->get('mc_fee'),
                        $this->em->getRepository('AppBundle:Currency')->find($request->get('mc_currency')),
                        null,
                        null,
                        null,
                        $request->get('exchange_rate')
                    ),
                    null,
                    null,
                    409
                );
            }

        }else if ($status === "pending" ){

            $paymentInteract->setPaymentPending($request->get('pending_reason'));

        }else if ($status === "refunded" ){

            $paymentInteract->setPaymentCancelled('Refund');

        }else if ($status === "failed" ){

            $paymentInteract->setPaymentFailed('Failed');

        }else if ($status === "denied" ){

            $paymentInteract->setPaymentCancelled('Denied');

        }else if ($paymentInteract->getResponseResult()->getStatusCode() == 422 ){

            $this->logger->addAlert("Payment status unknown: '$status'");
        }

    }

    protected function processInSpecialCases(PaymentIpnInteract $paymentInteract, Request $request, Payment $payment)
    {
        $currency = $payment->getPaymentDetail()->getCurrency();

        if (strtolower($request->get('txn_type') === "new_case"))
        {
            $paymentInteract->setPaymentDispute($payment);
        }

        if (strtolower($request->get('payment_status')) === "reversed"){

            $paymentInteract->setPaymentDisputeEnd(false, strtolower($request->get('reason_code')), $payment);
            if ($extraCost = $request->get('mc_fee'))
            {
                $paymentInteract->setExtraCost(
                    new PurchaseExtraCostBean(null, $extraCost, $extraCost, $extraCost),
                    strtolower($request->get('reason_code')),
                    $payment
                );
            }

        }else if (strtolower($request->get('payment_status')) === "canceled_reversal"){

            $paymentInteract->setPaymentDisputeEnd(true, strtolower($request->get('reason_code')), $payment);
            if ($extraCost = $request->get('mc_fee'))
            {
                $paymentInteract->setExtraCost(
                    new PurchaseExtraCostBean(null, $extraCost, $extraCost, $extraCost),
                    strtolower($request->get('reason_code')),
                    $payment
                );
            }

        }
    }

    /**
     * NOT USED because have a problems with webhooks
     * @param PaymentIpnInteract $paymentInteract
     */
    public function executePaymentIpnWebHook(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $apiContext = $this->getApiContext($paymentProcess);

        if (!$this->verifyPaymentWasSentByPayPalWebHook($paymentInteract->getRequest(), $apiContext))
            return ;

        $status = trim($request->get('event_type'));
        $this->logger->addInfo("Payment status by PayPal: ". $status);

        switch ($status)
        {
            case 'PAYMENT.SALE.COMPLETED':
                if ($paymentInteract->validatePrice($request->get('resource[amount][total]', null, true), $request->get('resource[amount][currency]', null, true), $paymentProcess))
                {
                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->request->get('resource[parent_payment]',null, true),
                        new PaymentFeeBean(
                            $request->get('resource[transaction_fee][value]'),
                            $this->em->getRepository('AppBundle:Currency')->find($request->get('resource[transaction_fee][currency]', null, true)),
                            null,
                            null,
                            null,
                            $request->get('exchange_rate')
                        )
                    );
                }
                break;
            case 'PAYMENT.SALE.PENDING':
                $paymentInteract->setPaymentPending($request->get('resource[reason_code]', null, true));
                break;
            case 'PAYMENT.SALE.REFUNDED':
                $paymentInteract->setPaymentCancelled('Refunded by merchant');
                break;
            case 'PAYMENT.SALE.REVERSED':
                $paymentInteract->setPaymentCancelled('Refunded by Paypal');
                break;
            case 'RISK.DISPUTE.CREATED':
                $paymentInteract->setPaymentDispute();
                break;
            default:
                $this->logger->addError("Unknown state $status");
                break;
        }

    }

    /**
     * @return array
     */
    protected function getUrlPaypal()
    {
        return $this->providerlive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    protected function verifyPaymentWasSentByPayPalIPN(PaymentIpnInteract $paymentInteract)
    {
        $post = $paymentInteract->getRequest()->request->all();
        $post['cmd'] = '_notify-validate';

        $requestVerification = $this->guzzle->post($this->getUrlPaypal(), [], $post);
        $responseVerification = $requestVerification->send();

        $this->logger->info("Verification payment. url ".$this->getUrlPaypal());

        if (strcmp ($responseVerification->getBody(), "VERIFIED") != 0)
        {
            $paymentInteract->setPaymentAttemptHack("paypal not verified! response was ". $responseVerification->getBody());
            return false;
        }

        $this->logger->info("Verification passed");

        return true;
    }

    protected function verifyPaymentWasSentByPayPalWebHook(Request $request, ApiContext $apiContext)
    {
        // ### Validate Received Event Method
        // Call the validateReceivedEvent() method with provided body, and apiContext object to validate
        try {
            /** @var \PayPal\Api\WebhookEvent $output */
            \PayPal\Api\WebhookEvent::validateAndGetReceivedEvent(json_encode($request->request->all()), $apiContext);
        } catch (\Exception $ex) {
            $this->logger->addInfo("Invalid petition: ".$ex->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {

        try{
            $request = $this->guzzle->post(
                'https://api.paypal.com/v1/oauth2/token',
                [
                    'Authorization' => "Basic ".base64_encode($credentialsArray['client_id'].":".$credentialsArray['secret']),
                    'Accept'        => 'application/json'
                ],
                ['grant_type' => 'client_credentials']
            );
            $request->send();

        }catch (\Exception $e){
            return false;
        }

        return true;
    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return ['client_id' => null, 'secret' => null];
    }

    /**
     * @param Payment $payment
     * @param string $reason
     * @param bool $clientPetition
     * @return bool
     */
    public function executeRefund(Payment $payment, $reason = 'refund', $clientPetition = false)
    {
        $paymentDetails = $payment->getPaymentDetail();

        $apiContext = $this->getApiContext($payment);

        $paymentPaypal = ApiPaypal\Payment::get($paymentDetails->getExtraData()['paypal_payment_id'], $apiContext);

        $transactions = $paymentPaypal->getTransactions();
        $relatedResources = $transactions[0]->getRelatedResources();
        $sale = $relatedResources[0]->getSale();

        $saleId = $sale->getId();

        $sale = new ApiPaypal\Sale();
        $sale->setId($saleId);

        $amt = new ApiPaypal\Amount();
        $amt
            ->setCurrency($paymentDetails->getCurrency()->getId())
            ->setTotal($paymentDetails->getAmount())
        ;

        $refund = new ApiPaypal\Refund();
        $refund->setAmount($amt);

        $refundedSale = $sale->refund($refund, $apiContext);

        $this->em->flush();
        // paypal will send a callback with the status

        return true;
    }

}