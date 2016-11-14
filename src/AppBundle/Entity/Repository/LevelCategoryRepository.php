<?php

namespace AppBundle\Entity\Repository;

class LevelCategoryRepository extends AbstractRepository
{
    public function findAvailableByAppId($appId)
    {
        $sql="SELECT l
            FROM AppBundle:LevelCategory l
            JOIN AppBundle:AppShop ashop WITH ashop.levelCategory = l
            WHERE
                ashop.app = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->getResult();
        ;
    }


    public function findByAppId($appId)
    {
        $sql="
            SELECT l
            FROM AppBundle:LevelCategory l
            WHERE
                (l.app = :app AND l.isGeneric = 0)
                OR (l.isGeneric = 1)
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->getResult();
        ;
    }
} 