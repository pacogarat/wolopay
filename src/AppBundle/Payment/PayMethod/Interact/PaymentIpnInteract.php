<?php


namespace AppBundle\Payment\PayMethod\Interact;


use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Exception\NviaHackSecurityException;
use AppBundle\Payment\Actions\PurchaseExtraCost;
use AppBundle\Payment\Actions\SubscriptionFailed;
use AppBundle\Payment\Actions\SubscriptionFinished;
use AppBundle\Payment\Actions\SubscriptionStarted;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentDetailBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\Validation\PaymentPriceHackService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interact class is used like event, his main function is to pass information from controller to services.
 * but it can also be used to avoid the repetition of basic logic
 *
 * Class PaymentIpnInteract
 * @package AppBundle\Payment\PayMethod\Interact
 */
class PaymentIpnInteract extends AbstractInteract
{
    /**
     * @var PaymentProcessInterface
     */
    protected $paymentProcess;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var String
     */
    protected $contextId;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $responseResult;

    protected $result;

    /**
     * @var EntityManager
     */
    protected $em;


    function __construct(PaymentProcessInterface $paymentProcess, Request $request, ContainerInterface $container, $contextId)
    {
        $this->contextId = $contextId;;
        $this->paymentProcess = $paymentProcess;
        $this->request = $request;
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');

        $resultResponse = new \Symfony\Component\HttpFoundation\Response();
        $resultResponse->setStatusCode(422); // Unprocessable Entity

        $this->responseResult = $resultResponse;

        parent::__construct($container->get('logger'));
    }

    /**
     * @return String
     */
    public function getContextId()
    {
        return $this->contextId;
    }

    /**
     * @return PaymentProcessInterface
     */
    public function getPaymentProcess()
    {
        return $this->paymentProcess;
    }

    /**
     * @return Response
     */
    public function getResponseResult()
    {
        return $this->responseResult;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $transactionExternalId
     * @param \AppBundle\Payment\Bean\PaymentFeeBean $feeBeanOverride
     * @param \AppBundle\Payment\Bean\AmountBean $amountOverride
     * @param \AppBundle\Payment\Bean\PaymentDetailBean $paymentDetailOverride
     * @param bool $returnCustomReturnDuplicated
     */
    public function setPaymentCompleted(
        $transactionExternalId,
        PaymentFeeBean $feeBeanOverride = null,
        AmountBean $amountOverride = null,
        PaymentDetailBean $paymentDetailOverride = null,
        $returnCustomReturnDuplicated = false
    )
    {
        if ($this->em->getRepository("AppBundle:Payment")->findOneByTransactionExternalId($transactionExternalId))
        {
            $this->setPaymentOurError("Duplicate external transaction id '$transactionExternalId' payment, some is wrong");

            if ($returnCustomReturnDuplicated !== false)
            {
                $this->setResponseStatus($returnCustomReturnDuplicated);

            }else{
                $this->setResponseStatus(200); //with "false", setResponse throws exception
            }

            return;

        }

        $paymentCompleted = $this->container->get('shop.payment.completed');
        $paymentCompleted->execute($this->paymentProcess, $transactionExternalId, $feeBeanOverride, $amountOverride,false, $paymentDetailOverride);

        $this->logger->addInfo('Payment completed with transactionExternalId: '.$transactionExternalId);
        $this->setResponseStatus(200);
    }

    /**
     * Only use this function with extra costs like extra fee with charge back or some think like that
     *
     * @param \AppBundle\Payment\Bean\PurchaseExtraCostBean $paymentExtraCostBean
     * @param null $reason
     * @param Payment|null $payment
     * @throws \Exception
     */
    public function setExtraCost(PurchaseExtraCostBean $paymentExtraCostBean, $reason=null, $payment= null)
    {
        /** @var Payment $payment */
        $payment = $payment ?: $this->paymentProcess;

        /** @var PurchaseExtraCost $extraCost */
        $extraCost = $this->container->get('shop.payment.purchase_extra_cost');

        if (!$purchase = $payment->getPurchase())
            throw new \Exception("Purchase not available to create extra cost for payment: ".$payment->getId());

        $extraCost->purchaseExtraCost($paymentExtraCostBean, $purchase, $reason);

        $this->setResponseStatus(200);
    }

    /**
     * @param $transactionExternalId
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function setSubscriptionStarted($transactionExternalId)
    {
        if ($this->em->getRepository("AppBundle:Subscription")->findOneByTransactionExternalId($transactionExternalId, [$this->paymentProcess->getId()]))
        {
            $this->setPaymentOurError("Duplicate subscription external transaction external id '$transactionExternalId', some is wrong");
            return;
        }

        /** @var SubscriptionStarted $subStart */
        $subStart = $this->container->get('shop.subscription.started');
        $subStart->execute($this->paymentProcess, $transactionExternalId);

        $this->setResponseStatus(200);
    }


    public function setSubscriptionFinished()
    {
        /** @var SubscriptionFinished $subscriptionCancel */
        $subscriptionFinished = $this->container->get('shop.subscription.finished');
        $subscriptionFinished->execute($this->paymentProcess);

        $this->setResponseStatus(200);
    }

    public function setSubscriptionFailed()
    {
        /** @var SubscriptionFailed $subscriptionCancel */
        $subscriptionCancel = $this->container->get('shop.subscription.failed');
        $subscriptionCancel->execute($this->paymentProcess);

        $this->setResponseStatus(200);
    }

    /**
     * @param null $text
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function setPaymentAttemptHack($text = null)
    {
        if ($text)
            $this->logger->addCritical($text);

        $this->setResponseStatus(422);
    }

    /**
     * Failed by our, like internal logic error, some php crashes ...
     *
     * @param null $text
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function setPaymentOurError($text = null)
    {
        if ($text)
            $this->logger->addAlert($text);

        $this->setResponseStatus(500);
    }

    /**
     * @param $status
     */
    public function setResponseStatus($status)
    {
        $this->responseResult->setStatusCode($status);
    }

    public function setPaymentDispute($payment = null, $reason = null)
    {
        $this->container->get('shop.payment.dispute')->execute($payment ?: $this->paymentProcess, $reason);
        $this->setResponseStatus(200);
    }

    public function setPaymentDisputeEnd($win, $reason='', $payment = null)
    {
        $this->container->get('shop.payment.dispute_end')->execute($payment ?: $this->paymentProcess, $win, $reason);
        $this->setResponseStatus(200);
    }

    /**
     * Failed by Provider, not Failed in wolopay
     */
    public function setPaymentFailed($reason=null)
    {
        $this->container->get('shop.payment.failed')->execute($this->paymentProcess, $reason);
        $this->setResponseStatus(200);
    }

    /**
     * Failed by PayGateway can't be process this payment
     */
    public function setPaymentFailedIncorrectOrCrashed()
    {
        $this->setPaymentFailed();
        $this->setResponseStatus(422);
    }

    /**
     * @param $reason
     * @param null $payment
     * @param bool $calledByMerchantNow
     */
    public function setPaymentCancelled($reason, $payment = null, $calledByMerchantNow = false)
    {
        $this->setResponseStatus(200);
        $this->container->get('shop.payment.cancelled')->execute($payment ?: $this->paymentProcess, $reason, $calledByMerchantNow);
    }

    /**
     * @param $reason
     */
    public function setPaymentPending($reason)
    {
        $this->setResponseStatus(200);
        $this->container->get('shop.payment.pending')->execute($this->paymentProcess, $reason);
    }

    /**
     * Blocked By Provider
     *
     * @param null $payment
     */
    public function setPaymentBlocked($payment = null)
    {
        $this->setResponseStatus(200);
        $this->container->get('shop.payment.blocked')->execute($payment ?: $this->paymentProcess);
    }

    /**
     * Unblocked By Provider
     *
     * @param null $payment
     */
    public function setPaymentUnBlocked($payment = null)
    {
        $this->setResponseStatus(200);
        $this->container->get('shop.payment.unblocked')->execute($payment ?: $this->paymentProcess);
    }

    public function validatePrice($newPrice, $currency)
    {
        try{
            /** @var PaymentPriceHackService $paymentPriceHackService */
            $this->container->get('shop.payment.validation.price_hack')
                ->validate($newPrice, $currency, $this->paymentProcess)
            ;

        }catch (NviaHackSecurityException $e ){

            $this->setPaymentAttemptHack("Price was incorrect");

            return false;
        }

        return true;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function setResponseDirectly(Response $response)
    {
        $this->responseResult = $response;
        return $this;
    }

} 