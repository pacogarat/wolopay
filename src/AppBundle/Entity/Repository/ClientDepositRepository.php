<?php

namespace AppBundle\Entity\Repository;


use AppBundle\Entity\ClientDeposit;

class ClientDepositRepository extends AbstractRepository
{
    /**
     * @param $clientId
     * @return null|ClientDeposit
     */
    public function findLast($clientId)
    {
        $sql="
            SELECT d
            FROM AppBundle:ClientDeposit d
            WHERE
                d.client = :clientId
            ORDER BY d.usedUntilAt DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('clientId' => $clientId))
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
    }

} 