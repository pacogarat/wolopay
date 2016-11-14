<?php

namespace AppBundle\Payment\PayMethod\Voice;

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
 * @Service("shop.payment.nvia_voice_ipn_pay_method")
 *
 * You can use this command shop:simulate:voice_ipn to simulate a payment via sms
 */
class VoicePayMethod  extends AbstractPayMethod implements PayMethodIpnExecutionInterface
{
    /** @var string  */
    protected $providerlive;

    /** @var string  */
    protected $providerUser;

    /** @var string  */
    protected $providerPassword;

    /** @var ContainerInterface */
    protected $container;

    const PREFIX_EXTERNAL_TRANSACTION = 'NVIA_VOICE_';

    /**
     * @InjectParams({
     *    "container"    = @Inject("service_container"),
     *    "live"   = @Inject("%payments.rixty.live%"),
     *    "user"  = @Inject("%payments.rixty.user%"),
     *    "password"  = @Inject("%payments.rixty.password%"),
     * })
     */
    function __construct(ContainerInterface $container, $live, $user, $password)
    {
        $this->providerlive = $live;

        $this->providerUser     = $user;
        $this->providerPassword = $password;

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
        $url = $router->generate('voice_vo_vt_code',
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

        $voiceCodeId = $request->get('voice_code_id');
        if (!$smsCode = $this->em->getRepository("AppBundle:VoiceCode")->find($voiceCodeId))
            return ;

        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$voiceCodeId);
    }
}