<?php

namespace AppBundle\Entity\Repository;

class PromoCodeUsedByGamerRepository extends AbstractRepository
{
    public function countCodeUsesByGamer($code, $gamerId)
    {
        $sql="SELECT count(p)
            FROM AppBundle:PromoCodeUsedByGamer p
            WHERE
                p.promoCode = :code
                AND p.gamer = :gamerId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('gamerId' => $gamerId, 'code' => $code))
            ->getSingleScalarResult();
        ;
    }

    public function countCodesUsesByPromoAndGamer($promoId, $gamerId)
    {
        $sql="SELECT count(p)
            FROM AppBundle:PromoCodeUsedByGamer p
            JOIN p.promoCode pc
            WHERE
                pc.promo = :promoId
                AND p.gamer = :gamerId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('gamerId' => $gamerId, 'promoId' => $promoId))
            ->getSingleScalarResult();
        ;
    }

} 