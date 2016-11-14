<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Helper\UtilHelper;

class AppHasPayMethodProviderCountryRepository extends AbstractRepository
{
    /**
    * @param $appId
    * @param array $countries
    * @return int
    */
    public function deleteByAppIdAndCountries($appId,$countries)
    {
        $sql="
            DELETE AppBundle:AppHasPayMethodProviderCountry ahpmpc
            WHERE
                ahpmpc.app = :appId AND
                ahpmpc.payMethodProviderHasCountry in
                (
                    SELECT pmpc.id FROM AppBundle:PayMethodProviderHasCountry pmpc
                    WHERE pmpc.country not in (:countriesIds)
                )
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'countriesIds' => $countries))
            ->execute()
            ;
    }

    /**
     * @param $appId
     * @param $country
     * @param null $providerId
     * @param null $providerName
     * @return AppHasPayMethodProviderCountry[]
     */
    public function findByAppIdAndCountryEnabled($appId, $country, $providerId = null, $providerName = null, $payMethodName = null)
    {
        $extraSql = '';

        $params = ['appId' => $appId, 'country' => $country, 'active' => true];

        if ($providerId)
        {
            $extraSql .= 'AND pmp.provider = :providerId ';
            $params['providerId'] = $providerId;
        }

        if ($providerName)
        {
            $extraSql .= 'AND prov.name = :providerName ';
            $params['providerName'] = $providerName;
        }

        if ($payMethodName)
        {
            $extraSql .= 'AND pm.name = :payMethodName ';
            $params['payMethodName'] = $payMethodName;
        }

        $sql="
            SELECT ahpmpc
            FROM AppBundle:AppHasPayMethodProviderCountry ahpmpc
                JOIN ahpmpc.payMethodProviderHasCountry pmpc
                JOIN pmpc.payMethodHasProvider pmp
                JOIN pmp.provider prov
                JOIN pmp.payMethod pm

            WHERE
                ahpmpc.app = :appId
                AND pmpc.country = :country
                AND ahpmpc.active = :active

                $extraSql
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
            ;
    }


    /**
     * @param $appId
     * @param $countryConfiguredId
     * @param $countryClientId
     * @param $levelCategoryId
     * @param null $articlesId
     * @param \AppBundle\Entity\AppShopHasAppTab $appShopHasAppTab
     * @param null $payMethodsAvailable
     * @param null $externalStore
     * @param bool $orderByDefault
     * @param bool $articleActive
     * @param bool $articlePMPCAActive
     * @return AppHasPayMethodProviderCountry[]
     */
    public function findByAppIdAndCountryAndLevelCategoryandArticleIdAndAppTabAndStatus(
        $appId,
        $countryConfiguredId,
        $countryClientId,
        $levelCategoryId,
        $articlesId = null,
        AppShopHasAppTab $appShopHasAppTab = null,
        $payMethodsAvailable = null,
        $externalStore = null,
        $orderByDefault = true,
        $articleActive = true,
        $articlePMPCAActive = true
    ) {

        $params = array(
            'articlePMPCAActive'  => $articlePMPCAActive,
            'articleActive'       => $articleActive,
            'countryConfiguredId' => $countryConfiguredId,
            'countryClientId'     => $countryClientId,
            'appId'               => $appId,
            'levelCategoryId'     => $levelCategoryId,
            'payCategoryMobile'   => PayCategoryEnum::MOBILE_ID,
            'payCategoryVoice'    => PayCategoryEnum::VOICE_ID,
        );

        $extra = '';
        $extraPMPC = '';

        if ($articlesId)
        {
            $params['articlesId'] = $articlesId;
            $extra .= " AND a in (:articlesId)";
        }

        if ($appShopHasAppTab)
        {
            $extra .= " AND a in (:filter_articles)";

            if (!$appShopHasAppTab->getArticles()->isEmpty())
            {
                $params['filter_articles'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getArticles());
            }else{
                $params['filter_articles'] = [-999]; // because articles_filter is mandatory
            }

            if (!$appShopHasAppTab->getAppTab()->getArticleCategories()->isEmpty())
            {
                $extra .= " AND a.articleCategory in (:filter_articleCategoryIds) ";
                $params['filter_articleCategoryIds'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getAppTab()->getArticleCategories());
            }

            if (!$appShopHasAppTab->getAppTab()->getPayCategories()->isEmpty())
            {
                $extraPMPC .= " AND pay_method.payCategory in (:filter_payCategories)  ";
                $params['filter_payCategories'] = UtilHelper::getIdsArrayFromObjects($appShopHasAppTab->getAppTab()->getPayCategories());
            }

        }

        if ($payMethodsAvailable && count($payMethodsAvailable) > 0)
        {
            $params['payMethods'] = $payMethodsAvailable;
            $extraPMPC .= " AND pmp.payMethod in (:payMethods)";
        }

        if ($externalStore)
        {
            $params['externalStore'] = $externalStore;
            $extraPMPC .= "AND pmp.externalStore = :externalStore ";
        }else{
            $extraPMPC .= "AND pmp.externalStore IS NULL ";
        }

        $orderBy = $orderByDefault ? 'pmpc.order' : 'ahpmpc.order';

        $sql = "
            SELECT ahpmpc
            FROM AppBundle:AppHasPayMethodProviderCountry ahpmpc
                JOIN ahpmpc.app app
                JOIN ahpmpc.payMethodProviderHasCountry pmpc
                JOIN pmpc.payMethodHasProvider pmp
                JOIN pmp.payMethod pay_method

            WHERE
                ahpmpc.app = :appId
                AND pmpc.country = :countryClientId
                AND pmp.active = :articleActive
                AND pay_method.active = :articleActive
                AND pmpc.active = :articleActive
                AND ahpmpc.active = :articlePMPCAActive

                AND EXISTS(
                    SELECT 1
                    FROM AppBundle:AppShopHasArticle sha
                        LEFT JOIN sha.SMSs sms
                        LEFT JOIN sha.voices voice
                        JOIN sha.article a
                        JOIN a.app app2
                        JOIN a.item i
                        JOIN sha.appShop app_shop WITH app_shop.levelCategory = :levelCategoryId
                        JOIN app2.countries app_countries WITH sha.country = app_countries

                    WHERE
                        app2 = app
                        AND sha.country = :countryConfiguredId
                        AND a.articleCategory = pay_method.articleCategory
                        AND sha.active = :articlePMPCAActive
                        AND a.active = :articleActive
                        AND i.active = :articleActive
                        AND app_shop.active = :articleActive

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

                        $extra

                )

                $extraPMPC

                ORDER BY $orderBy

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
            ;
    }
}
