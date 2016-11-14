<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;

use AppBundle\Controller\PaymentHosted\AbstractPaymentHosted;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\SMSCode;
use AppBundle\Entity\VoiceCode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractNviaPayMethods extends AbstractPaymentHosted
{

    /**
     * @param $code
     * @param $amountOur
     * @param $repository
     * @param PayMethodProviderHasCountry $pmpc
     * @return bool|object
     */
    protected function validateCode($code, $amountOur, $repository, PayMethodProviderHasCountry $pmpc)
    {
        $currencyService = $this->get('common.currency');
        /** @var EntityManagerInterface $em */
        $em = $this->get('doctrine.orm.default_entity_manager');
        $logger = $this->get('logger');

        $valid=false;

        /** @var SMSCode|VoiceCode $smsCode */
        if (($code = $em->getRepository($repository)->find($code))
            && $code->getUsedAt() === null)
        {
            $amountParsed = $code->getAmount();
            if ($pmpc->getCurrency()->getId() !== $code->getCurrency()->getId())
            {
                $amountParsed = $currencyService->getExchange($amountParsed, $code->getCurrency(),
                    $pmpc->getCurrency()->getId()
                );
            }
            $diff = ($amountOur * 3) / 100; // 3 percent max diff

            $minAccepted = $amountOur - $diff;
            $maxAccepted = $amountOur + $diff;

            if ($minAccepted <= $amountParsed && $maxAccepted >= $amountParsed)
                $valid = $code;
            else
                $logger->addWarning("This code is not valid for this article price received: $amountParsed, minAccepted: $minAccepted, maxAccepted: $maxAccepted");
        }else{
            $logger->addWarning("This code: '$code' not exist or was used");
        }

        return $valid;
    }

    protected function addSpecialLogByPayMethod($idServicePaymentMethod, $action='in', $subfolder = '')
    {
        parent::addSpecialLogByPayMethod($idServicePaymentMethod, $action, '/nvia_pay_methods'.$subfolder);
    }


}
