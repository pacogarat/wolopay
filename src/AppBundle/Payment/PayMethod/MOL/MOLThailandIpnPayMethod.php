<?php

namespace AppBundle\Payment\PayMethod\MOL;

use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.mol_thailand_ipn_pay_method")
 *
 * Not implemented because his price his variable 
 */
class MOLThailandIpnPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface
{
    /** @var ContainerInterface */
    protected $container;

    const ROUTE_TO_INI_PROCESS='hosted_mol_thailand';

    const PREFIX_EXTERNAL_TRANSACTION = 'MOL_THAILAND_';

    /**
     * @InjectParams({
     *    "container"    = @Inject("service_container")
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

        $paymentInteract->setPaymentCompleted(static::PREFIX_EXTERNAL_TRANSACTION. $smsCode->getExternalTransactionId());
    }
}