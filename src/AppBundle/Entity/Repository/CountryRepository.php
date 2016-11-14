<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\StatusCategoryEnum;

class CountryRepository extends AbstractRepository
{
    public function findByAppIdAndLevelCategoryAndArticlesStatus($appId, $levelCategoryId, $active = true)
    {
        $sql="
            SELECT c
            FROM AppBundle:Country c
            JOIN AppBundle:AppShopHasArticle sha WITH sha.country = c
            JOIN sha.appShop app_shop WITH app_shop.app = :appId AND app_shop.levelCategory = :levelCategory
            JOIN sha.article sha_a
            JOIN sha_a.articleHasPMPCs apmpc
            JOIN apmpc.payMethodProviderHasCountry as pmpc WITH pmpc.country = sha.country
            WHERE
              sha_a.active = :active
              AND apmpc.active = :active
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'active' => $active, 'levelCategory' => $levelCategoryId))
            ->getResult()
        ;
    }


    public function findByAppAndAllAvailableWithPMPC($appId=null, $onlyCountryEnabled=null, $pmpcs=null, $countries =null, $orContinents=null)
    {
        $sql="
            SELECT c
            FROM AppBundle:Country c
            JOIN AppBundle:PayMethodProviderHasCountry sha WITH sha.country = c
            WHERE
                1=1
        ";

        $params = [];

        if ($appId)
        {
            if ($countries)
            {
                $sql .= "AND (c in (:countries)";
                $params['countries']=$countries;

                if ($orContinents)
                {
                    $sql .= "OR c.continent in (:orContinents)";
                    $params['orContinents']=$orContinents;
                }

                $sql.=')';
            }

            $sql.="
                AND EXISTS (
                    SELECT 1 FROM AppBundle:App a
                    JOIN a.countries ac
                    JOIN a.appHasPayMethodProviderCountry apmpc
                    JOIN apmpc.payMethodProviderHasCountry pmpc
                    where
                        a = :appId
                        AND apmpc.active = :active
                ";

            if ($onlyCountryEnabled)
            {
                $sql .=' AND ac = c ';
            }

            if ($pmpcs)
            {
                $sql .= "AND pmpc in (:pmpcs)";
                $params['pmpcs'] = $pmpcs;
            }

            $sql .= ') ';

            $params['appId']  = $appId;
            $params['active'] = true;
        }

        $sql .=" ORDER BY c.name ASC ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
            ;
    }

    public function findAllStandard($standard = true)
    {
        $sql="
            SELECT c
            FROM AppBundle:Country c
            WHERE c.standard = :standard
            ORDER BY c.localName
            ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['standard' => $standard])
            ->getResult()
        ;
    }

    public function findStandardsByCountriesOrContinents($countries, $continents)
    {
        $sql="
            SELECT c
            FROM AppBundle:Country c
            WHERE
              c.standard = :standard
              AND c.id in (:countries)
              OR c.continent in (:continents)
            ORDER BY c.localName
            ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['standard' => true, 'countries' => $countries, 'continents' => $continents])
            ->getResult()
            ;
    }

    /**
     * @param bool $onlyConfigured
     * @param $appId
     * @param array $levelCategoryIds
     * @param null $countriesFilter
     * @param array|null $articlesAvailable
     * @param null $payMethodsAvailable
     * @param bool $active
     * @param bool $onlyCount
     * @param null $externalStore
     * @param bool $removeBlackListed
     * @return Country[]
     */
    public function findByAppIdAndLevelCategoryAndArticlesStatusInCountriesAvailable(
        $onlyConfigured = false,
        $appId,
        array $levelCategoryIds,
        $countriesFilter = null,
        $articlesAvailable = null,
        $payMethodsAvailable = null,
        $active = true,
        $onlyCount = false,
        $externalStore = null,
        $removeBlackListed = false
    ) {

        $params = array(
            'appId'             => $appId,
            'active'            => $active,
            'levelCategoryIds'   => $levelCategoryIds,
//            'payCategoryMobile' => PayCategoryEnum::MOBILE_ID,
//            'payCategoryVoice'  => PayCategoryEnum::VOICE_ID,
        );
        $extra='';
        $extraPMPC='';
        $extraArticles= '';

        if ($payMethodsAvailable && count($payMethodsAvailable) > 0)
        {
            $params['payMethods'] = $payMethodsAvailable;
            $extraPMPC .= "AND pmp.payMethod in ( :payMethods ) ";
        }

        if ($articlesAvailable && count($articlesAvailable) > 0)
        {
            $params['articles'] = $articlesAvailable;
            $extraArticles .= "AND a in ( :articles ) ";
        }

        if ($countriesFilter)
        {
            $extra .= " AND c in (:countriesFilter) ";
            $params['countriesFilter'] = $countriesFilter;
        }

        if ($externalStore)
        {
            $extraPMPC .= " AND pmp.externalStore = :externalStore ";
            $params['externalStore'] = $externalStore;
        } else {
            $extraPMPC .= " AND pmp.externalStore IS NULL ";
        }

        $select = "SELECT c";

        if ($onlyCount)
            $select = "SELECT COUNT(c) ";

        $sql="
            $select
            FROM AppBundle:Country c
            WHERE
                1 = 1
                $extra
        ";

        if ($onlyConfigured)
        {
            $sql .= "
                AND EXISTS(
                    SELECT 1
                    FROM AppBundle:App apx
                        JOIN apx.countries apx_c
                    WHERE
                        apx = :appId
                        AND apx_c = c

                )
            ";
        }

        $existArticlesSql = "
            SELECT 1
            FROM AppBundle:AppShopHasArticle sha
                JOIN sha.article a
                JOIN sha.appShop app_shop WITH app_shop.levelCategory in (:levelCategoryIds) AND app_shop.app = :appId
                JOIN app_shop.app app
                JOIN a.item i
                LEFT JOIN sha.offer offer
                LEFT JOIN sha.SMSs sms
                LEFT JOIN sha.voices voice

            WHERE
                app = :appId

                ".($onlyConfigured ? 'AND sha.country = c' : '')."
                AND ( (a.validFrom is null) OR (a.validFrom <= CURRENT_TIMESTAMP()) )
                AND ( (a.validTo is null) OR (a.validTo > CURRENT_TIMESTAMP()) )
                AND i.active = :active
                AND app_shop.active = :active
                AND sha.active = :active

                AND a.active = :active

                $extraArticles
        ";

        $existsPMPCSql = "
            SELECT 1
            FROM AppBundle:AppHasPayMethodProviderCountry ahpmpc
                JOIN ahpmpc.payMethodProviderHasCountry pmpc
                JOIN pmpc.payMethodHasProvider pmp
                JOIN pmp.payMethod pay_method

            WHERE
                ahpmpc.app = :appId
                ".(!$onlyConfigured ? 'AND pmpc.country = c' : '')."
                AND pmp.active = :active
                AND pay_method.active = :active
                AND pmpc.active = :active
                AND ahpmpc.active = :active

                $extraPMPC
        ";

        $commonFiltersForLastChildExists = "

            ";

//        AND pay_method.articleCategory = a.articleCategory
//            AND (
//                pay_method.payCategory != :payCategoryMobile
//                OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = false )
//                OR (pay_method.payCategory = :payCategoryMobile AND pmp.isOurImplementation = true AND sms.payMethodProviderHasCountry = pmpc.id )
//            )
//            AND (
//                pay_method.payCategory != :payCategoryVoice
//                OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = false )
//                OR (pay_method.payCategory = :payCategoryVoice AND pmp.isOurImplementation = true AND voice.payMethodProviderHasCountry = pmpc.id)
//            )
//        ";

        if ($onlyConfigured)
        {
            $sql .=    "
                AND EXISTS(
                    $existArticlesSql
                    AND EXISTS(
                         $existsPMPCSql
                         $commonFiltersForLastChildExists
                    )
                )
            ";
        }else{

            $sql .=    "
                AND EXISTS(
                    $existsPMPCSql
                    AND EXISTS(
                         $existArticlesSql
                         $commonFiltersForLastChildExists
                    )
                )
            ";

        }

        if ($removeBlackListed)
        {
            $sql .= "
                AND NOT EXISTS(
                    SELECT 1
                    FROM AppBundle:App appb
                        JOIN appb.blacklistedCountries blc
                    WHERE
                        appb = :appId
                        AND blc = c
            )";
        }

        if ($onlyCount)
        {
            return $this->getEntityManager()
                ->createQuery($sql)
                ->setParameters($params)
                ->getSingleScalarResult()
            ;
        }

        $sql .= " ORDER BY c.order, c.name";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
            ;
    }

} 