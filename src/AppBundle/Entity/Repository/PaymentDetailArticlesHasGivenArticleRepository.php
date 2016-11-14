<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PaymentDetailArticlesHasGivenArticle;

class PaymentDetailArticlesHasGivenArticleRepository extends AbstractRepository
{
    /**
     * @param string $gamerId
     * @param string $gachaArticleId
     * @param bool $test
     * @return PaymentDetailArticlesHasGivenArticle
     */
    public function findLastBoxGachaByGamerIdAndArticleId($gamerId, $gachaArticleId, $test=false)
    {
        $sql="
            SELECT pdaha
            FROM AppBundle:PaymentDetailArticlesHasGivenArticle pdaha
                JOIN pdaha.paymentDetailHasArticle pdha
                JOIN pdha.paymentDetail pd
                JOIN pd.payment pay
                JOIN pay.purchase p
            WHERE
                pdha.article = :articleId
                AND p.gamer = :gamerId
                AND p.extraCostFromParent IS NULL
                ".($test === null ? '' : ' AND p.test = :test ' )."

            ORDER BY pdaha.gachaInitialDate DESC, pdaha.id DESC
        ";

        $extraParams = [];

        if ($test !== null)
            $extraParams['test']=$test;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['gamerId' => $gamerId, 'articleId' => $gachaArticleId], $extraParams))
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

    /**
     * @param string $gamerId
     * @param string $gachaArticleId
     * @param $cycleSize
     * @param bool $test
     * @return array
     */
    public function findLastStepGachaArticlePurchasedByGamerIdAndArticleId($gamerId, $gachaArticleId, $cycleSize=10, $test = false)
    {
        $sql="SELECT IDENTITY(pdaha.article) as article, pay.createdAt as paymentDate, pdha.stepInGacha as stepInGacha
            FROM AppBundle:Purchase p
            JOIN p.payment pay
            JOIN pay.paymentDetail pay_det
            JOIN pay_det.paymentDetailHasArticles pdha
            JOIN pdha.paymentDetailArticlesHasGivenArticles pdaha
            WHERE
                pdha.article = :articleId
                AND p.gamer = :gamerId
                AND p.extraCostFromParent IS NULL
                ".($test === null ? '' : ' AND p.test = :test ' )."
            ORDER BY pay.createdAt ASC
        ";

        $extraParams = [];
        if ($test !== null)
            $extraParams['test']=$test;


        $resultSql= $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array_merge(['gamerId' => $gamerId, 'articleId'=>$gachaArticleId], $extraParams))
            ->getResult();

        $i=0;
        $result = [];
        $restart=true;

        foreach ($resultSql as $row)
        {
            if (($restart) || ($row['stepInGacha'] == 1)) {
                $i = 1;
                $result = [];
                $result['initialDate'] = $row['paymentDate'];

            }
            $result['lastPurchase']= $row['article'];
        }

        return $result;
    }
} 