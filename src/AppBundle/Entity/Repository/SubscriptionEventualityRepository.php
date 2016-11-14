<?php

namespace AppBundle\Entity\Repository;

class SubscriptionEventualityRepository extends AbstractRepository
{
    public function findOneBySubscriptionIdAndIsActive($subscriptionId)
    {
        $sql="SELECT se
            FROM AppBundle:SubscriptionEventuality se
            WHERE
                se.subscription = :subscriptionId
                AND se.endAt is null
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('subscriptionId' => $subscriptionId))
            ->getOneOrNullResult();
        ;
    }
} 