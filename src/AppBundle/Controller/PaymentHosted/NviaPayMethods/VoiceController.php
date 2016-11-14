<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;

use AppBundle\Controller\PaymentHosted\NviaPayMethods\Exception\NviaPayMethodException;
use AppBundle\Entity\SuperClass\CodePurchase;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\VoiceCode;
use AppBundle\Form\Type\CodePurchaseType;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

/**
 * @Route("/voice")
 */
class VoiceController extends AbstractNviaPayMethods
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    const LOG_NAME = 'voice_vo_vt_code';

    /**
     * @Route("/logic_vo_vt_code/{_locale}/{transaction_id}/{payment_process_id}", name="voice_vo_vt_code" )
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Template()
     */
    public function logicVoVtCodeAction(Request $request, Transaction $transaction, $payment_process_id, $_locale)
    {
        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'i');

        $paymentObject = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);
        $details = $paymentObject->getPaymentDetail();
        $voice = $details->getVoice();
        $pmpc = $this->paymentProcessService->getPayMethodProviderHasCountry($paymentObject);

        if (!$voice)
            throw new \Exception("This pay method haven't voice payment");

        $codePurchaseTmp = new CodePurchase();
        $form = $this->createForm(new CodePurchaseType(), $codePurchaseTmp);

        if ($request->getMethod() === 'POST')
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                if ($voiceCode = $this->validateCode($codePurchaseTmp->getCode(), $voice->getAmount(), "AppBundle:VoiceCode", $pmpc))
                {
                    $this->logger->addInfo("Code is valid: '".$codePurchaseTmp->getCode()."'");

                    $params = [
                        'payment_process_id' => $payment_process_id,
                        '_locale' => $_locale,
                        'security_random' => $paymentObject->getPaymentDetail()->getSecurityRandomIpn(),
                        'transaction_id' => $transaction->getId(),
                        'voice_code_id' => $codePurchaseTmp->getCode()
                    ];

                    $url = $this->container->getParameter('domain_main'). $this->router->generate('payment_ipn',  $params);

                    $request   = $this->guzzle->get($url);
                    $response  = $request->send();

                    $this->logger->addInfo("Response to process this payment ($url) was '".$response->getStatusCode()."'");

                    if ($response->getStatusCode() === 200)
                    {
                        $voiceCode->setUsedAtNow();
                        $this->em->flush();

                        $params['security_random'] = $paymentObject->getPaymentDetail()->getSecurityRandomDone();

                        $this->logger->addInfo("All was right! redirecting to payment_done");

                        return new RedirectResponse($this->router->generate('payment_done', $params));
                    }

                }else{

                    $this->logger->addWarning("Code is invalid: '".$codePurchaseTmp->getCode()."'");
                    $form->get('code')->addError(new FormError("Invalid code"));
                }
            }
        }
        $appShopHasArticles = $paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getAppShopHasArticle();
        $itemsQuantity = $paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getItemsQuantity();

        $articleNameTranslated = ArticleService::getTranslation($appShopHasArticles, $request->getLocale(), $appShopHasArticles->getNameCurrentLabel());

        return array(
            'appp'         => $appShopHasArticles->getAppShop()->getApp(),
            'articleName' => $articleNameTranslated,
            'voice'       => $voice,
            'form'        => $form->createView()
        );
    }

    /**
     * @Route("/ipn_static", name="voice_ipn")
     */
    public function ipnStaticAction(Request $request)
    {
        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'in');

        $action = $request->get('action');
        $number = $request->get('llamado');

        if($action != 'end' && $action != 'start')
            throw new NviaPayMethodException("Invalid action $action");

        if (!$voice = $this->em->getRepository("AppBundle:Voice")->findByNumber($number))
            throw new NviaPayMethodException("this number $voice in't configured");

        if($action == 'start')
        {
            $newCode = $this->getNewCode();

            $voiceCode = new VoiceCode();
            $voiceCode
                ->setAmount($voice->getAmount())
                ->setCurrency($voice->getPayMethodProviderHasCountry()->getCurrency())
                ->setNumber($number)
                ->setCode($newCode)
            ;

            $this->em->persist($voiceCode);
            $this->em->flush();

            return new Response($newCode);
        }

        // End action

//        $code = $request->get('numero');
//        $llamado = $request->get('llamado');
//        $duracion = $request->get('duracion');

//        if (!$voiceCode = $this->em->getRepository("AppBundle:VoiceCode")->findOneByCodeAndValid($code))
//            throw new NviaPayMethodException("Invalid code: $code");
//
//        $voiceCode->setAmount($voice->getAmount());
//
//        $this->em->flush();
//        $this->logger->addInfo("Updated $code with amount ".$voice->getAmount());

        return new Response("OK");
    }

    private function getNewCode()
    {
        $newCode=null;
        while (true)
        {
            $newCode = rand ( 10000 , 999999);

            if (!$this->em->getRepository("AppBundle:VoiceCode")->find($newCode))
                break;
        }

        return $newCode;
    }
}
