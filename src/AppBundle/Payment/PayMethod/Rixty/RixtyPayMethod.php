<?php

namespace AppBundle\Payment\PayMethod\Rixty;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("shop.payment.rixty_ipn_pay_method")
 *
 * At this moment is inactive
 *
 * To test
 * user: Makalister
 * password: pw4742
 *
 * Controll panel
 * https://sandbox.rixty.com/merchant
 *
 * username: dmorillo@nviasms.com
 * password: perry
 *
 * To change ipn url,
 * 1. first you need change in control panel.
 * 2. ask with partnersupport@rixty.com to deploy setting to production
 */
class RixtyPayMethod  extends AbstractPayMethod implements PayMethodIpnStaticExecutionInterface
{
    /** @var string  */
    protected $providerlive;

    /** @var string  */
    protected $providerUser;

    /** @var string  */
    protected $providerPassword;

    const URL_SANDBOX = 'https://sandbox.rixty.com/rixtyapi/payout';
    const URL_LIVE    = 'https://partner.rixty.com/rixtyapi/payout';

    const PREFIX_EXTERNAL_TRANSACTION = 'RIXTY_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.rixty.live%"),
     *    "user"  = @Inject("%payments.rixty.user%"),
     *    "password"  = @Inject("%payments.rixty.password%")
     * })
     */
    function __construct($live, $user, $password)
    {
        $this->providerlive = $live;

        $this->providerUser     = $user;
        $this->providerPassword = $password;
    }

    /**
     * @param PaymentPrepareInteract $paymentInteract
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\BadResponseException
     */
    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $postValues = [
            'applicationCode' => $this->providerUser,
            'referenceId'     => $paymentProcess->getId(),
            'version'         => 'v1',
            'channelId'       => 2,
            'amount'          => $this->amountWithoutTwoLastNumbersAsDecimals($paymentInteract->getAmountFloat()),
            'currencyCode'    => $paymentInteract->getCurrencyPaymentISO(),
            'returnUrl'       => $this->router->generate('shop_index',['transaction_id'=>$paymentDetails->getTransaction()->getId()], true),
            'description'     => $paymentInteract->getNameAllTranslations($paymentDetails),
            'customerId'      => $paymentDetails->getTransaction()->getGamer()->getId(),
        ];

        $this->logger->addInfo('Parameters sent: '.http_build_query($postValues));

        $postValues['signature'] = md5(
            $postValues['amount'] . $postValues['applicationCode'] . $postValues['channelId'] . $postValues['currencyCode']
            . $postValues['customerId'] . $postValues['description'] . $postValues['referenceId']  . $postValues['returnUrl']
            . $postValues['version'] . $this->providerPassword
        );

        try{
            $url = $this->getUrlProvider().'/payments';
            $paymentInteract->setSubRequestDone($url, $postValues);
            $request  = $this->guzzle->post($url, null, $postValues);
            $response = $request->send();

            $paymentInteract->setSubRequestDoneResponse($response->getBody(), $response->getStatusCode(), true);
            $result = json_decode($response->getBody());

            $paymentInteract->setRequestResult(urldecode($result->paymentUrl), 'GET');


        } catch (BadResponseException $exception) {

            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;

        }

    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        if (!$request->get('referenceId'))
        {
            $this->logger->addError("haven't query parameter 'referenceId'");
            return null;
        }

        return $this->genericIpnStaticWhichPaymentIsIt($request->get('referenceId'));
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     */
    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $amount = $request->get('amount');
        $version = $request->get('version');
        $paymentId = $request->get('paymentId');
        $currencyCode = $request->get('currencyCode');
        $paymentStatusCode = $request->get('paymentStatusCode');
        $signature = $request->get('signature');
        $returnUrl = $request->get('returnUrl');

        $this->logger->debug("Payment status by Rixty: ". $request->get('payment_status'));

        if ($paymentStatusCode != '00')
        {
            if ($paymentStatusCode == '99')
            {
                $paymentInteract->setPaymentFailed();
            }else{

                if ($paymentStatusCode == '01')
                    $txt = 'Incomplete';
                else
                    $txt = 'Expired';

                $paymentInteract->setPaymentCancelled($txt.' by rixty');
            }

            $this->logger->info("the payment doesn't end correctly, status: '$paymentStatusCode''");
            return;
        }

        $valid = false;

        $getValues = ''.
            "applicationCode=$this->providerUser".
            "&paymentId=$paymentId".
            "&version=$version".
            "&signature=".md5($this->providerUser . $paymentId . $version . $this->providerPassword)
        ;

        try{
            $request  = $this->guzzle->get($this->getUrlProvider().'/payments?'. $getValues);
            $response = $request->send();

            $result = json_decode($response->getBody());

            if ($result->paymentStatusCode === "00")
                $valid=true;

        }catch (\Exception $e){
            $this->logger->addError("error response ". $e->getMessage());
        }

        if (!$valid)
        {
            $paymentInteract->setPaymentFailedIncorrectOrCrashed();
            return;
        }

        $amount = $amount / 100;

        if ($paymentInteract->validatePrice($amount, $currencyCode))
            $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$paymentId);

    }

    /**
     * @return array
     */
    protected function getUrlProvider()
    {
        return $this->providerlive ? self::URL_LIVE : self::URL_SANDBOX;
    }

}