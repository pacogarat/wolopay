<?php

namespace AppBundle\Payment\PayMethod\Neteller;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\EmailRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
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
 * @Service("shop.payment.neteller_ipn_pay_method")
 */
class NetellerIpnPayMethod extends AbstractPayMethod implements PayMethodIpnExecutionInterface, PayMethodIpnStaticExecutionInterface, PayMethodVerifyCredentialsInterface, PreviousStepInterface
{
    /** @var string  */
    protected $providerLive;

    const URL_SANDBOX      = 'https://test.api.neteller.com/v1';
    const URL_LIVE         = 'https://api.neteller.com/v1';

    const SECRET_WEBHOOK   = 'Zc2cpBT3kX';

    const API_USER = 'AAABTPoMHStYSV1i';
    const API_PASSWORD = '0.wCvQnRpiJ7LCUO3SBkyOuVUvleLDRM7xxWLbenbaBu4.EAAQnPh9ieVrapbrSOay2m3B_Uu9cFU';

    const API_USER_SANDBOX = 'AAABTQW30kJELcFo';
    const API_PASSWORD_SANDBOX = '0.kmzcozpPCdWj3OnU8p7306ei6LAsV4fX3_jHp5qG_Ag.dHb6b39r-DhR4zaooEPgZK268Wk';

    public static $availableLanguages = [ 'en','da','de','es','fr','gr','it','ja','ko','pl','pt','ru','sv','tk'];

    const PREFIX_EXTERNAL_TRANSACTION = 'NETELLER_';


    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.adyen.live%"),
     *    "locale" = @Inject("%locale%")
     * })
     */
    function __construct($live, $locale)
    {
        $this->providerLive  = $live;
        $this->locale        = $locale;
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
        $parameters = $this->generateParameters($paymentInteract);
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        try {
            $token = $this->getToken($credentialsDetailsArr ['api_user'], $credentialsDetailsArr ['api_password']);
            $this->logger->addInfo('Parameters sent: '.urldecode(http_build_query($parameters)));

            $url = $this->getUrlProvider().'/orders';
            $paymentInteract->setSubRequestDone($url, $parameters);

            $request = $this->guzzle->post($this->getUrlProvider().'/orders', [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ],
                json_encode($parameters)
            );

            $response = $request->send();
        } catch (BadResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }


        $responseJson = $response->json();
        $paymentInteract->setSubRequestDoneResponse($response->getBody(true));

        $paymentDetails->setExtraData(['externalId' => $responseJson['orderId']]);
        $paymentInteract->setRequestResult($responseJson['links'][0]['url']);
    }

    protected function generateParameters(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $gamer = $paymentDetails->getTransaction()->getGamer();

        $lang = $this->locale;

        if (in_array($paymentDetails->getLanguage()->getId(), self::$availableLanguages))
            $lang = $paymentDetails->getLanguage()->getId();

        $items = [];

        foreach ($paymentDetails->getPaymentDetailHasArticles() as $ppdha)
        {
            $description = UtilHelper::maxLengthString(
                $this->removeHtml(
                    $paymentInteract->getDescLabelTranslation($ppdha)
                ), 145
            );
            $item['quantity'] = $ppdha->getArticlesQuantity();
            $item['name'] = $paymentInteract->getNameTranslation($ppdha);
            $item['description'] = ($description ? $description : $item['name']);
            $item['amount'] = $this->amountWithoutTwoLastNumbersAsDecimals(
                $ppdha->getAmount(),
                $paymentDetails->getCurrency()->getDecimalPlaces()
            );

            $items[] = $item;
        }

        if (!$gamer->getEmail())
            throw new EmailRequiredPayMethodException();

        $parameters = [
            'order' => [
                'merchantRefId' => $paymentProcess->getId(),
                'totalAmount'   => $this->amountWithoutTwoLastNumbersAsDecimals(
                    $paymentDetails->getAmount(),
                    $paymentDetails->getCurrency()->getDecimalPlaces()
                ),
                'currency'      => $paymentInteract->getCurrencyPaymentISO(),
                'lang'          => $lang, // 'en_US',
                'items'         => $items,
                'redirects'     => [
                    [
                        'rel' => 'on_success',
                        'uri' => $paymentInteract->getUrlOk()
                    ],
                    [
                        'rel' => 'on_cancel',
                        'uri' => $paymentInteract->getUrlKo()
                    ]
                ],
            ],
            'payerProfile' => [
                'email' => $gamer->getEmail()
            ]
        ];

        if (!$paymentDetails->getPaymentDetailExtraCosts()->isEmpty())
        {
            $parameters['order']['fees'] = [];

            foreach ($paymentDetails->getPaymentDetailExtraCosts() as $ec)
            {
                $parameters['order']['fees'] []=  [
                    'feeName' => $ec->getName(),
                    'feeAmount' =>
                        $this->amountWithoutTwoLastNumbersAsDecimals(
                            $this->currencyService->getExchange($ec->getAmount(), $ec->getCurrency(), $paymentDetails->getCurrency()),
                            $paymentDetails->getCurrency()->getDecimalPlaces()
                        ),
                ];
            }
        }

        if (filter_var($paymentProcess->getIp(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
            $parameters['order']['customerIp'] = $paymentProcess->getIp();

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $paymentDetails->getPayMethod()->getId(), $paymentDetails->getProvider()->getId(), $paymentDetails->getCountry()->getId()
        );

        if (!$pmpc)
            throw new \Exception("Unknown PayMethodHasProvider");

        $extraOptions = $pmpc->getPayMethodHasProvider()->getExtraOptions();

        if (isset($extraOptions['external_provider_id']))
            $parameters['order']['paymentMethods'] = $extraOptions['external_provider_id'];

        return $parameters;
    }

    protected function getToken($apiUser = null, $apiPassword = null, $forceLive = null)
    {
        try{
            $request = $this->guzzle->post(
                $this->getUrlProvider($forceLive).'/oauth2/token?grant_type=client_credentials',
                [
                    'Authorization' => 'Basic '.base64_encode( ($apiUser ?: $this->getApiUser()).':'. ($apiPassword ?: $this->getApiUserPassword())),
                    'content-type' => 'application/json',
                ]);
            $response = $request->send();

        } catch (BadResponseException $exception) {

            $this->logger->addError("Neteller API Autentification Bad Request: ".$exception->getResponse()->getBody(true));
            throw $exception;

        } catch (\Exception $e) {

            $this->logger->addError("Neteller API Autentification ERROR Request: ".$e->getMessage());
            throw $e;
        }

        $body = $response->json();

        return $body['accessToken'];
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

        if (!$this->verifyPaymentWasSentByProvider($request, $credentialsDetailsArr['webhook']))
        {
            $paymentInteract->setPaymentAttemptHack("Signature is incorrect");
            $paymentInteract->setResponseStatus(422);
            return;
        }

        switch($request->get('eventType')){

            case 'payment_succeeded':

                $feeBean = null;
                $externalId = $paymentDetails->getExtraData()['externalId'];
                try{

                    $invoicePayment = $this->getInvoicePayment($paymentProcess);

                    if (isset($invoicePayment['transaction']) && isset($invoicePayment['transaction']['fees']))
                    {
                        $externalId = $invoicePayment['transaction']['id'];
                        $feeSaved = 0;
                        foreach ($invoicePayment['transaction']['fees'] as $fee)
                        {
                            // assumed all fees in same Currency
                            $feeSaved += $this->currencyService->getExchangeSimple(
                                $this->amountWithoutTwoLastNumbersAsDecimalsReverse($fee['feeAmount']),
                                $fee['feeCurrency'],
                                $paymentDetails->getCurrency()->getId()
                            );
                        }

                        $feeBean = new PaymentFeeBean($feeSaved, $paymentDetails->getCurrency(), null, null);
                    }

                }catch (\Exception $e){
                    $this->logger->addError("Transaction continues but cant get fee values, Neteller. ERROR: ".$e->getMessage());
                }

                $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $externalId, $feeBean);
                break;
            case 'payment_cancelled':
                $paymentInteract->setPaymentCancelled('User canceled');
                break;
            case 'payment_declined':
                $paymentInteract->setPaymentCancelled('Payment declined by provider');
                break;
            case 'payment_pending':
                $paymentInteract->setPaymentPending('');
                break;
        }
    }

    protected function getUrlProvider($forceLive=null)
    {
        return $forceLive || $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    protected function verifyPaymentWasSentByProvider(Request $request, $webhookForce = null)
    {
        if ($request->get('key') === ($webhookForce ?: self::SECRET_WEBHOOK ))
            return true;

        return false;
    }

    protected function getInvoicePayment(PaymentProcessInterface $paymentProcess)
    {
        try{

            $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
                $this->providerLive,
                $paymentProcess->getPaymentDetail(),
                $this->getShapeProviderClientCredentials()
            );

            $request = $this->guzzle->get($this->getUrlProvider().'/payments/'.$paymentProcess->getId().'?refType=merchantRefId', [
                    'Authorization' => 'Bearer '.$this->getToken($credentialsDetailsArr ['api_user'], $credentialsDetailsArr ['api_password']),
                    'content-type' => 'application/json',
                ]);

            $response = $request->send();
            $json = $response->json();

            $this->logger->addInfo("Invoice details ".urldecode(http_build_query($json)));
            return $json;

        } catch (BadResponseException $exception) {
            $this->logger->addError("Neteller API Info about invoice : ".$exception->getResponse()->getBody(true));
        }

        return null;
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\BadResponseException
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        if (!$url = $request->get('links[0][url]', null, true))
        {
            $this->logger->addError("haven't query parameter 'links'");
            return null;
        }

        try{

            $this->logger->addInfo("Calling Api to get info about payment and get id payment");
            $request = $this->guzzle->get($url, [
                    'Authorization' => 'Bearer '.$this->getToken(),
                    'content-type' => 'application/json',
                ]);
            $response = $request->send();
            $responseJson = $response->json();
            $this->logger->addInfo("Response was " . urldecode(http_build_query($responseJson)));

        } catch (BadResponseException $exception) {
            $this->logger->addError("Neteller API Info about invoice : ".$exception->getResponse()->getBody(true));
            throw $exception;
        }

        $merchantRefId = $responseJson['transaction']['merchantRefId'];

        return $this->genericIpnStaticWhichPaymentIsIt($merchantRefId);
    }


    protected function getApiUser()
    {
        return $this->providerLive ? self::API_USER : self::API_USER_SANDBOX;
    }

    protected function getApiUserPassword()
    {
        return $this->providerLive ? self::API_PASSWORD : self::API_PASSWORD_SANDBOX;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {
        try{
            $this->getToken($credentialsArray['api_user'], $credentialsArray['api_password'], true);
        }catch (\Exception $e){
            return false;
        }

        return true;
    }

    public function getShapeProviderClientCredentials()
    {
        return [
            'api_user' => null,
            'api_password' => null,
            'webhook' => null
        ];
    }
}