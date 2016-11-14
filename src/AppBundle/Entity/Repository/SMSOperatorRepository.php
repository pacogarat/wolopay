<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\SMSOperator;

class SMSOperatorRepository extends AbstractRepository
{
    /**
     * @param $nameLike
     * @param $countryId
     * @return SMSOperator
     */
    public function findOneByLikeNameAndCountry($nameLike, $countryId)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMSOperator sms
            WHERE
                sms.name like :nameLike
                and sms.country = :countryId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'countryId' => $countryId,
                    'nameLike' => $nameLike,
                )
            )
            ->getOneOrNullResult()
            ;
    }

    public function findOneByShortNameAndCountry($shortName, $countryId)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMSOperator sms
            WHERE
                sms.shortName = :shortName
                and sms.country = :countryId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'countryId' => $countryId,
                    'shortName' => $shortName,
                )
            )
            ->getOneOrNullResult()
        ;
    }
}
