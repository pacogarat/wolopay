<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Transaction;
use AppBundle\Helper\StatsHelper;
use AppBundle\Helper\UtilHelper;

class TransactionRepository extends AbstractRepository
{
    /**
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

        $sql="SELECT l.name as shop, l.id as shop_id, count( l.id ) as num_shops
            count( DISTINCT t.gamer ) as num_unique_gamers,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider, sum(p.amountWolo * $change) amount_wolopay, sum(p.amountGame * $change) amount_game,
            DATE_FORMAT( DATE_ADD(p.createdAt, $offset, 'hour'), $dateFormatStr) as date_format
            FROM AppBundle:Purchase p
                JOIN p.transaction t
                JOIN t.levelCategory l
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
                AND p.wasCanceled <> 1
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

            $uniqueGamers[$line['shop']][$line['date_format']] = (int) $line['num_unique_gamers'];

            $countLevel[$line['shop']][$line['date_format']] = (int) $line['num_shops'];
            $revenueLevel[$line['shop']][$line['date_format']] = (int) $line['amount_game'] ;
        }

        foreach ($countLevel as $index => $lvl)
            $countLevel[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        foreach ($revenueLevel as $index => $lvl)
            $revenueLevel[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        foreach ($uniqueGamers as $index => $lvl)
            $uniqueGamers[$index] = StatsHelper::fillAllStats($lvl, $dateFrom, $dateTo, $dateFormat, $offset);

        return [
            'count_level' => $countLevel,
            'revenue_level' => $revenueLevel,
            'unique_gamers' => $uniqueGamers,
        ];
    }

    /**
     * @param array $appIds
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param $dateFormat
     * @param string $groupBy
     * @param bool $test
     * @return array
     */
    public function fullStatsByAppIdAndDateRangeAndGroupByCountry(array $appIds, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, $dateFormat, $groupBy = 'date_format, c.id', $test=false, $offset=2)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="SELECT c.name as country, c.id as country_iso, count(t.id) as transactions,
        DATE_FORMAT(DATE_ADD(t.beginAt,$offset,'hour'), $dateFormatStr) as date_format
            FROM AppBundle:Transaction t
            LEFT JOIN t.purchases p
            LEFT JOIN t.countryDetected c
            WHERE
                t.app in (:appIds)
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                       AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )

                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."
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
            $row['transactions'] = (int) $row['transactions'];
        }

        return $result;
    }

    /**
     * @param array $states
     * @return Transaction[]
     */
    public function findExpired( $states = [ TransactionStatusCategoryEnum::BEGIN_ID,
        TransactionStatusCategoryEnum::SHOPPING_ID,TransactionStatusCategoryEnum::PENDING_PAYMENT_ID,
        TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID ]
    )
    {
        $now = new \DateTime();

        $sql="SELECT t
            FROM AppBundle:Transaction t
            WHERE
                t.expireAt < :now
                AND t.statusCategory in (:statusCategories)
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('now' => $now, 'statusCategories' => $states))
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param int $offset
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat= 'months', $offset=2, $test = false, $includeNegatives = true)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="SELECT COUNT(distinct(t.id)) as num,
                  DATE_FORMAT( DATE_ADD (t.beginAt, $offset, 'hour') , $dateFormatStr ) as date_format_trans,
                  DATE_FORMAT( DATE_ADD (p.createdAt, $offset, 'hour') , $dateFormatStr ) as date_format_purch,
                  CASE WHEN t.beginAt<:dateFrom THEN
                      CASE WHEN p.createdAt < :dateFrom THEN
                        DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                      ELSE
                        DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                      END
                  ELSE
                        DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                  END as date_format,
                  CASE WHEN t.beginAt<:dateFrom THEN 'true' ELSE 'false' END as past
            FROM AppBundle:Transaction t
              LEFT JOIN t.purchases p
            WHERE
                t.app = :appId AND
                 (
                    (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                    OR (p.id is not null  "
                    . ($includeNegatives ? "" : " AND p.extraCostFromParent IS NULL ")
                    . " AND (    (p.createdAt between :dateFrom AND :dateTo) )
                    )
                 )
                 " .($test === null ? '' : ' AND t.test = :test ' )."
                GROUP BY date_format
        ";

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
            if ( !array_key_exists($line['date_format'],$result) )
                $result[$line['date_format']] = 0;

            $result[$line['date_format']] += (int) $line['num'] ;
        }

        $result=StatsHelper::fillAllStats($result, $dateFrom, $dateTo, $dateFormat, $offset);

        return $result;
    }


    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $test
     * @param bool $includeNegatives
     * @return array
     */
    public function statsFrequencyByGamer($appId, \DateTime $dateFrom, \DateTime $dateTo, $test = false, $includeNegatives=true)
    {
        $sql="
            SELECT count(t.id) as num, IDENTITY (t.gamer)
            FROM AppBundle:Transaction t
            LEFT JOIN t.purchases p
            WHERE
                t.app = :appId
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                       AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )

                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."
                ". ($includeNegatives? "" : " AND p.extraCostFromParent IS NULL") . "
                GROUP BY t.gamer
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

        $result = [];
        for ($i=1 ; $i<=9; $i++)
            $result[(string) $i] = 0;

        $result['10-15'] = 0;
        $result['15-25'] = 0;
        $result['25-50'] = 0;
        $result['>50']   = 0;

        foreach ($sqlResult as $line)
        {
            $num = (int) $line['num'];
            switch ($num){
                case ($num < 10):
                    $result[(string) $num] ++;
                    break;
                case ($num >= 10 && $num < 15):
                    $result['10-15'] ++;
                    break;
                case ($num >= 15 && $num < 25):
                    $result['15-25'] ++;
                    break;
                case ($num >= 25 && $num < 50):
                    $result['25-50'] ++;
                    break;
                case ($num >= 50):
                    $result['>50'] ++;
                    break;
            }
        }

        $result = StatsHelper::normalFormat($result);

        return $result;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $test
     * @return array
     */
    public function statsFrequencyDaysFromLastVisit($appId, \DateTime $dateFrom, \DateTime $dateTo, $test = false)
    {
        $sql="
            SELECT result.*, count(1) as num
                , CASE date_diff WHEN 0 THEN CONCAT(date_diff,'D ' , FLOOR(HOUR(time_diff) / 12) * 12,'H') ELSE date_diff END as date_diff_formated
            FROM (
                SELECT allmost_result.*
                    , DATEDIFF(allmost_result.last_visit, allmost_result.previous_visit) as date_diff
                    , TIMEDIFF(allmost_result.last_visit, allmost_result.previous_visit) as time_diff

                FROM (
                    SELECT t.gamer_id, MAX(t.begin_at) as last_visit,
                        (
                            SELECT
                                MAX(ttt.begin_at)
                            FROM `transaction` ttt
                            WHERE
                                t.gamer_id = ttt.gamer_id
                                AND ttt.begin_at < DATE_SUB(MAX(t.begin_at), INTERVAL 1 HOUR )
                        ) as previous_visit

                    FROM `transaction` t
                    WHERE
                        t.app_id = '$appId'
                        AND t.begin_at between '".$dateFrom->format('Y-m-d H:i:s')."' AND '".$dateTo->format('Y-m-d H:i:s')."'"
                        .($test === null ? '' : ' AND t.test = '. ($test ? 1 : 0) )."
                    GROUP BY t.gamer_id
                ) allmost_result
            ) result
            GROUP BY date_diff_formated
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        //$stmt->bindParam('t.appId',$appId);
        $stmt->execute();
        $sqlResult = $stmt->fetchAll();

        $result['0D 0H'] = 0;
        $result['0D 12H'] = 0;

        for ($i=1 ; $i<=9; $i++)
            $result[(string) $i] = 0;

        $result['10-15'] = 0;
        $result['15-25'] = 0;
        $result['25-50'] = 0;
        $result['>50']   = 0;
        $result['Never'] = 0;

        foreach ($sqlResult as $line)
        {
            $num = $line['date_diff_formated'];
            $sum = (int) $line['num'];

            if ($num !== null && $num < 10)
                $result[(string) $num] = $sum;
            else if ($num >= 10 && $num < 15)
                $result['10-15'] += $sum;
            else if ($num >= 15 && $num <= 24)
                $result['15-25'] += $sum;
            else if ($num >= 25 && $num < 50)
                $result['25-50'] += $sum;
            else if ($num >= 50)
                $result['>50'] += $sum;
            else
                $result['Never'] += $sum;
        }

        $result = StatsHelper::normalFormat($result);

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
     * @return array
     */
    public function fullStatsCountriesSection(array $appIds, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, $dateFormat, $groupBy = 'date_format, c', $offset=2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $sql="SELECT c.name as country, c.id as country_iso,
            count(DISTINCT t.id) as transactions, count(DISTINCT p.id) as purchases, count(DISTINCT g.id) as unique_users,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider, sum(p.amountWolo * $change) amount_wolopay, sum(p.amountGame * $change) amount_game,
            DATE_FORMAT( DATE_ADD (t.beginAt, $offset, 'hour') , $dateFormatStr) as date_format
            FROM AppBundle:Transaction t
            LEFT JOIN t.purchases p
            LEFT JOIN t.countryDetected c
            JOIN t.gamer g
            WHERE
                t.app in (:appIds)
                AND  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                          AND (    (p.createdAt between :dateFrom AND :dateTo))
                       )
                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."
            GROUP BY $groupBy
            ORDER BY date_format
        ";

        //        echo $sql;die;

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
            $row['transactions'] = (int) $row['transactions'];
            $row['purchases'] = (int) $row['purchases'];
            $row['unique_users'] = (int) $row['unique_users'];

            $row['amount_total'] = (float) $row['amount_total'];
            $row['amount_provider'] = (float) $row['amount_provider'];
            $row['amount_wolopay'] = (float) $row['amount_wolopay'];
            $row['amount_game'] = (float) $row['amount_game'];
        }

        return $result;
    }

    /**
     * This value is wrong because is impossible take transactions and revenue in same Query
     *
     * @param array $appIds
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $currencyResult
     * @param $dateFormat
     * @param string $groupBy
     * @param bool $test
     * @return array
     */
    public function fullStatsByAppIdAndDateRangeAndGroupBy(array $appIds, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, $dateFormat, $groupBy = 'date_format, t.countryDetected', $offset= 2, $test=false, $includeNegatives=true)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $sql="SELECT c.id as country, c.id as country_iso, count( DISTINCT t.id) as transactions,
            count(DISTINCT(COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as purchases,
            count(DISTINCT t.gamer) as unique_users,
            count(DISTINCT p.gamer) as n_unique_users_by_purchase,
            sum(p.amountTotal * $change) amount_total,
            sum(p.amountProvider * $change) amount_provider,
            sum(p.amountWolo * $change) amount_wolopay,
            sum(p.amountGame * $change) amount_game,
            t.valueCurrent value_current,
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
            LEFT JOIN t.purchases p
            LEFT JOIN t.countryDetected c
            JOIN t.gamer g
            WHERE
                t.app in (:appIds)
                AND (   (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                    OR (p.id is not null  "
                        . ($includeNegatives ? "" : " AND p.extraCostFromParent IS NULL  ")
                        . "
                         AND (     (p.createdAt between :dateFrom AND :dateTo) )
                        )
                    )
                ".($test === null ? '' : ' AND t.test = :test ' )."
            GROUP BY $groupBy
            ORDER by $groupBy
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
            // This value is wrong because is impossible take transactions and revenue in same Query
            $row['transactions'] = (int) $row['transactions'];
            $row['purchases'] = (int) $row['purchases'];
            $row['unique_users'] = (int) $row['unique_users'];
            $row['n_unique_users_by_purchase'] = (int) $row['n_unique_users_by_purchase'];

            $row['amount_total'] = (float) $row['amount_total'];
            $row['amount_provider'] = (float) $row['amount_provider'];
            $row['amount_wolopay'] = (float) $row['amount_wolopay'];
            $row['amount_game'] = (float) $row['amount_game'];
        }

        return $result;
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param bool $disableGroupBy
     * @param int $offset
     * @param bool $test
     * @return array
     */
    public function statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat= 'months', $disableGroupBy=false, $offset = 2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $sql="SELECT count(DISTINCT t.gamer) as num, count(DISTINCT t.valueCurrent) as num_level_distinct, count(t.valueCurrent) as num_level,
            DATE_FORMAT( DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr) as date_format_old,
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
            LEFT JOIN t.purchases p
            WHERE
                t.app = :appId
                 AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                         AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )

                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."

        ";

        if ($disableGroupBy==false)
            $sql .= "GROUP BY date_format";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;
        $resultCountGamers=[];
        $resultCountLevels=[];
        $resultCountLevelsDistinct=[];

        if ($disableGroupBy)
        {
            return [
                'unique_gamers' => $sqlResult[0]['num'],
                'level_gamers' => $sqlResult[0]['num_level'],
                'level_gamers_distinct' => $sqlResult[0]['num_level'],
            ];
        }


        foreach ($sqlResult as $line)
        {
            $resultCountGamers[$line['date_format']] = (int) $line['num'] ;
            $resultCountLevels[$line['date_format']] = (int) $line['num_level'] ;
            $resultCountLevelsDistinct[$line['date_format']] = (int) $line['num_level_distinct'] ;
        }

        return [
            'unique_gamers' => StatsHelper::fillAllStats($resultCountGamers, $dateFrom, $dateTo, $dateFormat, $offset),
            'level_gamers'  => StatsHelper::fillAllStats($resultCountLevels, $dateFrom, $dateTo, $dateFormat, $offset),
            'level_gamers_distinct'  => StatsHelper::fillAllStats($resultCountLevelsDistinct, $dateFrom, $dateTo, $dateFormat, $offset),
        ];
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $dateFormat
     * @param string $currencyId
     * @param int $topFive
     * @param string $groupBy
     * @param int $offset
     * @param bool $test
     *
     * @return array
     */
    public function statsByPayMethodTop5($appId, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat= 'months'
        , $currencyId = CurrencyEnum::EURO, $topFive = 5, $groupBy= 'date_format, pm', $offset = 2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyId == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyId == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );
/*transaction WOT_57288e72583ba has two successful payment_details, one free, */
        $sql="
        SELECT
              COALESCE( sum(p.amountTotal * $change), 0) amount_total
            , COALESCE( sum(p.amountProvider * $change), 0) amount_provider
            , COALESCE( sum(p.amountWolo * $change), 0) amount_wolopay
            , COALESCE( sum(p.amountGame * $change), 0) amount_game
            , count( DISTINCT t) as num_transactions
            , count(DISTINCT(COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as num_purchases
            , count( DISTINCT pd.id ) as pay_method_attempt
            , count( DISTINCT t.gamer ) as unique_users
            , pm.name as pay_method
            , c.id as country
            , CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                    DATE_FORMAT(DATE_ADD (p.lastUpdateAt, $offset, 'hour'), $dateFormatStr)
                  ELSE
                    DATE_FORMAT(DATE_ADD (p.createdAt, $offset, 'hour'), $dateFormatStr)
                  END
                ELSE
                    DATE_FORMAT(DATE_ADD (t.beginAt, $offset, 'hour'), $dateFormatStr)
                END as date_format
            FROM AppBundle:Transaction t
                LEFT JOIN t.countryDetected c
                LEFT JOIN t.purchases p
                JOIN AppBundle:PaymentDetail pd WITH pd.transaction = p.transaction
                JOIN pd.payment pay
                JOIN pd.payMethod pm
            WHERE
            pay.amount IS NOT NULL
            AND pay.amount >0
            AND t.app = :appId
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                        AND (    (p.createdAt between :dateFrom AND :dateTo) )
                       )
                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."
            GROUP BY $groupBy
            ORDER BY date_format, amount_game DESC, pay_method_attempt DESC
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $sqlResult = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult();
        ;


        $current = '00-00';
        $currentI = $currentKey = 0;

        foreach ($sqlResult as &$row)
        {
            $row['amount_total'] = (float) $row['amount_total'];
            $row['amount_provider'] = (float) $row['amount_provider'];
            $row['amount_wolopay'] = (float) $row['amount_wolopay'];
            $row['amount_game'] = (float) $row['amount_game'];
            $row['num_transactions'] = (int) $row['num_transactions'];
            $row['num_purchases'] = (int) $row['num_purchases'];
            $row['pay_method_attempt'] = (int) $row['pay_method_attempt'];
            $row['unique_users'] = (int) $row['unique_users'];
        }


        if (!$topFive)
            return $sqlResult;

        $result=[];

        foreach ($sqlResult as $key => $rowN)
        {
            if ($rowN['date_format'] !== $current)
            {
                $current = $rowN['date_format'];
                $currentI = $currentKey = 0;
            }

            if ($currentI >= $topFive)
            {
                if (!$currentKey)
                {
                    $currentKey = $key;
                    $rowN['pay_method'] = "Others (Not top $topFive)";
                    $result[]=$rowN;

                }else{

                    end($result);
                    $last =  &$result[key($result)];
                    $last['amount_total']       += $rowN['amount_total'];
                    $last['amount_provider']    += $rowN['amount_provider'];
                    $last['amount_wolopay']     += $rowN['amount_wolopay'];
                    $last['amount_game']        += $rowN['amount_game'];
                    $last['num_transactions']   += $rowN['num_transactions'];
                    $last['num_purchases']      += $rowN['num_purchases'];
                    $last['pay_method_attempt'] += $rowN['pay_method_attempt'];
                }

            }else{
                $result[]=$rowN;
            }

            $currentI++;
        }

        return $result;
    }

    /**
     * @param $appId
     * @param $gamerId
     * @return Transaction
     */
    public function findLastByAppIdAndGamerId($appId, $gamerId){
        $sql="
            SELECT t
            FROM AppBundle:Transaction t
            WHERE
              t.app = :appId and t.gamer= :gamerId
            ORDER BY  t.beginAt DESC
        ";
        return $this->getEntityManager()
            ->createQuery($sql)
            ->setMaxResults(1)
            ->setParameters(array('appId' => $appId, 'gamerId'=>$gamerId))
            ->getOneOrNullResult();
    }

    /**
     * @param $appId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param bool $test
     * @param int $first
     * @param null $maxResults
     * @param array $filters
     * @return array
     */
    public function findByAppIdAndDateRangeAndGroupByMonths($appId, \DateTime $dateFrom, \DateTime $dateTo, $test=false, $first = 0, $maxResults = null, $filters = [])
    {
        $sql="
            SELECT t
            FROM AppBundle:Transaction t
            LEFT JOIN t.purchases p
            JOIN t.gamer g
            WHERE
                t.app = :appId
                AND
                  (
                       (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                       OR (p.id is not null
                         AND (   (p.createdAt between :dateFrom AND :dateTo) )
                       )

                  )
                ".($test === null ? '' : ' AND t.test = :test ' )."
        ";

        $extraParams = [];

        $this->loadFilters($sql, $extraParams, $filters);

        $sql .=' order by t.beginAt DESC ';

        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setFirstResult($first)
            ->setMaxResults($maxResults)
            ->setParameters(array_merge(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getResult()
        ;
    }
} 