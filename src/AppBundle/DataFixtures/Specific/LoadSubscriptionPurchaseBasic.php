<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\SubscriptionEventuality;
use AppBundle\Entity\SubscriptionEventualityPayment;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadSubscriptionPurchaseBasic extends LoadSubscriptionPaymentBasic implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Subscription $paymentProcess */
        $paymentProcess = parent::load($manager);
        $subscriptionEventuality = new SubscriptionEventuality();

        $subscriptionEventuality
            ->addNPurchase()
            ->setSubscription($paymentProcess)
            ->addTotalAmount($paymentProcess->getAmountForEachPayment())
        ;

        $paymentProcess->addSubscriptionEventuality($subscriptionEventuality);
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();

        $payment = new SubscriptionEventualityPayment($subscriptionEventuality);
        $payment
            ->setPaymentDetail($paymentProcess->getPaymentDetail())
            ->setAmount($paymentProcess->getAmountForEachPayment())
            ->setApp($transaction->getApp())
            ->setGamer($transaction->getGamer())
        ;

        $purchase = new Purchase();
        $purchase
            ->setAmountTotal($paymentDetails->getAmount())
            ->setGamer($transaction->getGamer())
            ->setAmountGame($paymentDetails->getAmount() - 1.5)
            ->setAmountProvider(1)
            ->setAmountWolo(0.5)
            ->setAmountTax(0)
            ->setTaxPercent(0)

            ->setAmountBeforeTaxes($purchase->getAmountTotal())
            ->setApp($paymentDetails->getTransaction()->getApp())
            ->setCountry($paymentDetails->getCountry())
            ->setCurrency($paymentDetails->getCurrency())
            ->setExchangeRateEur($paymentDetails->getCurrency()->getExchangeRateEur())
            ->setExchangeRateUsd($paymentDetails->getCurrency()->getExchangeRateUsd())
            ->setExchangeRateGbp($paymentDetails->getCurrency()->getExchangeRateGbp())
            ->setPayment($payment)
            ->setTransaction($transaction)
            ->setProvider($paymentDetails->getProvider())
            ->setPayMethod($paymentDetails->getPayMethod())
        ;

        $paymentProcess->setStatusCategory($this->getReference("payment_status_category-". PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID));
        $payment->setStatusCategory($this->getReference("payment_status_category-". PaymentStatusCategoryEnum::COMPLETED_ID));
        $transaction->setStatusCategory($this->getReference("transaction_status_category-". TransactionStatusCategoryEnum::COMPLETED_ID));

        $this->om->persist($subscriptionEventuality);
        $this->om->persist($purchase);
        $this->om->persist($payment);
        $this->om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 800; // the order in which fixtures will be loaded
    }
}