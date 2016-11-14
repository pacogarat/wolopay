<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PromoCode;

class PromoCodeRepository extends AbstractRepository
{
    /**
     * @param $code
     * @param $appId
     * @return PromoCode
     */
    public function findOneByCodeAndAppId($code, $appId)
    {
        $sql="
            SELECT pro
            FROM AppBundle:PromoCode pro
            WHERE
                pro.code = :code
                AND pro.app = :appId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('code' => $code, 'appId' => $appId))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $promoId
     * @param $code
     * @param $appId
     * @return PromoCode
     */
    public function findOneByPromoAndCodeAndAppId($promoId, $code, $appId)
    {
        $sql="
            SELECT pro
            FROM AppBundle:PromoCode pro
            JOIN pro.promo promo
            WHERE
                pro.code = :code
                AND pro.app = :appId
                AND promo.id = :promoId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('code' => $code, 'appId' => $appId, 'promoId'=>$promoId))
            ->getOneOrNullResult()
            ;
    }


    /**
     * @param $appId
     * @return PromoCode
     */
    public function findByAppId($appId)
    {
        $sql="
            SELECT pro
            FROM AppBundle:PromoCode pro
            WHERE
                pro.app = :appId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getOneOrNullResult()
        ;
    }
} 