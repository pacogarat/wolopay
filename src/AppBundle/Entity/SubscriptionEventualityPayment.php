<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubscriptionPayment
 *
 * @ORM\Table(name="subscription_eventuality_payment")
 * @ORM\Entity
 */
class SubscriptionEventualityPayment extends Payment
{
    /**
     * @var \AppBundle\Entity\SubscriptionEventuality
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubscriptionEventuality", inversedBy="subscriptionEventualityPayments")
     * @ORM\JoinColumn(name="subscription_eventuality_id", referencedColumnName="id", nullable=false)
     */
    private $subscriptionEventuality;

    public function getType()
    {
        return 'subscription';
    }

    function __construct(SubscriptionEventuality $subscriptionEventuality)
    {
        parent::__construct();
        $this->id = $subscriptionEventuality->getId().'_'.$subscriptionEventuality->getNPurchase();

        $this->setSubscriptionEventuality($subscriptionEventuality);
    }


    /**
     * Set subscriptionEventuality
     *
     * @param \AppBundle\Entity\SubscriptionEventuality $subscriptionEventuality
     * @return SubscriptionEventualityPayment
     */
    public function setSubscriptionEventuality(\AppBundle\Entity\SubscriptionEventuality $subscriptionEventuality)
    {
        $this->subscriptionEventuality = $subscriptionEventuality;
        $subscriptionEventuality->addSubscriptionEventualityPayment($this);

        return $this;
    }

    /**
     * Get subscriptionEventuality
     *
     * @return \AppBundle\Entity\SubscriptionEventuality
     */
    public function getSubscriptionEventuality()
    {
        return $this->subscriptionEventuality;
    }

    /**
     * @return Subscription
     */
    public function getPaymentProcess()
    {
        return $this->getSubscriptionEventuality()->getSubscription();
    }
}
