<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Payment;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.dispute_end")
 */
class PaymentDisputedEnd
{
    private $logger;
    private $mailer;
    private $emailPaymentManager;
    private $emailApp;
    private $paymentCancelled;
    private $paymentUnCancelled;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "mailer" = @Inject("mailer"),
     *    "emailPaymentManager" = @Inject("%email_payment_manager%"),
     *    "emailApp" = @Inject("%email_app%"),
     *    "paymentCancelled" = @Inject("shop.payment.cancelled"),
     *    "paymentUnCancelled"= @Inject("shop.payment.un_cancelled")
     * })
     */
    function __construct(
        Logger $logger,
        \Swift_Mailer $mailer,
        $emailPaymentManager,
        $emailApp,
        PaymentCancelled $paymentCancelled,
        PaymentUnCancelled $paymentUnCancelled
    )
    {
        $this->logger              = $logger;
        $this->mailer              = $mailer;
        $this->emailPaymentManager = $emailPaymentManager;
        $this->emailApp            = $emailApp;
        $this->paymentCancelled    = $paymentCancelled;
        $this->paymentUnCancelled  = $paymentUnCancelled;
    }

    public function execute(Payment $payment, $win, $reason)
    {
        $provider = $payment->getPaymentDetail()->getProvider()->getName();

        $message = \Swift_Message::newInstance()
            ->setSubject('Disputa Finalizada '.($win ? 'a favor': 'en contra').', provider: '.$provider)
            ->setFrom($this->emailApp)
            ->setTo($this->emailPaymentManager)
            ->setBody("Disputa finalizada ".($win ? 'a favor': 'en contra')." para el provider: " .
                "Provider: $provider\n\n
                Transaccion PG: ". $payment->getPaymentDetail()->getTransaction()->getId(). "\n
                Pago id PG: ". $payment->getId()."\n
                Pago id External del proveedor: ". $payment->getTransactionExternalId()."\n
                Razon: $reason
            ")
        ;

        $this->mailer->send($message);

        $this->logger->addCritical(
            'new dispute with '.$provider.', payment :'.$payment->getId().', amount: '
            . $payment->getPaymentDetail()->getAmount().', user external: '.$payment->getPaymentDetail()->getTransaction()->getGamer()->getId()
        );

        if (!$win)
            $this->paymentCancelled->execute($payment, $reason, false);
        else
            $this->paymentUnCancelled->execute($payment);

    }

} 