<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Helper\UtilHelper;

class ArticleRepository extends AbstractRepository
{
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
    public function statsArticlesPurchased(array $appIds, \DateTime $dateFrom, \DateTime $dateTo,
        $currencyResult=CurrencyEnum::EURO, &$dateFormat, $groupBy = 'l.id, date_format, article_id', $offset=2, $test=false)
    {
        $dateFormatStr = UtilHelper::toDateStrStats($dateFormat);

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur ')
        );

        $calculateExtraCosts = function($field) use ($change){
            $prefix=$field.'vx';
            return "(select SUM($prefix.$field) FROM AppBundle:Purchase $prefix WHERE $prefix.extraCostFromParent = p.id)";
        };

        $sql="SELECT a.id as article_id, l.id as lvl_id,  l.name as shop, c.name as country, c.id as country_iso,
            count(DISTINCT(COALESCE(IDENTITY(p.extraCostFromParent) , p.id))) as purchases,
            count(t.id) transactions, count(DISTINCT g.id) unique_users,
            GROUP_CONCAT(DISTINCT p.id) as purchs,
            sum(p.amountTotal * $change )amount_total ,
            sum(p.amountProvider * $change ) amount_provider,
            sum(p.amountWolo * $change ) amount_wolopay,
            sum(p.amountGame * $change ) amount_game_old,
            sum((p.amountGame * $change ) * (pdha.amount/p.amountTotal)) amount_game,
            sum(pdha.articlesQuantity * pdha.amount * $change) amount_game_2,
            CASE WHEN t.beginAt<:dateFrom THEN
                  CASE WHEN p.createdAt < :dateFrom THEN
                  ". UtilHelper::dateQueryStr('p.lastUpdateAt', $offset, $dateFormat, $dateFormatStr, $dateFrom, $dateTo) ."
                  ELSE
                  ". UtilHelper::dateQueryStr('p.createdAt', $offset, $dateFormat, $dateFormatStr, $dateFrom, $dateTo) ."
                  END
                ELSE
                    ". UtilHelper::dateQueryStr('t.beginAt', $offset, $dateFormat, $dateFormatStr, $dateFrom, $dateTo) ."
                END as date_format
            FROM AppBundle:Article a
            JOIN AppBundle:PaymentDetailHasArticles pdha WITH pdha.article = a
            JOIN pdha.paymentDetail pd
            JOIN pd.payment pay
            JOIN AppBundle:Purchase p WITH p.payment = pay
            JOIN p.transaction t
            JOIN t.levelCategory l
            LEFT JOIN t.countryDetected c
            JOIN p.gamer g

            WHERE
                t.app in (:appIds)
                AND p.extraCostFromParent IS NULL
                AND (     (p.createdAt BETWEEN :dateFrom AND :dateTo) OR (p.lastUpdateAt BETWEEN :dateFrom AND :dateTo))"
                .($test === null ? '' : ' AND t.test = :test ' )."
            GROUP BY $groupBy
            ORDER BY lvl_id, date_format, article_id
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;

        $result = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['appIds' => $appIds, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo], $extraParams))
            ->getScalarResult()
        ;

//        ldd($result);
        $visitedArr = array();
        foreach ($result as &$row)
        {
            $row['transactions'] = (int) $row['transactions'];
            $row['purchases'] = (int) $row['purchases'];
            $row['unique_users'] = (int) $row['unique_users'];

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
            if ($purchases<>""){
                $result2 = $this->getEntityManager()
                        ->createQuery(
                            "SELECT
                      SUM(p.amountTotal * $change) as amount_total_extra,
                      SUM(p.amountProvider * $change) as amount_provider_extra,
                      SUM(p.amountWolo * $change) as amount_wolopay_extra,
                      SUM(p.amountGame * $change) as amount_game_extra
                     FROM AppBundle:Purchase p
                     WHERE p.extraCostFromParent IN (" . $purchases . ") AND p.test=0 and p.amountTotal<0
                 ")->getResult();

                foreach ($result2 as $k=>$v){
                    $row['amount_total'] = (float) $row['amount_total'] + (float) $v['amount_total_extra'];
                    $row['amount_provider'] = (float) $row['amount_provider'] + (float)$v['amount_provider_extra'];
                    $row['amount_wolopay'] = (float) $row['amount_wolopay'] + (float)$v['amount_wolopay_extra'];
                    $row['amount_game'] = (float) $row['amount_game'] + (float)$v['amount_game_extra'];
                }
            }else{
                $row['amount_total'] = (float) $row['amount_total'] ;
                $row['amount_provider'] = (float) $row['amount_provider'] ;
                $row['amount_wolopay'] = (float) $row['amount_wolopay'] ;
                $row['amount_game'] = (float) $row['amount_game'] ;
            }

//            $row['amount_total'] = (float) $row['amount_total'] + $v['amount_total_extra'];
//            $row['amount_provider'] = (float) $row['amount_provider'] + $v['amount_provider_extra'];
//            $row['amount_wolopay'] = (float) $row['amount_wolopay'] + $v['amount_wolopay_extra'];
//            $row['amount_game'] = (float) $row['amount_game'] + $v['amount_game_extra'];

            unset($row['amount_total_extra'], $row['amount_provider_extra'], $row['amount_wolopay_extra'], $row['amount_game_extra']);
        }


        return $result;
    }

    /**
     * @param $appId
     * @return Article[]
     */
    public function findByAppAndActive($appId)
    {
        $sql="
            SELECT a, asha, i
            FROM AppBundle:Article a
            JOIN a.item i
            JOIN a.appShopHasArticles asha
            WHERE
                a.app = :appId
                AND a.active = true
                AND i.active = true
                AND asha.active = true
                order by i.id, a.itemsQuantity

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(['appId' => $appId])
            ->getResult()
        ;
    }

    public function findOneByIdAndActive($id, $active=true)
    {
        $sql="SELECT a
            FROM AppBundle:Article a
            WHERE
                a.id = :articleId
                AND a.active = :active
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('articleId' => $id, 'active' => $active))
            ->getOneOrNullResult();
        ;
    }

    static public function sqlFindByAppId()
    {
        $sql="
            SELECT a
            FROM AppBundle:Article a
            JOIN a.item i
            WHERE
                a.app = :appId
                AND a.active = true
                AND i.active = true
            order by i.id, a.itemsQuantity
        ";

        return $sql;
    }

    /**
     * @param $appId
     * @return Article[]
     */
    public function findByApp($appId)
    {
        $sql=self::sqlFindByAppId();

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult();
        ;
    }

    /**
     * @param $appId
     * @param string $articleCategoryId
     * @param bool $active
     * @return Article[]
     */
    public function findByAppAndArticleCategory($appId, $articleCategoryId=ArticleCategoryEnum::SINGLE_PAYMENT_ID, $active=true)
    {
        $sql="SELECT a
            FROM AppBundle:Article a
            WHERE
                a.app = :appId
                AND a.articleCategory = :articleCategoryId
                AND a.active = :active
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'articleCategoryId' => $articleCategoryId, 'active'=> $active))
            ->getResult();
        ;
    }

    /**
     * @param $appId
     * @param array $countries
     * @param array $shops
     * @param bool $active
     * @return Article[]
     */
    public function findByAppAndCountriesAndAppShops($appId, array $countries, array $shops, $active=true)
    {
        $sql="SELECT a, ashop
            FROM AppBundle:Article a
            JOIN a.item i
            JOIN a.appShopHasArticles ashop
            WHERE
                a.app = :appId

                AND a.active = :active
                AND i.active = :active
                AND ashop.active = :active

                AND ashop.country in (:countries)
                AND ashop.appShop in (:shops)

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'countries' => $countries, 'shops' => $shops, 'active'=> $active))
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param null $tabUniqueName
     * @param null $tabId
     * @param null $levelCategoryId
     * @param null $country
     * @param null $articleCategoryId
     * @param null $specialType
     * @return Article[]
     */
    public function findByTabIdAndLevelCategoryFilters($appId, $tabUniqueName = null, $tabId = null,
        $levelCategoryId = null, $country = null, $articleCategoryId = null, $specialType = null)
    {
        $params = ['appId' => $appId];
        $extraSQl ='';
        $extraInnerJoin ='';

        if ($levelCategoryId)
        {
            $extraSQl .= 'AND appshop.levelCategory = :levelCategoryId ';
            $params['levelCategoryId'] = $levelCategoryId;
        }

        if ($tabId)
        {
            $extraSQl .= 'AND asht.appTab = :tabId ';
            $params['tabId'] = $tabId;
        }

        if ($tabUniqueName)
        {
            $extraInnerJoin = '
                JOIN appshop.appShopHasAppTabs asht
                JOIN asht.appTab tab
                JOIN asht.articles aa WITH aa = a
            ';

            $extraSQl .= 'AND tab.nameUnique = :tabNameUnique ';
            $params['tabNameUnique'] = $tabUniqueName;
        }

        if ($country)
        {
            $extraSQl .= 'AND ashopha.country = :country ';
            $params['country'] = $country;
        }

        if ($articleCategoryId)
        {
            $extraSQl .= 'AND a.articleCategory = :articleCategory ';
            $params['articleCategory'] = $articleCategoryId;
        }

        if ($specialType)
        {
            if ($specialType === 'null')
            {
                $extraSQl .= 'AND i.specialType is NULL ';

            }else{

                $extraSQl .= 'AND a.specialType = :specialType';
                $params['specialType'] = $specialType;
            }
        }

        $sql="
            SELECT a
                FROM AppBundle:Article a
                JOIN a.app app
                JOIN a.item i
                JOIN a.appShopHasArticles ashopha
                JOIN ashopha.appShop appshop

                $extraInnerJoin

                WHERE
                    a.app = :appId
                    AND a.active = true
                    AND i.active = true
                    $extraSQl

                ORDER BY i.id, a.itemsQuantity
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($params)
            ->getResult()
        ;
    }

    public function findOneByAppAndItemsQuantityAndItemIdAndArticleCategory($appId, $itemsQuantity, $itemId, $articleCategoryId=ArticleCategoryEnum::SINGLE_PAYMENT_ID)
    {
        $sql="SELECT a
            FROM AppBundle:Article a
            WHERE
                a.app = :appId
                AND a.itemsQuantity = :itemsQuantity
                AND a.articleCategory = :articleCategoryId
                AND a.item = :itemId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'itemsQuantity' => $itemsQuantity, 'articleCategoryId' => $articleCategoryId, 'itemId'=> $itemId))
            ->getOneOrNullResult();
        ;
    }

    public function findOneByIdAndActiveAndApp($id, $app, $active=true)
    {
        $sql="SELECT a
            FROM AppBundle:Article a
            WHERE
                a.id = :articleId
                AND a.active = :active
                AND a.app = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('articleId' => $id, 'active' => $active , 'app' => $app))
            ->getOneOrNullResult();
        ;
    }

    public function findByIdAndGachaTypeAndActive($id, $gachaType, $active=true){
        $sql="SELECT a, ag
            FROM AppBundle:Article a
            JOIN a.articlesGacha ag
            WHERE
                a.id = :articleId
                AND a.specialType = :specialType
                AND a.active = :active

        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('articleId' => $id, 'specialType'=>$gachaType, 'active' => $active))
            ->getResult();

    }


} 