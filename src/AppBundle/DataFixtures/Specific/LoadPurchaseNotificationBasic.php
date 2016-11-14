<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPurchaseNotificationBasic extends LoadSinglePurchaseBasic implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $purchase = parent::load($manager);
        $purchaseNotification = new PurchaseNotification();
        $purchaseNotification
            ->setIsReadyToNotify(true)
            ->setApp($purchase->getApp())
            ->setAmount($purchase->getAmountGame())
            ->addPurchase($purchase)
            ->setPaymentDetailHasArticle($purchase->getPayment()->getPaymentDetail()->getPaymentDetailHasArticles()[0])
            ->setEvent(PurchaseNotificationEventEnum::PAYMENT_COMPLETED)
        ;

        $this->om->persist($purchaseNotification);
        $this->om->flush();

        return $purchaseNotification;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 800; // the order in which fixtures will be loaded
    }
}