<?php

namespace AppBundle\Controller\Others;

use AppBundle\Entity\App;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestNotificationController extends Controller
{
    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @Route("/pg_notification_to_app_test", name="payment_pg_notification_test")
     */
    public function pgNotificationToAppTestAction(Request $request)
    {
        /** @var App $demoApp */
        $demoApp = $this->getDoctrine()->getManager()->getRepository("AppBundle:App")->findOneBy(['name'=>'demo']);

        $secret = $demoApp->getAppApiHasCredential()->getSecretKey();

        $params = '';
        foreach ($request->request->all() as $param)
            $params .= $param;

        $this->logger->addDebug($params);

        $signature = 'Signature '.sha1($params.$secret);

        if ($signature !== $request->headers->get('Authorization'))
            return new Response('secret is wrong '.$signature.' '.$request->headers->get('Authorization').', params: '.$params, 400);

        $message = \Swift_Message::newInstance()
            ->setSubject('TEST notification payment, env: '.$this->container->getParameter('kernel.environment').': ')
            ->setFrom($this->container->getParameter('email_app'))
            ->setTo($this->container->getParameter('email_developers'))
            ->setBody('URL: '.$request->getRequestUri()."\n\nGET:".print_r($_GET, true)."\n\nPOST".print_r($_POST, true))
        ;

        return new Response($this->get("mailer")->send($message));
    }

    /**
     * @Route("/internal_payment_notification", name="internal_payment_notification_test")
     */
    public function internalPaymentNotificationTestAction(Request $request)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('TEST internal payment notification payment, env: '.$this->container->getParameter('kernel.environment').': ')
            ->setFrom($this->container->getParameter('email_app'))
            ->setTo($this->container->getParameter('email_developers'))
            ->setBody('URL: '.$request->getRequestUri()."\n\nGET:".print_r($_GET, true)."\n\nPOST".print_r($_POST, true))
        ;

        return new Response($this->get("mailer")->send($message));
    }

    /*
     * @Route("/trufero", name="d")
     */
    public function truferoAction(Request $request)
    {
        $client = $this->guzzle->post('http://sym2_pay_gateway.dev/pg_notification_to_app_test', null, [
            'notificationId' => 'WONOT_54b7e18b874b5',
            'itemId' => 'a55459ca-6bdb-11e4-acee-00259068f82e',
            'payCategory' => 'Promo code',
            'tab'=>'Free',
            'price' => 0,
            'currency' => 'EUR',
            'payout' => 0,
            'gamerId' => 'DEMO_54b7e17ce24e8',
            'userId' => 'DEMO_54b7e17ce24e8',
            'amount' => 2,
            'transactionId'=>'WOT_54b7e17fd6c54',
            'status'=>'success',
            'providerId'=>'WOP_54b7e18b86edf',
            'exchangeEUR'=>0.7731,
            'articleId'=>'a55459ca-6bdb-11e4-acee-00259068f82e',
            'country'=>'ES'
            ]);

        try{

            $response  = $client->send();

        }catch (BadResponseException $e){
            $response = $e->getResponse();

            echo "Notification error:" . $e->getMessage(). $response->getBody(true);
        }catch (\Exception $e){

            die("Crash ".$e->getMessage());

        }
    }
}
