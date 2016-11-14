<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PayMethodHasProvider;

class PayMethodHasProviderRepository extends AbstractRepository
{
    /**
     * @param $payMethodId
     * @param null $canBeCustomTransaction
     * @return PayMethodHasProvider[]
     */
    public function findByPayMethodIdAndCanBeCustomTransaction($payMethodId, $canBeCustomTransaction=null)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
                JOIN pmp.payMethod pm
                JOIN pmp.payMethodProviderHasCountries pmpc
            WHERE
                pmp.payMethod = :payMethod
                AND pmpc.active = true
                AND pmp.active = true
                AND pm.active = true
        ";

        $parameters = array(
            'payMethod' => $payMethodId,
        );

        if ($canBeCustomTransaction !== null)
        {
            $sql.= " AND pmp.canBeCustomTransaction = :canBeCustomTransaction";
            $parameters['canBeCustomTransaction'] = $canBeCustomTransaction;
        }

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult();
        ;
    }

    public function findByProviderId($providerId)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
            WHERE
                pmp.provider        = :providerId
        ";

        $parameters = array(
            'providerId'        => $providerId,
        );

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult()
        ;
    }

    public function findOneByPayMethodIdAndProviderId($payMethodId, $providerId)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
                JOIN pmp.payMethod pm
            WHERE
                pmp.payMethod       = :payMethodId
                AND pmp.provider        = :providerId
        ";

        $parameters = array(
            'payMethodId'       => $payMethodId,
            'providerId'        => $providerId,
        );

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getOneOrNullResult();

    }

    public function findOneByPayMethodIdAndProviderIdAndArticleCategoryId($payMethodId, $providerId, $articleCategoryId)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
                JOIN pmp.payMethod pm
            WHERE
                pmp.payMethod       = :payMethodId
                AND pmp.provider        = :providerId
                AND pmp.articleCategory = :articleCategoryId
        ";

        $parameters = array(
            'payMethodId'       => $payMethodId,
            'providerId'        => $providerId,
            'articleCategoryId' => $articleCategoryId,
        );

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getOneOrNullResult();
        ;
    }

    /**
     * @param bool $canBeCustomTransaction
     * @internal param $payMethodId
     * @return PayMethodHasProvider[]
     */
    public function findByCanBeCustomTransaction($canBeCustomTransaction)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
            WHERE
                pmp.canBeCustomTransaction = :canBeCustomTransaction
        ";

        $parameters = array(
            'canBeCustomTransaction' => $canBeCustomTransaction,
        );

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult();
        ;
    }

    /**
     * @param $payCategoryId
     * @param $articleCategoryId
     * @param $providerId
     * @return PayMethodHasProvider[]
     */
    public function findByPayCategoryIdAndArticleCategoryIdAndProvider($payCategoryId, $articleCategoryId, $providerId)
    {
        $sql="
            SELECT pmp
            FROM
                AppBundle:PayMethodHasProvider pmp
                JOIN pmp.payMethod pm
            WHERE
                pmp.provider = :providerId
                AND pm.payCategory= :payCategoryId
                AND pm.articleCategory = :articleCategoryId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array(
                    'payCategoryId'     => $payCategoryId,
                    'articleCategoryId' => $articleCategoryId,
                    'providerId'        => $providerId,
                ))
            ->getResult();
        ;
    }
}
