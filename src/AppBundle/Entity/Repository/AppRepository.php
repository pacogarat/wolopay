<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\App;

class AppRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @param $clientId
     * @return null|App
     */
    public function findOneByAppIdAndClientId($appId, $clientId)
    {
        $sql="SELECT a
            FROM AppBundle:App a
            WHERE
                a = :appId
                AND a.client = :clientId
            ORDER BY a.createdAt ASC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'clientId' => $clientId))
            ->getOneOrNullResult();
        ;
    }

    /**
     * @param $clientId
     * @return App[]
     */
    public function findByAppAppClientId( $clientId)
    {
        $sql="SELECT a
            FROM AppBundle:App a
            WHERE
                 a.client = :clientId
            ORDER BY a.createdAt ASC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('clientId' => $clientId))
            ->getResult();
        ;
    }
} 