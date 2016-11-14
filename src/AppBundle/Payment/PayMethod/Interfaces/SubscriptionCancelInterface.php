<?php


namespace AppBundle\Payment\PayMethod\Interfaces;

use AppBundle\Entity\Subscription;

interface SubscriptionCancelInterface
{
    /**
     * @param Subscription $subscription
     * @return bool
     * @throw \Exception
     */
    public function cancelSubscription(Subscription $subscription);
} 