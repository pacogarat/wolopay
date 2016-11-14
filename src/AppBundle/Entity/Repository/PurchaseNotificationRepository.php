<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PurchaseNotification;

class PurchaseNotificationRepository extends AbstractRepository
{
    public function findOneByPartialPayment($partialPaymentId, $isExtraPurchase = false)
    {
        $sql="SELECT n
            FROM AppBundle:PurchaseNotification n
            JOIN n.purchases purchase
            WHERE
                purchase.partialPayment = :partialPaymentId
                AND n.isExtra = :isExtraPurchase
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('partialPaymentId' => $partialPaymentId, 'isExtraPurchase' => $isExtraPurchase))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param bool $isReadyToNotify
     * @param bool $wasReceived
     * @return PurchaseNotification[]
     */
    public function findByIsReadyToNotifyAndWasReceived($isReadyToNotify=true, $wasReceived=false)
    {
        $sql="SELECT n
            FROM AppBundle:PurchaseNotification n
            JOIN n.app a

            WHERE
                n.wasReceived = :wasReceived
                AND n.isReadyToNotify = :isReadyToNotify
                AND (n.forceToNotify = 1 OR n.attempts < a.notificationRetriesOnFailure)
                AND (n.minDelay IS NULL OR n.minDelay < CURRENT_TIMESTAMP() )
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('isReadyToNotify' => $isReadyToNotify, 'wasReceived' => $wasReceived))
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param null $test
     * @param int $first
     * @param null $maxResult
     * @param array $filters
     * @return PurchaseNotification[]
     */
    public function findByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo, $test=null, $first = 0, $maxResult=null, $filters = [])
    {
        $sql="SELECT n
            FROM AppBundle:PurchaseNotification n
            JOIN n.purchases p
            JOIN p.gamer g
            WHERE
                n.app = :appId AND n.createdAt between :dateFrom AND :dateTo
                 ".($test === null ? '' : ' AND p.test = :test ' )."
        ";

        $extraParams = [];

        $this->loadFilters($sql, $extraParams, $filters);

        $sql .= ' order by n.createdAt DESC ';


        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setFirstResult($first)
            ->setMaxResults($maxResult)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getResult();
        ;
    }
} 