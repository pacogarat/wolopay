<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PayMethod;

class PayMethodRepository extends AbstractRepository
{
    /**
     * @param $payCategoryId
     * @param $articleCategoryId
     * @param $name
     * @return PayMethod
     */
    public function findOneByPayCategoryIdAndArticleCategoryIdAndName($payCategoryId, $articleCategoryId, $name)
    {
        $sql="
            SELECT pm
            FROM AppBundle:PayMethod pm
            WHERE
                pm.payCategory= :payCategoryId
                AND pm.articleCategory = :articleCategoryId
                AND pm.name = :name
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array('payCategoryId' => $payCategoryId, 'articleCategoryId' => $articleCategoryId, 'name' => $name)
            )
            ->getOneOrNullResult()
        ;
    }


    /**
     * @param $appId
     * @param null $active
     * @return PayMethod[]
     */
    public function findByAppId($appId, $active=null)
    {
        $sql="
            SELECT pm, pmp, pmpc, pmpc_sms, pmpc_voice, provider, cc, curr, pm_pay_category,
                continent, language
            FROM AppBundle:PayMethod pm
            JOIN pm.payMethodHasProvider pmp
            JOIN pm.payCategory pm_pay_category
            JOIN pmp.provider provider
            JOIN pmp.payMethodProviderHasCountries pmpc
            LEFT JOIN pmpc.SMSs pmpc_sms
            LEFT JOIN pmpc.voices pmpc_voice
            JOIN pmpc.country cc
            JOIN cc.continent continent
            JOIN cc.currency curr
            JOIN cc.language language
            JOIN pmpc.appHasPayMethodProviderCountries a_pmpcs
            JOIN a_pmpcs.app a
            JOIN a.countries c
            WHERE
                a = :appId

                AND pmpc.active = true
                AND pmp.active = true
                AND pm.active = true
        ".($active!== null ? " AND a_pmpcs.active = true" : '' )."
            order by pmp.order ASC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult()
            ;
    }

    /**
     * @param $appId
     * @param null $active
     * @param null $country
     * @param null $articleCategory
     * @param null $canBeCustomTransaction
     * @return PayMethod[]
     */
    public function findByCanBeCustom($appId, $active=null, $country=null, $articleCategory=null, $canBeCustomTransaction=null)
    {
        $params = array('appId' => $appId);
        $extraSql = '';

        if ($country)
        {
            $extraSql .= " AND pmpc.country = :country";
            $params['country'] = $country;
        }

        if ($active!== null )
        {
            $extraSql .= " AND a_pmpcs.active = :active";
            $params['active'] = $active;
        }

        if ($articleCategory !== null )
        {
            $extraSql .= " AND pm.articleCategory = :articleCategory";
            $params['articleCategory'] = $articleCategory;
        }

        if ($canBeCustomTransaction !== null )
        {
            $extraSql .= " AND pmp.canBeCustomTransaction= :canBeCustomTransaction";
            $params['canBeCustomTransaction'] = $canBeCustomTransaction;
        }

        $sql="
            SELECT pm

            FROM AppBundle:PayMethod pm
            JOIN pm.payMethodHasProvider pmp
            JOIN pm.payCategory pm_pay_category
            JOIN pmp.payMethodProviderHasCountries pmpc
            JOIN pmpc.appHasPayMethodProviderCountries a_pmpcs
            JOIN a_pmpcs.app a
            WHERE
                a = :appId

                AND pmpc.active = true
                AND pmp.active = true
                AND pm.active = true

                $extraSql

            order by pmp.order ASC
        ";


        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
            ;
    }


    /**
     * @param $appId
     * @param array $services
     * @param $PMPCCountries
     * @return PayMethod[]
     */
    public function findByAppIdAndPaymentServiceCategoriesIdAndCountries($appId, array $services, $PMPCCountries)
    {
        $sql="
            SELECT pm, pmp, pmpc, pmpc_c, pmpc_curr, pmpc_language, pmpc_continent, sms, voice
            FROM AppBundle:PayMethod pm
            JOIN pm.payMethodHasProvider pmp
            JOIN pmp.payMethodProviderHasCountries pmpc
            JOIN pmpc.country pmpc_c
            JOIN pmpc_c.currency pmpc_curr
            JOIN pmpc_c.language pmpc_language
            JOIN pmpc_c.continent pmpc_continent
            JOIN pmpc.appHasPayMethodProviderCountries ahpmpc
            JOIN ahpmpc.app a
            LEFT JOIN pmpc.SMSs sms WITH (sms.active = true)
            LEFT JOIN pmpc.voices voice
            WHERE
                a = :appId
                AND pmpc_c in (:PMPCCountries)
                AND pmp.paymentServiceCategory in (:services)
                AND pmpc.active = true
                AND pmp.active = true
                AND pm.active = true
                AND ahpmpc.active = true

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'services' => $services, 'PMPCCountries' => $PMPCCountries))
            ->getResult()
        ;
    }

}
