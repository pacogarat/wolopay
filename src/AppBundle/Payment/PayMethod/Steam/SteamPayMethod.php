<?php

namespace AppBundle\Payment\PayMethod\Steam;

use AppBundle\Entity\ClientHasProviderCredential;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Repository\ClientHasProviderCredentialRepository;
use AppBundle\Exception\NviaException;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\AbstractItemRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Exceptions\SteamIdRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnStaticExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodRefundExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use AppBundle\Util\SteamSignIn;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



abstract class SteamPayMethod extends AbstractPayMethod implements PreviousStepInterface, PayMethodIpnExecutionInterface,
    PayMethodRefundExecutionInterface
{
    /** @var string  */
    protected $providerLive;

    /** @var ContainerInterface */
    protected $container;

    const URL_LIVE         = 'https://api.steampowered.com/ISteamMicroTxn';
    const URL_SANDBOX      = 'https://api.steampowered.com/ISteamMicroTxnSandbox';

    const API_KEY          = 'BE8C8E9011D559ED704A1F3BC6321B8E';

    const PREFIX_EXTERNAL_TRANSACTION = 'STEAMWEB_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.steam_web.live%"),
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
     * @throws \AppBundle\Payment\PayMethod\Exceptions\SteamIdRequiredPayMethodException
     * @return mixed
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous)
    {
        $transaction = $previous->getTransaction();
        $gamer = $transaction->getGamer();

        if (!$gamer->getSteamId())
            throw new SteamIdRequiredPayMethodException();
    }

    public function executePaymentPrepareReal(PaymentPrepareInteract $paymentInteract, $isWeb=false)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em=$this->container->get('doctrine.orm.default_entity_manager');

        $request   = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $gamer = $transaction->getGamer();
        $app = $transaction->getApp();
        $providerCredentialDetails = $this->getProviderCredentialDetails($app->getId(), $em);
        $m=microtime(true);
        $steamOrderId=sprintf("%08d%05d",floor($m),($m-floor($m))*1000000);

        if (!$steamId=$gamer->getSteamId()){
            $steamId = $request->get('steamId');
            if ($steamId) $gamer->setSteamId($steamId);
            $em->persist($gamer);
            $em->flush();
        }
        if (!$steamId){

            //  throw new SteamIdRequiredPayMethodException();
            $provider = new SteamSignIn();
            $url=$provider->genUrl(
                $this->container->getParameter('domain_main') .
                $this->container->get('router')->generate('payment_steam_id_callback_required_form',
                    [
                        'transaction_id' => $transaction->getId()
                    ])
                , false);
            $this->logger->addInfo("Url to login into STEAM: $url");
            $paymentInteract->setRequestResult($url, 'GET');
        }

        $params = [
            'orderid' => $steamOrderId,
            'steamid' => $steamId,
            'appid'   =>  $providerCredentialDetails['app_id'],
            'key'     =>  $providerCredentialDetails['api_key'],
            'itemcount' => count($paymentDetails->getPaymentDetailHasArticles()),
            'language'  => $paymentDetails->getLanguage()->getId(),
            'currency'  => $paymentInteract->getCurrencyPaymentISO()
        ];
        if ($isWeb){
            $params['usersession'] = 'web';
            $params['ipaddress'] = $request->getClientIp();
        }else{
            $params['usersession'] = 'client';
        }

        $i = 0;
        foreach ($paymentDetails->getPaymentDetailHasArticles() as $ppdha)
        {
            $params["itemid[$i]"]     = $ppdha->getArticle()->getItem()->getId();
            $params["qty[$i]"]         = $ppdha->getArticlesQuantity();
            $params["amount[$i]"]      = $ppdha->getAmount()*100;
            $params["description[$i]"] = $paymentInteract->getNameTranslation($ppdha);

            $i++;
        }
        try {
            $url = $this->getUrlProvider() .'/InitTxn/v3/';

            $paymentInteract->setSubRequestDone($url, $params);
            $request = $this->guzzle->post($url,null ,$params);
            $response = $request->send();
            $resJson = $response->json()['response'];
            $paymentInteract->setSubRequestDoneResponse($response->getBody(true));
        } catch (BadResponseException $exception) {
            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }

        if ($resJson['result'] !== "OK")
        {
            throw new NviaException("Bad Status (".$resJson['error']['errorcode'].")with STEAM ".$resJson['error']['errordesc']);
        }
        if (!$resJson['params']['transid'])
        {
            throw new NviaException("Parameters missing from STEAM answer (transid)");
        }

        $externalTransactionId=$resJson['params']['transid'];
        $paymentProcess->setTransactionExternalId($externalTransactionId);
        $paymentDetails->setExtraData(array("steamOrderId" => $steamOrderId, "steamTransactionId"=>$externalTransactionId));


        if ($isWeb){
            if (!$resJson['params']['steamurl'])
            {
                throw new NviaException("Parameters missing from STEAM answer (steamurl)");
            }

            $retUrl = $paymentInteract->getUrlIpn();
            $urlToConfirmInSteam=$resJson['params']['steamurl'] . '?returnurl=' . $retUrl;
            $paymentInteract->setRequestResult($urlToConfirmInSteam, 'GET');
        }else{
            $paymentInteract->setResponseToDo(new JsonResponse(['payment_process_id' => $paymentProcess->getId()]));
        }
        $em->persist($paymentDetails);
        $em->flush();
    }

    /**
     * @param Request $request
     * @return PaymentProcessInterface|Response
     */
    public function ipnStaticWhichPaymentIsIt(Request $request)
    {
        $steamOrderId = $request->get('steamOrderId');
        $conditionExtraData = '%"steamOrderId":"'.$steamOrderId.'"%';
        return $this->IpnStaticWhichPaymentByExtraData($conditionExtraData);
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $amountSum=$vatSum=0;

        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $request        = $paymentInteract->getRequest();


        $resJson = $this->finalizeSteamTransaction($paymentInteract);

        if ($resJson['result']=='OK'){
            $params = $resJson['params'];

            //$paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $params['transid']);
            $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $params['orderid']);

            $paymentInteract->setResponseDirectly(
                new RedirectResponse($this->generateUrlPaymentDone($paymentProcess))
            );
            return;
        }

        //Double check with QueryTxn
        $resJson = $this->getSteamTransactionStatus($paymentInteract);
        $params = $resJson['params'];

        switch($params['status']) {
            case "Approved":
                foreach ($params['items'] as $item) {
                    $amountSum += $item['amount'];
                    $vatSum += $item['vat'];
                }
                $tot = $amountSum + $vatSum;

                if ($paymentInteract->validatePrice($tot, $params['currency'], $paymentProcess)) {
                    //$paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $params['transid']);
                    $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $params['orderid']);
                    if (!$paymentDetails->getTransaction()->getGamer()->getSteamId()) $paymentDetails->getTransaction()->getGamer()->setSteamId($params['steamid']);

                    $paymentInteract->setResponseDirectly(
                        new RedirectResponse($this->generateUrlPaymentDone($paymentProcess))
                    );
                }
                break;

            case "Failed":
                $paymentInteract->setPaymentFailed();
                $paymentInteract->setResponseDirectly(
                    new RedirectResponse($this->generateUrlPaymentCancel($paymentProcess))
                );
                break;
            case "Init":
                $paymentInteract->setPaymentPending("Initiated in Steam and waiting");
                break;
            default:
                $paymentInteract->setPaymentFailedIncorrectOrCrashed();
                $paymentInteract->setResponseDirectly(
                    new RedirectResponse($this->generateUrlPaymentCancel($paymentProcess))
                );
                break;
        }
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     * @return \Guzzle\Http\Message\Response
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\BadResponseException
     */
    protected function finalizeSteamTransaction(PaymentIpnInteract $paymentInteract)
    {
        // https://api.steampowered.com/ISteamMicroTxn/FinalizeTxn/V0002/ (?orderid&appid)
        $request = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $app = $transaction->getApp();
        $providerCredentialDetails = $this->getProviderCredentialDetails($app->getId());
        $app_id = $providerCredentialDetails['app_id'];
        $api_key = $providerCredentialDetails['api_key'];

        $steamOrderId = $paymentDetails->getExtraData()['steamOrderId'];

        $params = [
            'orderid' => $steamOrderId,
            'appid' => $app_id,
            'key' => $api_key,
        ];

        try {
            $url = $this->getUrlProvider() . '/FinalizeTxn/v2/';
            $paymentInteract->setSubRequestDone($url, $params);
            $request = $this->guzzle->post($url, null, $params);
            $response = $request->send();
            $resJson = $response->json()['response'];
            return $resJson;
        } catch (BadResponseException $exception) {
            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     * @return \Guzzle\Http\Message\Response
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\BadResponseException
     */
    protected function getSteamTransactionStatus(PaymentIpnInteract $paymentInteract)
    {
        $request   = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $app = $transaction->getApp();
        $providerCredentialDetails = $this->getProviderCredentialDetails($app->getId());
        $app_id   =  $providerCredentialDetails['app_id'];
        $api_key =  $providerCredentialDetails['api_key'];

        try {
            $url = $this->getUrlProvider() .'/QueryTxn/v2/';
            $params = [
                'key' => $api_key,
                'appid' => $app_id,
                'orderid' => $paymentDetails->getExtraData()['steamOrderId'],
                'transid' => $paymentDetails->getExtraData()['steamTransactionId'],
            ];

            $paymentInteract->setSubRequestDone($url."?".http_build_query($params));
            $request = $this->guzzle->get($url."?".http_build_query($params));
            $response = $request->send();
            $resJson = $response->json()['response'];
            return $resJson;
        } catch (BadResponseException $exception) {
            $paymentInteract->setSubRequestDoneResponse($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode(), true);
            throw $exception;
        }
    }

    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    /**
     * @param Payment $payment
     * @param string $reason
     * @param bool $clientPetition
     * @return bool
     */
    public function executeRefund(Payment $payment, $reason = 'refund', $clientPetition = false)
    {
        //$steamOrderId = $this->getExternalIdWithOutPrefix($payment->getTransactionExternalId());
        $steamOrderId = $payment->getPaymentDetail()->getExtraData()['steamOrderId'];

        $app = $payment->getApp();
        $providerCredentialDetails = $this->getProviderCredentialDetails($app->getId());
        $app_id = $providerCredentialDetails['app_id'];
        $api_key = $providerCredentialDetails['api_key'];

        $params = [
            'orderid' => $steamOrderId,
            'appid' => $app_id,
            'key' => $api_key,
        ];

        //https://api.steampowered.com/ISteamMicroTxn/RefundTxn/V0001/
        //$url = $this->getUrlProvider() . '/rest/transactions/' . $steamTransactionId;
        $url = $this->getUrlProvider() . '/RefundTxn/v2/';

        try {
            $request = $this->guzzle->post($url, null, $params);
            $response = $request->send();
            $resJson = $response->json()['response'];
            if ($resJson['result']!=='OK')
                return false;
        } catch (BadResponseException $exception) {

            throw $exception;
        }

        return true;
    }

    /**
     * @param string $appId
     * @param \Doctrine\ORM\EntityManager $em
     * @return array
     */
    public function getProviderCredentialDetails($appId,\Doctrine\ORM\EntityManager $em=null){

        if (!$em){
            /** @var \Doctrine\ORM\EntityManager $em */
            $em=$this->container->get('doctrine.orm.default_entity_manager');
        }
        /** @var ClientHasProviderCredentialRepository $chpcRepo */
        $chpcRepo = $em->getRepository('AppBundle:ClientHasProviderCredential');
        /** @var ClientHasProviderCredential $providerCredentials */
        $chpc= $chpcRepo->findOneByAppIdAndProviderName($appId,ProviderEnum::STEAM_NAME);
        $providerCredentialDetails = $chpc->getDetails();

        return $providerCredentialDetails;
    }


}