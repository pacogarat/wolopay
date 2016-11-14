<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Affiliate;

class AffiliateRepository extends AbstractRepository
{
    /**
     * @param $clientId
     * @param $affiliateId
     * @return Affiliate
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */
    public function findOneByClientIdAndAffiliateId($clientId, $affiliateId)
    {
        $sql="SELECT a
            FROM AppBundle:Affiliate a
            WHERE
                a.affiliateId = :affiliateId
                AND a.client = :client
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('affiliateId' => $affiliateId, 'client' => $clientId))
            ->useResultCache(false)
            ->getOneOrNullResult()
        ;
    }
} 