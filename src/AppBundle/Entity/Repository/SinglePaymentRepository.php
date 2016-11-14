<?php

namespace AppBundle\Entity\Repository;

class SinglePaymentRepository extends AbstractRepository
{
    public function findOneByExternalTransactionId($externalTransactionId)
    {
        $sql="
            SELECT s
            FROM AppBundle:SinglePayment s
            WHERE
                s.transactionExternalId = :transactionExternalId

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['transactionExternalId' =>$externalTransactionId])
            ->getOneOrNullResult();
        ;
    }

    public function findLast($transactionId=null)
    {
        $parameters = [];
        $extraSql = '';

        if ($transactionId)
        {
            $parameters['transactionId'] = $transactionId;
            $extraSql = 'WHERE pd.transaction = :transactionId ';
        }

        $sql="
            SELECT s
            FROM AppBundle:SinglePayment s
            JOIN s.paymentDetail pd
            $extraSql
            order by s.createdAt desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setMaxResults(1)
            ->setParameters($parameters)
            ->getOneOrNullResult();
        ;
    }
} 