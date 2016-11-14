<?php

namespace AppBundle\Entity\Repository;

class OfferProgrammerRepository extends AbstractRepository
{
    /**
     * @param null $articleId
     * @return \AppBundle\Entity\OfferProgrammer[]
     */
    public function findAllActiveOffersAndArticleId($articleId=null)
    {
        $sql="SELECT op
            FROM AppBundle:OfferProgrammer op
            WHERE
                (op.offerTo is null OR op.offerFrom < CURRENT_TIMESTAMP())
                AND (op.offerTo is null OR op.offerTo > CURRENT_TIMESTAMP()) ".
                ($articleId ? ' AND op.article = :articleId ' : '')
        ;

        $arrayParameters = [];
        if ($articleId)
            $arrayParameters['articleId'] = $articleId;

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($arrayParameters)
            ->getResult()
        ;
    }

    /**
     * @param $appId
     * @param int $extraMonths
     * @return \AppBundle\Entity\OfferProgrammer[]
     */
    public function findByAppIdAndActive($appId, $extraMonths=0)
    {
        $sql="SELECT op
            FROM AppBundle:OfferProgrammer op
            WHERE
                op.app = :appId
                AND (op.offerTo is null OR DATE_ADD( op.offerTo, :extraMonths, 'month') > CURRENT_TIMESTAMP())
                AND ( (op.isActive is null) or (op.isActive=true) )
                "
        ;

        $arrayParameters = ['appId'=> $appId, 'extraMonths' => $extraMonths];

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($arrayParameters)
            ->getResult()
        ;
    }

    /**
     * @param array $articlesIds
     * @param array $appShopsIds
     * @param array $countriesIds
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @return \AppBundle\Entity\AppShopHasArticles[]
     */
    public function findIfExistOtherOfferInSamePeriod(array $articlesIds, array $appShopsIds, array $countriesIds,
        \DateTime $dateFrom, \DateTime $dateTo, $notInOfferProgrammerId=null)
    {
        $extraSql='';

        $parameters = [
            'articles' => $articlesIds,
            'countries' => $countriesIds,
            'appShops' => $appShopsIds,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ];

        if ($notInOfferProgrammerId)
        {
            $parameters['offerProgrammerId'] = $notInOfferProgrammerId;
            $extraSql.='AND o <> :offerProgrammerId';
        }

        $sql = "
            SELECT o

            FROM AppBundle:OfferProgrammer o
            JOIN o.articles a
            JOIN o.countries c
            JOIN o.appShops s
            WHERE
                a in (:articles)
                AND c in (:countries)
                AND s in (:appShops)
                AND (CASE WHEN o.offerFrom >= :dateFrom THEN o.offerFrom ELSE :dateFrom END) <= (CASE WHEN o.offerTo <= :dateTo THEN o.offerTo ELSE :dateTo END)
                AND (CASE WHEN o.offerFrom >= :dateFrom THEN o.offerFrom ELSE :dateFrom END) >= o.offerFrom
                AND (CASE WHEN o.offerTo <= :dateTo THEN o.offerTo ELSE :dateTo END) <= o.offerTo
                AND ( (o.isActive is null) or (o.isActive=true) )
                $extraSql
            "
        ;
//
//        echo $this->getEntityManager()
//            ->createQuery($sql)
//            ->setParameters($parameters)->getSQL();

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult();
        ;
    }
} 