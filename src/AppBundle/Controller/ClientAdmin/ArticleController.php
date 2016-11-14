<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\AppTab;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleGachaHasArticle;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\ArticleSpecialTypeEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Item;
use AppBundle\Exception\NviaException;
use AppBundle\Helper\StatsHelper;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\AppShopHasArticleService;
use AppBundle\Service\CountryService;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\TranslateHelperService;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Constraints\Country;

/**
 * @Route("/api")
 */
class ArticleController extends Controller
{
    use SonataMedia;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Serializer
     * @Inject("jms_serializer")
     */
    public $serializer;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
     * @var CountryService
     * @Inject("country")
     */
    public $countryService;

    /**
     * @var OfferCommand
     * @Inject("command.shop.offer.sync")
     */
    public $offerCommand;

    /**
     * @var AppShopHasArticleService
     * @Inject("app_shop_has_article")
     */
    public $appShopHasArticleService;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @Route("/article/simple/{app}", name="admin_articles_by_filters")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articlesSimpleByAppIdAction(Request $request, App $app)
    {
        $articles = $this->em->getRepository("AppBundle:Article")->findByTabIdAndLevelCategoryFilters(
                $app->getId(),
                $request->get('app_tab_name_unique'),
                $request->get('app_tab_id'),
                $request->get('level_category_id'),
                $request->get('country'),
                $request->get('article_category_id'),
                $request->get('article_special_type')
            );

        $context = SerializationContext::create()->setGroups(array('Default', 'ArticleOnlyName', 'allTranslations'));
        return new Response($this->serializer->serialize($articles, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/article/app/{app}", name="admin_articles_by_app")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articlesByAppIdAction(Request $request, App $app)
    {
        $groups = array('Admin','ArticleFull', 'AppShopHasArticleFull', 'ArticleFull&Translations', 'allTranslations');

        if ($request->get('pmpc'))
        {
            // not iterate because time exceed....
            $groups[]= 'AppShopArticleHasPMPCFull&PMPC';
            $groups[]= 'AppShopCountryFull';
            $groups[]= 'Continent';

            $params = [
                'appId' => $app->getId(),
                'countryId' => $request->get('country')
            ];

            $iterableResult = $this->em
                ->createQuery("
                    SELECT a, asha, i, o, aLabel, aTrans, sms, voice
                    FROM AppBundle:Article a
                    JOIN a.item i
                    JOIN a.appShopHasArticles asha
                    LEFT JOIN asha.SMSs sms
                    LEFT JOIN asha.voices voice

                    LEFT JOIN asha.offer o

                    LEFT JOIN a.nameLabel aLabel
                    LEFT JOIN aLabel.translations aTrans

                    WHERE
                        a.app = :appId
                        AND asha.country = :countryId
                        AND a.active = true
                        AND i.active = true
                        AND asha.active = true

                    ORDER BY i.id, a.itemsQuantity
        ")
            ->setParameters($params)
            ->getResult();

        }else if ($request->get('active')){

            $params = ['appId' => $app->getId()];
            $extra = '';
            if ($request->get('country'))
            {
                $params['country'] = $request->get('country');
                $extra.=' AND asha.country = :country ';
            }

            $groups[]= 'ItemFull';
            $groups[]= 'AppShopCountryFull';

            $iterableResult = $this->em
                ->createQuery("

                    SELECT a, asha, o, aLabel, aTrans
                    FROM AppBundle:Article a
                    JOIN a.app app
                    JOIN a.item i
                    JOIN a.appShopHasArticles asha

                    LEFT JOIN asha.offer o

                    LEFT JOIN a.nameLabel aLabel
                    LEFT JOIN aLabel.translations aTrans


                    WHERE
                        a.app = :appId
                        $extra

                        AND a.active = true
                        AND i.active = true
                        AND asha.active = true

                  ORDER BY i.id, a.itemsQuantity

               ")
                ->setParameters($params)
                ->getResult();

        }else if($request->get('app_shop_has_article_filtered')){
            $iterableResult = $this->em
                ->createQuery("
                    SELECT a, asha, ashop, l
                    FROM AppBundle:Article a
                    LEFT JOIN a.appShopHasArticles asha
                    LEFT JOIN asha.appShop ashop
                    LEFT JOIN ashop.levelCategory l
                    JOIN a.app app
                    JOIN a.item i
                    WHERE
                        app = :appId
                        AND a.active = true
                        AND i.active = true

                    GROUP BY a.id, l.id
                    ORDER BY i.id, a.itemsQuantity
                ")
                ->setParameters(array('appId' => $app->getId()))
                ->getResult();

        }else{

            $iterableResult = $this->em
                ->createQuery("
                    SELECT a
                    FROM AppBundle:Article a
                    JOIN a.app app
                    JOIN a.item i
                    WHERE
                        app = :appId
                        AND a.active = true
                        AND i.active = true
                    ORDER BY i.id, a.itemsQuantity
                ")
                ->setParameters(array('appId' => $app->getId()))
                ->getResult();
        }

        //create manually json, because JMSSerializer is too slow with big data

        $articlesSerialize = [];
        foreach ($iterableResult as $article)
        {
            /** @var Article $article */
            $articleSerialize = [
                "id" => $article->getId(),
                "amount_standard"=> $article->getAmountStandard(),
                "items_quantity"=>  $article->getItemsQuantity(),
                "name_label" =>  $this->getTranslationJsonString($app, $article->getNameCurrentLabel()),
                "article_category"=> ["id" => $article->getArticleCategory()->getId()],
                "app_shop_has_articles" => [],
                "periodicity" => $article->getPeriodicity()
            ];

            if (in_array('ItemFull', $groups))
            {
                $country = $article->getItem()->getUnitaryPriceCountry() ?: $app->getClient()->getCountry();

                $articleSerialize["item"] = [
                    "unitary_price_country" => [
                        "id"       => $country->getId(),
                        "name"     => $country->getName(),
                        "currency" => [
                            "symbol" => $country->getCurrency()->getSymbol()
                        ]
                    ]
                ];
            }

            foreach ($article->getAppShopHasArticles() as $appShopHasArticle)
            {
                if ($request->get('active'))
                {
                    if (!$appShopHasArticle->getActive() || in_array($appShopHasArticle->getId(), UtilHelper::getIdsArrayFromObjects($app->getCountries()) ))
                    {
                        continue;
                    }
                }

                $country = $appShopHasArticle->getCountry();

                $appShopHasArticleSerialize = [
                        "id" => $appShopHasArticle->getId(),
                        "amount" =>$appShopHasArticle->getAmount(),
                        "active" => ($appShopHasArticle->getActive() ? 1 : 0),
                        "app_shop"=> [ "active"=>($appShopHasArticle->getActive() ?: 0), "level_category"=> ["id"=> $appShopHasArticle->getAppShop()->getLevelCategory()->getId()]],
                        "current_amount_without_offer"=> $appShopHasArticle->getCurrentAmountWithoutOffer(),
                        "virtual_currency_amount" => $appShopHasArticle->getVirtualCurrencyAmount(),
                        "order" => $appShopHasArticle->getOrder(),
                ];

                if (in_array('AppShopCountryFull', $groups))
                {
                    $appShopHasArticleSerialize["country"] = [
                        "id"       => $country->getId(),
                        "name"     => $country->getName(),
                        "currency" => [
                            "symbol" => $country->getCurrency()->getSymbol()
                        ]
                    ];

                    if (in_array('Continent', $groups))
                    {
                        $appShopHasArticleSerialize["country"]['continent']= [
                            "id" => $country->getContinent()->getId()
                        ];
                    }
                }

                if (in_array('AppShopArticleHasPMPCFull&PMPC', $groups))
                {
                    $appShopHasArticlePMPCSerializeCurrent= [];

                    foreach ($appShopHasArticle->getSMSs() as $sms)
                    {
                        $appShopHasArticlePMPCSerializeCurrent[] = ['id' => $sms->getId()];
                        $this->em->detach($sms);
                    }

                    $appShopHasArticleSerialize['_s_m_ss'] = $appShopHasArticlePMPCSerializeCurrent;
                    $appShopHasArticlePMPCSerializeCurrent= [];

                    foreach ($appShopHasArticle->getVoices() as $voice)
                    {
                        $appShopHasArticlePMPCSerializeCurrent[] = ['id' => $voice->getId()];
                        $this->em->detach($voice);
                    }

                    $appShopHasArticleSerialize['voices'] = $appShopHasArticlePMPCSerializeCurrent;
                }


                $articleSerialize['app_shop_has_articles'][] = $appShopHasArticleSerialize;
            }

            $articlesSerialize[]= $articleSerialize;
            $this->em->detach($article);
        }

        return new JsonResponse($articlesSerialize, 200, ['Content-Type' => 'application/json']);
    }

    private function getTranslationJsonString(App $app, TransUnit $obj = null)
    {
        if (!$obj)
            return null;

        $result =[];

        foreach ($app->getLanguages() as $language)
        {
            if ($obj->hasTranslation($language->getId()))
                $result ["translation_".$language->getId()] = $obj->getTranslation($language->getId())->getContent();
        }

        return $result;
    }

    /**
     * @Route("/app/{app}/article_gacha/", name="admin_article_gacha_create", methods={"POST"})
     * @Route("/app/{app}/article_gacha/{article_id}", name="admin_article_gacha_update", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function createOrUpdateArticleGacha(App $app, Request $request, $article_id = null)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($request->get('possible_article_0') === null)
        {
            throw new BadRequestHttpException('possible articles are required');
        }

        if ($article_id)
        {
            /** @var Article article */
            if (!$article = $this->em->getRepository("AppBundle:Article")->find($article_id))
                throw new BadRequestHttpException('article not found');

            if ($article->getApp()->getId() !== $app->getId() || !$article->getSpecialType() || $article->getSpecialType()->getId() != ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX)
                throw new AccessDeniedException('invalid article');
        }else{

            $item = $this->em->getRepository("AppBundle:Item")->find($request->get('item_id'));

            if (!$item)
                throw new NviaException('item with gacha NOT FOUND');

            if ($item->getApp()->getId() !== $app->getId() || $item->getSpecialType()->getId() != ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX)
                throw new AccessDeniedException('invalid article');

            $article = new Article();
            $article
                ->setApp($app)
                ->setItem($item)
                ->setItemsQuantity(1)
                ->setArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID))
            ;
        }

        /** @var TranslateHelperService $translateHelper */
        $translateHelper = $this->get('app.translate_helper');

        $translateHelper->setLabelArticleFromRequest($request, $article, 'name_label_translation_', 'name_label', 'article.title.');
        $translateHelper->setLabelArticleFromRequest($request, $article, 'description_label_translation_', 'description_label', 'article.description.');
        $translateHelper->setLabelArticleFromRequest($request, $article, 'description_short_label_translation_', 'description_short_label', 'article.description_short.');

        $article
            ->setAmountStandard($request->get('amount_standard'))
            ->setArticlesGacha([])
            ->setNPurchasesTotal( UtilHelper::is0GetNull( $request->get("n_purchases_total")))
            ->setShowWhenStockUnderN($request->get("show_when_stock_under_n", 0))
            ->setNPurchasesPerClient( UtilHelper::is0GetNull( $request->get("n_purchases_per_client")))
        ;

        if ($request->get("file_deleted") && $article->getImage())
        {
            $article->setImage(null);
            $this->sonataRemoveImage($article->getImage());

        }else if ($request->files->get("file")){
            /** @var UploadedFile $file */
            $file = $request->files->get("file");

            if ($file->getSize() > 200000)
                return new JsonResponse(['message'=>'image_size_exceed', 400]);

            if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                return new JsonResponse(['message'=>'image_invalid_format', 400]);

            $oldImage= $article->getImage();
            $media = $this->sonataCreateMediaImageFromUploadedFile($file, Article::SONATA_CONTEXT);
            $article->setImage($media);
            $this->sonataRemoveImage($oldImage);
        }

        if ($validFrom = $request->get("valid_from"))
        {
            $article->setValidFrom(new \DateTime($validFrom));
        }else{
            $article->setValidFrom(null);
        }

        if ($validTo = $request->get("valid_to"))
        {

            $article->setValidTo(new \DateTime($validTo));
        }else{
            $article->setValidTo(null);
        }

        if ($request->get('hours_to_reset_gacha'))
            $article->setHoursToResetGacha($request->get('hours_to_reset_gacha'));
        else
            $article->setHoursToResetGacha(null);

        $article->setArticlesGacha([]);

        $this->em->persist($article);
        $this->em->flush();

        for ($i=0; $i<=100; $i++)
        {
            if ($request->get('possible_article_'.$i) === null)
                break;

            if (!$possibleArticle = $this->em->getRepository("AppBundle:Article")->find($request->get('possible_article_'.$i)))
                throw new BadRequestHttpException("Not found possible article");

            if ($possibleArticle->getApp()->getId() !== $app->getId())
                throw new AccessDeniedException('invalid possible article');

            $articleGachaHasArticle =  new ArticleGachaHasArticle($article);
            $articleGachaHasArticle
                ->setPossibleArticle($possibleArticle)
                ->setOrder($i+1)
                ->setAmountToGive($request->get('amount_to_give_'.$i))
                ->setBestArticle($request->get('best_article_'.$i))
            ;
            $this->em->persist($articleGachaHasArticle);
        }
        $this->em->flush();

        return new JsonResponse(['id' => $article->getId()]);
    }

    /**
     * @Route("/app/{app}/article/{article_id}", name="admin_articles_delete", methods={"DELETE"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "article_id"})
     */
    public function deleteArticleAction(App $app, Article $article, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($article->getApp()->getId() !== $app->getId())
            throw $this->createAccessDeniedException();

        $article->setActive(false);
        $this->em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/article/sync/special_pay_methods/app/{app}", name="admin_articles_sync_special_pay_methods", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articleSyncSpecialPayMethodsAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $articlesPost = $request->get('articles');

        foreach ($articlesPost as $articlePost)
        {
            if (!$article = $this->em->getRepository("AppBundle:Article")->find($articlePost['id']))
                continue;

            if ($article->getApp()->getId() != $app->getId())
                $this->createAccessDeniedException();

            foreach ($articlePost['app_shop_has_articles'] as $appShopHasArticlesPost)
            {
                $smsSelecteds = StatsHelper::ifExistKeyPrefix($appShopHasArticlesPost, 'selected_sms');
                $voiceSelecteds = StatsHelper::ifExistKeyPrefix($appShopHasArticlesPost, 'selected_voice');

                if (!$smsSelecteds && !$voiceSelecteds )
                    continue;

                $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->find($appShopHasArticlesPost['id']);

                if ($appShopHasArticle->getArticle()->getApp()->getId() != $app->getId())
                    $this->createAccessDeniedException();

                foreach ($smsSelecteds as $smsSelected)
                {
                    if ($appShopHasArticlesPost[$smsSelected]!=true) // deselected
                        continue;

                    $id = substr($smsSelected, strlen('selected_sms_'));

                    if (!$sms = $this->em->getRepository("AppBundle:SMS")->find($id))
                        continue;

                    $appShopHasArticle->addSMS($sms);
                }

                foreach ($voiceSelecteds as $voiceSelected)
                {
                    if ($appShopHasArticlesPost[$voiceSelected]!=true) // deselected
                        continue;

                    $id = substr($voiceSelected, strlen('selected_voice_'));

                    if (!$voice = $this->em->getRepository("AppBundle:Voice")->find($id))
                        continue;

                    $appShopHasArticle->addVoice($voice);
                }
            }
        }

        $this->em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/article/sync/prices/app/{app}", name="admin_articles_sync_prices", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articleSyncPricesAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $articlesPost = $request->get('articles');
        $offersProgrammerAffected = [];

        foreach ($articlesPost as $articlePost)
        {
            if (!$article = $this->em->getRepository("AppBundle:Article")->find($articlePost['id']))
                continue;

            if ($article->getArticleCategory()->getId() == ArticleCategoryEnum::FREE_PAYMENT_ID)
                continue;

            if ($article->getApp()->getId() != $app->getId())
                $this->createAccessDeniedException();

            $article->setAmountStandard($articlePost['amount_standard']);

            foreach ($articlePost['app_shop_has_articles'] as $appShopHasArticlesPost)
            {
                if (isset($appShopHasArticlesPost['id']))
                    $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->find($appShopHasArticlesPost['id']);
                else{

                    $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdAndLevelCategory(
                        $appShopHasArticlesPost['country']['id'],
                        $article->getId(),
                        $appShopHasArticlesPost['app_shop']['level_category']['id']
                    );

                    if (!$appShopHasArticles)
                        continue;
                }

                if (!$appShopHasArticles)
                    throw new BadRequestHttpException('not found appShopHasArticle '.print_r($appShopHasArticlesPost, true));


                if ($appShopHasArticles->getArticle()->getApp()->getId() != $app->getId())
                    $this->createAccessDeniedException();

                if (!$appShopHasArticles->getActive())
                    continue;

                if (!isset($appShopHasArticlesPost['current_amount_without_offer']) || !$appShopHasArticlesPost['current_amount_without_offer'])
                {
                    $appShopHasArticles
                        ->setActive(true)
                        ->setAmount(0)
                    ;
                }else{
                    $appShopHasArticles
                        ->setActive(true)
                        ->setAmount($appShopHasArticlesPost['current_amount_without_offer'])
                    ;

                    if ($appShopHasArticles->getOffer())
                    {
                        if( !in_array($appShopHasArticles->getOffer()->getOfferProgrammer(), $offersProgrammerAffected))
                            $offersProgrammerAffected[] = $appShopHasArticles->getOffer()->getOfferProgrammer();
                    }

                }

                if ($app->hasVirtualCurrencyEnabled() && isset($appShopHasArticlesPost['virtual_currency_amount']))
                {
                    $appShopHasArticles->setVirtualCurrencyAmount($appShopHasArticlesPost['virtual_currency_amount']);
                }else{
                    $appShopHasArticles->setVirtualCurrencyAmount(null);
                }
            }

        }

        $this->em->flush();

        if ($offersProgrammerAffected)
            $this->offerCommand->reconfigureAllOffersByOfferProgrammers($offersProgrammerAffected);

        return new JsonResponse();
    }

    /**
     * @Route("/article/sync/shops/app/{app}", name="admin_articles_sync_shops", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articleSyncShopsAction(App $app, Request $request)
    {
//        $time = time();

        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $levelsPost = $request->get('categories');
        $this->em->getRepository("AppBundle:AppShopHasAppTab")->deleteByAppId($app->getId());

        $appTabsPresent = new \Doctrine\Common\Collections\ArrayCollection();
//        echo "CONFIGURE TABS".(time()-$time);
        foreach ($levelsPost as $lvlPost)
        {
            $shop = $app->getappShopByLevelCategory($lvlPost['id']);

            if ($shop)
                $shop->setActive((isset($lvlPost['selected']) && $lvlPost['selected']));

            if (isset($lvlPost['selected']) && $lvlPost['selected'])
            {
                if (!$shop)
                {
                    $shop = new AppShop();
                    $shop
                        ->setApp($app)
                        ->setLevelCategory($this->em->getRepository("AppBundle:LevelCategory")->find($lvlPost['id']))
                        ->setName($shop->getLevelCategory()->getName())
                    ;
                    $app->addAppShop($shop);
                    $this->em->persist($shop);
                }

                $shop
                    ->setValueLower($lvlPost['value_lower'])
                    ->setValueHigher($lvlPost['value_higher'])
                    ->setCss($this->em->getRepository("AppBundle:ShopCss")->find($lvlPost['css']['id']))
                ;

                $this->em->flush();

                $levelCategoryId = $shop->getLevelCategory()->getId();
                $appTabsOrder = 0;
                foreach ($lvlPost['app_shop_has_app_tabs'] as $appShopHasAppTabsPost)
                {
                    $appTabPost = $appShopHasAppTabsPost['app_tab'];

                    $temp = new AppTab();
                    $temp->setName($appTabPost['name']);

                    if (isset($appTabPost['id']) && $appTabPost['id'])
                        $appTab = $this->em->getRepository("AppBundle:AppTab")->find($appTabPost['id']);
                    else
                        $appTab = $this->em->getRepository("AppBundle:AppTab")->findOneByAppIdAndNameUnique($app->getId(), $temp->getNameUnique());

                    if (!$appTab)
                    {
                        $appTab = new AppTab();
                        $appTab->setApp($app);
                    }

                    if (!$appTabsPresent->contains($appTab))
                    {
                        $appTabsPresent->add($appTab);

                        $appTab
                            ->setActive(true)
                            ->setArticleCategory([]);

                        if (isset($appTabPost['article_categories']))
                        {
                            foreach ($appTabPost['article_categories'] as $articleCategoryPost)
                            {
                                $appTab->addArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find($articleCategoryPost['id']));
                            }
                        }

                        $appTab->setPayCategories([]);
                        if (isset($appTabPost['pay_categories']))
                        {
                            foreach ($appTabPost['pay_categories'] as $payCategoryPost)
                            {
                                $appTab->addPayCategory($this->em->getRepository("AppBundle:PayCategory")->find($payCategoryPost['id']));
                            }
                        }


                        $appTab
                            ->setName($appTabPost['name'])
                            ->setOrder($appTabsOrder++)
                        ;


                        $appTab->setNameLabel(
                            $this->translationChange(
                                isset($appTabPost['name_label']) ? $appTabPost['name_label'] : null,
                                $appTab->getNameLabel(),
                                $app
                            )
                        );

                        $appTab->setDescriptionLabel(
                            $this->translationChange(
                                isset($appTabPost['description_label']) ? $appTabPost['description_label'] : null,
                                $appTab->getDescriptionLabel(),
                                $app
                            )
                        );

                        $this->em->persist($appTab);
                        $this->em->flush();
                    }

                    $appShopHasAppTab = new AppShopHasAppTab();

                    $appShopHasAppTab
                        ->setAppShop($shop)
                        ->setAppTab($appTab)
                    ;

                    $this->em->persist($appShopHasAppTab);
                    $this->em->flush();

                    $appShopHasAppTab->setArticle([]);

                    foreach ($appShopHasAppTabsPost['articles'] as $articlePost)
                    {
                        if (isset($articlePost['selected_'.$levelCategoryId]) && $articlePost['selected_'.$levelCategoryId])
                        {
                            if (!$article = $this->em->getRepository("AppBundle:Article")->find($articlePost['id']))
                                continue;

                            if ($article->getApp()->getId() != $app->getId())
                                $this->createAccessDeniedException();

                            // remove all by default
                            if ($article->getActive() !== true)
                                $article->setActive(null);

                            $appShopHasAppTab->addArticle($article);
                        }
                    }
                }
            }
        }

        $appTabs = $this->em->getRepository("AppBundle:AppTab")->findByAppId($app->getId(), null);
        foreach ($appTabs as $appTab)
        {
            if (!$appTabsPresent->contains($appTab))
            {
                if ($appTab->getNameLabel() && $appTab->getNameLabel()->getDomain() == $app->getTranslationDomain())
                    $this->em->remove($appTab->getNameLabel());

                if ($appTab->getDescriptionLabel() && $appTab->getDescriptionLabel()->getDomain() == $app->getTranslationDomain())
                    $this->em->remove($appTab->getNameLabel());

                if ($appTab->getImage())
                    $this->em->remove($appTab->getImage());

                $this->em->remove($appTab);
            }
        }

        $this->em->flush();
//        echo "\nEND CONFIGURE TABS".(time()-$time);

        $this->appShopHasArticleService->syncAllAppShopHasArticlesWithAppTabIfEnabled($app);
        $this->em->clear();

//        echo "\nTABS AFTER".(time()-$time);

        $this->em->getConnection()->executeUpdate("
            UPDATE
                app_shop_has_articles asha
                INNER JOIN article a ON (a.id = asha.article_id)
            SET
                asha.order = :order
            WHERE
                a.app_id = :appId

                        ", ['appId' => $app->getId(), 'order' => 9999])
        ;
        // set order of articles
//        echo "\n BEFORE ORDER".(time()-$time);

        foreach ($levelsPost as $lvlPost)
        {
            if (isset($lvlPost['selected']) && $lvlPost['selected'])
            {
                $shop = $app->getappShopByLevelCategory($lvlPost['id']);
                $levelCategoryId = $shop->getLevelCategory()->getId();
                foreach ($lvlPost['app_shop_has_app_tabs'] as $appShopHasAppTabsPost)
                {
                    $order = 0;
                    foreach ($appShopHasAppTabsPost['articles'] as $articlePost)
                    {
                        if (isset($articlePost['selected_'.$levelCategoryId]) && $articlePost['selected_'.$levelCategoryId] )
                        {
                            $this->em->getConnection()->executeUpdate("
                            UPDATE
                                app_shop_has_articles asha
                                INNER JOIN article a ON (a.id = asha.article_id)
                            SET
                                asha.order = :order
                            WHERE
                                asha.app_shop_id = :appShopId
                                AND asha.article_id = :articleId
                                AND a.app_id = :appId

                        ", ['appShopId' => $shop->getId(), 'articleId' => $articlePost['id'], 'appId' => $app->getId(), 'order' => ++$order])
                            ;
                        }
                    }
                }
            }
        }

        return new JsonResponse();
    }

    private function translationChange($post, \Lexik\Bundle\TranslationBundle\Entity\TransUnit $translationLabel= null, App $app)
    {
        $transLexik = $this->get('lexik_translation.trans_unit.manager');

        if (!$post)
        {
            if ($translationLabel && $translationLabel->getDomain() == $app->getTranslationDomain())
                $this->em->remove($translationLabel);

            return null;
        }

        foreach ($app->getLanguages() as $language)
        {
            $message =  isset($post['translation_'.$language->getId()]) ? $post['translation_'.$language->getId()] : '';

            // verify modified
            if ($translationLabel && $translationLabel->getTranslation($language->getId()) !== $message || !$translationLabel)
            {
                if (!$translationLabel || $translationLabel->getDomain() !== $app->getTranslationDomain())
                {
                    // create new lexiktrans
                    $translationLabel = $transLexik->create('app_tab.'.uniqid(),  $app->getTranslationDomain());
                }

                if ($translationLabel->hasTranslation($language->getId()))
                {
                    $transLexik->updateTranslation($translationLabel, $language->getId(), $message);
                }else{
                    $transLexik->addTranslation($translationLabel, $language->getId(), $message);
                }
            }
        }

        return $translationLabel;
    }


    /**
     * @Route("/article/{app}/{shops_ids}/{countries_ids}/{_locale}", name="admin_articles")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function articleByAppAndShopsAndCountriesAction(App $app, $shops_ids, $countries_ids)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var AppShop[] $appShops */
        $appShops = UtilHelper::getObjectsFromCSV($shops_ids, "AppBundle:AppShop", $this->em);
        /** @var Country[] $countries */
        $countries = UtilHelper::getObjectsFromCSV($countries_ids, "AppBundle:Country", $this->em);

        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndCountriesAndAppShops(
            $app->getId(),
            UtilHelper::getIdsArrayFromObjects($countries),
            UtilHelper::getIdsArrayFromObjects($appShops)
        );

        $context = SerializationContext::create()->setGroups(array('ArticleFull', 'ArticleFull&Translations', 'allTranslations'));

        return new Response($this->serializer->serialize($articles, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }




    /**
     * Step 4 Articles
     * @Route("/article/sync_amounts/{item_id}", name="admin_articles_sync")
     * @ParamConverter("item", class="AppBundle:Item", options={"id" = "item_id"})
     */
    public function articleSyncAmountsAction(Item $item=null, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($item->getApp())))
            throw $this->createAccessDeniedException();

        $app = $item->getApp();

        $olArticles = $item->getArticles();

        foreach ($olArticles as $article)
            $article->setActive(false);

        for ($index=0;$index<200;$index++)
        {
            if (!$request->get("items_quantity_$index"))
                break;

            if ($request->get("id_$index"))
                $article = $this->em->getRepository("AppBundle:Article")->find($request->get("id_$index"));
            else
                $article = new Article();

            if ($app->getId() !== $item->getApp()->getId())
            {
                $this->logger->addError("Trying to update other article from other app");
                continue;
            }

            $article
                ->setApp($app)
                ->setItemsQuantity($request->get("items_quantity_$index"))
                ->setArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find($request->get("type_$index")))
                ->setItem($item)
                ->setActive(true)
                ->setAmountStandard($request->get("amount_standard_$index"))
            ;

            if ($article->getArticleCategory()->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
                $article->setPeriodicity($request->get("periodicity_$index"));
            else
                $article->setPeriodicity(null);


            /** @var TranslateHelperService $translateHelper */
            $translateHelper = $this->get('app.translate_helper');

            $translateHelper->setLabelArticleFromRequest($request, $article, 'name_label_original_'.$index.'_', 'name_label', 'article.title.');
            $translateHelper->setLabelArticleFromRequest($request, $article, 'description_label_original_'.$index.'_', 'description_label', 'article.description.');
            $translateHelper->setLabelArticleFromRequest($request, $article, 'description_short_label_original_'.$index.'_', 'description_short_label', 'article.description_short.');

            if ($validFrom = $request->get("valid_from_$index"))
            {
                $article->setValidFrom(new \DateTime($validFrom));
            }else{
                $article->setValidFrom(null);
            }

            if ($validTo = $request->get("valid_to_$index"))
            {
                $article->setValidTo(new \DateTime($validTo));
            }else{
                $article->setValidTo(null);
            }

            $article
                ->setNPurchasesTotal( UtilHelper::is0GetNull( $request->get("n_purchases_total_$index")))
                ->setShowWhenStockUnderN($request->get("show_when_stock_under_n_$index", 0))
                ->setNPurchasesPerClient( UtilHelper::is0GetNull( $request->get("n_purchases_per_client_$index")))
                ->setArticlesExtra([])
                ->setExternalArticleId($request->get("external_article_id_$index"))
            ;

            if ($articlesExtraIdsCsv = $request->get("articles_extra_$index"))
            {
                $articlesExtraIds = explode(',', $articlesExtraIdsCsv);

                foreach ($articlesExtraIds as $articlesExtraId)
                {
                    $articleExtra = $this->em->getRepository("AppBundle:Article")->find($articlesExtraId);
                    if ($article->getApp()->getId() !== $app->getId())
                    {
                        $this->logger->addError("Trying to update other article from other app");
                        continue;
                    }

                    $article->addArticlesExtra($articleExtra);
                }
            }

            if ($request->get("file_deleted_$index") && $article->getImage())
            {
                $article->setImage(null);
                $this->sonataRemoveImage($article->getImage());


            }else if ($request->files->get("file_$index")){
                /** @var UploadedFile $file */
                $file = $request->files->get("file_$index");
                if ($file->getSize() > 100000)
                    return new JsonResponse(['message'=>'image_size_exceed', 400]);

                if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                    return new JsonResponse(['message'=>'image_invalid_format', 400]);

                $oldImage= $article->getImage();
                $media = $this->sonataCreateMediaImageFromUploadedFile($file, Article::SONATA_CONTEXT);
                $article->setImage($media);
                $this->sonataRemoveImage($oldImage);
            }

            $this->em->persist($article);

            /** @var \Doctrine\Common\Collections\ArrayCollection $countries */
            $countries = clone($item->getApp()->getCountries());
            if (!$countries->contains($item->getUnitaryPriceCountry()))
                $countries[]=$item->getUnitaryPriceCountry();
        }

        $this->em->flush();
        $this->em->refresh($item);

        $context = SerializationContext::create()->setGroups(array('Public'));

        return new Response($this->serializer->serialize($item, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }
}
