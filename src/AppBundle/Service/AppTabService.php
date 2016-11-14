<?php


namespace AppBundle\Service;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\App;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;


/**
 * @Service("app_tab")
 */
class AppTabService
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

    /** @Inject("%kernel.environment%")   */
    public $env;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    CONST AMOUNT_NOT_CALCULATED = -9999;

    /**
     * @param App $app
     */
    public function removeAll(App $app)
    {
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
                    app_shop_has_articles_update.id =a_sub.id
            )
            WHERE
                app_shop.app_id = '".$app->getId()."'
        ");

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

            WHERE

                app.id = '".$app->getId()."'
                AND app.active=1
                AND a_s.active=1
                AND a.active=1
        ");

    }

} 