<?php


namespace AppBundle\Payment\Actions;

use AppBundle\Entity\Payment;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("shop.payment.dispute")
 */
class PaymentDisputed
{
    private $logger;
    private $mailer;
    private $emailPaymentManager;
    private $emailApp;

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "mailer" = @Inject("mailer"),
     *    "emailPaymentManager" = @Inject("%email_payment_manager%"),
     *    "emailApp" = @Inject("%email_app%")
     * })
     */
    function __construct(Logger $logger, \Swift_Mailer $mailer, $emailPaymentManager, $emailApp)
    {
        $this->logger              = $logger;
        $this->mailer              = $mailer;
        $this->emailPaymentManager = $emailPaymentManager;
        $this->emailApp            = $emailApp;
    }

    public function execute(Payment $payment, $reason = null)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($payment->getApp()->getName() .' New dispute')
            ->setFrom($this->emailApp)
            ->setTo($this->emailPaymentManager)
            ->setBody(
                "A new dispute was created in pay method: " .$payment->getPaymentDetail()->getProvider()->getName(). "\n\n
                Transaction Id: ". $payment->getPaymentDetail()->getTransaction()->getId(). "\n
                Payment Id: ". $payment->getId()."\n
                PayMethod Id: ". $payment->getTransactionExternalId()."\n
                Reason: ".$reason. "\n
            ")
        ;

        $this->mailer->send($message);

        $this->logger->addInfo('new dispute with '.$payment->getPaymentDetail()->getProvider()->getName().
            ' payment :'.$payment->getId().', amount: '. $payment->getPaymentDetail()->getAmount().
            ', user external: '.$payment->getPaymentDetail()->getTransaction()->getGamer()->getId()
        );
    }

} 