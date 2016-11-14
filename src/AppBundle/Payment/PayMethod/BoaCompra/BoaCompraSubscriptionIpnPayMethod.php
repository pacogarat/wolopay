<?php

namespace AppBundle\Payment\PayMethod\BoaCompra;

use AppBundle\Entity\Payment;
use AppBundle\Entity\Subscription;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\PayMethod\Exceptions\EmailRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * NOT AVAILABLE
 *
 * @Service("shop.payment.boa_compra_subscription_ipn_pay_method")
 *
 * Integration manual https://billing-partner.boacompra.com/docs/recurring-billing-integration-guide.pdf
 *
 * Sandbox:
 *
 * Link: http://billing.boacompra.com/loja_teste/index.php
 * Login: dev-tests
 * Password: A73*pgf1HIu&
 */
class BoaCompraSubscriptionIpnPayMethod extends BoaCompraIpnPayMethod implements PayMethodIpnExecutionInterface, PayMethodRefundExecutionInterface
    // , PayMethodVerifyCredentialsInterface
{
    /** @var string  */
    protected $providerLive;

    const PREFIX_EXTERNAL_TRANSACTION = 'BOASUB_';

    protected function getHeaders($url, $content='')
    {
        if (parse_url($url, PHP_URL_QUERY))
            $httpVerb = parse_url($url, PHP_URL_PATH).'?'.parse_url($url, PHP_URL_QUERY);
        else
            $httpVerb = parse_url($url, PHP_URL_PATH);

        return [
            'Accept' => 'application/vnd.boacompra.com.v1+json; charset=UTF-8',
            'Accept-Language' => 'en-US',
            'Content-Type' => 'application/json',
            'Content-MD5' => md5($content),
            // like example 'Authorization' => $this->getStoreId() . ':' . hash_hmac('sha256',  $httpVerb .  md5($content), $this->getApiSecret()),
            'Authorization' => $this->getStoreId() . ':' . hash_hmac('sha256',  $httpVerb .  base64_encode(md5($content)), $this->getApiSecret()),
        ];
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $parameters = $this->generateParametersToPrepare($paymentInteract);
        $parametersJson = json_encode($parameters);

        $url = 'https://api.BoaCompra.com/pre-approvals';
        $headers = $this->getHeaders($url, $parametersJson);

        $paymentInteract->setSubRequestDone($url, $parameters);

        try {

            $options = ['verify' => false]; // SSL certificate problem.
            $request = $this->guzzle->post($url, $headers, $parametersJson, $options);
            $response = $request->send();

        } catch (BadResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }

        $paymentInteract->setSubRequestDoneResponse($response->getBody(true), 200, true);
        ;

        $paymentInteract->setRequestResult($response->json()['redirect-url']);
    }

    protected function generateParametersToPrepare(PaymentPrepareInteract $paymentInteract)
    {
        /** @var Subscription $subscription */
        $subscription = $paymentInteract->getPaymentProcess();
        $paymentDetails = $subscription->getPaymentDetail();

        return [
            'reference' => $subscription->getId(),
            'store-id'  => $this->getStoreId(),
            'notify-url' => $paymentInteract->getUrlIpn(),
            'return-url' => $paymentInteract->getUrlOk(),
            'description' => UtilHelper::maxLengthString($paymentInteract->getNameAllTranslations($paymentDetails), 195),
            'payment-group' => 'credit_card', // TODO verify, its works without this value
            'test-mode' => !$this->providerLive,
            'sender' => [
                'email' => $paymentDetails->getTransaction()->getGamer()->getEmail()
            ],
            'payment' => [
                'currency' => $paymentDetails->getCurrency()->getId(),
                'amount' => $paymentDetails->getAmount(),
                'notify-url' =>  $paymentInteract->getUrlIpn()
            ]
        ];

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

            // OPTIONALS
            'language' => $lang,
            'test_mode' => !$this->providerLive,
        ];

        if ($transaction->getCountryDetected())
            $request['country_payment'] = $transaction->getCountryDetected()->getId();

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

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded($this->providerLive, $paymentProcess, $this->getShapeProviderClientCredentials());

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
            'country_payment'  => $transaction->getCountryDetected() ? $transaction->getCountryDetected()->getId() : $paymentDetails->getCountry()->getId(),
            'customer_country' => $transaction->getCountryDetected() ? $transaction->getCountryDetected()->getId() : $paymentDetails->getCountry()->getId(),
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