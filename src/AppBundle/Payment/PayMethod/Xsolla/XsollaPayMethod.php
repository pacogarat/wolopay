<?php

namespace AppBundle\Payment\PayMethod\Xsolla;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Subscription;
use AppBundle\Exception\NviaException;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentDetailBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Service("shop.payment.xsolla_ipn_pay_method")
 */
class XsollaPayMethod extends AbstractPayMethod  implements PayMethodIpnStaticExecutionInterface
{
    /** @var string  */
    protected $providerLive;

    public static $availableLanguages = [ 'en','ru','bg','cn','cs','de','ar','es','fr','he','vi','tw','tr','th','ro','pt','pl','ko','ja','it'];

    const PROYECT_ID       = '14258';
    const PROYECT_SECRET   = 'Cgg7gjCr9YP9kM0m';

    const MERCHANT_ID      = '8564';
    const MERCHANT_SECRET  = 'jPFPQiHsdAKyn0DQ';

    const BASE_URL = 'https://secure.xsolla.com/paystation2';
    const SANDBOX_URL = 'https://sandbox-secure.xsolla.com/paystation2';

    const PREFIX_EXTERNAL_TRANSACTION = 'XSOLLA_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.xsolla.live%"),
     * })
     */
    function __construct($live)
    {
        $this->providerLive  = $live;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $lang = $this->locale;

        if (in_array($paymentDetails->getLanguage()->getId(), static::$availableLanguages))
            $lang = $paymentDetails->getLanguage()->getId();

        $requestParameters = $this->generatePrepareParameters($paymentInteract, $lang);
        $this->logger->addInfo('Parameters sent: '.http_build_query($requestParameters));

        // IMPORTANT: To load Sandbox currency will be USD
        if ($this->providerLive == false)
            $requestParameters['settings']['mode'] = 'sandbox';

        $headers = [
            'Content-Type'=>'application/json',
            'Accept'=>'application/json',
        ];

        $options = [
            'auth'    => [static::MERCHANT_ID, static::MERCHANT_SECRET],
        ];

        $url = 'https://api.xsolla.com/merchant/merchants/'.static::MERCHANT_ID.'/token';

        $response = null;

        try {
            $paymentInteract->setSubRequestDone($url, $requestParameters);
            $request = $this->guzzle->post($url, $headers, json_encode($requestParameters), $options);
            $response = $request->send();

        } catch (ClientErrorResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            $this->logger->addError($exception->getResponse()->getBody(true));
            throw $exception;
        }

        $responseObj = json_decode($response->getBody(true));
        $paymentInteract->setSubRequestDoneResponse($response->getBody(true), $response->getStatusCode());
//        die($responseObj->token);
        $url = $this->getUrlBase().'/?access_token='.$responseObj->token;

        $paymentInteract->setRequestResult($url);
    }

    protected function generatePrepareParameters(PaymentPrepareInteract $paymentInteract, $lang)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $parameters = [
            'user' => [
                'id' => [
                    'value'  => (string)$paymentDetails->getTransaction()->getGamer()->getId(),
                    'hidden' => true,
                ],
            ],
            'settings' => [
                'project_id'  => (int) static::PROYECT_ID,
                'language'    => $lang,
                'currency'    => $paymentDetails->getCurrency()->getId(),
                'external_id' => $paymentProcess->getId(),
                'return_url'  => $paymentInteract->getUrlOk(),
            ],
            'purchase' => [
                'checkout' => [
                    'currency' => $paymentDetails->getCurrency()->getId(),
                    'amount'   => $paymentDetails->getAmount()
                ],
                'description' => [
                    'value' => UtilHelper::maxLengthString(
                            $paymentInteract->getNameAllTranslations($paymentDetails),
                            100
                        )
                ]
            ]
        ];

        if ($paymentDetails->getCountryGamer() && $paymentDetails->getCountryGamer()->isStandardIsoCountry())
        {
            $parameters['user']['country'] = [
                'value'        => $paymentDetails->getCountryGamer()->getId(),
                'allow_modify' => true
            ];
        }

        $gamer = $paymentDetails->getTransaction()->getGamer();

        if ($gamer->getEmail())
            $parameters['user']['email'] = ['value' => $gamer->getEmail()];

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $paymentDetails->getPayMethod()->getId(), $paymentDetails->getProvider()->getId(), $paymentDetails->getCountry()->getId()
        );

        if (!$pmpc)
            throw new \Exception("Unknown PayMethodHasProvider");

        $extraOptions = $pmpc->getPayMethodHasProvider()->getExtraOptions();

        if (isset($extraOptions['external_provider_id']))
            $parameters['settings']['payment_method'] = $extraOptions['external_provider_id'];

        return $parameters;
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $this->logger->addInfo("Checkout");

        if ($request->get('notification_type') === 'payment')
        {
            $totalFee = $this->getFee($request, $paymentProcess);
            $vatPaidByXsolla = $this->getVat($request, $paymentProcess);
            $finalCurrency = $this->getFinalCurrency($request);
            $xsollaPayMethodId = $request->get('TRANSACTION[payment_method]', null, true);

            if ($paymentInteract->validatePrice($request->get('purchase[checkout][amount]', null, true), $request->get('purchase[checkout][currency]', null, true), $paymentProcess))
            {
                $amountSaved = $request->get('purchase[total][amount]', null, true);
                $currencySaved =  $this->em->getRepository("AppBundle:Currency")->find($request->get('purchase[total][currency]', null, true));

                $paymentInteract->setPaymentCompleted(static::PREFIX_EXTERNAL_TRANSACTION.$request->get('transaction[id]', null, true),
                    new PaymentFeeBean($totalFee, $finalCurrency, null, null),
                    new AmountBean($amountSaved, $currencySaved,false,false,null,null, $vatPaidByXsolla),
                    new PaymentDetailBean(["xsollaPayMethodId"=>$xsollaPayMethodId])
                );
            }
        }elseif ($request->get('notification_type') === 'refund') {

            $paymentInteract->setPaymentCancelled($request->get('refund_details[reason]', null, true));
        }

        $this->logger->addDebug("end xsolla.php");
    }

    protected function getFee(Request $request, PaymentProcessInterface $paymentProcess)
    {
        $xsollaFee = $payMethodFee = $vat = $payout = 0;

        if ($request->get('payment_details[payout][amount]', null, true) !== null)
        {
            $payout = $this->currencyService->getExchangeSimple($request->get('payment_details[payout][amount]', null, true),
                $request->get('payment_details[payout][currency]', null, true), $request->get('purchase[total][currency]', null, true));
            $vat = $this->getVat($request, $paymentProcess);

            if ($payout)
            {
                $xsollaFee = floatval($request->get('purchase[total][amount]', null, true)) - $payout;
            }
        }
        return $xsollaFee;
    }

    protected function getVat(Request $request, PaymentProcessInterface $paymentProcess)
    {
        $vat = null;
        if ($request->get('payment_details[vat][amount]', null, true) !== null)
        {
            $vat = $this->currencyService->getExchangeSimple(
                $request->get('payment_details[vat][amount]', null, true),
                $request->get('payment_details[vat][currency]', null, true),
                $request->get('purchase[total][currency]', null, true)
            );
        }
        return $vat;
    }

    protected function getFinalCurrency(Request $request)
    {
        if (!$currency = $this->em->getRepository("AppBundle:Currency")->find($request->get('purchase[total][currency]',null,true)))
            throw new NviaException("invalid currency '".$request->get('purchase[total][currency]',null,true)."'");

        return $currency;
    }

    /**
     * @return array
     */
    protected function getUrlBase()
    {
        return $this->providerLive ? static::BASE_URL : static::SANDBOX_URL;
    }

    /**
     * @param Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        $signature = 'Signature '.sha1($request->getContent().static::PROYECT_SECRET);

        if ($signature !== $request->headers->get('Authorization'))
            throw new BadRequestHttpException('{"error":{ "code": "INVALID_SIGNATURE", "message": "Invalid signature" }}');

        // ignore request create_subscription
        if ($request->get('notification_type') === 'create_subscription')
        {
            return new Response();
        }

        if ($request->get('notification_type') === 'user_validation')
        {
            $userId = $request->get('user[id]', null, true);

            if (!$this->em->getRepository("AppBundle:Gamer")->find($userId))
                throw new BadRequestHttpException('{"error":{ "code": "INVALID_USER", "message": "Invalid user" }}');

            return new Response();
        }

        $paymentProcess = null;

        if ($request->get('notification_type') === 'payment' || $request->get('notification_type') === 'refund')
        {
            if ($paymentProcessId = $request->get('transaction[external_id]', null, true))
            {
                if (!$paymentProcess = $this->em->getRepository("AppBundle:SinglePayment")->find($paymentProcessId))
                {
                    if (!$paymentProcess = $this->em->getRepository("AppBundle:Subscription")->find($paymentProcessId))
                    {
                        throw new BadRequestHttpException('{"error":{ "code": "INCORRECT_INVOICE", "message": "Invoice is incorrect." }}');
                    }
                }

            }else if($externalSubscriptionId = $request->get('purchase[subscription][subscription_id]', null, true)){

                if (!$paymentProcess = $this->em->getRepository("AppBundle:Subscription")->findOneByTransactionExternalId('XSOLLA_SUB_'.$externalSubscriptionId))
                {
                    throw new BadRequestHttpException('{"error":{ "code": "INCORRECT_INVOICE", "message": "Invoice is incorrect." }}');
                }

            }

        }

        return $paymentProcess;
    }
}