<?php

namespace AppBundle\Payment\PayMethod\SMS;

use AppBundle\Entity\SMSCode;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;


/**
 * @Service("shop.payment.nvia_sms_ipn_pay_method")
 *
 * You can use this command shop:simulate:sms_ipn to simulate a payment via sms
 */
class SMSPayMethod  extends AbstractPayMethod implements PayMethodIpnExecutionInterface
{
    /** @var ContainerInterface */
    protected $container;

    const ROUTE_TO_INI_PROCESS='sms_logic_mo_mt_code';

    const PREFIX_EXTERNAL_TRANSACTION = 'NVIA_SMS_';

    /**
     * @InjectParams({
     *    "container"    = @Inject("service_container"),
     * })
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param PaymentPrepareInteract $paymentInteract
     */
    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $request = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        /** @var Router $router */
        $router  = $this->container->get('router');

        $url = $router->generate(static::ROUTE_TO_INI_PROCESS,
                [
                    '_locale' => $paymentInteract->getRequest()->getLocale(),
                    'payment_process_id' => $paymentProcess->getId(),
                    'transaction_id' => $paymentDetails->getTransaction()->getId(),
                ],
                true
        );

        $paymentInteract->setRequestResult($url, 'GET');
    }

    /**
     * @param PaymentIpnInteract $paymentInteract
     */
    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $smsCodeId = $request->get('sms_code_id');
        if (!$smsCode = $this->em->getRepository("AppBundle:SMSCode")->find($smsCodeId))
        {
            $this->logger->addError("This sms_code $smsCodeId doesnt exist");
            return ;
        }

        $amountBean=null;


        if ($paymentProcess->getPaymentDetail()->getProvider()->getFreeVat()){
            $countryVat = $paymentProcess->getPaymentDetail()->getCountry()->getVat();
            $vatPaidByProvider = $paymentProcess->getPaymentDetail()->getAmount() - round($paymentProcess->getPaymentDetail()->getAmount() / (1+ ($countryVat/100)),2);
            $amountBean = new AmountBean(null,null,false,false,null,null,$vatPaidByProvider);
        }

        $paymentInteract->setPaymentCompleted(static::PREFIX_EXTERNAL_TRANSACTION. $smsCode->getExternalTransactionId(),null,$amountBean);
    }

}