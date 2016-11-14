<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Gamer;

class GamerRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @param $gamerExternalId
     * @return Gamer
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */
    public function findOneByAppIdAndGamerExternalId($appId, $gamerExternalId)
    {
        $sql="SELECT g
            FROM AppBundle:Gamer g
            WHERE
                g.gamerExternalId = :gamerExternalId
                AND g.app = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('gamerExternalId' => $gamerExternalId, 'app' => $appId))
            ->useResultCache(false)
            ->getOneOrNullResult()
        ;
    }

    public function findByAppId($appId)
    {
        $sql="SELECT g
            FROM AppBundle:Gamer g
            WHERE
                g.app = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->useResultCache(false)
            ->getResult()
            ;
    }

    public function findRandByAppId($appId, $onlyDemo = false)
    {
        $sql="SELECT g
            FROM AppBundle:Gamer g
            WHERE
                g.app = :app ";
        if ($onlyDemo) $sql .= " AND g.gamerExternalId like 'DEMO_%'";
        $sql.= " ORDER BY Rand() ";

        $sal=$this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->setMaxResults(1)
            ->useResultCache(false)
            ->getOneOrNullResult();

        return $sal;
    }


    public function findByAppIdAndNotDemo($appId)
    {
        $sql="SELECT g
            FROM AppBundle:Gamer g
            WHERE
                g.app = :app
                AND g.gamerExternalId not like 'DEMO_%'
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->useResultCache(false)
            ->getResult()
            ;
    }

    /**
     * @param $appId
     * @return Gamer
     */
    public function findOneByAppIdAndNotDemoAndHadBought($appId)
    {
        $sql="SELECT g
            FROM AppBundle:Gamer g
            JOIN AppBundle:Purchase p
            WHERE
                g.app = :app
                AND p.gamer = g

            ORDER BY Rand()
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->useResultCache(false)
            ->setMaxResults(1)
            ->getOneOrNullResult()
            ;
    }
} 