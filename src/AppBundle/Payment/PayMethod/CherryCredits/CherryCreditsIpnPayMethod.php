<?php

namespace AppBundle\Payment\PayMethod\CherryCredits;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.cherry_credits_ipn_pay_method")
 *
 * User for testing
 *
 * User: gwtest@cherrycredits.com
 * Password: gwtest123
 * Pin: 123123
 *
 * To change ipn url
 * 1. speak with rdy2strike(Sean Tan) via skype
 *
 * Production pins
 * Login: wolotest1@cherrycredits.com
 * wolo123
 * pin: 123123
 *
 * Conversion 1800 cherry credits = 1 USD
 */
class CherryCreditsIpnPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface, PayMethodIpnStaticExecutionInterface
{
    /** @var string  */
    protected $providerLive;

    const URL_LIVE    = 'https://gw.cherrycredits.com:8933/gateway.aspx';
    const URL_SANDBOX = 'http://gw.cherrycredits.com:9933/gateway.aspx';

    const URL_EXCHANGE_CREDITS = 'https://exchange.cherrycredits.com/TagGateway/WebLogin.aspx?data=';

    const MERCHANT_ID = 18000;
    const COMPANY_NAME = 'Wolopay';
    const SECURE_KEY = '0075cee3-6c46-4951-8e36-ba2abddc7d96';

    public static $availableLanguages = [ 'el','hu','it','li','no','pl','pt','ru','sk','es','sv','th','tr','uk', 'ge', 'fr', 'fi', 'nl', 'da', 'cz', 'zh'];

    const PREFIX_EXTERNAL_TRANSACTION = 'CHERRY_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.cherry.live%"),
     * })
     */
    function __construct($live)
    {
        $this->providerLive  = $live;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $url = $this->getUrlProvider();

        $parameters = $this->generateParameters($paymentInteract);
        $paymentInteract->setSubRequestDone($url, $parameters);

        try {

            $request = $this->guzzle->post($this->getUrlProvider(), null, $parameters);
            $response = $request->send();

        } catch (BadResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }

        $paymentInteract->setSubRequestDoneResponse($response->getBody(true));
        $url = self::URL_EXCHANGE_CREDITS.$response->getBody(true);

        $paymentInteract->setRequestResult($url);
    }

    protected function generateParameters(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $amountCherryCredits = $this->currencyService->getExchangeFromVirtualFromProvider(
            $paymentDetails->getAmount(),
            $paymentDetails->getCurrency(),
            $paymentDetails->getProvider()
        );

        $params = [
            "MerchantID" => self::MERCHANT_ID,
            'mAcctID'    => $paymentDetails->getTransaction()->getGamer()->getId(),
            "mAmount"    => $amountCherryCredits,
            'mCredits'   => $amountCherryCredits,
            'mTransID' => $paymentProcess->getId(),
            "mTransDesc" => $paymentInteract->getNameAllTranslations($paymentDetails),
            "mUserIP"    => $paymentProcess->getIp(),
            'mProductID' => uniqid(),
            "mSignature" => md5(
                self::SECURE_KEY . self::MERCHANT_ID . $amountCherryCredits . $paymentProcess->getId() . $amountCherryCredits
            ),
        ];

        return $params;
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $request        = $paymentInteract->getRequest();

        if ($request->get('TransReqStatus') !== '2')
        {
            $this->logger->addInfo('Not valid TransReqStatus: "'.$request->get('TransReqStatus').'"');
            return;
        }

        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->get('ccTransID'));

        $paymentInteract->getResponseResult()->setContent('[accepted]');
    }

    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        return $this->genericIpnStaticWhichPaymentIsIt($request->get('mTransID'));
    }

}