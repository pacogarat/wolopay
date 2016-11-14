<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Helper\UtilHelper;

class AppShopHasArticleRepository extends AbstractRepository
{
    /**
     * @param int $appId
     * @param $countryConfiguredId
     * @param $countryClientId
     * @param int $levelCategoryId
     * @param \AppBundle\Entity\AppShopHasAppTab|\AppBundle\Entity\AppTab $appShopHasAppTab
     * @param bool $firstOffers
     * @param null $articlesAvailable
     * @param null $payMethodsAvailable
     * @param int $itemId
     * @param null $pmpcId
     * @param null $externalStore
     * @param bool $articleActive
     * @param bool $articlePMPCAActive
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function findByAppIdAndCountryAndLevelCategoryAndStatus(
        $appId,
        $countryConfiguredId,
        $countryClientId,
        $levelCategoryId,
        AppShopHasAppTab $appShopHasAppTab = null,
        $firstOffers= true,
        $articlesAvailable = null,
        $payMethodsAvailable = null,
        $itemId = null,
        $pmpcId = null,
        $externalStore = null,
        $articleActive = true,
        $articlePMPCAActive = true
        ,$include_free = false
    ) {

        $params = [
            'articleActive'      => $articleActive,
            'articlePMPCAActive' => $articlePMPCAActive,
            'countryConfiguredId'          => $countryConfiguredId,
            'appId'              => $appId,
            'levelCategoryId'    => $levelCategoryId,
            'payCategoryMobile'    => PayCategoryEnum::MOBILE_ID,
            'payCategoryVoice'     => PayCategoryEnum::VOICE_ID,
        ];

        if ($include_free){
            $params['articleCatFree']= ArticleCategoryEnum::FREE_PAYMENT_ID;
        }

        $extra ='';
        $extraPMPC = '';

        if ($appShopHasAppTab)
        {
            $extra .= "AND a in (:filter_articles) ";
            if (!$appShopHasAppTab->getArticles()->isEmpty())
            {
                $params['filter_articles'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getArticles());
            }else{
                $params['filter_articles'] = [-999]; // because articles_filter is mandatory
            }

            if (!$appShopHasAppTab->getAppTab()->getArticleCategories()->isEmpty())
            {
                $extra .= "AND a.articleCategory in (:filter_articleCategoryIds) ";
                $params['filter_articleCategoryIds'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getAppTab()->getArticleCategories());
            }

            if (!$appShopHasAppTab->getAppTab()->getPayCategories()->isEmpty())
            {
                $extraPMPC .= "AND pay_method.payCategory in (:filter_payCategories) ";
                $params['filter_payCategories'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getAppTab()->getPayCategories());
            }

        }

        if ($pmpcId)
        {
            $extraPMPC .= "AND pmpc = :pmpcId ";
            $params['pmpcId'] = $pmpcId;
        }

        if ($itemId)
        {
            $extra .= "AND i = :itemId ";
            $params['itemId'] = $itemId;
        }

        if ($payMethodsAvailable && count($payMethodsAvailable) > 0)
        {
            $params['payMethods'] = $payMethodsAvailable;
            $extraPMPC .= "AND pmp.payMethod in ( :payMethods ) ";
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

        if ($countryClientId)
        {
            $params['countryClientId'] = $countryClientId;
            $extraPMPC .= 'AND pmpc.country = :countryClientId ';
        }

        $sql = "
            SELECT sha, a, ashat, app_tab, offer ". ( (!$externalStore)?", voice, sms":'') ."
            FROM AppBundle:AppShopHasArticle sha
                JOIN sha.article a
                JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId AND app_shop.app = :appId
                JOIN a.appShopHasAppTab ashat with ashat.appShop=app_shop
                JOIN ashat.appTab app_tab
                JOIN app_shop.app app
                JOIN app.countries c WITH sha.country = c
                JOIN a.item i
                JOIN sha.country sha_country WITH sha_country = sha.country
                JOIN sha_country.currency sha_currency

                LEFT JOIN sha.offer offer " .
                ( (!$externalStore)? "
                    LEFT JOIN sha.SMSs sms
                    LEFT JOIN sha.voices voice ":'') ."
            WHERE
                sha.country = :countryConfiguredId
                AND app = :appId

                AND ( (a.validFrom is null) OR (a.validFrom <= CURRENT_TIMESTAMP()) )
                AND ( (a.validTo is null) OR (a.validTo > CURRENT_TIMESTAMP()) )
                AND i.active = :articleActive
                AND app_shop.active = :articleActive
                AND sha.active = :articlePMPCAActive
                AND a.active = :articleActive

                AND EXISTS(
                    SELECT 1
                    FROM AppBundle:AppHasPayMethodProviderCountry ahpmpc
                        JOIN ahpmpc.payMethodProviderHasCountry pmpc
                        JOIN pmpc.payMethodHasProvider pmp
                        JOIN pmp.payMethod pay_method
                    WHERE
                        ahpmpc.app = app.id

                        AND (" .
            ( ($include_free)? " a.articleCategory=:articleCatFree OR ":"")
                        ." pay_method.articleCategory = a.articleCategory )
                        AND pmp.active = :articleActive
                        AND pay_method.active = :articleActive
                        AND pmpc.active = :articleActive
                        AND ahpmpc.active = :articlePMPCAActive

                        AND (
                            pay_method.payCategory != :payCategoryMobile
                            OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = false )
                            OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = true ". ((!$externalStore)?" AND (sms.payMethodProviderHasCountry = pmpc.id) ":'') .")
                            )
                        AND (
                            pay_method.payCategory != :payCategoryVoice
                            OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = false )
                            OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = true ". ((!$externalStore)?" AND (voice.payMethodProviderHasCountry = pmpc.id) ":'').")
                        )

                        $extraPMPC
                )

                $extra

            order by ";

        $sql.=($firstOffers ? ' offer.appShopHasArticle DESC, ' : '' )." sha.order ASC ";
        //$sql.=", CASE sha.order WHEN app_shop.order_type='by_database' THEN 1 ELSE -1 END ASC, app_shop.amount";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param bool $active
     * @return int
     */
    public function findNumArticlesConfiguredByAppId(
        $appId,
        $active = true
    ) {
        $sql = "
            SELECT count(asha)
            FROM AppBundle:AppShopHasArticle asha
            JOIN asha.article a
            JOIN a.item i
            JOIN a.app app
            WHERE
                app = :appId
                AND a.active = :active
                AND i.active = :active
        ";

        return (int) $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'appId' => $appId,
                'active' => $active,
            )
        )->getSingleScalarResult();
    }

    public function findByArticleIdAndActive($articleId)
    {
        $sql="
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.article a
            JOIN a.item i
            WHERE
                a.id = :articleId
                AND a.active = true
                AND i.active = true

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'articleId' => $articleId,
            )
        )->getResult();
    }

    public function findByAppIdAndActive($appId)
    {
        $sql="
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.article a
            JOIN a.item i
            WHERE
                a.app = :appId
                AND sha.active = true
                AND a.active = true
                AND i.active = true

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'appId' => $appId,
            )
        )->getResult();
    }

    /**
     * @param $appId
     * @return AppShopHasArticle[]
     */
    public function findByAppId($appId)
    {
        $sql="
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.article a
            JOIN a.item i
            WHERE
                a.app = :appId

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'appId' => $appId,
            )
        )->getResult();
    }

    /**
     * @param $articleId
     * @param $levelCategoryId
     * @return AppShopHasArticle[]
     */
    public function findByArticleIdAndLevelCategory($articleId, $levelCategoryId)
    {
        $sql="
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.article a
            JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId
            WHERE
                a = :articleId

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'articleId' => $articleId,
                'levelCategoryId' => $levelCategoryId,
            )
        )->getResult();
    }

    /**
     * @param $countryId
     * @param $appShopId
     * @param $articleId
     * @return AppShopHasArticle
     */
    public function findOneById($countryId, $appShopId, $articleId)
    {
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha

            WHERE
                sha.country = :countryId
                AND sha.appShop = :appShopId
                AND sha.article = :articleId
        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'articleId' => $articleId,
                'appShopId' => $appShopId,
                'countryId' => $countryId,
            )
        )->getOneOrNullResult();
    }

    /**
     * @param $countryId
     * @param $articleId
     * @param $levelCategoryId
     * @param null $appId
     * @param null $active
     * @return AppShopHasArticle
     */
    public function findOneByIdAndLevelCategory($countryId, $articleId, $levelCategoryId, $appId = null, $active = null){

        $params = array(
            'articleId'       => $articleId,
            'levelCategoryId' => $levelCategoryId,
            'countryId'       => $countryId,
        );
        $extraSQL = '';

        if ($active !== null)
        {
            $params['active'] = $active;

            $extraSQL .= '
                AND sha.active = :active
            ';
        }

        if ($active !== null)
        {
            $params['appId'] = $appId;

            $extraSQL .= '
                AND app_shop.app = :appId
            ';
        }

        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId
            JOIN sha.article a
            WHERE
                sha.country = :countryId
                AND sha.article = :articleId
                $extraSQL
        ";

        return $this->getEntityManager()->createQuery($sql)
            ->setParameters($params)
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $countryId
     * @param $articleIds
     * @param $levelCategoryId
     * @param $appId
     * @return AppShopHasArticle[]
     */
    public function findByArticlesIdsAndCountryIdAndLevelCategoryAndAppId($countryId, $articleIds, $levelCategoryId, $appId)
    {
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId

            WHERE
                sha.country = :countryId
                AND app_shop.app = :appId
                AND sha.article in (:articleIds)
        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'appId' => $appId,
                'articleIds'       => $articleIds,
                'levelCategoryId' => $levelCategoryId,
                'countryId'       => $countryId,
            )
        )->getResult();
    }

    /**
     * @param $countryId
     * @param $articleId
     * @param $gamerLevel
     * @return AppShopHasArticle
     */
    public function findOneByIdWithGamerLevel($countryId, $articleId, $gamerLevel){
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.appShop app_shop

            WHERE
                sha.country = :countryId
                AND sha.article = :articleId
                AND app_shop.valueLower <= :gamerLevel
                AND app_shop.valueHigher > :gamerLevel
        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'articleId'  => $articleId,
                'gamerLevel' => $gamerLevel,
                'countryId'  => $countryId,
            )
        )->getOneOrNullResult();
    }

    /**
     * @param bool $offerExist
     * @param null $articleId
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function findAllWithOfferAndArticleId($offerExist=false, $articleId=null)
    {
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            WHERE
                sha.offer " . ($offerExist ? ' is not null ' : ' is null ').
                ($articleId ? ' AND sha.article = :articleId ' : '')
        ;

        $arrayParameters = [];
        if ($articleId)
            $arrayParameters['articleId'] = $articleId;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($arrayParameters)
            ->getResult();
    }

    /**
     * @param $offerProgrammerId
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function findByOfferProgrammerId($offerProgrammerId)
    {
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            JOIN sha.offer offer
            WHERE
                offer.offerProgrammer = :offerProgrammerId
                "
        ;

        $arrayParameters = ['offerProgrammerId' => $offerProgrammerId];

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($arrayParameters)
            ->getResult();
    }

    /**
     * @param array $articlesIds
     * @param array $appShopsIds
     * @param array $countriesIds
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function findByArticlesIdsAndAppShopIdsAndCountriesIds(array $articlesIds, array $appShopsIds, array $countriesIds)
    {
        $sql = "
            SELECT sha
            FROM AppBundle:AppShopHasArticle sha
            WHERE
                sha.country in (:countries)
                AND sha.article in (:articles)
                AND sha.appShop in (:appShops)
                "
        ;

        $arrayParameters = [
            'countries' => $countriesIds,
            'articles' => $articlesIds,
            'appShops' => $appShopsIds,
        ];

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($arrayParameters)
            ->getResult();
    }


} 