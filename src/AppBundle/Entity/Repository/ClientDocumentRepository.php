<?php

namespace AppBundle\Entity\Repository;


use AppBundle\Entity\FinInvoice;

class ClientDocumentRepository extends AbstractRepository
{
    /**
     * @param $ClientId
     * @param null $year
     * @param int $maxResult
     * @return FinInvoice[]
     */
    public function findByClientId($ClientId, $year = null, $maxResult=20)
    {
        $extraParams = [];
        $extraSql = '';

        if ($year)
        {
            $extraSql .= 'AND d.createdAt BETWEEN :dateFrom AND :dateTo';

            $extraParams['dateFrom'] = new \DateTime("$year-01-01 00:00:00");
            $extraParams['dateTo'] = new \DateTime(($year+1)."-01-01 00:00:00");
        }

        $sql="
            SELECT d
            FROM AppBundle:ClientDocument d
            LEFT JOIN d.finInvoice i
            WHERE
                d.client = :clientId
                AND ( i.id IS NULL OR i.forwardedForClientToAt IS NOT NULL)
                $extraSql
            ORDER BY d.createdAt DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['clientId' => $ClientId], $extraParams))
            ->setMaxResults($maxResult)
            ->getResult()
            ;
    }
} 