<?php


namespace AppBundle\Service;

use AppBundle\Entity\ClientDocument;
use AppBundle\Entity\FinInvoice;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Event\BillingInvoicesGeneratedEvent;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Event\NotificationFailedEvent;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Sonata\MediaBundle\Twig\Extension\MediaExtension;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\Translation\LoggingTranslator;


/**
 * @Service("app.emails")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 * @Tag("kernel.event_listener", attributes = {"event" = "payment.notification.failed"})
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.cancelled"})
 * @Tag("kernel.event_listener", attributes = {"event" = "app.billing_invoices.generated"})
 */
class EmailService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Inject("%is_production%"),
     * @var bool $isProduction
     */
    public $isProduction;

    /**
     * @var \Swift_Mailer
     * @Inject("mailer")
     */
    public $mailer;

    /**
     * @var String
     * @Inject("%email_app%")
     */
    public $emailApp;

    /**
     * @var String
     * @Inject("%email_invoices%")
     */
    public $emailInvoices;

    /**
     * @var String
     * @Inject("%email_billing%")
     */
    public $emailBilling;

    /**
     * @var String
     * @Inject("%email_developers%")
     */
    public $emailDevelopers;

    /**
     * @var String
     * @Inject("%email_info_wolopay%")
     */
    public $emailInfoWolopay;

    /**
     * @var String
     * @Inject("%email_finance%")
     */
    public $emailFinance;

    /**
     * @var String
     * @Inject("%kernel.root_dir%")
     */
    public $kernelRootDir;

    /**
     * @var String
     * @Inject("%domain_main%")
     */
    public $domainMain;

    /**
     * @var TimedTwigEngine
     * @Inject("templating")
     */
    public $twig;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var LoggingTranslator
     * @Inject("translator")
     */
    public $translator;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var MediaExtension
     * @Inject("sonata.media.twig.extension")
     */
    public $mediaExtension;

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        if ($this->isProduction)
            $this->sendEmailGamerPaymentCompleted($paymentCompletedEvent->getPurchase());
    }

    public function sendEmailGamerPaymentCompleted(Purchase $purchase)
    {
        if ($purchase->getTest() || $purchase->getAmountTotal() === 0)
            return;

        if (!$purchase->getGamer()->getEmail())
        {
            $this->logger->addWarning("Gamer email not configured and gamer email not be sent");
            return;
        }

        $payment =$purchase->getPayment();

        if ($payment instanceof SubscriptionEventualityPayment)
            $ip = $payment->getSubscriptionEventuality()->getSubscription()->getIp();
        else
            $ip = $payment->getIp();


        if ($purchase->getCli()){
            $purchase->setAmountTotal(0)->setAmountBeforeTaxes(0);

            $view = $this->twig->render('@App/AppShop/Payment/email/payment_completed.html.twig', [
                'product'     => $this->getTranslationArticlesFromPurchase($purchase),
                'purchase'    => $purchase,
                'ip'          => $ip,
                'beforeTaxes' => 0,
            ]);
        }else{
            $view = $this->twig->render('@App/AppShop/Payment/email/payment_completed.html.twig', [
                'product'     => $this->getTranslationArticlesFromPurchase($purchase),
                'purchase'    => $purchase,
                'ip'          => $ip,
                'beforeTaxes' => $purchase->getAmountTotal() / (($purchase->getCountryGamer()->getVat() /100) + 1),
            ]);
        }

        $message = \Swift_Message::newInstance()
            ->setSubject($this->translator->trans('payment.gamer_email.subject'))
            ->setFrom($this->emailBilling)
            ->setTo($purchase->getGamer()->getEmail())
            ->setBody($view, 'text/html')
        ;


        if ($this->mailer->send($message))
            $this->logger->addInfo('Gamer email was sent');

        // Copy to emailBilling
        $message = \Swift_Message::newInstance()
            ->setSubject($this->translator->trans('payment.gamer_email.subject'))
            ->setFrom($this->emailBilling)
            ->setTo($this->emailBilling)
            ->setBody($view, 'text/html')
        ;

        $this->mailer->send($message);
    }

    protected function getTranslationArticlesFromPurchase(Purchase $purchase)
    {
        if ($purchase->getTransaction()->getCustomAmount())
        {
            return $purchase->getTransaction()->getCustomArticleTitle();
        }

        $translated = '';
        foreach ($purchase->getPayment()->getPaymentDetail()->getPaymentDetailHasArticles() as $pdHa)
        {
            if ($pdHa->getAppShopHasArticle())
                $transUnit = $pdHa->getAppShopHasArticle()->getNameCurrentLabel();
            else
                $transUnit = $pdHa->getArticle()->getNameCurrentLabel();

            $translated .= ', '.ArticleService::getTranslationBasic(
                $transUnit,
                $pdHa->getItemsQuantity(),
                $purchase->getPayment()->getPaymentDetail()->getLanguage()->getId()
            );
        }

        $translated = substr($translated, 2);

        return $translated;
    }

    public function onPaymentNotificationFailed(NotificationFailedEvent $notificationFailedEvent)
    {
        if ($notificationFailedEvent->getPurchaseNotification()->getAttempts() !== 1 && !$notificationFailedEvent->getWasLastAttemptAndNoMore())
            return;

        $this->sendEmailAppNotificationFailed(
            $notificationFailedEvent->getPurchaseNotification(),
            $notificationFailedEvent->getUrl(),
            $notificationFailedEvent->getParams(),
            $notificationFailedEvent->getHeaders());
    }

    public function sendEmailAppNotificationFailed(PurchaseNotification $purchaseNotification, $url, $params, $headers)
    {
        $emailClientTo = $purchaseNotification->getApp()->getTechnicalEmail();
        $attemptNumber = $purchaseNotification->getAttempts();
        $remainingAttempts = $purchaseNotification->getRemainingAttempts();

        if (!$emailClientTo)
        {
            $this->logger->addInfo('We can\'t send email app notification failed, because it hasn\'t technical email settled');
            return;
        }

        $this->logger->addInfo("Sending email to notify appNotification error, attempt $attemptNumber, remaining attempts $remainingAttempts");

        $content = "Purchase Notification failed:\r\n\r\n";
        $content.= "Url:  " . $url . "\r\n\r\n";
        $content.= "Params:  " . $params . "\r\n\r\n";
        $content.= "Headers: " . $headers . "\r\n\r\n";

        $subject = 'WOLOPAY Purchase Notification Failed, '.$purchaseNotification->getApp()->getName().'(attempt number: '.$attemptNumber.'; remaining attempts: '.$remainingAttempts.')';

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->emailApp)
            ->setTo($emailClientTo)
            ->setBody($content  , 'text/plain')
        ;

        $this->mailer->send($message);

        // Copy to admin
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->emailApp)
            ->setTo($this->emailInfoWolopay)
            ->setBody($content  , 'text/plain')
        ;

        $this->mailer->send($message);
    }

    public function onShopPaymentCancelled(PaymentCancelledEvent $e)
    {
        // only execute when his status was completed
        if (!$e->getWasCompletedBeforeCancelled() || $e->getCalledByMerchantNow())
            return;

        $payment = $e->getPayment();
        $purchase = $payment->getPurchase();
        $notificationsIds = UtilHelper::parseIdEntitiesToCSV($purchase->getPurchaseNotification());

        $emailsClientToSend = [];

        if ($purchase->getApp()->getEndUserSupportEmail())
            $emailsClientToSend[]= $purchase->getApp()->getEndUserSupportEmail();

        if ($purchase->getApp()->getOwnerEmail())
            $emailsClientToSend[]= $purchase->getApp()->getOwnerEmail();


        $subject = "Payment was canceled $notificationsIds, App: ".$purchase->getApp()->getName().", ".
            $purchase->getAmountTotal().' '.$purchase->getCurrency()->getSymbol()
        ;

        $content = "Payment canceled:\r\n\r\n";
        $content.= "Game Id:  " . $purchase->getApp()->getName(). "\r\n\r\n";
        $content.= "Notification Id:  $notificationsIds\r\n\r\n";
        $content.= "Transaction Id:  " . $purchase->getTransactionId(). "\r\n\r\n";
        $content.= "Amount:  " . number_format($purchase->getAmountTotal()) . ' ' . $purchase->getCurrency()->getSymbol() . "\r\n\r\n";
        $content.= "user Id:  " . $purchase->getGamer()->getGamerExternalId(). "\r\n\r\n";
        $content.= "user Email:  " . $purchase->getGamer()->getEmail(). "\r\n\r\n";
        $content.= "Article/s:  " . $purchase->getArticlesString(). "\r\n\r\n";

        if ($e->getReason())
            $content.= "Reason:  ".$e->getReason();

        // Copy to admin
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->emailApp)
            ->setTo($this->emailInfoWolopay)
            ->setBody($content  , 'text/plain')
        ;

        $this->mailer->send($message);

        if (!$emailsClientToSend)
            return;

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->emailApp)
            ->setTo($emailsClientToSend)
            ->setBody($content  , 'text/plain')
        ;

        $this->mailer->send($message);
    }

    public function onAppBillingInvoicesGenerated(BillingInvoicesGeneratedEvent $billingInvoicesGeneratedEvent)
    {
        $this->sendEmailInvoiceRequireApprovement();
    }

    private function sendEmailInvoiceRequireApprovement()
    {
        $nRequireToApprove = $this->em->getRepository("AppBundle:FinInvoice")->findRequireApprove(true);

        $developers = $this->emailDevelopers;
        if (!is_array($this->emailDevelopers))
            $developers = [$developers];

        $emailsClientToSend= array_merge([$this->emailInvoices], $developers );

        $urlListPending = $this->domainMain.$this->router->generate('billing_invoices_pending_list');

        $body = "
Some invoices are generated<br>
Pending to approve: $nRequireToApprove<br><br>

<a href='$urlListPending'>click here to list all pending invoices</a>

";

        $message = \Swift_Message::newInstance()
            ->setSubject('Invoices are generated')
            ->setFrom($this->emailApp)
            ->setTo($emailsClientToSend)
            ->setBody($body, 'text/HTML')
        ;

        $this->mailer->send($message);
    }


    /**
     * @param ClientDocument[] $clientDocuments
     * @param $msgExtra
     * @param \AppBundle\Entity\FinInvoice[] $finInvoices
     */
    public function sendClientAfterApproval(array $finInvoices, array $clientDocuments, $msgExtra)
    {
        $body = "
Please find the latest invoices attached.<br>
Should  you have any doubt, please contact ".$this->emailFinance."<br><br>

$msgExtra

Best regards,<br>
Wolopay Team<br>
";

        $message = \Swift_Message::newInstance()
            ->setSubject('Wolopay invoices for period '.$finInvoices[0]->getReferenceDate()->format('M Y'))
            ->setFrom($this->emailFinance)
            ->setTo($finInvoices[0]->getExternalCompanyNotWolopay()->getFinanceEmail())
        ;

        foreach ($finInvoices as $finInvoice)
        {
            $message->attach(\Swift_Attachment::fromPath($this->kernelRootDir.'/../web'. $this->mediaExtension->path($finInvoice->getDocument(), 'reference')));
        }

        foreach ($clientDocuments as $clientDocument)
        {
            $message->attach(\Swift_Attachment::fromPath($this->kernelRootDir.'/../web'. $this->mediaExtension->path($clientDocument->getDocument(), 'reference')));
        }

        $message->setBody($body, 'text/HTML');

        $this->mailer->send($message);
    }
} 