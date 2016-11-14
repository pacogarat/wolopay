<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;


use AppBundle\Entity\SMSCode;
use AppBundle\Entity\SuperClass\CodePurchase;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\CodePurchaseType;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Lexik\Bundle\TranslationBundle\Translation\Translator;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AbstractSMSController extends AbstractNviaPayMethods
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var PaymentProcessService
     */
    private $paymentProcessService;

    /**
     * @var \Guzzle\Service\Client
     */
    private $guzzle;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Translator
     * @Inject("translator")
     */
    private $translator;

    const LOG_NAME = 'sms_mo_mt_code';

    private function hydrateProperties()
    {
        $this->em                    = $this->get('doctrine.orm.default_entity_manager');
        $this->paymentProcessService = $this->get("shop.payment.payment_process");
        $this->guzzle                = $this->get('guzzle.client');
        $this->router                = $this->get('router');
        $this->logger                = $this->get("logger");
        $this->translator            = $this->get('translator');
    }

    public function logicMoMtCodeRender(Request $request, Transaction $transaction, $payment_process_id, $_locale)
    {
        $this->hydrateProperties();
        $this->addSpecialLogByPayMethod(static::LOG_NAME, 'i');

        $paymentObject = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);
        $sms           = $paymentObject->getPaymentDetail()->getSms();
        $pmpc          = $this->paymentProcessService->getPayMethodProviderHasCountry($paymentObject);

        $smsAliasOverRide =$paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getAppShopHasArticle()->getSmsAliasCurrent();

        $smsAlias = $sms->getSmsAliasValid($smsAliasOverRide);

        $codePutchaseTmp = new CodePurchase();
        $form = $this->createForm(new CodePurchaseType(), $codePutchaseTmp);

        if ($request->getMethod() === 'POST')
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                $this->logger->addInfo("User is trying to use this code: '".$codePutchaseTmp->getCode()."'");

                if ($smsCode = $this->validateCode($codePutchaseTmp->getCode(), $sms->getAmount(), "AppBundle:SMSCode", $pmpc))
                {
                    $this->logger->addInfo("Code is valid: '".$codePutchaseTmp->getCode()."'");

                    $params = [
                        'payment_process_id' => $payment_process_id,
                        '_locale' => $_locale,
                        'security_random' => $paymentObject->getPaymentDetail()->getSecurityRandomIpn(),
                        'transaction_id' => $transaction->getId(),
                        'sms_code_id' => $codePutchaseTmp->getCode()
                    ];

                    $url = $this->container->getParameter('domain_main'). $this->router->generate('payment_ipn',  $params);

                    $request   = $this->guzzle->get($url);
                    $response  = $request->send();
                    $this->logger->addInfo("Response to process this payment ($url) was '".$response->getStatusCode()."'");

                    if ($response->getStatusCode() === 200)
                    {
                        $smsCode->setUsedAtNow();
                        $this->em->flush();

                        $params['security_random'] = $paymentObject->getPaymentDetail()->getSecurityRandomDone();

                        $this->logger->addInfo("All was right! redirecting to payment_done");

                        return new RedirectResponse($this->router->generate('payment_done', $params));
                    }

                }else{
                    $this->logger->addWarning("Code is invalid: '".$codePutchaseTmp->getCode()."'");
                    $form->get('code')->addError(new FormError("Invalid code"));
                }
            }
        }

        $article = $paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getArticle();
        $appShopHasArticles = $paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getAppShopHasArticle();

        $articleNameTranslated = ArticleService::getTranslation($appShopHasArticles, $request->getLocale(), $appShopHasArticles->getNameCurrentLabel());

        $replace = [
            '%number%'   => $sms->getShortNumber(),
            '%amount%'   => $sms->getAmount(),
            '%currency%' => $sms->getPayMethodProviderHasCountry()->getCurrency()->getSymbol(),
        ];

        $legalText = $this->translator->trans($sms->getLegalTextLabel()->getKey(), $replace, $sms->getLegalTextLabel()->getDomain());

        if ($legalText===$sms->getLegalTextLabel()->getKey())
        {
            $this->logger->addError('Sms legal text "'.$sms->getLegalTextLabel()->getKey().'" NOT FOUND');
            $legalText = $this->translator->trans('sms.legal_text.standard', $replace, 'sms');
        }

        $params = array(
            'appp'       => $article->getApp(),
            'articleName' => $articleNameTranslated,
            'alias'      => $smsAlias,
            'sms'        => $sms,
            'article'    => $paymentObject->getPaymentDetail()->getPaymentDetailHasArticles()[0],
            'form'       => $form->createView(),
            'legalText'  => $legalText,
        );

        return new Response(
            $this->container->get('templating')->render('AppBundle:PaymentHosted/NviaPayMethods/SMS:logicMoMtCode.html.twig', $params)
        );

    }



}
