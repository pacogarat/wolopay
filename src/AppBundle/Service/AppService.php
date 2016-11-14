<?php


namespace AppBundle\Service;

use AppBundle\Entity\App;
use AppBundle\Entity\AppTab;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Helper\StatsHelper;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("app.app")
 */
class AppService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    public function addDefaultTabs($app){
        $appTabSingle = new AppTab();
        $appTabSingle
            ->setApp($app)
            ->setName('Single Payment')
            ->setNameLabel($this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['domain'=>'shop', 'key'=> 'article_categories.single.description']))
            ->addArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID))
            ->setOrder(1)
        ;

        $appTabFree = new AppTab();
        $appTabFree
            ->setApp($app)
            ->setName('Free Payment')
            ->setNameLabel($this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['domain'=>'shop', 'key'=> 'article_categories.free.description']))
            ->addArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::FREE_PAYMENT_ID))
            ->setOrder(2)
        ;

        $appTabSubscription = new AppTab();
        $appTabSubscription
            ->setApp($app)
            ->setName('Subscription Payment')
            ->setNameLabel($this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['domain'=>'shop', 'key'=> 'article_categories.subscription.description']))
            ->addArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID))
            ->setOrder(3)
        ;

        $this->em->persist($appTabSingle);
        $this->em->persist($appTabFree);
        $this->em->persist($appTabSubscription);
    }

    /**
     * @param App $app
     */
    public function onCreateAppInsertBasicData(App $app)
    {
        $this->addDefaultTabs($app);

        $app->setActive($app->getClient()->getOnCreateAppActiveByDefault());
        $app->setCanCustomizeAppTabs($app->getClient()->getOnCreateAppCanCustomizeAppTabs());



        $this->em->flush();
    }

    /**
     * @param App $app
     * @return Country[]
     */
    public function getRealCountriesPMPC(App $app)
    {
        if ($app->getCountries()->contains($this->em->getRepository("AppBundle:Country")->find(CountryEnum::OTHER)))
        {
            return $this->em->getRepository("AppBundle:Country")->findByAppAndAllAvailableWithPMPC($app->getId());
        }

        $countries = [];
        $continents = [];

        foreach ($app->getCountries() as $c)
        {
            if (in_array($c->getId(), CountryEnum::$OTHERS_ALL))
                $continents[]=$c->getContinent()->getId();
            else
                $countries[]= $c->getId();
        }

        return $this->em->getRepository("AppBundle:Country")->findByAppAndAllAvailableWithPMPC($app->getId(), null, $countries, $continents);
    }

    /**
     * @param App $app
     * @param bool $flush
     * @return Country[]
     */
    public function enableOrDisablePMPCFromApp(App $app, $flush = false)
    {
        foreach ($app->getAppHasPayMethodProviderCountry() as $aPMPC)
        {
            $state = true;

            $pmpc = $aPMPC->getPayMethodProviderHasCountry();
            if ($app->getPayMethodsMaxFeeProviderPercent() > $pmpc->getCurrentFeeProviderPercent())
                $state = false;

            $aPMPC->setActive($state);
        }

        if ($flush)
            $this->em->flush();
    }


    /**
     * @param App $app
     * @param $date_from
     * @param $date_to
     * @param Currency $currency
     * @param $date_format
     * @param int $offset
     * @return array()
     */
    public function getAppTransactionsPurchases(App $app, $date_from, $date_to,Currency $currency, $date_format, $offset=0){
        $em = $this->em;

        $result = $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRangeByDays($app->getId(), $date_from, $date_to, $currency->getId(), $date_format, $offset);
        $result['amounts_game_subscriptions_with_offer'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                true,
                true,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_subscriptions_without_offer'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                true,
                false,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_subscriptions'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                true,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                false,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments_with_offer'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                false,
                true,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments_without_offer'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                $date_format,
                false,
                false,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments_by_weekday'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'weekdays',
                false,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_subscription_payments_by_weekday'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'weekdays',
                true,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments_by_hours_admin_local'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'hours',
                false,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_single_payments_by_hours_gamer_country'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'hours',
                false,
                null,
                'SUM',
                $offset,
                true
            )['amounts_game']
        ;

        $result['amounts_game_subscription_payments_by_hours_admin_local'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'hours',
                true,
                null,
                'SUM',
                $offset
            )['amounts_game']
        ;

        $result['amounts_game_subscription_payments_by_hours_gamer_country'] =
            $em->getRepository("AppBundle:Purchase")->totalAllAmountsByAppIdAndDateRange(
                $app->getId(),
                $date_from,
                $date_to,
                $currency->getId(),
                'hours',
                true,
                null,
                'SUM',
                $offset,
                true
            )['amounts_game']
        ;

        $result['purchases'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, false, $date_format, false, $offset);
        $result['purchases_sum'] = StatsHelper::sumSimpleRecursive($result['purchases']);

        $result['transactions'] = $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, $date_format, $offset);
        $result['transactions_sum'] = StatsHelper::sumSimpleRecursive($result['transactions']);

//        $result['purchases_without_gifts'] = $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, true, $date_format);
//        $result['purchases_without_gifts_sum'] = StatsHelper::sumSimpleRecursive($result['purchases_without_gifts']);

        $result['unique_users_transactions'] = (int) $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($app->getId(), $date_from, $date_to, $date_format, true, $offset)['unique_gamers'];

        $result['unique_users_purchases'] = (int) $em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($app->getId(), $date_from, $date_to, $date_format, true);

        $result['transactions'] = $em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonths($app->getId(), $date_from, $date_to, $date_format, $offset);
        $result['transactions_full'] = $em->getRepository("AppBundle:Transaction")->fullStatsByAppIdAndDateRangeAndGroupBy([$app->getId()], $date_from, $date_to, $currency->getId(), $date_format, 'date_format', $offset);

        $result['date_format'] = $date_format;

        return $result;
    }
} 