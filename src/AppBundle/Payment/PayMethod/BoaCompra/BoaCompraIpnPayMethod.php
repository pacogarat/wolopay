<?php

namespace AppBundle\Payment\PayMethod\BoaCompra;

use AppBundle\Entity\Payment;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\EmailRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.boa_compra_ipn_pay_method")
 *
 * Integration manual http://www.boacompra.com/shop/static/Billing_EN.pdf
 * Perfect Integration Manual – https://dl.dropboxusercontent.com/u/100802176/BoaCompra_Best_Practices_Integration.pdf
 * Refunds: http://billing-partner.boacompra.com/docs/BoaCompra_Refund.pdf
 *
 * To complete test payments, go to https://billing-partner.boacompra.com/projects.php
 *
 * Sandbox:
 *
 * Link: http://billing.boacompra.com/loja_teste/index.php
 * Login: dev-tests
 * Password: A73*pgf1HIu&
 */
class BoaCompraIpnPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface, PayMethodRefundExecutionInterface, PreviousStepInterface
{
    /** @var string  */
    protected $providerLive;

    const STORE_SANDBOX_ID = 10;
    const STORE_PRODUCTION_ID = 309;

    const API_SECRET_PRODUCTION = '$0-OA&N!=W%/J9V?(O3/';
    const API_SECRET_SANDBOX = 'A73*pgf1HIu&';

    public static $availableLanguages = [ 'en' => 'en_US', 'br' => 'pt_BR', 'es' => 'es_ES', 'pt' => 'pt_PT', 'tr' => 'tr_TR'];
    public static $ipsAvailable = [ '200.147.106.24', '200.147.106.25', '200.147.106.65', '200.147.106.66'];

    const PREFIX_EXTERNAL_TRANSACTION = 'BOAC_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.boa_compra.live%"),
     * })
     */
    function __construct($live)
    {
        $this->providerLive  = $live;
    }

    /**
     * @param PaymentPreviousStepsInteract $previous
     * @throws \AppBundle\Payment\PayMethod\Exceptions\EmailRequiredPayMethodException
     * @throws \AppBundle\Payment\PayMethod\Exceptions\PayMethodOnlyAvailableWithProviderClientCredentialsException
     * @return mixed
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous)
    {
        $transaction = $previous->getTransaction();
        $gamer = $transaction->getGamer();

        if (!$gamer->getEmail())
            throw new EmailRequiredPayMethodException();
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $url = 'https://billing.boacompra.com/payment.php';

//        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
//            $this->providerLive,
//            $paymentInteract->getPaymentProcess()->getPaymentDetail(),
//            $this->getShapeProviderClientCredentials()
//        );
        $parameters = $this->generateParameters($paymentInteract);

        $this->logger->addInfo('Parameters set: '.urldecode(http_build_query($parameters)));

        $paymentInteract->setRequestResult($url, 'POST', $parameters);
    }

    protected function generateParameters(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $gamer = $paymentDetails->getTransaction()->getGamer();

        $lang = self::$availableLanguages['en'];

        if (array_key_exists($paymentDetails->getLanguage()->getId(), self::$availableLanguages))
            $lang = self::$availableLanguages[$paymentDetails->getLanguage()->getId()];

        if (!$gamer->getEmail())
            throw new EmailRequiredPayMethodException();

//        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
//            $this->providerLive,
//            $paymentProcess,
//            $this->getShapeProviderClientCredentials()
//        );

        $amount = $this->amountWithoutDecimals($paymentDetails->getAmount());

        $request = [
            "store_id" => $this->getStoreId(),
            'return' => $paymentInteract->getUrlOk(),
            'notify_url' => $paymentInteract->getUrlIpn(),
            'currency_code' => $paymentInteract->getCurrencyPaymentISO(),
            'order_id' => $paymentProcess->getId(),
            'order_description' => UtilHelper::maxLengthString($paymentInteract->getNameAllTranslations($paymentDetails), 195),
            'amount' => $amount,
            'client_email' => $gamer->getEmail(),
            'hash_key' => md5($this->getStoreId().$paymentInteract->getUrlIpn().$paymentProcess->getId().$amount.$paymentInteract->getCurrencyPaymentISO().$this->getApiSecret()),
            'country_payment' => $paymentDetails->getCountry()->getId(),

            // OPTIONALS
            'language' => $lang,
            'test_mode' => !$this->providerLive,
        ];

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $paymentDetails->getPayMethod()->getId(), $paymentDetails->getProvider()->getId(), $paymentDetails->getCountry()->getId()
        );

        if (!$pmpc)
            throw new \Exception("Unknown PayMethodHasProvider");

        $extraOptions = $pmpc->getPayMethodHasProvider()->getExtraOptions();

        if (isset($extraOptions['external_provider_id']))
            $request['payment_id'] = $extraOptions['external_provider_id'];

        return $request;
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $request        = $paymentInteract->getRequest();

        if (!$this->verifyPaymentWasSentByProvider($request))
        {
            $paymentInteract->setPaymentAttemptHack("verifyPaymentWasSentByProvider");
            $paymentInteract->setResponseStatus(401);
            return;
        }

        if ($request->get('refund_id'))
        {
            $this->logger->addInfo('Refund detected, Refund id: '.$request->get('refund_id'));

            if ($request->get('status') == 3) // processed
                $paymentInteract->setPaymentCancelled('Cancelled by refund');

            return;
        }

        if (!$paymentInteract->validatePrice($request->get('amount'), $request->get('currency_code'), $paymentProcess))
        {
            $paymentInteract->setPaymentAttemptHack("validatePrice");
            $paymentInteract->setResponseStatus(401);
            return;
        }

        $hash = md5($request->get('store_id'). $request->request->get('transaction_id'). $request->get('order_id'). $request->get('amount'). $request->get('currency_code'). $this->getApiSecret());
        $params = [
            "store_id"         => $this->getStoreId(),
            'transaction_id'   => $request->request->get('transaction_id'), // external Transaction
            'order_id'         => $paymentProcess->getId(),
            'amount'           => $request->get('amount'),
            'currency_code'    => $request->get('currency_code'),
            'payment_id'       => $request->get('payment_id'),
            'country_payment'  => $paymentDetails->getCountryGamer()->getId(),
            'customer_country' => $paymentDetails->getCountryGamer()->getId(),
            'cmd'              => '_code-notify',
            'hash_key'         => $hash,

        ];

        $this->logger->addInfo('Params validate with boa: '.urldecode(http_build_query($params)));

        if ($this->providerLive)
            $url = 'https://billing.boacompra.com/boacompra.php';
        else
            $url = 'https://billing.boacompra.com/boacompra_test.php';

        $paymentInteract->setSubRequestDone($url, $params);
        try {

            $requestToDo = $this->guzzle->post($url, null, $params);
            $response = $requestToDo->send();

        } catch (ClientErrorResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            $this->logger->addError($exception->getResponse()->getBody(true));
            throw $exception;
        }

        $paymentInteract->setSubRequestDoneResponse($response->getBody(true), $response->getStatusCode());
        $codret = str_replace('CODRET=', '', $response->getBody(true));

        $transactionExternalId = self::PREFIX_EXTERNAL_TRANSACTION. $request->request->get('transaction_id');

        switch ($codret)
        {
            case '0': // Order successfully confirmed.
            case '1': // Order already confirmed.

                $paymentInteract->setPaymentCompleted($transactionExternalId);
                $paymentInteract->setResponseStatus(200);

                break;
            case '2': // Incorrect parameters values.
                $this->logger->addError('Incorrect parameters values.');
                break;
            case '3': // Order not found.
                $this->logger->addError('Incorrect parameters values.');
                break;
            case '4': // Postback is missing data.
                $this->logger->addError('Incorrect parameters values.');
                break;
            case '5': // Order not paid yet.
                $this->logger->addError('Incorrect parameters values.');
                break;
            case '6': // Error reported by the Virtual Store.
                $this->logger->addError('Error reported by the Virtual Store.');
                break;
            case '7': // Value for “hash_key” parameter is incorrect.
                $this->logger->addError('Value for “hash_key” parameter is incorrect.');
                break;
            case '9': // Wrong postback url. Please check the “Test Environment” section.
                $this->logger->addError('Wrong postback url. Please check the “Test Environment” section.');
                break;
            default:
                $this->logger->addInfo('Unknown code');
        }
    }


    protected function getStoreId()
    {
        return $this->providerLive ? self::STORE_PRODUCTION_ID : self::STORE_SANDBOX_ID;
    }

    protected function getApiSecret()
    {
        return $this->providerLive ? self::API_SECRET_PRODUCTION : self::API_SECRET_SANDBOX;
    }


    protected function verifyPaymentWasSentByProvider(Request $request)
    {
        if (!in_array($request->getClientIp(), self::$ipsAvailable))
        {
            $this->logger->addError('Failed in ip request validation');
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function executeRefund(Payment $payment, $reason = 'refund', $clientPetition = false)
    {
        $paymentDetails = $payment->getPaymentDetail();

        $params = [
            'store_id' => $this->getStoreId(),
            'transaction_id' => $this->getExternalIdWithOutPrefix($payment->getTransactionExternalId()),
            'hash_key' => hash('sha256', $this->getStoreId() . $payment->getId() . $this->getApiSecret() ),
//            'amount' => , // if its null is a full refund
            'notify_url' => $this->domainMain . $this->router->generate(
                    'payment_ipn',
                    [
                        '_locale' => $paymentDetails->getLanguage()->getId(),
                        'payment_process_id' => $payment->getId(),
                        'security_random' => $paymentDetails->getSecurityRandomIpn(),
                        'transaction_id' => $paymentDetails->getTransaction()->getId()
                    ]
                ),
            'send_email' => true, // send email to customer
            'test_mode'  => !$this->providerLive
        ];

        $url = 'https://billing.boacompra.com/refund.php';

        $this->logger->addInfo("Refund to $url, params: ".urldecode(http_build_query($params)));

        try {

            $response = $this->guzzle->post($url, null, $params)->send();
            $json = $response->json();

        } catch (ClientErrorResponseException $exception) {

            $this->logger->addError($exception->getResponse()->getBody(true));
            throw $exception;
        }

        $this->logger->addInfo("response was: ".urldecode(http_build_query($json)));

        if ($json['status'] === 'OK' OR ($json['status'] === 'NOK' && $json['error']['code'] === 132))
        {
            $purchase = $payment->getPurchase();
            $purchase->setCancelInProcess(true);
            $this->em->flush();

            return true;
        }

        return false;
    }
}