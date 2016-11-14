<?php


namespace AppBundle\Payment\Validation;

use AppBundle\Entity\Payment;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Subscription;
use AppBundle\Exception\NviaHackSecurityException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.validation.price_hack")
 */
class PaymentPriceHackService
{
    private $logger;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger")
     * })
     */
    function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function validatePaymentProcessInterfaceAfterProcess($newPrice, $currency, PaymentProcessInterface $payment)
    {
        if ($payment instanceof Subscription)
            $priceConfigured = $payment->getAmountForEachPayment();
        elseif ($payment instanceof  Payment)
            $priceConfigured = $payment->getAmount();

        if (floatval($newPrice) !==  floatval($priceConfigured))
        {
            $this->logger->addCritical("Hack attempt changing the price, (Real price: ".$payment->getPaymentDetail()->getAmount().
                ", Hack price: $newPrice) to payment id: ". $payment->getId()
            );

            throw new NviaHackSecurityException(
                NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::PAYMENT_VALIDATION_CHANGE_PRICE
            );
        }
    }

    public function validate($newPrice, $currency, PaymentProcessInterface $payment)
    {
        $newPrice = floatval($newPrice);
        $price = floatval($payment->getPaymentDetail()->getAmount());

        if (floatval($newPrice) !==  floatval($payment->getPaymentDetail()->getAmount()) && $newPrice < $price)
        {
            $this->logger->addCritical("Hack attempt changing the price, (Real price: ".$payment->getPaymentDetail()->getAmount().
                ", Hack price: $newPrice) to payment id: ". $payment->getId()
            );

            throw new NviaHackSecurityException(
                NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::PAYMENT_VALIDATION_CHANGE_PRICE
            );
        }

        if (strtoupper($currency) !==  $payment->getPaymentDetail()->getCurrency()->getId())
        {
            $this->logger->addCritical(
                "Hack attempt changing currency, (Real currency: ".$payment->getPaymentDetail()->getCurrency()->getId().
                ", Hack currency: $currency) to payment id: ". $payment->getId()
            );

            throw new NviaHackSecurityException(
                NviaHackSecurityException::MESSAGE_STANDARD, NviaHackSecurityException::PAYMENT_VALIDATION_CHANGE_PRICE
            );
        }
    }

} 