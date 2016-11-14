<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\Subscription;

interface SubscriptionNeedMakePaymentRequestExecutionInterface
{
    /**
     * Some Pay methods need to make request to renew subscription in recurrent payments
     *
     * @param Subscription $subscription
     * @return int externalPayMethodId with prefix
     */
    public function subscriptionNeedMakePaymentRequest(Subscription $subscription);
} 