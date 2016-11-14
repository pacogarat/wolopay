<?php


namespace AppBundle\Payment\Util\CartExtraCost\ExtraCostsRules;


use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailExtraCost;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Service\PayMethodService;

class ExtraCostByPMPCRule extends AbstractExtraCostRule
{
    /**
     * {@inheritDoc}
     */
    public function injectExtraCost(&$total, PaymentDetail $paymentDetail, PayMethodProviderHasCountry $payMethodProviderHasCountry)
    {
        $oldTotal = $total;

        if ($paymentDetail->getTransaction()->getApp()->getPayMethodsAddFeeToFinalAmount() || $payMethodProviderHasCountry->hasAFixedAmount())
        {
            /** @var PayMethodService $payMethodService */
            $payMethodService = $this->container->get('app.pay_method');
            $total = $payMethodService->getAmountIncreasedByPMPC(
                $total,
                $payMethodProviderHasCountry->getCurrency(),
                $payMethodProviderHasCountry,
                $paymentDetail->getTransaction()->getApp()
            );
        }

        $offset = $total - $oldTotal;

        if ($offset > 0)
        {
            $paymentDetailExtraCost = new PaymentDetailExtraCost(
                $offset,
                $payMethodProviderHasCountry->getCurrency(),
                $payMethodProviderHasCountry->getPayMethod()->getName()
            );
            $paymentDetail->addPaymentDetailExtraCost($paymentDetailExtraCost);

            return $offset;
        }


        return false;
    }



}