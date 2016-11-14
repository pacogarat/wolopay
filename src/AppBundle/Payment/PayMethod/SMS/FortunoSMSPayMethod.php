<?php

namespace AppBundle\Payment\PayMethod\SMS;

use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;


/**
 * @Service("shop.payment.fortuno_sms_ipn_pay_method")
 */
class FortunoSMSPayMethod extends SMSPayMethod
{
    const ROUTE_TO_INI_PROCESS='fortuno_sms_logic_mo_mt_code';

    const PREFIX_EXTERNAL_TRANSACTION = 'FORTUNO_SMS_';
}