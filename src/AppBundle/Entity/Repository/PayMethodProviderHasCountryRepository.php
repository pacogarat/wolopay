<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\ExternalStoreEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\PayMethodProviderHasCountry;

class PayMethodProviderHasCountryRepository extends AbstractRepository
{
    /**
     * @param null $countriesFilter
     * @param bool $default
     * @return PayMethodProviderHasCountry[]
     */
    public function findByDefault($countriesFilter=null, $default=true) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc

            WHERE
                pmpc.default = :default

        ";

        $params = array(
            'default' => $default,
        );

        if ($countriesFilter)
        {
            $sql.= " AND pmpc.country in (:countries) ";
            $params['countries'] = $countriesFilter;
        }

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult();
    }

    /**
     * General like 'facebook' ...
     *
     * @param $pmpc
     * @param $countryId
     * @return PayMethodProviderHasCountry|null|object
     */
    public function findOneByGeneralPMPCOrId($pmpc, $countryId)
    {
        $payMethodProviderHasCountry = null;

        switch ($pmpc)
        {
            case ExternalStoreEnum::FACEBOOK:

                $payMethodProviderHasCountry = $this->findOneByPayMethodNameAndProviderNameAndCountryId(
                    PayMethodEnum::FACEBOOK_NAME, ProviderEnum::FACEBOOK_NAME, $countryId
                );
                break;
            case ExternalStoreEnum::FACEBOOK.'-subscription':

                $payMethodProviderHasCountry = $this->findOneByPayMethodNameAndProviderNameAndCountryId(
                    PayMethodEnum::FACEBOOK_SUBSCRIPTION_NAME, ProviderEnum::FACEBOOK_NAME, $countryId
                );
                break;
            case ExternalStoreEnum::STEAM:

                $payMethodProviderHasCountry = $this->findOneByPayMethodNameAndProviderNameAndCountryId(
                    PayMethodEnum::STEAM_CLIENT_NAME, ProviderEnum::STEAM_NAME, $countryId
                );
                break;
            case ExternalStoreEnum::STEAM_WEB:

                $payMethodProviderHasCountry = $this->findOneByPayMethodNameAndProviderNameAndCountryId(
                    PayMethodEnum::STEAM_WEB_NAME, ProviderEnum::STEAM_NAME, $countryId
                );
                break;
        }

        if (!$payMethodProviderHasCountry)
            $payMethodProviderHasCountry = $this->find($pmpc);

        return $payMethodProviderHasCountry;
    }

    /**
     * @param array $paymentServices
     * @param $appId
     * @param null $countryId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByPaymentServicesAndAppIdAndCountryId(array $paymentServices, $appId, $countryId=null)
    {
        $parameters = [
            'paymentServices'=>$paymentServices,
            'appId' => $appId,
        ];

        $extraSQL = '';

        if ($countryId)
        {
            $parameters['countryId'] = $countryId;
            $extraSQL.=' AND pmpc.country = :countryId';
        }

        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            WHERE
                 pmpc in (
                    select pmp_filter
                    from AppBundle:App a
                      JOIN a.appHasPayMethodProviderCountry ahpmpc
                      JOIN ahpmpc.payMethodProviderHasCountry pmp_filter
                    where a = :appId
                 )
                 AND pmp.paymentServiceCategory in (:paymentServices)
                 $extraSQL
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult();
    }

    /**
     * @param $providerId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByProviderId($providerId) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            WHERE
                pmp.provider = :providerId

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('providerId' => $providerId))
            ->getResult();
    }

    /**
     * @param $providerId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByProviderIdAndActive($providerId) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.provider pro
            WHERE
                pmp.provider = :providerId
                AND pro.active = TRUE

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('providerId' => $providerId))
            ->getResult();
    }

    /**
     * @param $providerId
     * @param $countryId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByProviderIdAndCountryId($providerId, $countryId) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp

            WHERE
                pmpc.country = :countryId
                AND pmp.provider = :providerId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array(
                'countryId'   => $countryId,
                'providerId'  => $providerId))
            ->getResult();
    }

    /**
     * @param $providerId
     * @param $countryId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByProviderIdAndCountryIdAndActive($providerId, $countryId) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.provider prov
            WHERE
                pmpc.country = :countryId
                AND pmp.provider = :providerId
                AND pmp.active = TRUE
                AND prov.active = TRUE
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array(
                'countryId'   => $countryId,
                'providerId'  => $providerId))
            ->getResult();
    }

    /**
     * @param $providerId
     * @param array $countriesIds
     * @return PayMethodProviderHasCountry[]
     */
    public function findByProviderIdAndCountriesIdsAndActive($providerId,array $countriesIds) {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            WHERE
                pmp.provider = :providerId AND
                pmpc.country in (:countries) AND
                pmp.active = true AND
                pmpc.active = true

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(  'providerId' => $providerId,
                        'countries'=> $countriesIds))
            ->getResult();
    }

    /**
     * @param $payMethodId
     * @param $providerId
     * @param $countryId
     * @return PayMethodProviderHasCountry
     */
    public function findOneByPayMethodIdAndProviderIdAndCountryId($payMethodId, $providerId, $countryId)
    {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp

            WHERE
                pmpc.country = :countryId
                AND pmp.provider = :providerId
                AND pmp.payMethod = :payMethodId

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'countryId'   => $countryId,
                'providerId'  => $providerId,
                'payMethodId' => $payMethodId,
            )
        )->getOneOrNullResult();
    }


    /**
     * BE CAREFUL if some paymethods or provider has the same name it'll crash
     *
     * @param $payMethodName
     * @param $providerName
     * @param $countryId
     * @return PayMethodProviderHasCountry
     */
    public function findOneByPayMethodNameAndProviderNameAndCountryId($payMethodName, $providerName, $countryId)
    {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.provider p
            JOIN pmp.payMethod pm

            WHERE
                pmpc.country = :countryId
                AND p.name = :providerName
                AND pm.name = :payMethodName

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'countryId'   => $countryId,
                'providerName'  => $providerName,
                'payMethodName' => $payMethodName,
            )
        )->getOneOrNullResult();
    }

    /**
     * @param $payMethodId
     * @param $countryId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByPayMethodIdCountryId($payMethodId, $countryId)
    {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp

            WHERE
                pmpc.country = :countryId
                AND pmp.payMethod = :payMethodId

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'countryId'   => $countryId,
                'payMethodId' => $payMethodId,
            )
        )->getResult();
    }

    /**
     * @param $payMethodId
     * @param $countryId
     * @param $appId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByPayMethodIdCountryIdAndAppIdAndActive($payMethodId, $countryId, $appId)
    {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.payMethod pm

            WHERE
                pmpc.country = :countryId
                AND pmp.payMethod = :payMethodId
                AND pmpc.active = :active
                AND pmp.active = :active
                AND pm.active = :active

                AND EXISTS(
                    SELECT 1
                    FROM AppBundle:AppHasPayMethodProviderCountry apmpc WITH pmpc.id = apmpc.payMethodProviderHasCountry
                    JOIN apmpc.app a
                    WHERE
                        a = :appId
                        AND apmpc.active = :active
                )
        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'countryId'   => $countryId,
                'payMethodId' => $payMethodId,
                'appId' => $appId
            )
        )->getResult();
    }


    /**
     * @param $payMethodName
     * @param $payCategoryId
     * @param $articleCategory
     * @param $providerId
     * @param $countryId
     * @return PayMethodProviderHasCountry
     */
    public function findOneByPayMethodNameAndProviderIdAndCountryId($payMethodName, $payCategoryId, $articleCategory, $providerId, $countryId)
    {
        $sql = "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.payMethod pm

            WHERE
                pmpc.country = :countryId
                AND pmp.provider = :providerId
                AND pm.payCategory = :payCategoryId
                AND pm.articleCategory = :articleCategory
                AND pm.name = :payMethodName

        ";

        return $this->getEntityManager()->createQuery($sql)->setParameters(
            array(
                'countryId'       => $countryId,
                'providerId'      => $providerId,
                'payCategoryId'   => $payCategoryId,
                'articleCategory' => $articleCategory,
                'payMethodName'   => $payMethodName,
            )
        )->getOneOrNullResult();
    }

    /**
     * @param $appId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByApp($appId) {

        return $this->getEntityManager()->createQuery(self::sqlFindByApp())->setParameters(
            array(
                'appId' => $appId,
            )
        )->getResult();
    }

    /**
     * @param bool $count
     * @param $appId
     * @param $maxPercentage
     * @param null $minPercentage
     * @return PayMethodProviderHasCountry[]|int
     */
    public function findByAppAndSomeFilters($count = false, $appId, $maxPercentage = null, $minPercentage = null) {

        $select = $count ? 'SELECT count(pmpc.id)' : "SELECT pmpc";

        $extraSQL = '';

        $params = ['appId' => $appId];

        if ($maxPercentage)
        {
            $extraSQL.= 'AND (pmpc.feeProviderPercent >= :maxPercentage OR (pmpc.feeProviderPercent IS NULL AND pmp.feeProviderPercent >= :maxPercentage))';
            $params['maxPercentage'] = $maxPercentage;
        }

        if ($minPercentage)
        {
            $extraSQL.= 'AND (pmpc.feeProviderPercent <= :minPercentage OR (pmpc.feeProviderPercent IS NULL AND pmp.feeProviderPercent <= :minPercentage))';
            $params['minPercentage'] = $minPercentage;
        }

        $q = $this->getEntityManager()->createQuery("
            $select
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.payMethod pm

            JOIN AppBundle:AppHasPayMethodProviderCountry ahpmpc WITH ahpmpc.payMethodProviderHasCountry = pmpc
            JOIN ahpmpc.app app

            WHERE
                app = :appId
                AND pmpc.active = true
                AND pmp.active = true
                AND pm.active = true

                $extraSQL
              ")
            ->setParameters($params);


        if ($count)
            return (int) $q->getSingleScalarResult();

        return $q->getResult();
    }

    /**
     * @param $appId
     * @param array $articleCategoryIds
     * @return PayMethodProviderHasCountry[]
     */
    public function findByAppAndArticleCategoryId($appId, array $articleCategoryIds)
    {
        return $this->getEntityManager()
            ->createQuery( "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.appHasPayMethodProviderCountry ahpmpc
            JOIN ahpmpc.app app
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.payMethod pm

            WHERE
              app = :appId
              AND pm.articleCategory in (:articleCategoryIds)

              ")
            ->setParameters(
                array(
                    'appId'              => $appId,
                    'articleCategoryIds' => $articleCategoryIds
                )
            )->getResult();
    }

    /**
     * @param $countryId
     * @param bool $canBeCustomTransaction
     * @return PayMethodProviderHasCountry[]
     */
    public function findByCountryAndCanBeCustomTransaction($countryId, $canBeCustomTransaction=true)
    {
        return $this->getEntityManager()
            ->createQuery( "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp

            WHERE
              pmp.canBeCustomTransaction = :canBeCustomTransaction
              AND pmpc.country = :countryId

              ")
            ->setParameters(
                array(
                    'countryId' => $countryId,
                    'canBeCustomTransaction' => $canBeCustomTransaction
                )
            )->getResult();
    }

    /**
     * @param $appId
     * @return PayMethodProviderHasCountry[]
     */
    public function findIfNotExistInAppShopArticleHasPMPC($appId)
    {
        return $this->getEntityManager()
            ->createQuery( "
                SELECT pmpc
                FROM AppBundle:PayMethodProviderHasCountry pmpc
                JOIN pmpc.appHasPayMethodProviderCountries ahpmpc
                JOIN ahpmpc.app app
                JOIN app.appShops app_shop
                JOIN app_shop.appShopHasArticles ash_a
                LEFT JOIN ash_a.appShopArticleHasPMPCs asa_pmpc WITH pmpc = asa_pmpc.payMethodProviderHasCountry

                WHERE
                  app = :appId
                  AND ash_a.active = true
                  AND asa_pmpc is NULL

              ")
            ->setParameters(
                array(
                    'appId' => $appId,
                )
            )->getResult();
    }

    static public function sqlFindByPayCategoriesIds()
    {
        return "SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.payMethodHasProvider pmp
            JOIN pmp.payMethod pm

            WHERE
              pm.payCategory in (:payCategories)";
    }

    static public function sqlFindByApp()
    {
        return "
            SELECT pmpc
            FROM AppBundle:PayMethodProviderHasCountry pmpc
            JOIN pmpc.appHasPayMethodProviderCountry ahpmpc
            JOIN ahpmpc.app app

            WHERE
              app = :appId
              ";
    }
}
