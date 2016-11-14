<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\AppShop;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\Transaction;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;


abstract class AbstractLoadPayment extends AbstractFixture
{
    /**
     * @var ObjectManager
     */
    protected  $om;

    /**
     * @param PaymentProcessInterface $paymentProcess
     * @param PaymentDetailHasArticles[] $paymentDetailHasArticles
     * @param $amount
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $pmpc
     */
    protected  function createPaymentDetails(PaymentProcessInterface $paymentProcess, array $paymentDetailHasArticles, $amount,PayMethodProviderHasCountry $pmpc)
    {
        $app  = $paymentProcess->getApp();
        $pmp  = $pmpc->getPayMethodHasProvider();

        $appKey = $app->getName();

        $gamer = new Gamer($app, '32');
        $gamer->setEmail('mgarcia@wolopay.com');

        /** @var AppShop $appShop */
        $appShop  = $this->getReference('app_shop-'.$appKey.'-'.LevelCategoryEnum::ROOKIE_ID);

        $transaction = new Transaction($gamer, $appShop, 5);
        $transaction
            ->setApiCrendetials($app->getAppApiHasCredential())
            ->setStatusCategory($this->getReference('transaction_status_category-'.TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID))
        ;

        if ($paymentProcess instanceof SingleCustomPayment)
        {
            $transaction
                ->setCustomAmount($amount)
                ->setCustomCurrency($pmpc->getCurrency())
            ;
        }

        $this->om->persist($transaction);
        $this->om->persist($gamer);

        $paymentDetail = new PaymentDetail($paymentProcess->getId());
        $paymentDetail
            ->setTransaction($transaction)
            ->setPayMethod($pmp->getPayMethod())
            ->setCurrency($pmpc->getCurrency())
            ->setCountry($pmpc->getCountry())
            ->setProvider($pmp->getProvider())
            ->setLanguage($this->getReference('language-'.LanguageEnum::ENGLISH))
            ->setAmount($amount)
        ;

        foreach ($paymentDetailHasArticles as $pda)
            $paymentDetail->addPaymentDetailHasArticle($pda);

        $this->om->persist($paymentDetail);

        $paymentProcess
            ->setPaymentDetail($paymentDetail)
            ->setGamer($transaction->getGamer())
        ;

        $this->om->persist($paymentProcess);
        $this->om->flush();
    }

    protected function createPurchaseByPaymentProcess(PaymentProcessInterface $paymentProcess)
    {
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();

        $purchase = new Purchase();
        $purchase
            ->setAmountTotal($paymentDetails->getAmount())
            ->setGamer($transaction->getGamer())
            ->setAmountGame($paymentDetails->getAmount() - 1.5)
            ->setAmountProvider(1)
            ->setAmountWolo(0.5)
            ->setAmountTax(0)
            ->setAmountBeforeTaxes(0)

            ->setTaxPercent(0)
            ->setApp($paymentDetails->getTransaction()->getApp())
            ->setCountry($paymentDetails->getCountry())
            ->setCurrency($paymentDetails->getCurrency())
            ->setExchangeRateEur($paymentDetails->getCurrency()->getExchangeRateEur())
            ->setExchangeRateUsd($paymentDetails->getCurrency()->getExchangeRateUsd())
            ->setExchangeRateGbp($paymentDetails->getCurrency()->getExchangeRateGbp())
            ->setPayment($paymentProcess)
            ->setTransaction($transaction)
            ->setProvider($paymentDetails->getProvider())
            ->setPayMethod($paymentDetails->getPayMethod())
        ;

        $paymentProcess->setStatusCategory($this->getReference("payment_status_category-". PaymentStatusCategoryEnum::COMPLETED_ID));
        $transaction->setStatusCategory($this->getReference("transaction_status_category-". TransactionStatusCategoryEnum::COMPLETED_ID));

        $this->om->persist($purchase);
        $this->om->flush();

        return $purchase;
    }
}