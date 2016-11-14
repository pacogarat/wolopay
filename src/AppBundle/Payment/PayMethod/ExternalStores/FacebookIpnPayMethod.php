<?php

namespace AppBundle\Payment\PayMethod\ExternalStores;

use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Payment\Actions\SubscriptionFinished;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\PayMethod\Exceptions\PayMethodOnlyAvailableWithProviderClientCredentialsException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use AppBundle\Service\ArticleService;
use Facebook\FacebookRequest;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.facebook_ipn_pay_method")
 */
class FacebookIpnPayMethod extends AbstractExternalStore implements PayMethodIpnStaticExecutionInterface, PayMethodRefundExecutionInterface, PreviousStepInterface, PayMethodVerifyCredentialsInterface
{
    /** @var SubscriptionFinished */
    protected $subscriptionFinished;

    /** @var string  */
    protected $providerLive;
    protected $transactionCreateCommand;
    /** @var  ArticleService */
    protected $articleService;
    protected $paymentCompleted;

    const PREFIX_EXTERNAL_TRANSACTION = 'FACE_';
    const PREFIX_USER = 'FACE_';

    /**
     * @InjectParams({
     *    "locale" = @Inject("%locale%"),
     *    "providerLive" = @Inject("%payments.facebook.live%")
     * })
     */
    function __construct($locale, $providerLive)
    {
        $this->locale                   = $locale;
        $this->providerLive = $providerLive;
    }

    /**
     * @param PaymentPreviousStepsInteract $previous
     * @throws \AppBundle\Payment\PayMethod\Exceptions\PayMethodOnlyAvailableWithProviderClientCredentialsException
     * @return mixed
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous)
    {
        $transaction = $previous->getTransaction();
        $pmpc = $previous->getPayMethodProviderHasCountry();

        $credentials = $this->getProviderClientCredentials($transaction->getApp(), $pmpc->getProvider(), $this->getShapeProviderClientCredentials());

        if ($credentials === null)
            throw new PayMethodOnlyAvailableWithProviderClientCredentialsException($transaction->getApp(), $pmpc->getProvider());
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $paymentInteract->setResponseToDo(
            new JsonResponse([
                'payment_process_id' => $paymentProcess->getId()
            ])
        );
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        if ($request->getMethod() === 'GET' && $request->get('hub_verify_token') === 'token_verify' ) // todo change
            return new Response($request->get('hub_challenge'));

        $app = $this->em->getRepository("AppBundle:App")->find($request->get('app_id'));
        $provider = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name' => ProviderEnum::FACEBOOK_NAME]);

        $credentials = $this->getProviderClientCredentials($app, $provider, $this->getShapeProviderClientCredentials());
        $processPayment = null;

        if ($request->get('object') === 'payments')
        {
            $paymentId = $request->get("entry[0][id]", null, true);

            $responseArr = $this->getValuesFromPaymentId($paymentId, $credentials['app_id'], $credentials['app_secret']);
            $processPayment = $this->em->getRepository("AppBundle:Payment")->find($responseArr['request_id']);
        }

        return $processPayment;
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     */
    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request = $paymentInteract->getRequest();

        $this->logger->addInfo('POST'.print_r($request->request->all(), true));
        $this->logger->addInfo('GET'.print_r($request->query->all(), true));

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $paymentInteract->getPaymentProcess()->getPaymentDetail(),
            $this->getShapeProviderClientCredentials()
        );

        if ($request->get('object') === 'payments')
        {
            $paymentId = $request->get("entry[0][id]", null, true);
            $responseArr = $this->getValuesFromPaymentId($paymentId, $credentialsDetailsArr['app_id'], $credentialsDetailsArr['app_secret']);

            $this->logger->addInfo("STATE: ".print_r($responseArr, true));

            if (in_array('actions', $request->get('entry[0][changed_fields]', null, true)))
            {
                $actions = $responseArr['actions'][count($responseArr['actions'])-1]; // get last Action
                switch ($actions['type'])
                {
                    case 'charge':

                        if( $actions['status'] == 'completed' )
                        {
                            $currency = $this->em->getRepository("AppBundle:Currency")->find($actions['currency']);

                            $paymentInteract->setPaymentCompleted(
                                static::PREFIX_EXTERNAL_TRANSACTION . $paymentId,
                                new PaymentFeeBean($actions['tax_amount'], $currency),
                                new AmountBean($actions['amount'], $currency)
                            );
                        }

                        break;
                    case 'chargeback':
                    case 'decline':
                    case 'refund':

                        $paymentInteract->setPaymentCancelled($actions['type']);

                        break;
                }
            }

            if (in_array('disputes', $request->get('entry[0][changed_fields]', null, true)))
            {
                $disputes = $responseArr['disputes'][0];

                if ($disputes['status'] == 'pending')
                {
//                    $paymentInteract->setPaymentDispute(null, $disputes['user_comment']);

                }else if ($disputes['status'] == 'resolved'){

                    $actions = $responseArr['actions'];

//                    if ($actions[count($actions)-1]['type'] == 'refund')
//                        $paymentInteract->setPaymentDisputeEnd(false, $disputes['reason']);
//                    else
//                        $paymentInteract->setPaymentDisputeEnd(true, $disputes['reason']);
                }

                // We'll ignore at this moment because we need to close paymentDispute with api and develop a admin
                // version to handle disputes..
                $paymentInteract->setResponseStatus(200);
            }
        }
    }

    public function executeRefund(Payment $payment, $reason = 'refund', $clientPetition = false)
    {
        $purchase = $payment->getPurchase();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerLive,
            $payment->getPaymentDetail(),
            $this->getShapeProviderClientCredentials()
        );

        $fb = new \Facebook\Facebook([
            'app_id'                => $credentialsDetailsArr['app_id'],
            'app_secret'            => $credentialsDetailsArr['app_secret'],
            'default_graph_version' => 'v2.5',
        ]);

        $params = [
            'currency' => $purchase->getCurrency()->getId(),
            'amount'   => $purchase->getAmountTotal(),
            'reason' => 'CUSTOMER_SERVICE'
        ];

        $response = $fb->post(
            "/".$this->getExternalIdWithOutPrefix($payment->getTransactionExternalId())."/refunds",
            $params,
            $this->getAccessToken($credentialsDetailsArr['app_id'], $credentialsDetailsArr['app_secret'])
        );

        return true;
    }

    protected function getValuesFromPaymentId($paymentId, $appId, $appSecret)
    {
        $fb = new \Facebook\Facebook([
            'app_id'                => $appId,
            'app_secret'            => $appSecret,
            'default_graph_version' => 'v2.5',
        ]);

        $response = $fb->get(
            "/$paymentId?fields=user,actions,items,gift_requests,request_id,disputes",
            $this->getAccessToken($appId, $appSecret)
        );

        return $response->getDecodedBody();
    }

    protected function getAccessToken($appId, $appSecret)
    {
        return "$appId|$appSecret";
    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return [
            'app_id'         => null,
            'app_secret'     => null,
        ];
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {
        $fb = new \Facebook\Facebook([
            'app_id'                => $credentialsArray['app_id'],
            'app_secret'            => $credentialsArray['app_secret'],
            'default_graph_version' => 'v2.5',
        ]);

        $response = $fb->get(
            "/app",
            $this->getAccessToken($credentialsArray['app_id'], $credentialsArray['app_secret'])
        );

        return true;
    }


}