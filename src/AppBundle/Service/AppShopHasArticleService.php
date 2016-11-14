<?php


namespace AppBundle\Service;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("app_shop_has_article")
 */
class AppShopHasArticleService
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

    /**
     * @var OfferCommand
     * @Inject("command.shop.offer.sync")
     */
    public $offerCommand;

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

    /** @Inject("%kernel.environment%")   */
    public $env;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    CONST AMOUNT_NOT_CALCULATED = -9999;

    public function deleteANDsyncALL(App $app){
        $this->deleteOffers_OfNotExistingASHAs($app);
        $this->syncAllAppShopHasArticlesWithAppTabIfEnabled($app);
    }

    /**
     * @param App $app
     * @return int
     * @throws \Doctrine\DBAL\DBALException
     */
    public function deleteOffers_OfNotExistingASHAs(App $app){
        return $this->em->getConnection()->exec("
            DELETE FROM offer
              WHERE offer.app_shop_has_article_id IN
              (
                SELECT app_shop_has_articles.id FROM app_shop_has_articles
                WHERE
                app_shop_has_articles.app_shop_id IN
                (
                    SELECT app_shop.id FROM app_shop
                    WHERE  app_shop.app_id = '" . $app->getId() . "'
                )
                AND app_shop_has_articles.country_id NOT IN
                (
                    SELECT app_has_countries.country_id FROM app_has_countries
                    WHERE app_has_countries.app_id = '" . $app->getId() . "'
                )
            )
        ");
    }

    public function deleteASHA_OfRemovedCountriesOfApp(App $app){
        return $this->em->getConnection()->exec("
            DELETE FROM app_shop_has_articles
            WHERE
            app_shop_has_articles.app_shop_id IN
            (
                    SELECT app_shop.id FROM app_shop
                    WHERE  app_shop.app_id = '" . $app->getId() . "'
            )
            AND app_shop_has_articles.country_id NOT IN
            (
                SELECT app_has_countries.country_id FROM app_has_countries
                WHERE app_has_countries.app_id = '". $app->getId() . "'
            )
        ");
    }

    /**
     * @param App $app
     */
    public function syncAllAppShopHasArticlesWithAppTabIfEnabled(App $app)
    {
//        $time = time();
        $this->em->getConnection()->exec("
            UPDATE app_shop_has_articles app_shop_has_articles_update
            INNER JOIN app_shop on (app_shop.id = app_shop_has_articles_update.app_shop_id)
            SET app_shop_has_articles_update.active = (
                SELECT CASE WHEN (count(1) = 0 ) THEN 0 ELSE 1 END
                FROM app_shop_has_app_tabs
                JOIN app_shop_app_tab_has_articles on (app_shop_app_tab_has_articles.appshophasapptab_id = app_shop_has_app_tabs.id)
                JOIN article a_sub on (app_shop_app_tab_has_articles.article_id = a_sub.id )
                INNER JOIN app_tab on (app_tab.id = app_shop_has_app_tabs.app_tab_id)
                WHERE
                    app_shop_has_articles_update.article_id = app_shop_app_tab_has_articles.article_id
                    AND app_shop_has_app_tabs.app_shop_id = app_shop.id
            )
            WHERE
                app_shop.app_id = '".$app->getId()."'
        ");

//        echo " --- UPDATE ".(time()-$time);

        $this->em->getConnection()->exec("
            INSERT INTO app_shop_has_articles (article_id, country_id, app_shop_id, `order`, created_at, amount, active)
            SELECT a.id, c.id, a_s.id, 0, NOW(), ".self::AMOUNT_NOT_CALCULATED.", 1
            FROM country c

                INNER JOIN app_has_countries a_c ON (c.id = a_c.country_id)
                INNER JOIN app ON (a_c.app_id = app.id)
                INNER JOIN app_shop a_s ON (app.id = a_s.app_id)
                INNER JOIN app_shop_has_app_tabs as_at ON (a_s.id = as_at.app_shop_id)
                INNER JOIN app_shop_app_tab_has_articles asata ON (asata.appshophasapptab_id = as_at.id)
                INNER JOIN article a ON (a.id= asata.article_id)
                LEFT JOIN app_shop_has_articles asa ON (asa.article_id=a.id AND asa.app_shop_id=a_s.id AND asa.country_id=c.id)

            WHERE

                app.id = '".$app->getId()."'
                AND asa.id IS NULL
                AND app.active=1
                AND a_s.active=1
                AND a.active=1
        ");

//        echo " --- SELECT INSERT ".(time()-$time);

        $amountIncompleteds = $this->em->createQuery("
                Select asha
                FROM
                    AppBundle:AppShopHasArticle asha
                    JOIN asha.article a
                WHERE
                    a.app = :appId
                    AND asha.amount = :amount
            ")
            ->setParameters(['appId' => $app->getId(), 'amount' => AppShopHasArticleService::AMOUNT_NOT_CALCULATED])
            ->iterate()
        ;

        foreach ($amountIncompleteds as $amountIncompleted)
        {
            /** @var AppShopHasArticle $appShopHasArticle */
            $appShopHasArticle = $amountIncompleted[0];

            $amount = $appShopHasArticle->getArticle()->getAmountStandard();
            $countryWanted = $appShopHasArticle->getCountry();

            if ($app->getCostOfLiveIsEnabled())
            {
                $amount = $this->countryService->getPriceCostOfLifeSimple(
                    $appShopHasArticle->getArticle()->getAmountStandard(),
                    $appShopHasArticle->getArticle()->getItem()->getUnitaryPriceCountry(),
                    $countryWanted
                );
            }


            $amount = $this->currencyService->getExchange(
                $amount,
                $appShopHasArticle->getArticle()->getItem()->getUnitaryPriceCountry()->getCurrency(),
                $countryWanted->getCurrency()->getId()
            );

            if ($app->getPrettyPriceIsEnabled())
            {
                $amount = UtilHelper::prettyPrice(
                    $amount,
                    $countryWanted->getCurrency()->getDecimalPlaces(),
                    $countryWanted->getDecimalFormat()
                );
            }

            $amount = round($amount, $countryWanted->getCurrency()->getDecimalPlaces());

            $appShopHasArticle->setAmount($amount);
        }
        $this->em->flush();
//        echo " --- SET AMOUNT ".(time()-$time);
    }

} 