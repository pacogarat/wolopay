<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Transaction;
use AppBundle\Helper\StatsHelper;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\Query;

class PurchaseRepository extends AbstractRepository
{
    /**
     * This value is wrong because is impossible take transactions and revenue in same Query
     *
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $dateFormat
     * @param string $currencyResult
     * @param int $offset
     * @param bool $test
     * @internal param string $dateFormat
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByGamerLevel(
        $appId,
        \DateTime $dateFrom,
        \DateTime $dateTo,
        $dateFormat,
        $currencyResult = CurrencyEnum::EURO,
        $offset = 2,
        $test = false
    )
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $sql="SELECT l.name as shop, l.id as shop_id,
            count( l.id ) as num_shops,
            count( DISTINCT t.id ) as num_transactions,
            count( DISTINCT t.gamer ) as num_unique_gamers,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider, sum(p.amountWolo * $change) amount_wolopay,
            sum(p.amountGame * $change) amount_game,
            CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                END as date_format
            FROM AppBundle:Transaction t
                JOIN t.levelCategory l
                LEFT JOIN t.purchases p
            WHERE
                p.app = :appId
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                        AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )
                  )
                ".($test === null ? '' : ' AND p.test = :test ' )."
            GROUP BY date_format, l.id
            ORDER BY l.id
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

        $countLevel = $revenueLevel = $uniqueGamers = $transactions = [];

        foreach ($sqlResult as $line)
        {
            if (!isset($countLevel[$line['shop']]))
                $countLevel[$line['shop']] = [];

            if (!isset($revenueLevel[$line['shop']]))
                $revenueLevel[$line['shop']] = [];

            if (!isset($uniqueGamers[$line['shop']]))
                $uniqueGamers[$line['shop']] = [];

            if (!isset($transactions[$line['shop']]))
                $transactions[$line['shop']] = [];


            $uniqueGamers[$line['shop']][$line['date_format']] = (int) $line['num_unique_gamers'];
            $transactions[$line['shop']][$line['date_format']] = (int) $line['num_transactions'] ;
            $countLevel[$line['shop']][$line['date_format']] = (int) $line['num_shops'];

            $revenueLevel[$line['shop']][$line['date_format']] = (float) $line['amount_game'] ;
        }

        foreach ($countLevel as $index => $lvl)
            $countLevel[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        foreach ($revenueLevel as $index => $lvl)
            $revenueLevel[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        foreach ($transactions as $index => $lvl)
            $transactions[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        foreach ($uniqueGamers as $index => $lvl)
            $uniqueGamers[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        return [
            'count_level' => $countLevel,
            'revenue_level' => $revenueLevel,
            // This value is wrong because is impossible take transactions and revenue in same Query
            'transactions' => $transactions,
            'unique_gamers' => $uniqueGamers,
        ];
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param bool $test
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat= 'months', $groupByDisable = false, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);
        $sql="SELECT count(DISTINCT p.gamer) as num,
            DATE_FORMAT(p.createdAt, $dateFormatStr ) as date_format
            FROM AppBundle:Purchase p
            WHERE
                p.app = :appId
                 AND (    (p.createdAt between :dateFrom AND :dateTo) )
                ".($test === null ? '' : ' AND p.test = :test ' )."
        ";

        if (!$groupByDisable)
            $sql .= 'GROUP BY date_format';

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;

        if ($groupByDisable)
            return $sqlResult[0]['num'];


        $result=[];

        foreach ($sqlResult as $line)
        {
            $result[$line['date_format']] = (int) $line['num'] ;
        }

        $result=StatsHelper::fillAllStats($result, $dateFrom, $dateTo, $dateFormat);

        return $result;
    }


    /**
     * todo
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByPayMethodTop5AndOthers($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat= 'months'
        , $currencyId = CurrencyEnum::EURO, $offset=2, $test=false, $includeNegatives=true)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyId == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyId == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $sql="SELECT l.name as shop, l.id as shop_id,
            count( p.id ) as num_purchases,
            count( DISTINCT t.gamer ) as num_unique_gamers,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider, sum(p.amountWolo * $change) amount_wolopay
            , sum(p.amountGame * $change) amount_game,
            DATE_FORMAT( DATE_ADD(t.beginAt, $offset, 'hour'), $dateFormatStr) as date_format_old,
            CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
            END as date_format
            FROM AppBundle:Transaction t
                JOIN t.levelCategory l
                LEFT JOIN t.purchases p
            WHERE
                t.app = :appId
                AND ((p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                    OR (p.id is not null "
                    . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL  ")
                    . " AND (    (p.createdAt between :dateFrom AND :dateTo) )
                    )
                ) ".($test === null ? '' : ' AND p.test = :test ' )."
            GROUP BY p.payMethod
            ORDER BY amount_game
        ";


        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;

        $amountGame = [];

        foreach ($sqlResult as $line)
        {
            $amountGame[$line['date_format']] = (int) $line['amount_game'] ;
        }

        $result=StatsHelper::fillAllStats($amountGame, $dateFrom, $dateTo, $dateFormat, $offset);

        return $result;
    }


    /**
     * @param $purchaseId
     * @param bool $notificationReceived
     * @return Purchase
     */
    public function findOneByIdAndNotificationReceived($purchaseId, $notificationReceived = false)
    {
        $sql="SELECT p
            FROM AppBundle:Purchase p
            WHERE
                p.id = :purchaseId
                AND p.notificationReceived = :notificationReceived

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('purchaseId' => $purchaseId, 'notificationReceived' => $notificationReceived))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $transactionId
     * @return Purchase[]
     */
    public function findByTransaction($transactionId)
    {
        $sql="SELECT p
            FROM AppBundle:Purchase p
            WHERE
                p.transaction = :transaction
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('transaction' => $transactionId))
            ->getResult();
        ;
    }

    /**
     * @param $partialId
     * @return Purchase[]
     */
    public function findByPartial($partialId)
    {
        $sql="SELECT p
            FROM AppBundle:Purchase p
            WHERE
                p.partialPayment = :partialId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('partialId' => $partialId))
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsGroupedByLevelCategoryAndTabNameAndArticleId($appId, \DateTime $dateFrom, \DateTime $dateTo
        , $currencyResult = CurrencyEnum::EURO, $test=false, $includeNegatives=true)
    {
        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $calculateExtraCosts = function($field) use ($change){
            $prefix=$field.'vx';
            return "(select SUM($prefix.$field) FROM AppBundle:Purchase $prefix WHERE $prefix.extraCostFromParent = p.id)";
        };

        $sql="SELECT
            l.name,
            CASE WHEN (pdha.tabName is null) THEN 'Virtual' ELSE pdha.tabName END as tab_name,
            a.id as article_id,
            count(DISTINCT (COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as purchases,
             GROUP_CONCAT(DISTINCT p.id) as purchs,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider,
            sum(p.amountWolo * $change) amount_wolopay,
            sum(pdha.articlesQuantity * p.amountGame * (pdha.amount/p.amountTotal) * $change) amount_game
            FROM AppBundle:Purchase p
            JOIN p.transaction t
            JOIN t.levelCategory l
            JOIN p.payment payment
            JOIN payment.paymentDetail detail
            JOIN detail.paymentDetailHasArticles pdha
            JOIN pdha.article a
            WHERE
             payment.amount IS NOT NULL AND payment.amount >0 AND
                p.app = :appId
                AND ( (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                      OR ( p.id is not null "
                           . ($includeNegatives ? "" : " AND p.extraCostFromParent IS NULL ")
                           . " AND (   (p.createdAt BETWEEN :dateFrom AND :dateTo) or (p.lastUpdateAt BETWEEN :dateFrom AND :dateTo) )
                      )
                    )

                ".($test === null ? '' : ' AND p.test = :test ' ).
            "
            GROUP BY l.id, pdha.tabName, a.id
            ORDER BY l.id, pdha.tabName, a.id
            ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;

        $visitedArr = array();
        /*
         * one purchase, 2 articles, cancelled, and uncancelled... take a look at this case... how to process it?
        SELECT * FROM purchase p WHERE p.id='WOP_572a310744d4b' OR p.extra_cost_from_parent_id='WOP_572a310744d4b'  ;
        */
        foreach ($sqlResult as &$row)
        {
//            $row['amount_total'] = (float) $row['amount_total'] + $row['amount_total_extra'];
//            $row['amount_provider'] = (float) $row['amount_provider'] + $row['amount_provider_extra'];
//            $row['amount_wolopay'] = (float) $row['amount_wolopay'] + $row['amount_wolopay_extra'];
//            $row['amount_game'] = (float) $row['amount_game'] + $row['amount_game_extra'];
            $row['purchases'] = (int) $row['purchases'];
            $trs = $row['purchs'];
            $purchases="";
            $first=true;
            $arr = explode(",",$trs);
            foreach ($arr as $value) {
                if (in_array($value,$visitedArr)) continue;
                array_push($visitedArr,$value);
                if (!$first) $purchases .= ",";
                $purchases .= "'$value'";
                $first=false;
            }

            if ($purchases<>"") {
                $result2 = $this->getEntityManager()
                    ->createQuery(
                        "SELECT
                      SUM(p.amountTotal * $change) as amount_total_extra,
                      SUM(p.amountProvider * $change) as amount_provider_extra,
                      SUM(p.amountWolo * $change) as amount_wolopay_extra,
                      SUM(p.amountGame * $change) as amount_game_extra
                     FROM AppBundle:Purchase p
                     WHERE p.extraCostFromParent IN (" . $purchases . ") and p.test=0
                 ")->getResult();

                foreach ($result2 as $k => $v) {
                    $row['amount_total'] = (float)$row['amount_total'] + (float)$v['amount_total_extra'];
                    $row['amount_provider'] = (float)$row['amount_provider'] + (float)$v['amount_provider_extra'];
                    $row['amount_wolopay'] = (float)$row['amount_wolopay'] + (float)$v['amount_wolopay_extra'];
                    $row['amount_game'] = (float)$row['amount_game'] + (float)$v['amount_game_extra'];
                }
            }else{
                $row['amount_total'] = (float)$row['amount_total'] ;
                $row['amount_provider'] = (float)$row['amount_provider'];
                $row['amount_wolopay'] = (float)$row['amount_wolopay'];
                $row['amount_game'] = (float)$row['amount_game'];

            }
//            unset($row['amount_total_extra'], $row['amount_provider_extra'], $row['amount_wolopay_extra'], $row['amount_game_extra']);
        }

        return $sqlResult;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $noIncludeGift
     * @param string $dateFormat
     * @param bool $distinctGamer
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo, $noIncludeGift = false
        , $dateFormat='months', $distinctGamer = false, $offset=2, $test=false, $includeNegatives=true)
    {

        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        if ($distinctGamer)
            $sql = "SELECT count(distinct p.gamer) as num, ";
        else
            $sql = "SELECT count(DISTINCT p.id) as num, ";

        $sql .= "DATE_FORMAT( DATE_ADD(t.beginAt, $offset, 'hour'), $dateFormatStr) as date_format_old,
                 CASE WHEN t.beginAt<:dateFrom THEN
                      CASE WHEN p.createdAt < :dateFrom THEN
                        DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                      ELSE
                        DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                      END
                 ELSE
                      DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                 END as date_format
                FROM AppBundle:Purchase p
                    JOIN p.transaction t
                    JOIN p.payMethod pm
                WHERE
                    p.app = :appId
                    AND (  (p.createdAt between :dateFrom AND :dateTo) ) "
                    . ($includeNegatives? "" : " t.beginAt between :dateFrom AND :dateTo AND p.extraCostFromParent IS NULL ")
                    . ($test === null ? '' : " AND p.test = :test " )
                    . ($noIncludeGift ? ' AND pm.payCategory <> \''.PayCategoryEnum::PROMO_CODE_ID.'\'' : '')."";

        if ($dateFormat)
            $sql .=' GROUP BY date_format ';

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;
        $result=[];

        foreach ($sqlResult as $line)
        {
            $result[$line['date_format']] = (int) $line['num'] ;
        }

        if ($dateFormat)
            $result=StatsHelper::fillAllStats($result, $dateFrom, $dateTo, $dateFormat, $offset);

        return $result;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param bool $distinctGamer
     * @param bool $test
     * @return array
     */
    public function statsRefundsByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo
        , $dateFormat='months', $distinctGamer = false, $offset=2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        if ($distinctGamer)
            $sql ="SELECT count(distinct p.gamer) as num";
        else
            $sql="SELECT count(DISTINCT(IDENTITY(p.extraCostFromParent))) as num";

        $sql .= ", DATE_FORMAT( DATE_ADD(p.createdAt, $offset, 'hour'), $dateFormatStr) as date_format
            FROM AppBundle:Purchase p
                JOIN p.transaction t
            WHERE
                p.app = :appId
                 AND (    (p.createdAt between :dateFrom AND :dateTo) )
                AND p.extraCostFromParent IS NOT NULL
                AND p.amountTotal <0
                ".($test === null ? '' : ' AND p.test = :test ' );

        if ($dateFormat)
            $sql .=' GROUP BY date_format ';

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;
        $result=[];

        foreach ($sqlResult as $line)
        {
            $result[$line['date_format']] = (int) $line['num'] ;
        }

        if ($dateFormat)
            $result=StatsHelper::fillAllStats($result, $dateFrom, $dateTo, $dateFormat, $offset);

        return $result;
    }
    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param CurrencyEnum $currencyResult
     * @param string $dateFormat
     * @param bool $distinctGamer
     * @param int $offset
     * @param bool $test
     * @return array
     */
    public function statsRefundsAmountByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, $dateFormat='months', $distinctGamer = false, $offset=2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );


        if ($distinctGamer)
            $sql ="SELECT count(distinct p.gamer) as amount";
        else
            $sql="SELECT sum(p.amountTotal * $change) as amount";

        $sql .= ", DATE_FORMAT( DATE_ADD(p.createdAt, $offset, 'hour'), $dateFormatStr ) as date_format
                FROM AppBundle:Purchase p
                    JOIN p.transaction t
                WHERE
                    p.app = :appId
                     AND (    (p.createdAt between :dateFrom AND :dateTo) )
                    AND p.extraCostFromParent IS NOT NULL
                    AND p.amountTotal <0
                    ".($test === null ? '' : ' AND p.test = :test ' );

        if ($dateFormat)
            $sql .=' GROUP BY date_format ';

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;
        $result=[];

        foreach ($sqlResult as $line)
        {
            $result[$line['date_format']] = (float) $line['amount'] ;
        }

        if ($dateFormat)
            $result=StatsHelper::fillAllStats($result, $dateFrom, $dateTo, $dateFormat, $offset);

        return $result;
    }


    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $noIncludeGift
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsPieByAppIdAndDateRangeAndGroupByPayMethodAndPayCategory($appId, \DateTime $dateFrom, \DateTime $dateTo, $noIncludeGift = false, $test = false, $includeNegatives=true)
    {
        $sql="SELECT CONCAT( pm.name , ', ', pay.name ) as name, count(p.id) as num
            FROM AppBundle:Purchase p
            JOIN p.transaction t
            JOIN p.payMethod pm
            JOIN pm.payCategory pay
            WHERE
                p.app = :appId
                AND t.beginAt between :dateFrom AND :dateTo
                AND (     (p.createdAt between :dateFrom AND :dateTo) )
                    "
                . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                . ($noIncludeGift ? ' AND pm.payCategory <> \''.PayCategoryEnum::PROMO_CODE_ID.'\'' : '')
                . ($test === null ? '' : ' AND p.test = :test ' )."
                GROUP BY pm.id, pay.id
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $noIncludeGift
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsPieByAppIdAndDateRangeAndGroupByArticles($appId, \DateTime $dateFrom, \DateTime $dateTo, $noIncludeGift = false, $test = false, $includeNegatives=true)
    {
        $sql="SELECT CONCAT( a.itemsQuantity, ' ', i.name)  as name, count(p.id) as num";

        $sql.="
            FROM AppBundle:Purchase p
            JOIN p.transaction t
            JOIN p.payment payment
            JOIN payment.paymentDetail detail
            JOIN detail.paymentDetailHasArticles pdha
            JOIN pdha.article a
            JOIN a.item i
            JOIN p.payMethod pm
            WHERE
                p.app = :appId
                 AND (    (p.createdAt between :dateFrom AND :dateTo) )"
                . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                . ($noIncludeGift ? ' AND pm.payCategory <> \''.PayCategoryEnum::PROMO_CODE_ID.'\'' : '')."
                ".($test === null ? '' : ' AND p.test = :test ' )."
                GROUP BY a.id
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;


        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $dateFormat
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByCountry($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat, $test=false, $includeNegatives=true, $offset=2)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql = "SELECT IDENTITY(t.countryDetected) as country, count(p.id) as num";
        $sql.= ",DATE_FORMAT(DATE_ADD(t.beginAt, $offset, 'hour'), $dateFormatStr) as date_format";
        $sql.= "
            FROM AppBundle:Purchase p
            JOIN p.transaction t
            WHERE
                p.app = :appId
                AND (     (p.createdAt between :dateFrom AND :dateTo) )"
                . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                . ($test === null ? '' : ' AND p.test = :test ' ).
                "GROUP BY date_format, p.country";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $resultSql= $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;

        $result = [];
        foreach ($resultSql as $row)
        {
            $result[$row['date_format']][$row['country']]= (int) $row['num'];
        }

        return $result;
    }

    /**
     * @param array $appIds
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param $dateFormat
     * @param string $groupBy
     * @param int $offset
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function fullStatsByAppIdAndDateRangeAndGroupByCountry(array $appIds, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, $dateFormat='months', $groupBy = 'date_format, c', $offset=2, $test=false, $includeNegatives=true)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $sql="SELECT c.name as country, c.id as country_iso,
            count(DISTINCT(COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as purchases,
            count(DISTINCT g.id) as gamers,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider, sum(p.amountWolo * $change) amount_wolopay, sum(p.amountGame * $change) amount_game,
            DATE_FORMAT( DATE_ADD (t.beginAt, $offset, 'hour') , $dateFormatStr) as date_format
            FROM AppBundle:Purchase p
            JOIN p.transaction t
            LEFT JOIN t.countryDetected c
            JOIN p.gamer g
            WHERE
                p.app in (:appIds)
                AND (     (p.createdAt between :dateFrom AND :dateTo) )"
                . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                . ($test === null ? '' : ' AND p.test = :test ' )."
            GROUP BY $groupBy
            ORDER BY date_format
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $result = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appIds' => $appIds, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

        foreach ($result as &$row)
        {
//            $row['transactions'] = (int) $row['transactions'];
            $row['purchases'] = (int) $row['purchases'];
            $row['gamers'] = (int) $row['gamers'];

            $row['amount_total'] = (float) $row['amount_total'];
            $row['amount_provider'] = (float) $row['amount_provider'];
            $row['amount_wolopay'] = (float) $row['amount_wolopay'];
            $row['amount_game'] = (float) $row['amount_game'];
        }

        return $result;
    }

    /**
     * @param array $clientIds
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param $dateFormat
     * @param string $groupBy
     * @param int $offset
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByClientIdAndDateRangeAndGroupByAffiliate(array $clientIds, \DateTime $dateFrom, \DateTime $dateTo,
                                                                       $currencyResult = CurrencyEnum::EURO, $dateFormat='months',
                                                                       $groupBy = 'date_format, affiliate', $offset = 2, $test = false, $includeNegatives=true)
    {
        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="SELECT
            CASE WHEN (g.externalAffiliateId IS NULL) THEN 'no_affiliate' ELSE g.externalAffiliateId END as affiliate,
            count(DISTINCT g.id) as gamers,
            count(DISTINCT (COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as purchases,
            sum(p.amountTotal * $change) as amount_total,
            sum(p.amountGame * $change) amount_game,
            DATE_FORMAT( DATE_ADD (t.beginAt, $offset, 'hour') , $dateFormatStr) as date_format_old,
            CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
            END as date_format
            FROM AppBundle:Transaction t
            JOIN t.app a
            JOIN a.client c
            JOIN t.gamer g
            LEFT JOIN AppBundle:Purchase p WITH t = p.transaction

            WHERE
                c.id in (:clientIds) AND c.active=1
                AND((p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null "
                        . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL  AND t.beginAt between :dateFrom AND :dateTo ")
                        . "
                         AND (     (p.createdAt between :dateFrom AND :dateTo))
                        )
                ) ".($test === null ? '' : ' AND p.test = :test ' )."
            GROUP BY $groupBy
            ORDER BY date_format
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $resultSql = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['clientIds' => $clientIds, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

        $result = [];
        $result['gamers'] = $result['purchases'] = $result['amount_total'] = $result['amount_game'] = array();
        foreach ($resultSql as $row)
        {
            $result['gamers'][$row['affiliate']][$row['date_format']]      = (int) $row['gamers'];
            $result['purchases'][$row['affiliate']][$row['date_format']]   = (int) $row['purchases'];
            $result['amount_total'][$row['affiliate']][$row['date_format']]= (float) $row['amount_total'];
            $result['amount_game'][$row['affiliate']][$row['date_format']] = (float) $row['amount_game'];
        }

        foreach ($result['gamers'] as $aff => $data){
            $result['gamers'][$aff] = StatsHelper::fillAllStats($data,$dateFrom, $dateTo, $dateFormat,$offset);
        }
        foreach ($result['purchases'] as $aff => $data){
            $result['purchases'][$aff] = StatsHelper::fillAllStats($data,$dateFrom, $dateTo, $dateFormat,$offset);
        }
        foreach ($result['amount_total'] as $aff => $data){
            $result['amount_total'][$aff] = StatsHelper::fillAllStats($data,$dateFrom, $dateTo, $dateFormat,$offset);
        }
        foreach ($result['amount_game'] as $aff => $data){
            $result['amount_game'][$aff] = StatsHelper::fillAllStats($data,$dateFrom, $dateTo, $dateFormat,$offset);
        }
        return $result;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $dateFormat
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByGamer($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat='months', $test = false, $includeNegatives = true, $offset=2)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="SELECT g.gamerExternalId as gamer, count(p.id) as num,
            DATE_FORMAT(DATE_ADD(p.createdAt,$offset,'hour'), $dateFormatStr) as date_format
            FROM AppBundle:Purchase p
            JOIN p.gamer g

            WHERE
                p.app = :appId
                 AND (    (p.createdAt between :dateFrom AND :dateTo)) "
                . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                . ($test === null ? '' : ' AND p.test = :test ' )."
                GROUP BY date_format, p.gamer
        ";
        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;


        $resultSql= $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo],$extraParams))
            ->getScalarResult();
        ;

        $result = [];
        foreach ($resultSql as $row)
        {
            $result[$row['date_format']][$row['gamer']]=$row['num'];
        }

        return $result;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $gateway
     * @return Query
     */
    public function findAllValidPurchaseByClient($appId, \DateTime $dateFrom, \DateTime $dateTo, $gateway = false)
    {
        $sql="
            Select
                p

            FROM AppBundle:Purchase p
                JOIN p.app a
                JOIN p.provider pro
                JOIN p.currency c
                JOIN p.transaction t
                JOIN p.payment pa

            WHERE
                p.test <> 1
                AND p.usedAppProviderCredentials = :gateway
                AND t.id like '".Transaction::PREFIX."%' and p.id like '".Purchase::PREFIX."%'
                AND (     (p.createdAt between :dateFrom AND :dateTo) )
                AND a.id = :appId

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo, 'gateway' => $gateway])
            ->iterate();
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $gateway
     * @return array
     */
    public function arrayAllValidPurchaseByClientGroupByCurrency($appId, \DateTime $dateFrom, \DateTime $dateTo, $gateway = false)
    {
        $sql="
            SELECT
                c.id as currency,
                SUM (p.amountGame) as amountGame,
                SUM (p.amountTotal) as amountTotal,
                SUM (p.amountTax) as amountTax,
                SUM (p.amountProvider) as amountProvider,
                SUM (p.amountWolo) as amountWolo,
                count(DISTINCT(t.id)) as transactions

            FROM AppBundle:Purchase p
                JOIN p.app a
                JOIN p.currency c
                JOIN p.transaction t

            WHERE
                p.test <> 1
                AND p.usedAppProviderCredentials = :gateway
                AND (    (p.createdAt between :dateFrom AND :dateTo))
                AND a.id = :appId

            GROUP BY c.id
            ORDER BY amountTotal desc
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo, 'gateway' => $gateway])
            ->getScalarResult();
    }

    /**
     * @param $appId
     * @param $gamerId
     * @param \DateTime $dateFrom
     * @param bool $test
     *
     * @return Purchase[]
     */
    public function totalAmountByAppIdAndGamerIdFromDate($appId, $gamerId, \DateTime $dateFrom, $test=false){
        $extraParams="";
        $sql="
            SELECT SUM(p.amountTotal * p.exchangeRateEur) as amount_total
            FROM AppBundle:Purchase p
            WHERE
                p.app = :appId AND
                (p.createdAt > :dateFrom ) AND
                p.gamer = :gamerId
                ".($test === null ? '' : ' AND p.test = :test ' )."
        ";

        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'gamerId'=>$gamerId, 'dateFrom'=>$dateFrom],$extraParams))
            ->getSingleScalarResult();
    }


    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool|null $test
     * @param int $first
     * @param $maxResult
     * @param array $filters
     * @param string $customSelect
     * @return Purchase[]
     */
    public function findByAppIdAndDateRange($appId, \DateTime $dateFrom, \DateTime $dateTo, $test=false, $first=0, $maxResult=null, $filters = [], $customSelect = 'p')
    {
//        p, pay, t, g, pd, pdha
        $sql="SELECT $customSelect
            FROM
             AppBundle:Purchase p
            JOIN p.transaction t
            JOIN t.gamer g
            LEFT JOIN p.payment pay
            LEFT JOIN pay.paymentDetail pd
            LEFT JOIN pd.paymentDetailHasArticles pdha
            WHERE
                p.app = :appId
                AND (    (p.createdAt between :dateFrom AND :dateTo) OR (p.createdAt < :dateFrom) AND (p.lastUpdateAt BETWEEN :dateFrom AND :dateTo) )
                ".($test === null ? '' : ' AND t.test = :test ' )."
            ";

        $extraParams = [];

        $this->loadFilters($sql, $extraParams, $filters);

        $sql.=" ORDER BY p.createdAt DESC";

        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setFirstResult($first)
            ->setMaxResults($maxResult)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getResult()
        ;
    }

    /**
     * @return Purchase[]
     */
    public function findExtraCosts($test=false)
    {
        $sql="SELECT p
            FROM AppBundle:Purchase p
            WHERE
                 ".($test === null ? '' : ' AND p.test = :test ' )."
                AND p.extraCostFromParent IS NOT NULL
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($extraParams)
            ->getResult()
            ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param string $dateFormat
     * @param null $onlySubscriptions
     * @param $onlyOffers
     * @param string $operation
     * @param int $offsetHours
     * @param bool $offsetGamerCountry
     * @param bool $test
     * @return array
     */
    public function totalAllAmountsByAppIdAndDateRange($appId, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult = CurrencyEnum::EURO, $dateFormat = 'months', $onlySubscriptions = null, $onlyOffers = null,
        $operation = 'SUM', $offsetHours = 2, $offsetGamerCountry=false, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $extraParams = [];
        if (!$offsetGamerCountry )
            $extraParams['hours'] = $offsetHours ;

        $orderBy = 'date_format';
        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
                ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
            );

        $extraSQL = '';

        $sql="
            SELECT $operation(p.amountGame * $change) as amount_game, $operation(p.amountProvider * $change) as amount_provider
                , $operation(p.amountTotal * $change) as amount_total , $operation(p.amountWolo * $change) as amount_pg ";
        $sql.= ",

         CASE WHEN t.beginAt<:dateFrom THEN
             CASE WHEN p.createdAt < :dateFrom THEN
                DATE_FORMAT(DATE_ADD (p.lastUpdateAt, ".($offsetGamerCountry ? ' cDetected.utcDstOffset ' : ":hours") .", 'hour'), $dateFormatStr)
             ELSE
                DATE_FORMAT(DATE_ADD (p.createdAt, ".($offsetGamerCountry ? ' cDetected.utcDstOffset ' : ":hours") .", 'hour'), $dateFormatStr)
             END
         ELSE
            DATE_FORMAT(DATE_ADD (t.beginAt, ".($offsetGamerCountry ? ' cDetected.utcDstOffset ' : ":hours") .", 'hour'), $dateFormatStr)
         END as date_format ";

        if ($onlySubscriptions !== null)
        {
            $extraSQL .= 'AND ';
            if ($onlySubscriptions)
                $extraSQL .= 'subp.id IS NOT NULL ';
            else
                $extraSQL .= 'subp.id IS NULL ';
        }

        if ($onlyOffers !== null)
        {
            $extraSQL .= 'AND ';
            if ($onlyOffers)
                $extraSQL .= 'pdha.offerProgrammer IS NOT NULL ';
            else
                $extraSQL .= 'pdha.offerProgrammer IS NULL ';
        }

        $sql.= "
            FROM AppBundle:Transaction t
            LEFT JOIN AppBundle:Purchase p WITH t = p.transaction
            LEFT JOIN t.countryDetected cDetected
            JOIN p.currency c
            LEFT JOIN AppBundle:SubscriptionEventualityPayment subp WITH p.payment = subp
            LEFT JOIN AppBundle:PaymentDetailHasArticles pdha WITH pdha.paymentDetail = p.payment
            WHERE
                p.app = :appId
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                           AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )

                  )
                ".($test === null ? '' : ' AND p.test = :test ' )."
                $extraSQL
            GROUP BY date_format
            ORDER BY $orderBy
        ";

        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(
                    [
                        'appId'       => $appId,
                        'dateFrom'    => $dateFrom,
                        'dateTo'      => $dateTo,
                    ],
                    $extraParams
                ))
            ->getScalarResult()
        ;

        $resultAmountGame=$resultAmountProvider=$resultAmountTotal=$resultAmountPg=[];
        $sumAmountGame=$sumAmountProvider=$sumAmountTotal=$sumAmountPg= 0;

        foreach ($sqlResult as $line)
        {
            $resultAmountGame[$line['date_format']] = (float) $line['amount_game'] ;
            $resultAmountProvider[$line['date_format']] = (float) $line['amount_provider'] ;
            $resultAmountTotal[$line['date_format']] = (float) $line['amount_total'] ;
            $resultAmountPg[$line['date_format']] = (float) $line['amount_pg'] ;

            $sumAmountGame+=$line['amount_game'];
            $sumAmountProvider+=$line['amount_provider'];
            $sumAmountTotal+=$line['amount_total'];
            $sumAmountPg+=$line['amount_pg'];
        }

        $resultAmountGame=StatsHelper::fillAllStats($resultAmountGame, $dateFrom, $dateTo, $dateFormat, $offsetHours);
        $resultAmountProvider=StatsHelper::fillAllStats($resultAmountProvider, $dateFrom, $dateTo, $dateFormat, $offsetHours);
        $resultAmountTotal=StatsHelper::fillAllStats($resultAmountTotal, $dateFrom, $dateTo, $dateFormat, $offsetHours);
        $resultAmountPg=StatsHelper::fillAllStats($resultAmountPg, $dateFrom, $dateTo, $dateFormat, $offsetHours);

        return [
            'amounts_game'         => $resultAmountGame,
            'amounts_game_sum'     => $sumAmountGame,
            'amounts_provider'     => $resultAmountProvider,
            'amounts_provider_sum' => $sumAmountProvider,
            'amounts_total'        => $resultAmountTotal,
            'amounts_total_sum'    => $sumAmountTotal,
            'amounts_wolo'         => $resultAmountPg,
            'amounts_wolo_sum'     => $sumAmountPg,
        ];
    }


    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param string $dateFormat
     * @param int $offset
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function totalAllAmountsByAppIdAndDateRangeByDays($appId, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult = CurrencyEnum::EURO, $dateFormat = 'days', $offset=2, $test=false, $includeNegatives=true)
    {

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="
            SELECT
                sum(p.amountTotal * $change) as amount_total ,
                SUM (CASE WHEN p.amountTotal>0 THEN (p.amountTotal * $change) ELSE 0 END) as amount_total_positive,
                SUM (CASE WHEN p.amountTotal<0 THEN (p.amountTotal * $change) ELSE 0 END) as amount_total_negative,

                sum(p.amountGame * $change) as amount_game,
                SUM (CASE WHEN p.amountTotal>0 THEN (p.amountGame * $change) ELSE 0 END) as amount_game_positive,
                SUM (CASE WHEN p.amountTotal<0 THEN (p.amountGame * $change) ELSE 0 END) as amount_game_negative,

                sum(p.amountProvider * $change) as amount_provider,
                sum(p.amountTax * $change) as amount_taxes,

                sum(p.amountWolo * $change) as amount_pg,

                CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                END as date_format

                FROM AppBundle:Transaction t
                LEFT JOIN AppBundle:Purchase p WITH t = p.transaction
                JOIN p.currency c
                WHERE
                t.test<> 1 AND
                    t.app = :appId"
                    ." AND((p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                           OR (p.id is not null "
                           . ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ")
                           . " AND (   (p.createdAt between :dateFrom AND :dateTo) )
                           )
                        ) ".($test === null ? '' : ' AND t.test = :test ' )."
                    GROUP BY date_format
                    ORDER BY date_format
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

        $resultAmountGame=$resultAmountProvider=$resultAmountTotal=$resultAmountPg=$resultAmountTax=$resultAmountTotalPositive=$resultAmountTotalNegative=$resultAmountGamePositive=$resultAmountGameNegative=[];
        $sumAmountGame=$sumAmountProvider=$sumAmountTotal=$sumAmountPg=$sumAmountTax=$sumAmountTotalPositive=$sumAmountTotalNegative=$sumAmountGamePositive=$sumAmountGameNegative= 0;

        foreach ($sqlResult as $line)
        {
            $resultAmountGame[$line['date_format']] = (float) $line['amount_game'] ;
            $resultAmountProvider[$line['date_format']] = (float) $line['amount_provider'] ;
            $resultAmountTotal[$line['date_format']] = (float) $line['amount_total'] ;
            $resultAmountPg[$line['date_format']] = (float) $line['amount_pg'] ;
            $resultAmountTax[$line['date_format']] = (float) $line['amount_taxes'] ;
            $resultAmountTotalPositive[$line['date_format']] = (float) $line['amount_total_positive'] ;
            $resultAmountTotalNegative[$line['date_format']] = (float) $line['amount_total_negative'] ;
            $resultAmountGamePositive[$line['date_format']] = (float) $line['amount_game_positive'] ;
            $resultAmountGameNegative[$line['date_format']] = (float) $line['amount_game_negative'] ;

            $sumAmountGame+=$line['amount_game'];
            $sumAmountProvider+=$line['amount_provider'];
            $sumAmountTotal+=$line['amount_total'];
            $sumAmountPg+=$line['amount_pg'];
            $sumAmountTax+=$line['amount_taxes'];
            $sumAmountTotalPositive+=$line['amount_total_positive'];
            $sumAmountTotalNegative+=$line['amount_total_negative'];
            $sumAmountGamePositive+=$line['amount_game_positive'];
            $sumAmountGameNegative+=$line['amount_game_negative'];
        }



        $resultAmountGame=StatsHelper::fillAllStats($resultAmountGame, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountProvider=StatsHelper::fillAllStats($resultAmountProvider, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountTotal=StatsHelper::fillAllStats($resultAmountTotal, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountPg=StatsHelper::fillAllStats($resultAmountPg, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountTax=StatsHelper::fillAllStats($resultAmountTax, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountTotalPositive=StatsHelper::fillAllStats($resultAmountTotalPositive, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountTotalNegative=StatsHelper::fillAllStats($resultAmountTotalNegative, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountGamePositive=StatsHelper::fillAllStats($resultAmountGamePositive, $dateFrom, $dateTo, $dateFormat, $offset);
        $resultAmountGameNegative=StatsHelper::fillAllStats($resultAmountGameNegative, $dateFrom, $dateTo, $dateFormat, $offset);


        return [
            'amounts_game'         => $resultAmountGame,
            'amounts_game_sum'     => $sumAmountGame,
            'amounts_provider'     => $resultAmountProvider,
            'amounts_provider_sum' => $sumAmountProvider,
            'amounts_total'        => $resultAmountTotal,
            'amounts_total_sum'    => $sumAmountTotal,
            'amounts_wolo'         => $resultAmountPg,
            'amounts_wolo_sum'     => $sumAmountPg,
            'amounts_taxes'        => $resultAmountTax,
            'amounts_taxes_sum'    => $sumAmountTax,
            'amounts_total_pos'        => $resultAmountTotalPositive,
            'amounts_total_pos_sum'    => $sumAmountTotalPositive,
            'amounts_total_neg'        => $resultAmountTotalNegative,
            'amounts_total_neg_sum'    => $sumAmountTotalNegative,
            'amounts_game_pos'        => $resultAmountGamePositive,
            'amounts_game_pos_sum'    => $sumAmountGamePositive,
            'amounts_game_neg'        => $resultAmountGameNegative,
            'amounts_game_neg_sum'    => $sumAmountGameNegative,
        ];
    }

    /**
     * @param $gamerId
     * @param $articleId
     * @param bool $test
     * @return array
     */
    public function countByGamerIdAndArticleIdGroupByArticle($gamerId, $articleId, $test=false, $includeNegatives=true)
    {
        $sql="
            SELECT SUM(pdha.articlesQuantity) as num
            FROM AppBundle:Purchase p
            JOIN p.payment pay
            JOIN pay.paymentDetail pay_det
            JOIN pay_det.paymentDetailHasArticles pdha
            WHERE
                pdha.article = :articleId
                AND p.gamer = :gamerId
                ". ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL ") . "
                ".($test === null ? '' : ' AND p.test = :test ' )."

            GROUP BY pdha.article
        ";
        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $resultSql = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['gamerId' => $gamerId, 'articleId'=>$articleId], $extraParams))
            ->getArrayResult();

        $result = 0;

        foreach ($resultSql as $row)
            $result  = (int) $row['num'];

        return $result;
    }

    /**
     * @param $gamerId
     * @param $offerProgrammerId
     * @return array
     */
    public function countByGamerIdAndOfferProgrammer($gamerId=null, $offerProgrammerId, $test=false)
    {
        $parameters = ['offerProgrammerId'=>$offerProgrammerId];
        $extraSQL = '';

        if ($gamerId)
        {
            $parameters['gamerId'] = $gamerId;
            $extraSQL .=' AND p.gamer = :gamerId ';
        }

        $sql="
            SELECT SUM(pdha.articlesQuantity) as num
            FROM AppBundle:Purchase p
            JOIN p.payment pay
            JOIN pay.paymentDetail pay_det
            JOIN pay_det.paymentDetailHasArticles pdha
            WHERE
                pdha.offerProgrammer = :offerProgrammerId
                AND p.extraCostFromParent IS NULL
                ".($test === null ? '' : ' AND p.test = :test ' ) ."
                $extraSQL
        ";
        if ($test !== null)
            $extraParams['test']=$test;


        $result = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge($parameters, $extraParams))
            ->getOneOrNullResult();
        ;

        return isset($result['num']) ? $result['num'] : null;
    }


} 