<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Provider;

class ProviderRepository extends AbstractRepository
{
    /**
     * @param $hasClientCredentials
     * @return Provider
     */
    public function findByHasClientCredentials($hasClientCredentials = true)
    {
        $sql="SELECT p
            FROM AppBundle:Provider p
            WHERE
                p.hasClientCredentials = :hasClientCredentials
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('hasClientCredentials' => $hasClientCredentials))
            ->getResult()
        ;
    }
} 