<?php


namespace AppBundle\Payment\PayMethod;


use AppBundle\Entity\App;
use AppBundle\Entity\ClientHasProviderCredential;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Provider;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Exception\NviaException;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class AbstractPayMethod
{
    const PREFIX_EXTERNAL_TRANSACTION = 'TO OVERRIDE';
    /**
     * @var string
     * @Inject("%domain_main%")
     */
    public $domainMain;

    /**
     * @var Translator
     * @Inject("translator")
     */
    public $translator;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Inject("%locale%")
     * @var string
     */
    public $locale;

    /**
     * @Inject("router")
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    public $router;

    /**
     * @param mixed $paymentProcessService
     * @return $this
     */
    public function setPaymentProcessService($paymentProcessService)
    {
        $this->paymentProcessService = $paymentProcessService;

        return $this;
    }

    protected function amountWithoutTwoLastNumbersAsDecimals($amount, $decimalPlaces=2)
    {
        return $this->amountWithoutDecimals($amount, $decimalPlaces);
    }

    protected function amountWithoutDecimals($amount, $decimalPlaces=2)
    {
        return round( $amount* (pow (10, $decimalPlaces )));
    }

    protected function amountWithoutTwoLastNumbersAsDecimalsReverse($amount)
    {
        return $amount/100;
    }

    protected function forceTwoDecimals($amount)
    {
        return number_format((float) $amount, 2, '.', '');
    }

    protected function ipnStaticGetCredentialsForSpecialProviders(Request $request, $providerName)
    {
        if (!$this instanceof PayMethodVerifyCredentialsInterface)
            throw new \Exception('This method is only for especial pay method');

        if ($externalAppId=$request->get('external_app_id'))
        {
            /** @var App $app */
            if (!$app = $this->em->getRepository("AppBundle:App")->find($externalAppId))
                throw new BadRequestHttpException("external app id '$externalAppId' doesn't exist");

            $provider = $this->em->getRepository("AppBundle:Provider")->findByName($providerName);
            $credentials = $app->getProviderClientCredentials($provider);
            if (!$credentials)
                throw new BadRequestHttpException("invalid credentials");

            return $credentials;
        }

        $this->getShapeProviderClientCredentials();
    }

    /**
     * @param $isLive
     * @param \AppBundle\Entity\PaymentDetail $paymentDetails
     * @param $shapeFields array for example if paymethods has fields client_id,secret input will be ['client'=> null, 'secret' => null]
     * @throws \AppBundle\Exception\NviaException
     * @internal param \AppBundle\Entity\PaymentProcessInterface $paymentProcess
     * @return mixed
     */
    protected function getProviderClientCredentialsIfItIsNeeded($isLive, PaymentDetail $paymentDetails, array $shapeFields)
    {
        $result = $shapeFields;
        $transaction = $paymentDetails->getTransaction();

        if ($isLive && $paymentDetails->getUsedAppProviderCredentials())
        {
            $credentials = $this->getProviderClientCredentials($transaction->getApp(), $paymentDetails->getProvider(), $shapeFields);

            if ($credentials === null)
                throw new NviaException("Provider Client credential is active but clientHasProviderCredentials is empty for provider: ".$paymentDetails->getProvider()->getName());

            $this->logger->addInfo("Using custom GATEWAY");

            return $credentials;

        }else{

            // $paymentDetails was settled before in PaymentProcessService but it can be
            // override because disregards with providerLive parameter (rare case)

            $paymentDetails->setUsedAppProviderCredentials(false);
        }

        return $result;
    }

    /**
     * @param App $app
     * @param Provider $provider
     * @param array $shapeFields
     * @return array|null
     * @throws \AppBundle\Exception\NviaException
     */
    protected function getProviderClientCredentials(App $app, Provider $provider, array $shapeFields)
    {
        $providerClientCredentials = $app->getProviderClientCredentials($provider);

        if ($providerClientCredentials === null)
            return null;

        /** @var ClientHasProviderCredential $providerClientCredentials */
        $credentialsDetailsArr = $providerClientCredentials->getDetails();
        $result = [];

        foreach ($shapeFields as $key => $field)
        {
            if (!isset($credentialsDetailsArr[$key]))
                throw new NviaException("The Array haven't '$key' value");

            $result[$key] = $credentialsDetailsArr[$key];
        }

        return $result;
    }


    public function getNameTranslation(PaymentProcessInterface $paymentProcess, PaymentDetailHasArticles $paymentDetailHasArticles)
    {
        if ($paymentProcess instanceof SingleCustomPayment)
            return $paymentProcess->getArticleDescription();

        return ArticleService::getTranslationBasic($paymentDetailHasArticles->getNameCurrentLabel(),
            $paymentDetailHasArticles->getItemsQuantity(),
            $paymentProcess->getPaymentDetail()->getLanguage()->getId()
        );
    }

    public function genericIpnStaticWhichPaymentIsIt($id)
    {
        return $this->paymentProcessService->getPaymentProcessObjectById($id);
    }

    public function IpnStaticWhichPaymentByExtraData($conditionString)
    {
        return $this->paymentProcessService->getPaymentProcessObjectByExtraData($conditionString);
    }


    protected function getExternalIdWithOutPrefix($externalId)
    {
        return str_replace(static::PREFIX_EXTERNAL_TRANSACTION, '', $externalId);
    }

    protected function generateUrlPaymentDone(PaymentProcessInterface $processInterface)
    {
        $paymentDetail = $processInterface->getPaymentDetail();
        return $this->router->generate('payment_done', [
            'transaction_id' => $paymentDetail->getTransaction()->getId(),
            '_locale' => $paymentDetail->getLanguage()->getId(),
            'payment_process_id' => $processInterface->getId(),
            'security_random' => $paymentDetail->getSecurityRandomDone()
        ]);
    }

    protected function generateUrlPaymentCancel(PaymentProcessInterface $processInterface, $extraParams = [])
    {
        $paymentDetail = $processInterface->getPaymentDetail();
        return $this->router->generate('payment_cancel', array_merge([
                'transaction_id' => $paymentDetail->getTransaction()->getId(),
                '_locale' => $paymentDetail->getLanguage()->getId(),
                'payment_process_id' => $processInterface->getId(),
                'security_random' => $paymentDetail->getSecurityRandomCancel()
            ], $extraParams));
    }


    protected function getNewAmountForEachPDHArticleToPayMethodsWithNotExtraFee(PaymentDetail $paymentDetail)
    {
        $extraAmount = $paymentDetail->getSumExtraCosts();
        $subTotal = $paymentDetail->getAmount() - $extraAmount;

        $result = [];
        foreach ($paymentDetail->getPaymentDetailHasArticles() as $pdha)
        {
            $result []= [$pdha, $pdha->getAmount() * $paymentDetail->getAmount() / $subTotal];
        }

        return $result;
    }

    protected function removeHtml($textWithHtml)
    {
        $text = strip_tags($textWithHtml);
        return str_replace(['&nbsp;'],[''], $text);
    }
} 