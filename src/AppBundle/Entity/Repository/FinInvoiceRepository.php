<?php

namespace AppBundle\Entity\Repository;


use AppBundle\Entity\Enum\FinInvoiceCategoryEnum;
use AppBundle\Entity\FinInvoice;

class FinInvoiceRepository extends AbstractRepository
{
    /**
     * @param $clientId
     * @param string $categoryId
     * @return null|FinInvoice
     */
    public function findLastIssuedInvoiceFromClient($clientId, $categoryId = FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID)
    {
        $sql="SELECT f
            FROM AppBundle:FinInvoice f
            JOIN f.finInvoiceCategory c
            WHERE
                f.companyTo = :clientId
                AND c.id = :categoryId
            ORDER BY f.referenceDate DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('clientId' => $clientId, 'categoryId' => $categoryId))
            ->setMaxResults(1)
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param $clientId
     * @param string $categoryId
     * @return null|FinInvoice
     */
    public function findLastApprovedInvoiceFromClient($clientId, $categoryId = FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID)
    {
        $sql="SELECT f
            FROM AppBundle:FinInvoice f
            JOIN f.finInvoiceCategory c
            WHERE
                f.companyTo = :clientId
                AND c.id = :categoryId
                AND (f.requireApproval <> 1 OR (f.requireApproval = 1 AND f.approvedAt is NOT NULL ))
            ORDER BY f.referenceDate DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('clientId' => $clientId, 'categoryId' => $categoryId))
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
    }

    public function findWasExecutedAndSuccessFull($clientId, $referenceDate)
    {
         $sql="
            SELECT f
            FROM AppBundle:FinInvoice f
            WHERE
                (f.companyTo = :clientId OR f.companyFrom = :clientId)
                AND (f.forwardedForClientToAt IS NOT NULL OR f.approvedAt IS NOT NULL)
                AND f.referenceDate = :referenceDate
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('clientId' => $clientId, 'referenceDate' => $referenceDate))
            ->getResult()
            ;
    }

    /**
     * @param $externalClientIdNotWolopay
     * @param $dateReference
     * @return FinInvoice[]
     */
    public function findInvoicesGeneratedInSameProcess($externalClientIdNotWolopay, $dateReference)
    {
        $sql="
            SELECT f
            FROM AppBundle:FinInvoice f
            WHERE
                f.referenceDate = :dateReference
                AND (f.companyTo = :clientId OR f.companyFrom = :clientId)
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('dateReference' => $dateReference, 'clientId' => $externalClientIdNotWolopay))
            ->getResult()
            ;
    }

    /**
     * @param null $dateTime
     * @return FinInvoice[]
     */
    public function findDeclined($dateTime = null)
    {
        if ($dateTime)
            $dateTime = new \DateTime();

        $sql="
            SELECT f
            FROM AppBundle:FinInvoice f
            WHERE
                f.declinedAt < :dateTime

            ORDER BY f.referenceDate DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('dateTime' => $dateTime))
            ->getResult()
            ;
    }

    /**
     * @return FinInvoice[]
     */
    public function findRemainingForward()
    {
        $sql="
            SELECT f
            FROM AppBundle:FinInvoice f
            WHERE
                f.forwardForClientToAt <= :dateForwardForClient
                AND f.forwardedForClientToAt IS NULL

            ORDER BY f.referenceDate ASC, f.externalCompanyNotWolopay
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('dateForwardForClient' => new \DateTime()))
            ->getResult()
            ;
    }

    /**
     * @param bool $count
     * @param bool $requireApproval
     * @param $andNotApprovedOrDeclined
     * @return FinInvoice[]
     */
    public function findRequireApprove($count=false, $requireApproval = true, $andNotApprovedOrDeclined = false)
    {
        if ($count)
            $select = 'SELECT count(f.id)';
        else
            $select = 'SELECT f';

        $extraWhere = '';

        if ($andNotApprovedOrDeclined)
        {
            $extraWhere .= '
            AND f.declinedAt is null
            AND f.approvedAt is null';
        }

        $sql="
            $select
            FROM AppBundle:FinInvoice f
            JOIN f.finInvoiceCategory c
            WHERE
                f.requireApproval = :requireApproval
                $extraWhere
            ORDER BY f.referenceDate ASC, f.externalCompanyNotWolopay, f.id ASC
        ";

        $q = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('requireApproval' => $requireApproval))
        ;

        if ($count)
            return (int) $q->getSingleScalarResult();

        return $q->getResult();
    }


    /**
     * @param $ClientId
     * @param null $year
     * @param int $maxResult
     * @return FinInvoice[]
     */
    public function findOnlyValidByClientId($ClientId, $year = null, $maxResult=20)
    {
        $extraParams = [];
        $extraSql = '';

        if ($year)
        {
            $extraSql .= 'AND f.referenceDate BETWEEN :dateFrom AND :dateTo';

            $extraParams['dateFrom'] = new \DateTime("$year-01-01 00:00:00");
            $extraParams['dateTo'] = new \DateTime(($year+1)."-01-01 00:00:00");
        }

        $sql="
            SELECT f
            FROM AppBundle:FinInvoice f
            WHERE
                f.forwardedForClientToAt IS NOT NULL
                AND f.approvedAt IS NOT NULL
                AND (f.companyTo = :clientId OR f.companyFrom = :clientId)
                $extraSql
            ORDER BY f.referenceDate DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['clientId' => $ClientId], $extraParams))
            ->setMaxResults($maxResult)
            ->getResult()
            ;
    }

    /**
     * @param $clientId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @return int
     */
    public function removeUnApprovedInvoices($clientId, \DateTime $dateFrom, \DateTime $dateTo)
    {
        $sql="
            DELETE
            FROM AppBundle:FinInvoice f
            WHERE
                f.forwardedForClientToAt IS NULL
                AND f.approvedAt IS NULL
                AND (f.companyTo = :clientId OR f.companyFrom = :clientId)
                AND f.referenceDate BETWEEN :dateFrom AND  :dateTo
        ";

        $rowsAffected = $this->_em
            ->createQuery($sql)
            ->setParameters(['clientId' => $clientId, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo])
            ->execute()
        ;

        $lastDeposit = $this->_em->getRepository("AppBundle:ClientDeposit")->findLast($clientId);
        $lastDeposit->setUsedUntilAt(null);

        $this->_em->flush($lastDeposit);

        return $rowsAffected;
    }
} 