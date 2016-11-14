<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Helper\StatsHelper;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api/stats")
 */
class StatsController extends Controller
{

    /**
     * @var Serializer
     * @Inject("jms_serializer")
     */
    public $serializer;

    private function validateAccess(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_ANALITYCS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();
    }

    private function getDateFormatFromDates(\DateTime $date_from, \DateTime $date_to, $date_format = 'auto')
    {
        if ($date_format == 'auto')
        {
            $dateInterval = $date_from->diff($date_to);

            if ($dateInterval->days < 1 || ($dateInterval->days == 1 && $dateInterval->h == 0))
                $date_format = 'hours';
            elseif($dateInterval->days < 33)
                $date_format = 'days';
            elseif($dateInterval->days < 125)
                $date_format = 'weeks';
            else
                $date_format = 'months';
        }

        return $date_format;
    }

    /**
     * @Route("/user_levels/app/{app}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_user_level_by_app")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getUserLevelsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset= $clientUser->getTimeOffsetInHours();

        $this->validateAccess($app);
        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $resultTransactionCounts = $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($app->getId(), $date_from, $date_to, $date_format, false, $offset);

        $result['unique_users_transactions'] = $resultTransactionCounts['unique_gamers'];
        $result['unique_users_purchases'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($app->getId(), $date_from, $date_to, $date_format);

        $dataByGamerLevel = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByGamerLevel($app->getId(), $date_from, $date_to, $date_format, $currency->getId(), $offset);

        $result['count_level_by_shop'] = $dataByGamerLevel['count_level'];
        $result['revenue_by_level_by_shop'] = $dataByGamerLevel['revenue_level'];

        $result['revenue_by_shop_sum'] = StatsHelper::sumAllTogetherGroupedByFirstKey($result['revenue_by_level_by_shop']);

        $result['level_gamers_distinct_by_shop'] = $dataByGamerLevel['unique_gamers'];
        $result['transactions_by_shop'] = $dataByGamerLevel['transactions'];

        // frequency
        $result['gamer_frequency'] = $em->getRepository("AppBundle:Transaction")->statsFrequencyByGamer($app->getId(), $date_from, $date_to);
        $result['gamer_last_visit'] = $em->getRepository("AppBundle:Transaction")->statsFrequencyDaysFromLastVisit($app->getId(), $date_from, $date_to);
        $result['date_format'] = $date_format;

        return new JsonResponse($result);

    }

    /**
     * @Route("/payment_methods/app/{app}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_payment_methods_by_app")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getPayMethodsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();

        $this->validateAccess($app);
        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $result['table'] = $em->getRepository("AppBundle:Transaction")->statsByPayMethodTop5($app->getId(), $date_from, $date_to, $date_format, $currency->getId(), 5, 'date_format, pm', $offset);
        $result['table_without_date'] = $em->getRepository("AppBundle:Transaction")->statsByPayMethodTop5($app->getId(), $date_from, $date_to, $date_format, $currency->getId(), null, 'c, pm', $offset);
        $result['table_all'] = $em->getRepository("AppBundle:Transaction")->statsByPayMethodTop5($app->getId(), $date_from, $date_to, $date_format, $currency->getId(), null, 'date_format, c, pm', $offset);
        $result['date_format'] = $date_format;

        return new JsonResponse($result);

    }

    /**
     * @Route("/articles_shops/app/{app}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_articles_shops")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getArticlesByShop(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();

        $this->validateAccess($app);
        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $articlesByShopDate = $em->getRepository("AppBundle:Article")->statsArticlesPurchased([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'l.id, date_format, article_id', $offset);
        $articlesByShopsByTabs = $em->getRepository("AppBundle:Purchase")->statsGroupedByLevelCategoryAndTabNameAndArticleId($app->getId(), $date_from, $date_to, $currency->getId());

        $articlesTemp = [];
        $colors = StatsHelper::getColors();

        $injectArticleObjectAndColor = function  ($array) use ($em, &$colors, &$articlesTemp) {
            // use same colors
            foreach ($array as &$row)
            {
                $context = SerializationContext::create()->setGroups(array('Default','ArticleOnlyName','allTranslations'))->enableMaxDepthChecks();

                if (!isset($articlesTemp[$row['article_id']]))
                {
                    $articlePHP = json_decode($this->serializer->serialize(
                            $em->getRepository("AppBundle:Article")->find($row['article_id'])
                            , 'json', $context), true);

                    $articlePHP['color'] = array_shift ( $colors );
                    $articlesTemp[$row['article_id']] = $articlePHP;
                }

                $articlePHP = $articlesTemp[$row['article_id']];

                $row['article'] = $articlePHP;
                unset($row['article_id']);
            }

            return $array;
        };

        $result['articles_by_shop_date'] = $injectArticleObjectAndColor($articlesByShopDate);
        $result['articles_by_shops_by_tabs'] = $injectArticleObjectAndColor($articlesByShopsByTabs);

        $result['date_format'] = $date_format;

        return new JsonResponse($result);
    }

    /**
     * @Route("/continents_countries/app/{app}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_continents_countries")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getContinentsCountries(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();

        $this->validateAccess($app);
        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();


//        $result['purchases_by_country'] = $em->getRepository("AppBundle:Purchase")->fullStatsByAppIdAndDateRangeAndGroupByCountry([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'c.id');
//        $result['transaction_by_country'] = $em->getRepository("AppBundle:Transaction")->fullStatsByAppIdAndDateRangeAndGroupByCountry([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'c.id');

        $countries = [];

        $sumValues = function ($foreach) use (&$countries)
        {
            foreach ($foreach as $country)
            {
                if (!isset($countries[$country['country_iso']]))
                {
                    $countries[$country['country_iso']] = $country;
                    $countries[$country['country_iso']]['transactions']    = 0;
                    $countries[$country['country_iso']]['purchases']       = 0;
                    $countries[$country['country_iso']]['gamers']          = 0;
                    $countries[$country['country_iso']]['amount_total']    = 0;
                    $countries[$country['country_iso']]['amount_provider'] = 0;
                    $countries[$country['country_iso']]['amount_wolopay']  = 0;
                    $countries[$country['country_iso']]['amount_game']     = 0;
                    $countries[$country['country_iso']]['transactions_by_date']     = [];
                    $countries[$country['country_iso']]['purchase_by_date']     = [];
                    $countries[$country['country_iso']]['amount_game_by_date']     = [];
                }

                $countries[$country['country_iso']]['transactions']    += unless($country['transactions'], 0);
                $countries[$country['country_iso']]['purchases']       += unless($country['purchases'], 0);
                $countries[$country['country_iso']]['gamers']          += unless($country['gamers'], 0);
                $countries[$country['country_iso']]['amount_total']    += unless($country['amount_total'], 0);
                $countries[$country['country_iso']]['amount_provider'] += unless($country['amount_provider'], 0);
                $countries[$country['country_iso']]['amount_wolopay']  += unless($country['amount_wolopay'], 0);
                $countries[$country['country_iso']]['amount_game']     += unless($country['amount_game'], 0);

                if (isset($country['transactions']))
                    $countries[$country['country_iso']]['transactions_by_date'][$country['date_format']] = $country['transactions'];

                if (isset($country['purchases']))
                    $countries[$country['country_iso']]['purchase_by_date'][$country['date_format']] = $country['purchases'];
                if (isset($country['amount_game']))
                    $countries[$country['country_iso']]['amount_game_by_date'][$country['date_format']] = $country['amount_game'];

            }
        };

//        $purchasesByCountryDate = $em->getRepository("AppBundle:Purchase")->fullStatsByAppIdAndDateRangeAndGroupByCountry([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'date_format, c', $offset);
        $transactionsByCountryDate = $em->getRepository("AppBundle:Transaction")->fullStatsByAppIdAndDateRangeAndGroupBy([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'date_format, t.countryDetected', $offset);

//
//        $sumValues($purchasesByCountryDate);
        $sumValues($transactionsByCountryDate);

        // reorder and Complete all data
        foreach ($countries as &$country)
        {
            $country['transactions_by_date'] = StatsHelper::fillAllStats($country['transactions_by_date'], $date_from, $date_to, $date_format, $offset);
            $country['purchase_by_date'] = StatsHelper::fillAllStats($country['purchase_by_date'], $date_from, $date_to, $date_format, $offset);
            $country['amount_game_by_date'] = StatsHelper::fillAllStats($country['amount_game_by_date'], $date_from, $date_to, $date_format, $offset);
        }

//        $result['transactions_by_country_date'] = $transactionsByCountryDate;
        $result['purchases_and_transactions_full'] = $countries;
//        $result['purchases_by_country_date'] = $purchasesByCountryDate;
        $result['transactions_by_date'] = $em->getRepository("AppBundle:Transaction")->fullStatsCountriesSection([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'date_format, c', $offset);

        $result['date_format'] = $date_format;

        return new JsonResponse($result);
    }

    /**
     * @Route("/transaction_purchases/app/{app}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_transactions_purchases")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getTransactionPurchases(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();

        $this->validateAccess($app);
        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);


        $appService = $this->container->get('app.app');
        $result = array();
        $result = $appService->getAppTransactionsPurchases($app, $date_from, $date_to, $currency, $date_format);

        return new JsonResponse($result);
    }



    public function singleStatsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format, $offset=0)
    {
        $includeNegatives = true;
        $this->validateAccess($app);

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $result = $em->getRepository("AppBundle:Purchase")->
            totalAllAmountsByAppIdAndDateRangeByDays($app->getId(), $date_from, $date_to, $currency->getId(), $date_format, $offset, false, $includeNegatives);

        $sum = function($carry, $item){

            if (is_array($item))
            {
                foreach ($item as $it)
                    $carry += $it;
            }else{
                $carry += $item;
            }

            return $carry;
        };

        $result['purchases'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, false, $date_format, false, $offset,false,$includeNegatives);
        $result['purchases_sum'] = array_reduce($result['purchases'], $sum);

        $result['purchases_by_country'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByCountry($app->getId(), $date_from, $date_to, $date_format,false,$includeNegatives);
        $result['purchases_by_country_sum'] = StatsHelper::sumAllGroupSubArray($result['purchases_by_country']);

        $result['transactions'] = $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, $date_format, $offset,false,$includeNegatives);
        $result['transactions_sum'] = array_reduce($result['transactions'], $sum);

        $result['refundsNumber'] = $em->getRepository("AppBundle:Purchase")->statsRefundsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, $date_format, false, $offset);
        $result['refundsAmount'] = $em->getRepository("AppBundle:Purchase")->statsRefundsAmountByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, $currency->getId(),$date_format, false, $offset);

        $result['unique_users'] = $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($app->getId(), $date_from, $date_to, $date_format, false, $offset);
        $result['unique_users_sum'] = array_sum($result['unique_users']);
        $result['unique_users_purchases'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, false, $date_format, true, $offset,false,$includeNegatives);
        $result['unique_users_purchases_without_gifts'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, true, $date_format, true, $offset,false,$includeNegatives);

        $result['providers_pie'] = $em->getRepository("AppBundle:Purchase")->statsPieByAppIdAndDateRangeAndGroupByPayMethodAndPayCategory($app->getId(), $date_from, $date_to,false,false,$includeNegatives);
        $result['articles_pie'] = $em->getRepository("AppBundle:Purchase")->statsPieByAppIdAndDateRangeAndGroupByArticles($app->getId(), $date_from, $date_to,false,false,$includeNegatives);

        $result['purchases_by_country_full'] = $em->getRepository("AppBundle:Purchase")->fullStatsByAppIdAndDateRangeAndGroupByCountry([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'date_format, c', $offset,false,$includeNegatives);

        return $result;
    }

    /**
     * @Route("/apps/{apps}/{date_from}/{date_to}/{currency}/{date_format}", requirements={"date_format" = "(months|weeks|days|auto)"}, defaults={"date_format" = "months"}, name="admin_stats_by_apps")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function statsAppsAction($apps, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format)
    {
        $clientIds=array();
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();

        if ($date_from->getTimestamp() > $date_to->getTimestamp())
            throw new BadRequestHttpException("date from is higher than date to");

        $date_format = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        $apps = explode(',', $apps);
        $appsValid = [];

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $result = [];

        foreach ($apps as $appId)
        {
            if (!$app = $em->getRepository("AppBundle:App")->find($appId))
                throw new BadRequestHttpException("App '$appId' not exist");

            $rolesAdmin = $clientUser->getRolesAdmin($app);

            if (in_array(RoleEnum::ADMIN_DASHBOARD, $rolesAdmin))
            {
                $clientIds[]=$app->getClient()->getId();
                $result['apps'][$appId] = $this->singleStatsAction($app, $date_from, $date_to, $currency, $date_format, $offset);
                $appsValid[]= $appId;
            }

        }

        $sum = function($carry, $item){

            if (is_array($item))
            {
                foreach ($item as $it)
                    $carry += $it;
            }else{
                $carry += $item;
            }

            return $carry;
        };


        if (!$appsValid)
            throw $this->createAccessDeniedException();

        $result['purchases_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'purchases_sum');
        $result['transactions_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'transactions_sum');
        $result['amounts_game_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_game_sum');
        $result['amounts_total_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_total_sum');
        $result['amounts_taxes_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_taxes_sum');

        $result['amounts_total_pos_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_total_pos_sum');
        $result['amounts_total_neg_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_total_neg_sum');

        $result['amounts_game_pos_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_game_pos_sum');
        $result['amounts_game_neg_sum']=StatsHelper::sumArrayKeyByKey($result['apps'], 'amounts_game_neg_sum');

        $result['purchases_by_country_sum']= StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'purchases_by_country_sum');
        $result['amounts_total']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'amounts_total'));
        $result['amounts_game']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'amounts_game'));
        $result['amounts_taxes']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'amounts_taxes'));

        $result['amounts_total_pos']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'amounts_total_pos'));
        $result['amounts_total_neg']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'amounts_total_neg'));

        $result['transactions']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'transactions'));
        $result['purchases']=StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'purchases'));

        $result['refundsNumber_sum'] = StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'refundsNumber'));
        $result['refundsAmount_sum'] = StatsHelper::normalFormat(StatsHelper::sumAllGroupSubArrayByKey($result['apps'], 'refundsAmount'));
        $result['refundsNumber_total']= array_reduce($result['refundsNumber_sum'], $sum);
        $result['refundsAmount_total']= array_reduce($result['refundsAmount_sum'], $sum);

        $temp1 = $em->getRepository("AppBundle:Purchase")->statsByClientIdAndDateRangeAndGroupByAffiliate($clientIds, $date_from, $date_to, $currency->getId(), $date_format, 'date_format, affiliate', $offset);
        $result['affiliate_purchases'] = $temp1['purchases'];
        $result['affiliate_purchases_sum'] = StatsHelper::sumAllTogetherGroupedByFirstKey($result['affiliate_purchases']);
        $result['affiliate_gamers'] = $temp1['gamers'];
        $result['affiliate_gamers_sum'] = StatsHelper::sumAllTogetherGroupedByFirstKey($result['affiliate_gamers']);
        $result['affiliate_amount_total'] = $temp1['amount_total'];
        $result['affiliate_amount_total_sum'] = StatsHelper::sumAllTogetherGroupedByFirstKey($result['affiliate_amount_total']);
        $result['affiliate_amount_game'] = $temp1['amount_game'];
        $result['affiliate_amount_game_sum'] = StatsHelper::sumAllTogetherGroupedByFirstKey($result['affiliate_amount_game']);

        $result['date_format'] = $date_format;


//      $result['purchases_by_affiliate_full'] = StatsHelper::fillAllStats($temp1,$date_from,$date_to,$date_format,2, $emptyValue);

        return new JsonResponse($result);
    }

    /**
     * @Route("/pay_methods/apps/{apps}/{date_from}/{date_to}/{currency}/{date_format}", defaults={"date_format" = "months"}, name="admin_pay_method_stats_by_apps")
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function statsPayMethodsAppsAction($apps, \DateTime $date_from, \DateTime $date_to, Currency $currency, $date_format, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $offset = $clientUser->getTimeOffsetInHours();
        $showPayMethods = $request->get('show_pay_methods', false);
        $includeNegatives = true; //send as parameter?

        if ($date_from->getTimestamp() > $date_to->getTimestamp())
            throw new BadRequestHttpException("date from is higher than date to");

        $dateFormat = $this->getDateFormatFromDates($date_from, $date_to, $date_format);

        $apps = explode(',', $apps);
        $appsValid = [];

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        foreach ($apps as $appId)
        {
            $app = $em->getRepository("AppBundle:App")->find($appId);
            $rolesAdmin = $clientUser->getRolesAdmin($app);

            if (in_array(RoleEnum::ADMIN_DASHBOARD, $rolesAdmin))
                $appsValid[]= $appId;

        }

        if (!$appsValid)
            throw $this->createAccessDeniedException();

        $change = ($currency->getId() == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currency->getId() == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $result = $em->createQuery("
            SELECT
                DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr) as date_trans,
                DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr) as date_purch,
                CASE WHEN t.beginAt<:dateFrom THEN 'true' ELSE 'false' END as past,

                CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                END as date,
                COUNT( DISTINCT g.id ) as n_unique_users, a.name as app, a.id as app_id,
                pm.name as pay_method, c.name country_name, c.id country_iso,
                COUNT( DISTINCT t.id ) as n_transactions,
                group_concat(t.id) as trs,
                count(DISTINCT(p.id)) as n_purchases,
                SUM(p.amountTotal * $change) as amount_total,
                COALESCE( SUM(p.amountGame * $change), 0 )  as amount_game,
                COALESCE( SUM(p.amountTax * $change), 0 )  as amount_tax,
                COUNT( DISTINCT gp.id ) as n_unique_users_by_purchase
            FROM AppBundle:Transaction t
                JOIN t.gamer g
                JOIN t.app a
                LEFT JOIN t.countryDetected c
                LEFT JOIN t.purchases p
                LEFT JOIN p.payment pay
                LEFT JOIN pay.paymentDetail pd
                LEFT JOIN pd.payMethod pm
                LEFT JOIN p.gamer gp
            WHERE
                t.test <> 1
                AND t.app in (:apps)
                AND ((p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                      OR (p.id is not null  "
                      . ($includeNegatives ? "" : " AND p.extraCostFromParent IS NULL AND t.beginAt between :dateFrom AND :dateTo ")
                      . " AND (    (p.createdAt between :dateFrom AND :dateTo) )
                      )
                    )
            GROUP BY date, t.app, country_iso ". ($showPayMethods ? ', pd.payMethod' : '') ."
            ORDER BY date, t.app, country_iso ". ($showPayMethods ? ', pd.payMethod' : '') ."
          ")
            ->setParameters(['apps'=> $appsValid, 'dateFrom' => $date_from, 'dateTo' => $date_to])
            ->getResult()
        ;


        foreach ($result as $key=>&$line)
        {
            $line['n_unique_users_by_purchase'] = (int) $line['n_unique_users_by_purchase'];
            $line['n_unique_users'] = (int) $line['n_unique_users'];
            $line['n_transactions'] = (int) $line['n_transactions'];

            $line['n_purchases'] = (int) $line['n_purchases'];
            $line['amount_total'] = (float) $line['amount_total'];
            $line['amount_game'] = (float) $line['amount_game'];
            $line['amount_tax'] = (float) $line['amount_tax'];
            $trs = $line['trs'];
            $transactions="";
            $first=true;
            $arr = explode(",",$trs);
            foreach ($arr as $value) {
                if (!$first) $transactions .= ",";
                $transactions .= "'$value'";
                $first=false;
            }

            $result2 = $em->createQuery(
                "SELECT COUNT(distinct pd2.id) as n_clicked FROM AppBundle:PaymentDetail pd2 WHERE pd2.transaction IN (" . $transactions . ") ")
                ->getResult();
            foreach ($result2 as $k=>$v){
                $line['n_clicked'] = (int) $v['n_clicked'];
            }

        }


        return new JsonResponse( $result);
    }

}
