<?php

namespace AppBundle\Command;


use AppBundle\Entity\Enum\ArticleSpecialTypeEnum;
use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseNotification;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Exception\NviaException;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use AppBundle\Payment\Event\NotificationFailedEvent;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\CurlException;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use ZendDiagnostics\Check\GuzzleHttpService;

/**
 * @Service("command.shop.app_notification.send")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 * @Tag("console.command")
 */
class AppNotificationCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("event_dispatcher")
     * @var ContainerAwareEventDispatcher event_dispatcher
     */
    public $eventDispatcher;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    /** @Inject("%php_exe_path%")   */
    public $phpExePath;

    /** @Inject("%kernel.environment%")   */
    public $env;

    /**
     * @var StreamHandlerDynamicFileHelper
     * @Inject("shop.logger.transaction_helper")
     */
    public $streamHelper;

    /* Guzzle Bug... */
    private $lostUrl;
    private $lostParams;
    private $lostAuth;

    protected function configure()
    {
        $this
            ->setName('shop:app_notification:send')
            ->setDescription('send payment notification to app')
            ->addArgument('purchaseNotificationId', InputArgument::OPTIONAL, 'PurchaseNotificationId:id', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $notificationId = $input->getArgument('purchaseNotificationId');

        // Async 4 massive data
        if (!$notificationId)
        {
            $purchaseNotification = $this->em->getRepository("AppBundle:PurchaseNotification")->findByIsReadyToNotifyAndWasReceived();

            foreach ($purchaseNotification as $pN)
            {
                $exec = $this->phpExePath.' '.$this->rootDir.'/../bin/console shop:app_notification:send '.$pN->getId().' --env='.$this->env;
                $process = new Process($exec);

                $output->writeln("Send: ".$pN->getId());
                $process->start();
                usleep(500); // sleep 0.5 for each notification
            }

            return;
        }

        if (! $notification = $this->em->getRepository("AppBundle:PurchaseNotification")->find($notificationId) )
            throw new \Exception("Purchase Notification '$notificationId' is invalid'");

        $purchaseNotification = array( $notification );

        list($OK, $KO) = $this->sendNotifications($purchaseNotification);

        //        $output->writeln("\n---------------\n--- SUMMARY ---\n---------------");
        //        $output->writeln("Petitions OK : ".count($OK));
        //        $output->writeln("Petitions KO : ". count($KO));

        if (count($OK))
        {
            //            $output->writeln("\n---------------\nPetitions OK: \n---------------");

            foreach ($OK as $OKK)
                $output->writeln(" OK [-] ".$OKK);
        }

        if (count($KO))
        {
            //            $output->writeln("\n---------------\nPetitions KO:\n---------------");

            foreach ($KO as $KOO)
                $output->writeln(' FAIL ** [-] url: ' . $KOO['request']['url'].", http_code: ".$KOO['response']['http_code']
                    ."\n".$KOO['response']['content']);
        }
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        $this->logger->addDebug('manage appNotification to send');

        foreach ($paymentCompletedEvent->getPurchaseNotifications() as $pn)
        {
            if ($pn->getIsAsync())
            {
                $exec = $this->phpExePath.' '.$this->rootDir.'/../bin/console shop:app_notification:send '.$pn->getId().' --env='.$this->env;
                $this->logger->addInfo("exec: $exec");
                $process = new Process($exec);
                $process->start();
            }else{
                
                $this->sendNotifications([$pn]);
                $this->logger->addInfo("Async notification ".$pn->getId()." sent ");
            }

        }

    }

    /**
     * @param \AppBundle\Entity\PurchaseNotification[] $notifications
     * @throws \AppBundle\Exception\NviaException
     * @return array
     */
    public function sendNotifications(array $notifications)
    {
        $failed = function (&$KO, PurchaseNotification $notification, $result)
        {
            if ($notification->getCancelPaymentIfNotificationFail())
                $notification->getPurchases()[0]->setWasCanceled(true);

            $KO []= $result;
        };

        $OK = $KO = [];

        foreach ($notifications as $notification)
        {
            try{

                $this->streamHelper->changeLogFileByTransaction(
                    $notification->getPurchases()[0]->getPayment()->getPaymentDetail()->getTransaction()
                );

                if (!$notification->getForceToNotify() &&
                    (($notification->getWasReceived() || !$notification->getIsReadyToNotify() || $notification->getRemainingAttempts() <= 0)
                        || ($notification->getHasOnlyOneAttempt() && $notification->getAttempts() > 0)
                        || ($notification->getMinDelay() && $notification->getMinDelay()->getTimestamp() > (new \DateTime())->getTimestamp())
                    )
                )
                {
                    continue;
                }

                $notification->addAttempt();

                $purchases = $notification->getPurchases();

                if ($purchases->isEmpty())
                {
                    throw new NviaException("this notification '".$notification->getId()."' doesn't purchases"
                        , NviaException::INVALID_UNKNOWN
                    );
                }

                $todoRequest = $this->generateUrlNotification($notification, $purchases[0]);

                if (!$todoRequest)
                {
                    $KO []= $this->lostUrl;
                    $failed($KO, $notification, $notification->getId());
                    continue;
                }

                $result = $this->sendNotification($todoRequest, $notification);

                if ($result === true)
                {
                    $OK []= $this->lostUrl;
                    $notification->setWasReceived(true);

                }else{

                    $KO []= $this->lostUrl;
                    $wasLastAttemptAndNoMore = ($notification->getRemainingAttempts() === 0);

                    $this->logger->addInfo("Executing event: '".NotificationFailedEvent::EVENT."' for failure number " . $notification->getAttempts());
                    $this->eventDispatcher->dispatch(
                        NotificationFailedEvent::EVENT,
                        new NotificationFailedEvent($notification,$todoRequest, $this->lostUrl, $this->lostParams, $wasLastAttemptAndNoMore )
                    );

                    $failed($KO, $notification, $result);
                }

                $notification->setForceToNotify(false);

            }catch (\Exception $e){

                $this->logger->addError($e->getMessage());
            }

        }


        $this->em->flush();



        return [$OK, $KO];
    }

    /**
     * @param PurchaseNotification $notification
     * @param Purchase $purchase
     * @return \Guzzle\Http\Message\RequestInterface
     */
    public function generateUrlNotification(PurchaseNotification $notification, Purchase $purchase)
    {
        $app = $purchase->getApp();

        if (!$app->getUrlNotificationPayment() && !$app->getUrlNotificationSubscription())
        {
            $this->logger->addCritical("App ".$app->getName()." doesn't have url notifications ...");
            return false;
        }

        if ($notification->getIsExtra())
        {
            $base = $app->getUrlNotificationExtra();

        }elseif($purchase->getTransaction()->getUrlNotification()){

            $base = $purchase->getTransaction()->getUrlNotification();

        }else{
            if ($notification->getIsSubscription() && $app->getUrlNotificationSubscription())
                $base = $app->getUrlNotificationSubscription();
            else
                $base = $app->getUrlNotificationPayment();
        }

        if (strpos($base,'?') === false && $purchase->getTransaction()->getCustomParam())
            $base .= '?';

        $base .= $purchase->getTransaction()->getCustomParam();
        $countryDetectedNumCode = null;

        if($countryDetected = $purchase->getTransaction()->getCountryDetected()){
            $countryDetectedNumCode =  $countryDetected ->getMCC();
        }

        if ($notification->getPaymentDetailHasArticle())
        {
            $pdha = $notification->getPaymentDetailHasArticle();

            $article = $notification->getPaymentDetailHasArticle()->getArticle();

            if ($article->getSpecialType() &&
                $article->getSpecialType()->getId() != ArticleSpecialTypeEnum::ARTICLE_PACK)
            {
                if (!$notification->getPaymentDetailArticlesHasGivenArticle())
                    throw new NviaException("Not found article from given article");

                $article = $notification->getPaymentDetailArticlesHasGivenArticle()->getArticle();
            }

            $item = $article->getItem();

            $itemId = $item->getId();
            $woloItemId = $itemId;
            $gameItemId = $item->getExternalItemId();
            $gameArticleId = $article->getExternalArticleId();
            $tabName = $notification->getPaymentDetailHasArticle()->getTabName();

            if (!$pdha->getArticle()->getSpecialType())
            {
                $price = $pdha->getAmount() * $pdha->getArticlesQuantity();
                $itemsQuantity = $pdha->getItemsQuantity() * $pdha->getArticlesQuantity();

            }else{

                $price = $pdha->getAmount();
                $itemsQuantity = $article->getItemsQuantity();
            }

            $articleId = $article->getId();
        }else{

            $itemId = '';
            $woloItemId = $itemId;
            $gameItemId = '';
            $gameArticleId = '';
            $tabName = '';
            $price = $purchase->getAmountGame();
            $itemsQuantity = 1;
            $articleId= '';
        }

        if ($notification->getEvent() === PurchaseNotificationEventEnum::PAYMENT_CANCELLED)
            $itemsQuantity = $itemsQuantity * (-1);

        if (!($gamerIp=$purchase->getTransaction()->getGamerIp())) $gamerIp='';

        $params = [
            'notificationId' => $notification->getId(),
            'transactionId'  => $purchase->getPayment()->getPaymentDetail()->getTransaction()->getId(),
            'appId'          => $purchase->getApp()->getId(),
            'itemId'         => $itemId,
            'woloItemId'     => $woloItemId,
            'gameItemId'     => $gameItemId,
            'amount'         => $itemsQuantity,
            'itemsQuantity'  => $itemsQuantity,
            'articleId'      => $articleId,
            'gameArticleId'  => $gameArticleId,
            'payCategory'    => $purchase->getPayMethod()->getPayCategory()->getName(),
            'providerId'     => $purchase->getPayMethod()->getId(),
            'tabName'        => $tabName,
            'isSubscription' => (int) ($purchase->getPayment() instanceof SubscriptionEventualityPayment),
            'country'        => $purchase->getCountry()->getId(),
            'countryCode'    => $purchase->getCountry()->getMCC(),
            'currency'       => $purchase->getCurrency()->getId(),
            'price'          => $price,
            'tax'            => $purchase->getRealAmountTax(),
            'payMethodFee'   => $purchase->getAmountProvider(),
            'woloFee'        => $purchase->getAmountWolo(),
            'payout'         => $purchase->getAmountGame(),
            'userId'         => $purchase->getGamer()->getGamerExternalId(),
            'gamerId'        => $purchase->getGamer()->getGamerExternalId(),
            'gamerCountry'   => ($countryDetected ? $countryDetected->getId(): $purchase->getCountry()->getId() ),
            'gamerCountryCode'=>($countryDetected ? $countryDetectedNumCode  : $purchase->getCountry()->getId() ),
            'gamerIp'        => $gamerIp,
            'event'          => $notification->getEvent(),
            'status'         => 'success',
            'exchangeEUR'    => $purchase->getExchangeRateEur(),
            'test'           => (int) $purchase->getTest(),
        ];

        $secret = $this->generateASecret($notification->getApp()->getAppApiHasCredential()->getSecretKey(), $params);
        $this->lostUrl  = $base;
        $this->lostParams = http_build_query($params);
        $this->lostAuth = $secret;

        $request = $this->guzzle->post($base, ['Authorization' => 'Signature '.$secret], $params, [
                'timeout'         => 50,
                'connect_timeout' => 1.5
            ]);

        return $request;
    }

    private function generateASecret($secretKey, array $params)
    {
        $data='';

        foreach($params as $value)
            $data.=$value;

        return sha1($data.$secretKey);
    }

    private function sendNotification(\Guzzle\Http\Message\RequestInterface $todoRequest, PurchaseNotification $notification)
    {
        $response= null;

        try{

            $response  = $todoRequest->send();

        }catch (BadResponseException $e){

            $response = $e->getResponse();
            $this->logger->addWarning("Notification error: " . $e->getMessage());

        }catch (CurlException $e){

            $response = new \Guzzle\Http\Message\Response(520, [], $e->getMessage());
            $this->logger->addWarning("Crash ".$e->getMessage());

        }catch (\Exception $e){

            $response = new \Guzzle\Http\Message\Response(520, [], 'Unknown');
            $this->logger->addError("Crash ".$e->getMessage());
        }

        $date = new \DateTime();
        $notification->addRequestRequest([
                'url'    => $this->lostUrl,
                'params' => $this->lostParams,
                'auth'   => $this->lostAuth,
                'date'   => $date->format(\DateTime::ISO8601)
            ]);

        $notification->addRequestResponse([
                'http_code' => $response->getStatusCode(),
                'content' => mb_strimwidth($response->getBody(), 0, 200, '...'),
            ]);

        if (($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) && $notification)
        {
            $this->logger->addInfo("Error in notification app, notification: ".$notification->getId()
                .', transacción: '.$notification->getPurchases()[0]->getTransaction()->getId()
                .($notification->getPurchases()[0]->getTest() ? ' is a TEST, ' : '')."\n\n Response: \n
                HTTP_CODE: " . $response->getStatusCode() . "\nContent: ". $response->getBody()
            );

            return $notification->getRequestExact();
        }

        $this->logger->addInfo("Notification was sent to ".$this->lostUrl.", response was ".$response->getStatusCode());

        return true;
    }

} 