<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\Enum\PayCategoryEnum;

class AppShopHasAppTabRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @return AppShopHasAppTab
     */
    public function deleteByAppId($appId)
    {
        $sql="
            DELETE AppBundle:AppShopHasAppTab as_tab

            WHERE
                as_tab.appTab in (
                              Select app_tab.id
                              FROM AppBundle:AppTab app_tab
                              WHERE
                                  app_tab.app = :appId
                           )
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->execute()
        ;
    }

    /**
     * @param $appShopId
     * @param $nameUnique
     * @return AppShopHasAppTab
     */
    public function findOneByAppShopIdAndNameUnique($appShopId, $nameUnique)
    {
        $sql="
            SELECT as_tab
            FROM AppBundle:AppShopHasAppTab as_tab
            JOIN as_tab.appTab as tab
            WHERE
                as_tab.appShop = :appShopId
                AND tab.nameUnique = :nameUnique

            order by tab.order
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appShopId' => $appShopId, 'nameUnique' => $nameUnique))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $appShopId
     * @param $nameUnique
     * @return AppShopHasAppTab
     */
    public function findByAppShopId($appShopId)
    {
        $sql="
            SELECT as_tab
            FROM AppBundle:AppShopHasAppTab as_tab
            JOIN as_tab.appTab as tab
            WHERE
                as_tab.appShop = :appShopId
            order by tab.order
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appShopId' => $appShopId))
            ->getOneOrNullResult()
        ;
    }

    public function findOneByAppShopIdAndArticleId($appShopId, $articleId)
    {
        $sql="
            SELECT as_tab
            FROM AppBundle:AppShopHasAppTab as_tab
            JOIN as_tab.articles art
            WHERE
                as_tab.appShop = :appShopId
                AND art = :articleId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appShopId' => $appShopId, 'articleId'=>$articleId))
            ->getOneOrNullResult()
            ;
    }


    /**
     * @param $appId
     * @return AppShopHasAppTab[]
     */
    public function findByAppId($appId)
    {
        $sql="
            SELECT as_tab
            FROM AppBundle:AppShopHasAppTab as_tab
            JOIN as_tab.appTab as tab
            WHERE
                tab.app = :appId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult()
        ;
    }

    /**
     * @param int $appId
     * @param null $countryConfiguredId
     * @param null $countryClientId
     * @param int $levelCategoryId
     * @param null $appTabsAvailable
     * @param null $articlesAvailable
     * @param null $payMethodsAvailable
     * @param null $externalStore
     * @param bool $articleActive
     * @param bool $articlePMPCAActive
     * @return \AppBundle\Entity\AppShopHasAppTab[]
     */
    public function findByAppIdAndCountryAndLevelCategoryAndLevelCategoryIdAndStatus(
        $appId,
        $countriesConfiguredIds = null,
        $countriesClientIds = null,
        $levelCategoryId,
        $appTabsAvailable = null,
        $articlesAvailable = null,
        $payMethodsAvailable = null,
        $externalStore = null,
        $articleActive = true,
        $articlePMPCAActive = true
    ) {
        $params = array(
            'articleActive'      => $articleActive,
            'articlePMPCAActive' => $articlePMPCAActive,
            'appId'              => $appId,
            'levelCategoryId'    => $levelCategoryId,
            'payCategoryMobile'  => PayCategoryEnum::MOBILE_ID,
            'payCategoryVoice'   => PayCategoryEnum::VOICE_ID,
        );

        $extra = "";
        $extraPMPC= '';
        $extraApp = '';

        if ($payMethodsAvailable && count($payMethodsAvailable) > 0)
        {
            $params['payMethods'] = $payMethodsAvailable;
            $extraPMPC .= "AND pmp.payMethod in ( :payMethods ) ";
        }

        if ($appTabsAvailable && count($appTabsAvailable) > 0)
        {
            $params['appTabs'] = $appTabsAvailable;
            $extra .= "AND app_tab in ( :appTabs ) ";
        }

        if ($articlesAvailable && count($articlesAvailable) > 0)
        {
            $params['articles'] = $articlesAvailable;
            $extra .= "AND a in ( :articles ) ";
        }

        if ($externalStore)
        {
            $params['externalStore'] = $externalStore;
            $extraPMPC .= "AND pmp.externalStore = :externalStore ";

        } else {
            $extraPMPC .= "AND pmp.externalStore IS NULL ";
        }

        if ($countriesClientIds)
        {
            $params['countriesClientIds'] = $countriesClientIds;
            $extraPMPC .= "AND pmpc.country in (:countriesClientIds) ";
        }

        if ($countriesConfiguredIds)
        {
            $params['countriesConfiguredIds'] = $countriesConfiguredIds;

            $extra .= "AND sha.country in (:countriesConfiguredIds)";
            $extraApp .= 'AND c2 in (:countriesConfiguredIds) ';
        }

        $extraPMPC .= "
            AND ( app_tab_pay_categories.id IS NULL OR pay_method.payCategory = app_tab_pay_categories )
            AND ( app_tab_article_categories.id IS NULL OR a.articleCategory = app_tab_article_categories )

            AND (
                pay_method.payCategory != :payCategoryMobile
                OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = false )
                OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = true AND (sms.payMethodProviderHasCountry = pmpc.id) )
            )
            AND (
                pay_method.payCategory != :payCategoryVoice
                OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = false )
                OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = true AND (voice.payMethodProviderHasCountry = pmpc.id) )
            )
        ";

        $sql = "
            SELECT a_cat
            FROM AppBundle:appShopHasAppTab a_cat
            JOIN a_cat.appTab a_cat_app_tab
            WHERE
            a_cat in (
                SELECT distinct app_shop_has_app_tab.id
                FROM AppBundle:AppShopHasArticle sha
                JOIN sha.article a
                JOIN a.item i
                JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId AND app_shop.app = :appId
                JOIN app_shop.appShopHasAppTabs app_shop_has_app_tab
                JOIN app_shop_has_app_tab.appTab app_tab
                JOIN app_shop.app app
                JOIN app.countries c WITH c = sha.country
                JOIN sha.country sha_country
                LEFT JOIN sha.SMSs sms
                LEFT JOIN sha.voices voice

                JOIN app_shop_has_app_tab.articles app_tab_articles WITH a = app_tab_articles
                LEFT JOIN app_tab.articleCategories app_tab_article_categories
                LEFT JOIN app_tab.payCategories app_tab_pay_categories

                WHERE
                    app = :appId
                    AND sha.active = :articlePMPCAActive
                    AND a.active = :articleActive
                    AND ( (a.validFrom is null) OR (a.validFrom <= CURRENT_TIMESTAMP()) )
                    AND ( (a.validTo is null) OR (a.validTo > CURRENT_TIMESTAMP()) )
                    AND i.active = :articleActive
                    AND app_shop.active = :articleActive
                    AND EXISTS(

                        SELECT 1
                        FROM AppBundle:App app2
                        JOIN app2.countries c2
                        where
                            app = :appId

                            $extraApp
                    )
                    AND EXISTS(

                        SELECT 1
                        FROM AppBundle:AppHasPayMethodProviderCountry ahpmpc
                            JOIN ahpmpc.payMethodProviderHasCountry pmpc
                            JOIN pmpc.payMethodHasProvider pmp
                            JOIN pmp.payMethod pay_method

                        WHERE
                            ahpmpc.app = app.id

                            AND pay_method.articleCategory = a.articleCategory
                            AND pmp.active = :articlePMPCAActive
                            AND pay_method.active = :articlePMPCAActive
                            AND pmpc.active = :articlePMPCAActive
                            AND ahpmpc.active = :articlePMPCAActive



                            $extraPMPC
                    )

                    $extra
            )
            order by a_cat_app_tab.order
        ";

        //        die($this
        //            ->getEntityManager()
        //            ->createQuery($sql)
        //            ->setParameters($params)
        //            ->getSQL());


        return $this
            ->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult();
    }
} 