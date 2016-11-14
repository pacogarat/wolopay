<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Gamer;
use AppBundle\Entity\ItemTab;

class ItemTabRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @return Gamer
     */
    public function findByAppId($appId)
    {
        $sql="SELECT g
            FROM AppBundle:ItemTab g
            WHERE
                g.app = :appId

            ORDER BY g.order

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param $nameUnique
     * @return ItemTab
     */
    public function findOneByAppIdAndNameUnique($appId, $nameUnique)
    {
        $sql="
            SELECT i
            FROM AppBundle:ItemTab i
            WHERE
                i.app = :appId
                AND i.nameUnique = :nameUnique
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'nameUnique' => $nameUnique))
            ->getOneOrNullResult()
        ;
    }
} 