<?php

namespace AppBundle\Payment\PayMethod\PromoCode;

use AppBundle\Entity\SingleFreePayment;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodOnlyOneStepExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use AppBundle\Service\Promo\PromoService;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;


/**
 * @Service("shop.payment.nvia_promo_code_pay_method")
 */
class PromoCodePayMethod  extends AbstractPayMethod implements PayMethodOnlyOneStepExecutionInterface, PreviousStepInterface
{
    /** @var ContainerInterface */
    protected $container;

    /** @var PromoService */
    protected $promoService;

    const PREFIX_EXTERNAL_TRANSACTION = 'PROMO_';

    /**
     * @InjectParams({
     *    "container"    = @Inject("service_container"),
     *    "promoService" = @Inject("app.shop.promo"),
     * })
     */
    function __construct(ContainerInterface $container, PromoService $promoService)
    {
        $this->container    = $container;
        $this->promoService = $promoService;
    }

    /**
     * @param PaymentPreviousStepsInteract $previous
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return mixed
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous)
    {
        $request = $previous->getRequest();

        if (!$code = $request->get('code'))
            throw new BadRequestHttpException("code is required");
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function executeOnlyOneStep(PaymentIpnInteract $paymentInteract)
    {
        /** @var SingleFreePayment $paymentProcess */
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $request        = $paymentInteract->getRequest();
        $transaction    = $paymentProcess->getPaymentDetail()->getTransaction();

        $code = $request->get('code');
        $promoCode = $this->em->getRepository("AppBundle:PromoCode")->findOneByCodeAndAppId($code, $transaction->getApp()->getId());

        if (!$this->promoService->verifyIsAValidPromo($promoCode, $transaction->getGamer()))
            throw new BadRequestHttpException("code is invalid");

        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$promoCode->getApp()->getId().'-'.$promoCode->getCode().'-'.$promoCode->getCountNTimeUsed());
        $this->promoService->promoCodePurchaseCompleted($paymentProcess, $promoCode);

        $this->em->flush();
    }

}