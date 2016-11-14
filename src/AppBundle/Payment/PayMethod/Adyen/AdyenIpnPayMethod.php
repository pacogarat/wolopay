<?php

namespace AppBundle\Payment\PayMethod\Adyen;

use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Payment\Actions\SubscriptionFinished;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\EmailRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Exceptions\PayMethodOnlyAvailableWithProviderClientCredentialsException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.adyen_ipn_pay_method")
 *
 * User for testing
 *
 * $creditCard='5100 0811 1222 3332',
 * $holder='Bijenkorf',
 * $cardExpiryDateMonth='06',
 * $cardExpiryDateYear='2016',
 * $CVC=737
 *
 * Panel
 * https://ca-test.adyen.com/ca/ca/login.shtml?loginerror=true
 *
 * User IDCGames
 * userName: admin
 * password: Perryadyen02
 */
class AdyenIpnPayMethod extends AbstractPayMethod  implements PreviousStepInterface, PayMethodIpnExecutionInterface, PayMethodIpnStaticExecutionInterface,
    PayMethodVerifyCredentialsInterface
{
    /** @var SubscriptionFinished */
    protected $subscriptionFinished;

    /** @var string  */
    protected $providerLive;

    const URL_SANDBOX      = 'https://test.adyen.com/hpp/pay.shtml?';
    const URL_LIVE         = 'https://live.adyen.com/hpp/pay.shtml?';

    const URL_PAL_SANDBOX      = 'https://pal-test.adyen.com/pal/adapter/httppost';
    const URL_PAL_LIVE         = 'https://pal-live.adyen.com/pal/adapter/httppost';

    const API_USER = 'ws_008746@Company.IDCGames';
    const API_PASSWORD = '5^J\GN=jW9jA^AkB@u&(wZR-#';

    const SKIN_CODE             = '5woQhOcu';
    const TEST_SKIN_CODE        = 'jDZlMsi1';

//    const HMAC_KEY_NOTIFICATION_SANDBOX = '8EA842DBAAC5A74334B97FFBD24D572528608AD6EED1FD92A5736F3AAD156A44';
//    const HMAC_KEY_NOTIFICATION_LIVE = '0024A25EA9F73E29B492EA78C84EC64D0A2FBDEB0B2EA5C6D9717E528465B6C4';

    //Live Skin (IDC: 5woQhOcu)
    const HMAC_KEY_NOTIFICATION_SANDBOX = '943FC37D1523298B5DBEF17A3EEBFBC62066855C3CCE6ACFAF1702FEC9FE77A2';
    const HMAC_KEY_NOTIFICATION_LIVE = 'FD1304F1E323BDCD041EF62DFBBD706B7BCC6D8AA098A41387E862E80BC7B5BE';

    const HTTP_AUTHORIZATION = 'wolopay:!-E>Gp26(aA9X<a$';

    const MERCHANT_ACCOUNT      = 'IDCGamesCOM';

    public static $availableLanguages = [ 'el','hu','it','li','no','pl','pt','ru','sk','es','sv','th','tr','uk', 'ge', 'fr', 'fi', 'nl', 'da', 'cz', 'zh'];

    public static $visaCommissionPerCurrency = ['DEF'=>2.5, 'BRL'=>4, 'EUR'=>1.5,'GBP'=> 1.70, 'KRW'=> 4, 'PLN'=>1.5, 'USD'=>3.5];
    public static $mcCommissionPerCurrency =   ['DEF'=>2.7, 'BRL'=>4, 'EUR'=>1.8,'GBP'=> 3.70, 'KRW'=> 4, 'PLN'=>1.5, 'USD'=>3];

    const PREFIX_EXTERNAL_TRANSACTION = 'ADYEN_';

    /**
     * @InjectParams({
     *    "subscriptionFinished"   = @Inject("shop.subscription.finished"),
     *
     *    "live"   = @Inject("%payments.adyen.live%"),
     *    "locale" = @Inject("%locale%")
     * })
     */
    function __construct($live, $locale, SubscriptionFinished $subscriptionFinished)
    {
        $this->subscriptionFinished = $subscriptionFinished;

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
        $pmpc = $previous->getPayMethodProviderHasCountry();

        if (!$gamer->getEmail())
            throw new EmailRequiredPayMethodException();

        $credentials = $this->getProviderClientCredentials($transaction->getApp(), $pmpc->getProvider(), $this->getShapeProviderClientCredentials());

        if ($credentials === null)
            throw new PayMethodOnlyAvailableWithProviderClientCredentialsException($transaction->getApp(), $pmpc->getProvider());
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $url = $this->getUrlProvider();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentInteract->getPaymentProcess()->getPaymentDetail(),
            $this->getShapeProviderClientCredentials()
        );

        $parameters = $this->generateParameters($paymentInteract);
        $parameters = $this->generateSignatureToPaymentSetup($parameters, $credentialsDetailsArr['hmac_key']);

        foreach($parameters as $field => $value)
            $url .= "&".$field."=".urlencode($value);

        $this->logger->addInfo('Parameters sent: '.urldecode(http_build_query($parameters)));

        $paymentInteract->setRequestResult($url);
    }

    protected function generateParameters(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $gamer = $paymentDetails->getTransaction()->getGamer();

        $lang = strtoupper($this->locale);

        if (in_array($paymentDetails->getLanguage()->getId(), self::$availableLanguages))
            $lang = $paymentDetails->getLanguage()->getId();

        if ($lang=='en')
            $lang = 'en_GB';

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );
        // https://github.com/Adyen/php/blob/master/1.HPP/create-payment-url.php

        $request = [
            "merchantReference" => $paymentProcess->getId(),
            "paymentAmount" => $this->amountWithoutDecimals($paymentDetails->getAmount(), $paymentDetails->getCurrency()->getDecimalPlaces()),
            "currencyCode" => $paymentInteract->getCurrencyPaymentISO(),

            "shipBeforeDate" => date("Y-m-d"),
            "skinCode" => $credentialsDetailsArr['skin_code'] ?: self::SKIN_CODE,
            "merchantAccount" => $credentialsDetailsArr['merchant_account'] ?: self::MERCHANT_ACCOUNT,
            "sessionValidity" => date("c",strtotime("+2 hours")),
            "shopperLocale" => $lang,

            "orderData" => base64_encode(gzencode($paymentInteract->getNameAllTranslations($paymentDetails))),
            "shopperEmail" => $gamer->getEmail(),
            "shopperReference" => $gamer->getId(),
            "allowedMethods" => "",
            "recurringContract" => "ONECLICK",
            'merchantReturnData' => $paymentProcess->getPaymentDetail()->getSecurityRandomDone()
        ];

        if ($paymentDetails->getCountryGamer())
            $request["countryCode"] = $paymentDetails->getCountryGamer()->getId();

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $paymentDetails->getPayMethod()->getId(), $paymentDetails->getProvider()->getId(), $paymentDetails->getCountry()->getId()
        );

        if (!$pmpc)
            throw new \Exception("Unknown PayMethodHasProvider");

        $extraOptions = $pmpc->getPayMethodHasProvider()->getExtraOptions();

        if (isset($extraOptions['external_provider_id']))
            $request['allowedMethods'] = $extraOptions['external_provider_id'];

        return $request;
    }

    protected function generateSignatureToPaymentSetup($params, $HMAC_KEY = null)
    {
        $hmacKey="";
        if ($HMAC_KEY) {
            $hmacKey=$HMAC_KEY;
        } else{
            if ($this->providerLive){
                $hmacKey=self::HMAC_KEY_NOTIFICATION_LIVE;
            }else{
                $hmacKey=self::HMAC_KEY_NOTIFICATION_SANDBOX;
            }
        }

        // The character escape function
        $escapeval = function($val) {
            return str_replace(':','\\:',str_replace('\\','\\\\',$val));
        };

        // Sort the array by key using SORT_STRING order
        ksort($params, SORT_STRING);

        // Generate the signing data string
        $signData = implode(":",array_map($escapeval,array_merge(array_keys($params), array_values($params))));

        // base64-encode the binary result of the HMAC computation
        $merchantSig = base64_encode(hash_hmac('sha256',$signData,pack("H*" , $hmacKey),true));
        $params["merchantSig"] = $merchantSig;

        $this->logger->addInfo('Key used: '.$hmacKey.'; SignData='.$signData . 'merchantSig='.$merchantSig);


        return $params;
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $request        = $paymentInteract->getRequest();
        $currencyId = $paymentDetails->getCurrency()->getId();
/*
        $adyenMarkupPercent = 0.6;
        $adyenFixed = 0.1;
        $schemeFeePercent = 0.2;
        $interchangeMCMin = 0.03;
        $interchangeMCPercent = 0.25;
        $interchange= .2;
*/

        $event = $request->get('eventCode');
        $this->logger->addInfo("Payment status by ADYEN: ". $event);

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        switch($event){

            case 'AUTHORISATION':

                if ($request->get('success') == 'true')
                {
                    if (!$this->verifyPaymentWasSentByProvider($request, $credentialsDetailsArr['authorization']))
                    {
                        $paymentInteract->setPaymentAttemptHack("Signature is incorrect");
                        $paymentInteract->setResponseStatus(401);
                        return;
                    }

                    switch ($request->get('paymentMethod')){
                        case 'visa':
                            if (array_key_exists($currencyId,self::$visaCommissionPerCurrency)){
                                $percent = self::$visaCommissionPerCurrency[$currencyId];
                                $this->logger->addInfo('Adyen->Visa, currency = '.  $currencyId .', commission percent: ' . $percent);
                            }else{
                                $percent = self::$visaCommissionPerCurrency["DEF"];
                                $this->logger->addInfo('Adyen->Visa, default currency, commission percent: ' . $percent);
                            }
                            $paymentFeeBean = new PaymentFeeBean(null, new Currency('EUR'), $percent);
                            break;
                        case 'mc':
                            if (array_key_exists($currencyId,self::$mcCommissionPerCurrency)){
                                $percent = self::$mcCommissionPerCurrency[$currencyId];
                                $this->logger->addInfo('Adyen->MasterC, currency = '.  $currencyId .', commission percent: ' . $percent);
                            }else{
                                $percent = self::$mcCommissionPerCurrency["DEF"];
                                $this->logger->addInfo('Adyen->MasterC, default currency, commission percent: ' . $percent);
                            }

                            $paymentFeeBean = new PaymentFeeBean(null, new Currency('EUR'), $percent);
                            break;
                        case 'maestro':
                            $paymentFeeBean = new PaymentFeeBean(null, new Currency('EUR'), 3.85);
                            break;
                        case 'amex':
                            //en el caso de amex, adyen se queda 3.95%
                            $paymentFeeBean = new PaymentFeeBean(null,new Currency('EUR'),3.95);
                            break;
                        case 'diners':
                            //en el caso de diners, adyen se queda 3.5%
                            $paymentFeeBean = new PaymentFeeBean(null,new Currency('EUR'),3.5);
                            break;
                        case 'discover':
                            //en el caso de discover, adyen se queda 3.5%
                            $paymentFeeBean = new PaymentFeeBean(null,new Currency('EUR'),3.5);
                            break;
                        case 'unionpay':
                            //en el caso de UnionPay, adyen se queda 3.25%
                            $paymentFeeBean = new PaymentFeeBean(null,new Currency('EUR'),3.25);
                            break;
                        default:
                            //jcb, sepa, IBAN.. just in case
                            $paymentFeeBean = new PaymentFeeBean(null, new Currency('EUR'), 1, null, null, 0.5);
                    }
                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('pspReference'), $paymentFeeBean);

                }

                break;
            case 'CANCELLATION':
                $paymentInteract->setPaymentCancelled('User canceled');
                break;
            case 'PENDING':
                $paymentInteract->setPaymentPending($request->get('reason'));
                break;
            case 'NOTIFICATION_OF_FRAUD':
                $paymentInteract->setPaymentCancelled('Fraud: '.$request->get('reason'));
                $paymentInteract->setPaymentDispute();
                break;
            case 'REFUND':
                $paymentInteract->setPaymentCancelled('Refused');
                break;
            case "NOTIFICATION_OF_CHARGEBACK":
                $paymentInteract->setPaymentDispute();
                break;
            case "CHARGEBACK":
                $paymentInteract->setPaymentDisputeEnd(false, $request->get('reason'));
                $paymentInteract->setExtraCost(new PurchaseExtraCostBean(CurrencyEnum::EURO, -7.5, -7.5, -7.5), 'Charge back, commission by Adyen');
                break;
            case "CHARGEBACK_REVERSED":
                $paymentInteract->setPaymentDisputeEnd(true, $request->get('reason'));
                $paymentInteract->setExtraCost(new PurchaseExtraCostBean(CurrencyEnum::EURO, 7.5, 7.5, 7.5), 'Commission by Adyen reversed');
                break;
            case "REPORT_AVAILABLE":
                // do nothing
                $paymentInteract->setResponseStatus(200);
                break;
            default:
                $this->logger->addAlert("Unknown adyen event: $event");
                $paymentInteract->setResponseStatus(200);

        }

        $paymentInteract->getResponseResult()->setContent('[accepted]');
    }

    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    protected function getUrlPalProvider()
    {
        return $this->providerLive ? self::URL_PAL_LIVE : self::URL_PAL_SANDBOX;
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        if ($request->get('eventCode') == 'REPORT_AVAILABLE' || in_array($request->get('merchantReference'), ['0.5', '050']))
            return new Response('[accepted]');

        if (!$request->get('merchantReference'))
        {
            $this->logger->addError("haven't query parameter 'merchantReference'");
            return null;
        }

        if (!$singlePayment = $this->em->getRepository("AppBundle:SinglePayment")->find($request->get('merchantReference')))
        {
            if (!$singlePayment = $this->em->getRepository("AppBundle:Subscription")->find(substr($request->get('merchantReference'), 0,29)))
            {
                if (!$singlePayment = $this->em->getRepository("AppBundle:Payment")->findOneByTransactionExternalId(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('pspReference')))
                {
                    if (!$singlePayment = $this->em->getRepository("AppBundle:Payment")->findOneByTransactionExternalId(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('originalReference')))
                    {
                        $this->logger->addError("Not found single payment or Subscription payment: '".$request->get('merchantReference')."'" . print_r($request->query->all(), true));
                        return null;
                    }
                }

                if ($singlePayment instanceof SubscriptionEventualityPayment)
                {
                    $singlePayment = $singlePayment->getSubscriptionEventuality()->getSubscription();
                }
            }
        }

        return $singlePayment;
    }

    protected function verifyPaymentWasSentByProvider(Request $request, $authorization = null)
    {
        if (! ($authorization ?: self::HTTP_AUTHORIZATION) === $request->headers->get('Authorization'))
            return false;

        return true;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {
        try{
            $params = [
                "merchantReference" => uniqid(),
                "paymentAmount" => 2000,
                "currencyCode" => 'EUR',
                "shopperEmail" => 'test@wolopay.com',
                "shipBeforeDate" => date("Y-m-d"),
                "skinCode" => $credentialsArray['skin_code'],
                "merchantAccount" => $credentialsArray['merchant_account'],
                "sessionValidity" => date("c",strtotime("+2 hours")),
                "orderData" => base64_encode(gzencode('test')),
                "shopperReference" => 'test',
                "allowedMethods" => "",
                "blockedMethods" => "",
                "offset" => "",
                "merchantSig" => "",
                "recurringContract" => "ONECLICK",
                'merchantReturnData'=> 'https://wolopay.com',
            ];

            $params = $this->generateSignatureToPaymentSetup($params, $credentialsArray['hmac_key']);
            $url = self::URL_LIVE;
            foreach($params as $field => $value)
                $url .= "&".$field."=".urlencode($value);

            $request = $this->guzzle->get($url);
            $response = $request->send();

            if (strpos($response->getBody(true), 'Invalid Request') !== false)
                return false;

        }catch (\Exception $e){
            $this->logger->addInfo("Error validation ".$e->getMessage());
            return false;
        }

        return true;
    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return [
            'api_user'         => null,
            'api_password'     => null,
            'merchant_account' => null,
            'skin_code'        => null,
            'authorization'    => null,
            'hmac_key'         => null,
        ];
    }
}