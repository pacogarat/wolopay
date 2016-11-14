<?php

namespace AppBundle\Payment\PayMethod\Steam;

use AppBundle\Entity\ClientHasProviderCredential;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Repository\ClientHasProviderCredentialRepository;
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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.steam_client_ipn_pay_method")
 *
 * Steam user: wolopay
 *
 * Api documentation
 * https://lab.xpaw.me/steam_api_documentation.html#ISteamMicroTxn_InitTxn_v3
 *
 * Flow documentation
 * https://partner.steamgames.com/documentation/MicroTxn
 */
class SteamClientIpnPayMethod extends SteamPayMethod implements PreviousStepInterface, PayMethodIpnStaticExecutionInterface,
    PayMethodRefundExecutionInterface
{

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $this->container->get('logger')->addInfo("executePaymentPrepare for Steam CLIENT");
        $this->executePaymentPrepareReal($paymentInteract);
    }


}