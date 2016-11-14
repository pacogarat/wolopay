<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Subscription;

class SubscriptionRepository extends AbstractRepository
{
    public function findOneByTransactionExternalId($transactionExternalId, $notInId = [])
    {
        $parameters = ['transactionExternalId' => $transactionExternalId];
        $extraSql = '';

        if ($notInId)
        {
            $parameters['not_transaction_id'] = $notInId;
            $extraSql = 'AND s.id NOT IN (:not_transaction_id) ';
        }

        $sql="
            SELECT s
            FROM AppBundle:Subscription s
            JOIN s.paymentDetail pd
            WHERE
              s.transactionExternalId = :transactionExternalId
              $extraSql
            order by s.createdAt desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getOneOrNullResult()
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
            FROM AppBundle:Subscription s
            JOIN s.paymentDetail pd
            $extraSql
            order by s.createdAt desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setMaxResults(1)
            ->setParameters($parameters)
            ->getOneOrNullResult()
        ;
    }

    public function findOneTransactionExternal($externalTransactionId, $excludeSubscriptionIds = null)
    {
        $parameters = ['externalTransactionId' => $externalTransactionId];
        $extraSql = '';

        if ($excludeSubscriptionIds)
        {
            $extraSql.= ' AND s.id NOT IN (:excludeIds) ';
            $parameters['excludeIds'] = $excludeSubscriptionIds;
        }

        $sql="
            SELECT s
            FROM AppBundle:Subscription s
            WHERE
              s.transactionExternalId = :externalTransactionId
              $extraSql
            ORDER BY s.createdAt DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param int $range Extra range days to avoid some month errors with 31 days or delay of providers
     * @return Subscription[]
     */
    public function findSubscriptionToExpire($range=3)
    {
        $sql="SELECT s
            FROM AppBundle:Subscription s
            WHERE
                s.statusCategory = ".PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID."
                AND CURRENT_DATE() >
                    (
                    select DATE_ADD( MAX( e.createdAt ) , (s.periodicity + $range), 'day' )
                    from AppBundle:SubscriptionEventuality e where e.subscription = s
                    )

            order by s.createdAt desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->getResult();
        ;
    }

    /**
     * @param int $range Extra range days to avoid some month errors with 31 days or delay of providers
     * @return Subscription[]
     */
    public function findSubscriptionToRenewAndNeedMakePaymentRequest($range=0, $test = false)
    {
        $sql="
            SELECT s
            FROM AppBundle:Subscription s
            JOIN s.paymentDetail pd
            JOIN pd.transaction t
            WHERE
                s.statusCategory = ".PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID."
                AND CURRENT_TIMESTAMP() >=
                    (
                    select DATE_ADD( MAX( e.createdAt ) , (s.periodicity + :range), 'day' )
                    from AppBundle:SubscriptionEventuality e where e.subscription = s
                    )
                AND s.needMakeRequestPayment = :needMakePaymentRequest
                AND t.test <> :test

            order by s.createdAt desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['range' => $range, 'needMakePaymentRequest' => true, 'test' => $test])
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param null $statusCategoryId
     * @param bool $test
     * @return Subscription[]
     */
    public function findByAppIdAndDateRange($appId, \DateTime $dateFrom=null, \DateTime $dateTo=null, $statusCategoryId = null, $test=false, $first=0, $maxResult=null, $filters)
    {
        $extraWhere = '';
        $extraParameters = [];
        if ($statusCategoryId)
        {
            $extraWhere = ' AND s.statusCategory = :statusCategoryId ';
            $extraParameters = ['statusCategoryId' => $statusCategoryId];
        }

        if ($test !== null)
        {
            $extraWhere .= ' AND t.test = :test ';
            $extraParameters['test'] = $test;
        }

        if ($dateFrom && $dateTo)
        {
            $extraWhere .= ' AND s.createdAt between :dateFrom AND :dateTo ';
            $extraParameters['dateFrom'] = $dateFrom;
            $extraParameters['dateTo'] = $dateTo;
        }

        $sql="SELECT s
            FROM AppBundle:Subscription s
            JOIN s.paymentDetail pd
            JOIN pd.payment pay
            LEFT JOIN pay.purchase p
            JOIN pd.transaction t
            JOIN t.gamer g

            WHERE
                s.app = :appId
                $extraWhere

        ";

        $this->loadFilters($sql, $extraParameters, $filters);

        $sql .='order by s.createdAt DESC';

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setFirstResult($first)
            ->setMaxResults($maxResult)
            ->setParameters(array_merge($extraParameters, array('appId' => $appId)))
            ->getResult()
        ;
    }



    /**
     * @param $gamerId
     * @param $articleId
     * @return array
     */
    public function countByGamerIdAndArticleIdGroupByArticle($gamerId, $articleId)
    {
        $sql="SELECT SUM(pdha.articlesQuantity) as num, IDENTITY (pdha.article) as article
            FROM AppBundle:Subscription s
            JOIN s.paymentDetail pd
            JOIN pd.paymentDetailHasArticles pdha
            WHERE
                pdha.article = :articleId
                AND s.gamer = :gamerId
                GROUP BY pdha.article
        ";

        $resultSql= $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('gamerId' => $gamerId, 'articleId'=>$articleId))
            ->getScalarResult();
        ;

        $result = 0;

        foreach ($resultSql as $row)
            $result = (int) $row['num'];

        return $result;
    }
} 