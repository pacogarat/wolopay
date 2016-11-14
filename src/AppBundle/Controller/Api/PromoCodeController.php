<?php

namespace AppBundle\Controller\Api;


use AppBundle\Command\TransactionCreateCommand;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use AppBundle\Entity\SingleFreePayment;
use AppBundle\Form\Type\Api\PromoCodeApiType;
use AppBundle\Form\Type\Api\PromoCodeUpdateApiType;
use AppBundle\Payment\Actions\PaymentCompleted;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\Promo\PromoService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Util\Codes;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PromoCodeController extends AbstractAPI
{
    /**
     * @var PaymentProcessService
     * @DI\Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var TransactionCreateCommand
     * @DI\Inject("shop.command.transaction.create")
     */
    public $transactionCreateService;

    /**
     * @var PaymentCompleted
     * @DI\Inject("shop.payment.completed")
     */
    public $paymentCompletedService;

    /**
     * Verify if promo code is valid (optionally in a specific promo and/or for a specific user)
     *
     * @ApiDoc(
     *   section = "Promo Codes",
     *   output={
     *      "class"   = "AppBundle\Entity\PromoCode",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   statusCodes = {
     *     200 = "If code is valid",
     *     400 = "Is invalid"
     *   }
     * )
     *
     * @Get("/promo_code/check/{promo_code}", requirements={"promo_code":".+?"})
     * @QueryParam(name="promo_id", description="Promo Id", strict=true, nullable=true)
     * @QueryParam(name="gamer_id", description="Gamer Id to check", strict=true, nullable=true)
     *
     * @param string $promo_code PromoCode id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return array
     */
    public function isValidAction($promo_code, Request $request, $promo_id=null, $gamer_id=null)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $gamer=null;

        $em = $this->getDoctrine();
        try{

            if ($gamer_id) $gamer = $em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId(
                            $appCredentials->getApp()->getId(), $gamer_id);

            $app = $appCredentials->getApp()->getId();
            if ($promo_id<>""){
                $promoCode = $this->getDoctrine()->getRepository("AppBundle:PromoCode")
                    ->findOneByPromoAndCodeAndAppId($promo_id, $promo_code, $app);

                if (!$promoCode)
                    throw new BadRequestHttpException("This code doesn't exist for this promotion");
            }else{
                $promoCode = $this->getDoctrine()->getRepository("AppBundle:PromoCode")
                    ->findOneByCodeAndAppId($promo_code, $app);

                if (!$promoCode)
                    throw new BadRequestHttpException("This code doesn't exist");
            }

            /** @var PromoService $promoService */
            $promoService = $this->get('app.shop.promo');

            if ($promoService->verifyIsAValidPromo($promoCode, $gamer) === false)
                throw new BadRequestHttpException("This code is invalid");

        }catch (BadRequestHttpException $e){

            return $this->handleView($this->view($e->getMessage(), Codes::HTTP_BAD_REQUEST));
        }

        $view = $this->view($promoCode , Codes::HTTP_OK);

        $context = SerializationContext::create()->setGroups(array('Public'))->enableMaxDepthChecks();
        $view->setSerializationContext($context);

        return $this->handleView($view);
    }

    /**
     * Create a new promo code
     *
     * @ApiDoc(
     *   section = "Promo Codes",
     *   output={
     *      "class"   = "AppBundle\Entity\PromoCode",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   input="AppBundle\Form\Type\Api\PromoCodeApiType",
     *   statusCodes = {
     *     200 = "If code is valid",
     *     400 = "Is invalid"
     *   }
     * )
     *
     * @Post("/promo_code")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function createPromoCodeAction(Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();

        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();
        $promoCode = new PromoCode();
        $promoCode->setApp($appCredentials->getApp());

        $form = $this->createForm(new PromoCodeApiType(), $promoCode, ['em' => $em, 'app' => $app]);
        $form->submit($request);

        if (!$form->isValid())
        {
            return $this->handleView($this->view(['form' => $form], Codes::HTTP_BAD_REQUEST));
        }

        $em->persist($promoCode);
        $em->flush();

        $context = SerializationContext::create()->setGroups(array('Public'))->enableMaxDepthChecks();
        $view = $this->view($promoCode, Codes::HTTP_CREATED);
        $view->setSerializationContext($context);

        return $this->handleView($view);

    }

    /**
     * Create a new purchase with promo code and gamer id
     *
     * @ApiDoc(
     *   section = "Promo Codes",
     *   output={
     *      "class"   = "AppBundle\Entity\Purchase",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   statusCodes = {
     *     201 = "Purchase was created by promo_code",
     *     400 = "Is invalid"
     *   }
     * )
     *
     * @Post("/promo_code/use")
     *
     * @RequestParam(name="gamer_id", description="Gamer Id", strict=true, nullable=false)
     * @RequestParam(name="promo_code", description="Promo code", strict=true, nullable=false)
     * @RequestParam(name="transaction_id", description="Transaction id", strict=true, nullable=true)
     * @RequestParam(name="promo_id", nullable=true, description="Id of the promo to which the code belongs to)")
     * @RequestParam(name="custom_param", nullable=true, description="Custom param for each payment notification")
     * @RequestParam(name="url_notification", nullable=true, description="Url to notify payments (to override configured one)")

     *
     * @param string $gamer_id
     * @param string $promo_code
     * @param string $transaction_id
     * @param string $promo_id
     * @param string $custom_param
     * @param string $url_notification
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return array
     */
    public function createAPurchaseByPromoAction($gamer_id, $promo_code, $transaction_id, $promo_id, $custom_param = "", $url_notification="", Request $request)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $gamer = $this->getDoctrine()->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId(
            $appCredentials->getApp()->getId(),$gamer_id);

        if (!$gamer){
            //throw new BadRequestHttpException("This gamer doesn't exist");
            $gamer = new Gamer($app, $gamer_id);
        }


        if ($promo_id<>""){
            $promoCode = $this->getDoctrine()->getRepository("AppBundle:PromoCode")
                ->findOneByPromoAndCodeAndAppId($promo_id, $promo_code, $app);

            if (!$promoCode)
                throw new BadRequestHttpException("This code doesn't exist for this promotion");
        }else{
            $promoCode = $this->getDoctrine()->getRepository("AppBundle:PromoCode")
                ->findOneByCodeAndAppId($promo_code, $app);
            if (!$promoCode)
                throw new BadRequestHttpException("This code doesn't exist");
        }

        /** @var PromoService $promoService */
        $promoService = $this->get('app.shop.promo');

        if ($promoService->verifyIsAValidPromo($promoCode, $gamer) === false)
            throw new BadRequestHttpException("This code is invalid");

        if(!$promoCode->getArticle())
            throw new BadRequestHttpException("This promo is not valid because it hasn't an associated article");

        if($promoCode->getArticle()->getArticleCategory()->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
            throw new BadRequestHttpException("This article is a subscription and it is invalid");

        $payMethod = $this->getDoctrine()->getRepository("AppBundle:PayMethod")->findOneByPayCategoryIdAndArticleCategoryIdAndName(
            PayCategoryEnum::PROMO_CODE_ID, ArticleCategoryEnum::FREE_PAYMENT_ID, PayMethodEnum::PROMO_NAME
        );

        if (!$payMethod)
            throw new InternalErrorException("PayMethod doesnt found in promocode controller");

        /** @var AppApiCredentials $appCredentails */
        $appCredentials = $this->getUser();

        $transaction = null;

        if ($transaction_id)
        {
            if (!$transaction = $this->getDoctrine()->getRepository("AppBundle:Transaction")->find($transaction_id))
                throw new BadRequestHttpException("Transaction invalid");

            if ($transaction->getApp()->getId() !== $appCredentials->getApp()->getId())
                throw new BadRequestHttpException("Transaction invalid for this credential");
        }

        $ip = $request->getClientIp();

        if (!$transaction)
        {
            $transaction = $this->transactionCreateService->createTransactionCLI($appCredentials->getCodeKey(), $gamer->getGamerExternalId(),null,$custom_param,false,true,$url_notification);
            $ip = 'CLI';
        }
        /** @var SingleFreePayment $paymentProcess */
        $paymentProcess = $this->paymentProcessService->createPaymentProcessCLI(
            [$promoCode->getArticle()],
            ArticleCategoryEnum::FREE_PAYMENT_ID,
            $transaction,
            $payMethod,
            0,
            CurrencyEnum::EURO,
            ProviderEnum::NVIA_NAME,
            LanguageEnum::ENGLISH,
            $ip
        );

        $purchase = $this->paymentCompletedService->execute($paymentProcess, 'CLIPROMO_'.time().rand(10,300000), null, null, true);

        $purchase
            ->setCountryConfigured(null)
        ;

        $promoService->promoCodePurchaseCompleted($paymentProcess, $promoCode);

        $view = $this->view($purchase , Codes::HTTP_CREATED);
        $context = SerializationContext::create()->setGroups(array('Public'))->enableMaxDepthChecks();

        $view->setSerializationContext($context);

        return $this->handleView($view);
    }

    /**
     * Update a promo code
     *
     * @ApiDoc(
     *   section = "Promo Codes",
     *   output={
     *      "class"   = "AppBundle\Entity\PromoCode",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   },
     *   input="AppBundle\Form\Type\Api\PromoCodeUpdateApiType",
     *   statusCodes = {
     *     200 = "Return purchase object"
     *   }
     * )
     *
     * @Put("/promo_code/{promo_code}",requirements={"promo_code":".+?"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $promo_code
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     *
     * @return array
     */
    public function updatePromoAction(Request $request, $promo_code)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();
        $app = $appCredentials->getApp();

        $em = $this->getDoctrine()->getManager();
        if (!$promoCode = $em->getRepository("AppBundle:PromoCode")->findOneByCodeAndAppId($promo_code, $app->getId()))
            throw new BadRequestHttpException('Promo code: "'.$promo_code.'" doesn\'t exist');

        $form = $this->createForm(new PromoCodeUpdateApiType(), $promoCode, ['em' => $em, 'app' => $app]);
        $form->submit($request);

        if ($form->isValid())
        {
            $em->flush();

            $context = SerializationContext::create()->setGroups(array('Public'))->enableMaxDepthChecks();
            $view = $this->view($promoCode, Codes::HTTP_OK);
            $view->setSerializationContext($context);

            return $this->handleView($view);
        }

        return $this->handleView($this->view(['form' => $form], Codes::HTTP_BAD_REQUEST));

    }
}
