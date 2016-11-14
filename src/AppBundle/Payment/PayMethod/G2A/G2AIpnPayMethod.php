<?php

namespace AppBundle\Payment\PayMethod\G2A;

use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Exception\NviaException;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\PayMethodOnlyAvailableWithProviderClientCredentialsException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.g2a_ipn_pay_method")
 *
 * To Test
 * paypal user: test.customer@g2a.at
 * paypal password: test.customer
 *
 * Control panel Sandbox
 * Integrations@wolopay.com, password: testing1234!
 *
 * G2Pay Client account to make a real payment
 * user:  mgarcia@wolopay.com
 * password: Perrygarcia123123-
 */
class G2AIpnPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface, PayMethodIpnStaticExecutionInterface,
    PayMethodRefundExecutionInterface, PayMethodVerifyCredentialsInterface, PreviousStepInterface
{
    /** @var string  */
    protected $providerLive;

    /** @var ContainerInterface */
    protected $container;

    const URL_LIVE         = 'https://checkout.pay.g2a.com';
    const URL_SANDBOX      = 'https://checkout.test.pay.g2a.com';

    const URL_API_LIVE         = 'https://pay.g2a.com/rest';
    const URL_API_SANDBOX      = 'https://www.test.pay.g2a.com/rest';

    const API_USER_PRODUCTION = 'd3a7a17b-348a-4087-9297-6dc7c8a7fc9f';
    const API_KEY_PRODUCTION  = '^?l8D6taortPndEF?sHsvAcfn%uA&DD@By>O~sydUb_3>1I*sZpYjC?H6sQ2@d#2';

    const API_USER_SANDBOX = '698b8fd3-1825-4e79-a248-db70eb84062d';
    const API_KEY_SANDBOX = '_Jv6B!Uec#~OmEcTMrRc*+2?=-2@-^AmF!sPw7+J>shl@4>DwQptErr1cs#Oo2^=';

    const EMAIL = 'integrations@wolopay.com';

    const PREFIX_EXTERNAL_TRANSACTION = 'G2A_';


    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.g2a.live%"),
     *    "container" = @Inject("service_container"),
     * })
     */
    function __construct($live, ContainerInterface $container)
    {
        $this->container = $container;
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
        $pmpc = $previous->getPayMethodProviderHasCountry();

        $credentials = $this->getProviderClientCredentials($transaction->getApp(), $pmpc->getProvider(), $this->getShapeProviderClientCredentials());

        if ( $credentials === null)
            throw new PayMethodOnlyAvailableWithProviderClientCredentialsException($transaction->getApp(), $pmpc->getProvider());
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        $items = [];

        if ($paymentProcess instanceof SingleCustomPayment)
        {
            $time = time();
            $items[] = [
                'id'     => "ID_$time",
                'sku'    => "custom_$time",
                'name'   => $paymentProcess->getArticleTitle(),
                'amount' => $paymentDetails->getAmount(),
                'qty'    => 1,
                'price'  => $paymentDetails->getAmount(),
                'url'    => 'https://wolopay.com/1x1.png' // ?¿?¿ Added random data to force payment
            ];
        }

        foreach ($this->getNewAmountForEachPDHArticleToPayMethodsWithNotExtraFee($paymentDetails) as $row)
        {
            /** @var PaymentDetailHasArticles $ppdha */
            list ($ppdha, $amount) = $row;

            // ignore articles with amount 0...
            if ($amount <= 0)
                continue;

            $media = $ppdha->getImageClosest();

            $provider = $this->container->get($media->getProviderName());
            $imgUrl = $this->domainMain. $provider->generatePublicUrl($media, $media->getContext() . '_shop');

            $items[] = [
                'id'     => $ppdha->getArticle()->getId(),
                'sku'    => $ppdha->getArticle()->getId(),
                'name'   => $paymentInteract->getNameTranslation($ppdha),
                'amount' => $amount,
                'qty'    => $ppdha->getArticlesQuantity(),
                'price'  => $amount,
                'url'    => $imgUrl
            ];
        }



        $postParameters = [
            'api_hash'   => $this->getApiUser($credentialsDetailsArr),
            'hash'       => hash('sha256', $paymentProcess->getId(). $paymentDetails->getAmount(). $paymentInteract->getCurrencyPaymentISO(). $this->getApiKey($credentialsDetailsArr)),
            'order_id'   => $paymentProcess->getId(),

            'amount'     => $paymentDetails->getAmount(),
            'currency'   => $paymentInteract->getCurrencyPaymentISO(),

            'url_failure'  => $paymentInteract->getUrlKo(),
            'url_ok'       => $paymentInteract->getUrlOk(),

            'items'        => json_encode($items),
        ];

        if ($paymentDetails->getTransaction()->getGamer()->getEmail())
            $postParameters['email'] = $paymentDetails->getTransaction()->getGamer()->getEmail();

        try {
            $url = $this->getUrlProvider().'/index/createQuote';

            $paymentInteract->setSubRequestDone($url, $postParameters);

            $request = $this->guzzle->post($url, [
                    'content-type' => 'application/json'
                ],
                $postParameters
            );

            $response = $request->send();
        } catch (BadResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }

        $paymentInteract->setSubRequestDoneResponse($response->getBody(true));
//        echo $response->getBody(true);die;
        $resultJson = $response->json();

        if ($resultJson['status'] === false)
        {
            throw new NviaException("Bad Status with G2A ".$resultJson['status']);
        }

        if (!$resultJson['token'])
        {
            throw new NviaException("Token required with G2A ".$resultJson['token']);
        }

        $paymentInteract->setRequestResult($this->getUrlProvider().'/index/gateway?token='.$resultJson['token'], 'GET');
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        return $this->genericIpnStaticWhichPaymentIsIt($request->get('userOrderId'));
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $request        = $paymentInteract->getRequest();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        if (!$this->verifyPaymentWasSentByProvider($request, $credentialsDetailsArr))
        {
            $paymentInteract->setPaymentAttemptHack("Hash is incorrect");
            return;
        }


        switch($request->get('status'))
        {
            case 'pending':
                $paymentInteract->setPaymentPending('pending');
                break;

            case 'complete':
                $feeBean = null;
                $externalId = $request->get('transactionId');
                if ($paymentInteract->validatePrice($request->get('amount'), $request->get('currency'), $paymentProcess))
                {
                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $externalId, $feeBean);
                }
                break;

            case 'rejected':
                $paymentInteract->setPaymentCancelled('rejected');
                break;

            case 'refunded':
                $paymentInteract->setPaymentCancelled('refunded');
                break;
        }
    }

    protected function verifyPaymentWasSentByProvider(Request $request, $credentialsDetailsArr)
    {
        if ($request->get('hash') !== hash('sha256', $request->get('transactionId').$request->get('userOrderId').$request->get('amount').$this->getApiKey($credentialsDetailsArr)))
        {
            return false;
        }

        return true;
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
        $G2ATransactionId = $this->getExternalIdWithOutPrefix($payment->getTransactionExternalId());

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        $amount = $this->forceTwoDecimals($payment->getAmount());

        $parameters = [
            'action' => 'refund',
            'amount' => $amount,
            'currency' => $paymentDetails->getCurrency()->getId(),
            'hash'   => hash('sha256', $G2ATransactionId . $payment->getId() . $amount . $amount . $this->getApiKey($credentialsDetailsArr)),
        ];

        $url = $this->getUrlProviderApi() . '/transactions/' . $G2ATransactionId;

        $headers= [
            'Authorization' => $this->getApiUser($credentialsDetailsArr) . '; ' . hash(
                    'sha256',
                    $this->getApiUser($credentialsDetailsArr) .$this->getEmailShop($credentialsDetailsArr) . $this->getApiKey($credentialsDetailsArr)
                ),
            'Content-type'  => 'application/json'
        ];

        $this->logger->addInfo("Url $url, params: ".urldecode(http_build_query($parameters)).", headers: ".urldecode(http_build_query($headers)));

        $request = $this->guzzle->put($url, $headers, $parameters);

        $response = $request->send();
        $this->logger->addInfo("Response: ".$response->getBody(true));

        $body = $response->json();

        if ($body['status'] !== 'ok')
            return false;

        return true;
    }

    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    protected function getUrlProviderApi()
    {
        return $this->providerLive ? self::URL_API_LIVE : self::URL_API_SANDBOX;
    }

    protected function getApiUser(array $credentialsArray = [])
    {
        return $this->providerLive ? $credentialsArray['api_user'] ?: self::API_USER_PRODUCTION : self::API_USER_SANDBOX;
    }

    protected function getApiKey(array $credentialsArray = [])
    {
        return $this->providerLive ? $credentialsArray['api_password'] ?: self::API_KEY_PRODUCTION : self::API_KEY_SANDBOX;
    }

    protected function getEmailShop(array $credentialsArray = [])
    {
        return $credentialsArray['shop_email'] ?: self::EMAIL;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {
        try {
            $url = self::URL_API_LIVE. '/transactions/eac61839-7db6-4cab-8ec3-9708c4676938';
            $headers= [
                'Authorization' => $credentialsArray['api_user'].'; '.hash('sha256', $credentialsArray['api_user']. $credentialsArray['shop_email'] .$credentialsArray['api_password'] ),
                'Content-type'  => 'application/json'
            ];

            $response = $this->guzzle->get($url, $headers)->send();

        } catch (BadResponseException $exception) {

            $this->logger->debug('Bad Response, code: '.$exception->getCode().', content: '.$exception->getResponse()->getBody(true));
            $response = $exception->getResponse();
        }

        $this->logger->debug('Code: '.$response->getStatusCode().',Response: '.$response->getBody(true));

        if ($response->getStatusCode() !== 401)
            return true;

        return false;

    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return [
            'api_user'         => null,
            'api_password'     => null,
            'shop_email'       => null,
        ];
    }
}