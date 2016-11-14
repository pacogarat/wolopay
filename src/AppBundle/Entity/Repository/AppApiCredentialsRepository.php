<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppApiCredentials;

class AppApiCredentialsRepository extends AbstractRepository
{

    /**
     * @param $codeKey
     * @param $secretKey
     * @return AppApiCredentials|null
     */
    public function findByCodeKeyAndSecretKey($codeKey, $secretKey)
    {
        $sql="SELECT a
            FROM AppBundle:AppApiCredentials a
            WHERE
                a.active = true
                AND a.codeKey = :codeKey
                AND a.secretKey = :secretKey
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('codeKey' => $codeKey, 'secretKey' => $secretKey ))
            ->getOneOrNullResult();
        ;
    }

    /**
     * @param $codeKey
     * @param $active
     * @return AppApiCredentials|null
     */
    public function findByCodeKeyAndActive($codeKey, $active=true)
    {
        $sql="SELECT a
            FROM AppBundle:AppApiCredentials a
            WHERE
                a.active = :active
                AND a.codeKey = :codeKey
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('codeKey' => $codeKey, 'active' => $active ))
            ->getOneOrNullResult();
        ;
    }

    /**
     * @return AppApiCredentials
     */
    public function findDemo()
    {
        $sql="SELECT a
            FROM AppBundle:AppApiCredentials a
            JOIN a.app app
            where
              app.name = 'Demo'
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->getOneOrNullResult();
        ;
    }
}