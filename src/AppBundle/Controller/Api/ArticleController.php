<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ShopOrderTypeEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\Transaction;
use AppBundle\Payment\Util\ArticleExtraCost\ArticleTempPriceService;
use AppBundle\Service\ArticleService;
use AppBundle\Traits\StopWatchTrait;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ArticleController extends AbstractAPI
{
    /**
     * @var EntityManagerInterface
     * @DI\Inject("doctrine.orm.default_entity_manager")
     */
    private $em;

    /**
     * @var ArticleTempPriceService
     * @DI\Inject("app.article_temp_price")
     */
    private $articleTempPriceService;
    
    use StopWatchTrait;

    /**
     * Get all available articles reference to transaction and country
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/article")
     * @QueryParam(name="transaction_id", description="Transaction Id", strict=true, nullable=false)
     * @QueryParam(name="country", strict=true, requirements="[A-Z]{2}", description="Country")
     * @QueryParam(name="tab_category_id", description="example single_payment || subscription")
     * @QueryParam(name="pmpc_id", nullable=true, strict=true, description="Internal use")
     *
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     *
     * @param Transaction $transaction
     * @param \AppBundle\Entity\Country $country
     * @param $tab_category_id
     * @param $pmpc_id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return array
     */
    public function getArticlesAction(Transaction $transaction, Country $country, $tab_category_id, $pmpc_id, Request $request)
    {
        $this->stopWatchStart('Verify input');
        $countryConfigured = $this->verifyValidCountry($transaction, $country);

        $appTab = $this->getAppTab($tab_category_id, $transaction);

        $this->stopWatchStop('Verify input');

        /** @var AppApiCredentials $appCredentials */
        $appCredentials=$this->getUser();
        $app=$appCredentials->getApp();

        $this->stopWatchStart('Query Articles');

        $articles = $this->em->getRepository("AppBundle:AppShopHasArticle")
            ->findByAppIdAndCountryAndLevelCategoryAndStatus(
                $app->getId(),
                $countryConfigured->getId(),
                $country->getId(),
                $transaction->getLevelCategory()->getId(),
                $appTab,
                $transaction->getFirstOffers(),
                $transaction->getArticlesAvailable()->toArray(),
                $transaction->getPayMethodsAvailable()->toArray(),
                null,
                $pmpc_id,
                $transaction->getExternalStore(),
                true
            );

        $pmpc = null;
        if ($pmpc_id && count($articles) > 0)
        {
            $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->find($pmpc_id);

            array_walk($articles, function(AppShopHasArticle $appShopHasArticle) use ($pmpc){
                $appShopHasArticle->setPayMethodProviderHasCountriesAffectCache([$pmpc]);
            });

            $articles[0]->calculateRangeValues(null, false, $transaction->getExternalStore()  );
        }


        $this->stopWatchStop('Query Articles');

        /** @var ArticleService $articleService */
        $articleService = $this->get("shop_app.article");

        $this->stopWatchStart('parseAppShopHasArticlesToVerify');

        // exchangeFromAppShopHasArticles must be first to choose right pmpcs to calculate his price
        $articleService->exchangeFromAppShopHasArticles($articles, $country);

        $articles = $articleService->parseAppShopHasArticlesToVerifyArticles($articles, $transaction->getGamer(),null,$transaction->getExternalStore());
        $this->articleTempPriceService->injectTempPrices($articles, $country);

        $this->stopWatchStop('parseAppShopHasArticlesToVerify');

        if ($pmpc)
        {
            $paymentProcessService = $this->get('shop.payment.payment_process');

            if ($smsId = $request->query->getInt('sms_id'))
            {
                if (!$sms = $this->em->getRepository("AppBundle:SMS")->find($smsId))
                    throw new BadRequestHttpException("sms invalid");
            }

            if ($voiceId = $request->query->getInt('voice_id'))
            {
                if (!$voice = $this->em->getRepository("AppBundle:Voice")->find($voiceId))
                    throw new BadRequestHttpException("voiceId invalid");
            }

            $pmpc->setCurrency($country->getCurrency());

            $sms = $voice = null;

            $paymentDetail = new PaymentDetail('');
            $paymentDetail
                ->setCurrency($country->getCurrency())
                ->setTransaction($transaction)
            ;

            foreach ($articles as $article)
            {
                if ($pmpc->hasAFixedAmount())
                {
                    $sms = $article->getSMSFromPMPC($pmpc);

                    if (!$sms)
                        $voice = $article->getVoiceFromPMPC($pmpc);
                }
                $total = 0;
                $paymentProcessService->completePaymentDetailConfiguration([$article], $paymentDetail, $pmpc, $sms, $voice, $total, $periodicity);
                $article->setTempForcePrice($total);
            }

        }

        // Calculate articles special type
        foreach ($articles as $appShopHasArticle)
        {
            $articleService->fillRemainingArticleSpecialTypeForGamer($appShopHasArticle->getArticle(), $transaction->getGamer());
        }

        $appShop = $this->getDoctrine()->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory(
            $transaction->getApp()->getId(),
            $transaction->getLevelCategory()->getId()
        );

        $articles = $articleService->orderByType($appShop->getOrderType(), $articles);

        $view = $this->view(array_values($articles), 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default', 'OfferAddOfferProgrammer', 'ArticleFull&Translations','AppShopHasAppTabs&Tab','Public')));

        return $this->handleView($view);
    }

    /**
     * Get all available articles reference to country
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Check if you have a shop with that level for that country"
     *   }
     * )
     *
     * @Get("/articles/country/{country}")
     *
     * @QueryParam(name="currency", nullable=true, description="Currency")
     * @QueryParam(name="gamer_id", nullable=true, description="Gamer Id")
     * @QueryParam(name="gamer_level", requirements="\d+", default="5", description="Gamer level from your game")
     * @QueryParam(name="pay_method_id", requirements="\d+", description="Pay Method Id")
     * @QueryParam(name="item_id", requirements="\d+", description="Item Id")
     * @QueryParam(name="article_id", description="Article Id")
     * @QueryParam(name="order_type", nullable=true, description="Order by (by_price_asc|by_price_desc)", requirements="(by_price_asc|by_price_desc)", strict=true)
     * @QueryParam(name="is_external_store", description="Filter by only articles valid by external stores")
     * @QueryParam(name="include_free", description="include -or not- free articles. False by default", nullable=true)
     *
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     *
     * @param \AppBundle\Entity\Country $country
     * @param null $currency
     * @param null $gamer_id
     * @param int $gamer_level
     * @param null $pay_method_id
     * @param null $item_id
     * @param null $article_id
     * @param bool $is_external_store
     * @param string $order_type
     * @param bool $include_free
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return array
     */
    public function getArticlesByCountryAction(
        Country $country,
        $currency = null,
        $gamer_id = null,
        $gamer_level,
        $pay_method_id = null,
        $item_id = null,
        $article_id = null,
        $is_external_store = false,
        $order_type = ShopOrderTypeEnum::ORDER_BY_DATABASE_VALUES
        ,$include_free=false
    )
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials=$this->getUser();
        $app=$appCredentials->getApp();
        $gamer = $appShop = null;

        $countryService = $this->get('country');

        if (!$appShop = $this->getDoctrine()->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelGamer($appCredentials->getApp()->getId(), $gamer_level))
            throw new BadRequestHttpException("Unknown gamer level");

        if ($currency)
        {
            if (!$currency = $this->getDoctrine()->getRepository("AppBundle:Currency")->find($currency))
                throw new BadRequestHttpException("Currency is not valid");
        }

        if ($gamer_id)
        {
            $gamer = $this->getDoctrine()->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($appCredentials->getApp()->getId(), $gamer_id);
        }

        if ($pay_method_id)
        {
            if (!$payMethod = $this->getDoctrine()->getRepository("AppBundle:PayMethod")->find($pay_method_id))
                throw new BadRequestHttpException("Unknown payMethod");
        }

        if ($item_id)
        {
            if (!$payMethod = $this->getDoctrine()->getRepository("AppBundle:Item")->findOneByIdAndAppId($item_id, $app->getId()))
                throw new BadRequestHttpException("Unknown ItemId");
        }

        if ($article_id)
        {
            if (!$article = $this->getDoctrine()->getRepository("AppBundle:Article")->findOneByIdAndActiveAndApp($article_id,$app->getId()))
                throw new BadRequestHttpException("Unknown ArticleId");
        }

        if (!$countryConfigured = $countryService->getCountryConfiguredAndCloserFromApp($app, [$appShop->getLevelCategory()], $country))
        {
            throw new BadRequestHttpException("This country is invalid");
        }

        $articles = $this->getDoctrine()->getRepository("AppBundle:AppShopHasArticle")
            ->findByAppIdAndCountryAndLevelCategoryAndStatus(
                $appCredentials->getApp()->getId(),
                $countryConfigured->getId(),
                $country->getId(),
                $appShop->getLevelCategory()->getId(),
                null,
                true,
                ($article_id ? [$article_id] : null),
                ($pay_method_id ? [$pay_method_id] : null),
                $item_id
                ,null,null,true,true,$include_free
            );

        /** @var ArticleService $articleService */
        $articleService = $this->get("shop_app.article");

        // exchangeFromAppShopHasArticles must be first to choose right pmpcs to calculate his price
        $articleService->exchangeFromAppShopHasArticles($articles, $country);

        $articles = $articleService->parseAppShopHasArticlesToVerifyArticles($articles, $gamer, null, null, $include_free);
        $this->articleTempPriceService->injectTempPrices($articles, $country);

        if ($is_external_store)
            $articles = $articleService->filterToExternalStores($articles);

        $articles = $articleService->orderByType($order_type, $articles);

        $view = $this->view($articles);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Public', 'ArticleFull&Translations', 'ArticleFull')));

        return $this->handleView($view);
    }

    /**
     * @Get("/calculate_price_cart/{transaction_id}/{country}/{articles_ids}")
     *
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function getCalculatePriceShoppingCartAction($articles_ids, Country $country, Transaction $transaction, Request $request)
    {
        $countryConfigured = $this->verifyValidCountry($transaction, $country);

        /** @var AppShopHasArticle[] $appShopHasArticles */
        $appShopHasArticles = [];
        foreach (explode(',', $articles_ids) as $article_id)
        {
            $article_id = trim($article_id);
            $appShopHasArticles []= $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdWithGamerLevel($countryConfigured->getId(), $article_id, $transaction->getValueCurrent());
        }

        if (!$appShopHasArticles)
            throw new BadRequestHttpException('invalid article ids');

        $paymentDetail = new PaymentDetail('');
        $paymentDetail
            ->setCurrency($country->getCurrency())
            ->setTransaction($transaction)
        ;

        $paymentProcessService = $this->get('shop.payment.payment_process');
        $total = $totalEur = 0;
        $sms = $voice = null;


        if ($pmpcId = $request->query->getInt('pmpc_id'))
        {
            if (!$pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->find($pmpcId))
                throw new BadRequestHttpException("pmpc not found");

            if ($smsId = $request->query->getInt('sms_id'))
            {
                if (!$sms = $this->em->getRepository("AppBundle:SMS")->find($smsId))
                    throw new BadRequestHttpException("sms invalid");
            }

            if ($voiceId = $request->query->getInt('voice_id'))
            {
                if (!$voice = $this->em->getRepository("AppBundle:Voice")->find($voiceId))
                    throw new BadRequestHttpException("voiceId invalid");
            }

            if (!$pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->find($pmpcId))
                throw new BadRequestHttpException("pmpc not found");

            $pmpc->setCurrency($country->getCurrency());

            if (count($appShopHasArticles) == 1 && $pmpc->hasAFixedAmount())
            {
                $appShopHasArticle = $appShopHasArticles[0];

                $sms = $appShopHasArticle->getSMSFromPMPC($pmpc);

                if (!$sms)
                    $voice = $appShopHasArticle->getVoiceFromPMPC($pmpc);
            }
            $periodicity=null;
            $paymentProcessService->completePaymentDetailConfiguration($appShopHasArticles, $paymentDetail, $pmpc, $sms, $voice, $total, $periodicity,false, $totalEur);

        }else{

            if (count($appShopHasArticles) == 1 && !$appShopHasArticles[0]->getAmount())
            {
                $appShopHasArticle = $appShopHasArticles[0];

                if (!$appShopHasArticle->getSMSs()->isEmpty())
                {
                    $sms = $appShopHasArticle->getSMSs()[0];
                }

                if (!$sms && !$appShopHasArticle->getVoices()->isEmpty())
                {
                    if (!$appShopHasArticle->getVoices()->isEmpty())
                    {
                        $voice = $appShopHasArticle->getVoices()[0];
                    }
                }
            }

            if (!$sms && !$voice)
            {
                $paymentProcessService->completePaymentDetailConfigurationWithBasicPayMethod($appShopHasArticles, $paymentDetail, $country, $total,$periodicity,$totalEur);
            }elseif ($sms){
                $paymentProcessService->completePaymentDetailConfiguration($appShopHasArticles, $paymentDetail, $sms->getPayMethodProviderHasCountry(), $sms, null, $total, $periodicity,false,$totalEur);
            }elseif ($voice){
                $paymentProcessService->completePaymentDetailConfiguration($appShopHasArticles, $paymentDetail, $voice->getPayMethodProviderHasCountry(), null, $voice, $total, $periodicity,false,$totalEur);
            }
        }

        $paymentDetail->setAmount($total);
        $paymentDetail->setAmountEur($totalEur);

        $view = $this->view($paymentDetail, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('CartPrice', 'ArticleOnlyId', 'CurrencyStandard', 'ArticleOnlyName', 'LexikKey')));

        return $this->handleView($view);
    }

}
