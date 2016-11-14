<?php

namespace AppBundle\Payment\PayMethod\PayPal;

use AppBundle\Entity\Enum\CreditCardEnum;
use AppBundle\Entity\NotPersisted\CreditCards\AbstractCreditCard;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PaymentHostedIntermediateStepExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Service;
use PayPal\Api as ApiPaypal;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.paypal_credit_card_ipn_pay_method")
 */
class PayPalCreditCardIpnApiRestPayMethod extends PayPalIpnApiRestPayMethod implements PayMethodIpnExecutionInterface
{
    public static $creditCardsAvailable = [
        CreditCardEnum::VISA,
        CreditCardEnum::MASTER_CARD,
        CreditCardEnum::AMEX,
        CreditCardEnum::DISCOVER,
        CreditCardEnum::MAESTRO
    ];

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $params = [
            '_locale'            => $paymentDetails->getLanguage()->getId(),
            'transaction_id'     => $paymentDetails->getTransaction()->getId(),
            'payment_process_id' => $paymentProcess->getId(),
        ];

        $paymentDetails
            ->setExtraDataCreditCardsAvailable(self::$creditCardsAvailable)
            ->setExtraDataEndUrl($paymentInteract->getUrlIpn())
        ;
        $this->em->flush();

        $paymentInteract->setRequestResult($this->domainMain.$this->router->generate('hosted_credit_card', $params));
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();

        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        /** @var AbstractCreditCard $creditCard */
        $creditCard = unserialize($request->getContent());

        $card = new ApiPaypal\CreditCard();
        $card->setType(strtolower($creditCard::CREDIT_CARD_ENUM))
            ->setNumber($creditCard->getCardNumber())
            ->setExpireMonth($creditCard->getExpireDateMonth())
            ->setExpireYear($creditCard->getExpireDateYear())
            ->setCvv2($creditCard->getCvv())
            ->setFirstName($creditCard->getOwnerFirstName())
            ->setLastName($creditCard->getOwnerLastName())
        ;

//        echo $creditCard->getOwnerFirstName();die;

        $fi = new ApiPaypal\FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new ApiPaypal\Payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $itemList = $this->createItemList($paymentProcess);

        $amount = new ApiPaypal\Amount();
        $amount
            ->setCurrency($paymentDetails->getCurrency()->getId())
            ->setTotal($paymentDetails->getAmount())
        ;

        $transaction = new ApiPaypal\Transaction();
        $transaction
            ->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber($paymentProcess->getId())
            //            ->setNotifyUrl($paymentInteract->getUrlIpn()) // Not used by PAYPAL.....
        ;

        $payment = new ApiPaypal\Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));

        $payment->create($this->getApiContext($paymentProcess));

    }
}