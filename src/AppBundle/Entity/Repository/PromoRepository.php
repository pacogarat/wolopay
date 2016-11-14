<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PromoCode;

class PromoRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @return PromoCode
     */
    public function findByAppId($appId,$first=null,$maxResult=null)
    {
        $sql="
            SELECT pro
            FROM AppBundle:Promo pro
            WHERE
                pro.app = :appId
            ORDER BY pro.createdAt DESC
        ";

        $query = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
        ;
        if ($first)
            $query->setFirstResult($first);

        if ($maxResult)
            $query->setMaxResults($maxResult);

        return $query
            ->getResult()
        ;
    }

    /**
     * @param $promoId
     * @param $appId
     * @return PromoCode
     */
    public function findOneByPromoIdAndAppId($promoId, $appId)
    {
        $sql="
            SELECT pro
            FROM AppBundle:Promo pro
            WHERE
                pro.id = :promo
                AND pro.app = :appId

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('promo' => $promoId, 'appId' => $appId))
            ->getOneOrNullResult()
        ;
    }
} 