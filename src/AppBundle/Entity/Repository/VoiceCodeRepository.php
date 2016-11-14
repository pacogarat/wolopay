<?php

namespace AppBundle\Entity\Repository;

class VoiceCodeRepository extends AbstractRepository
{
    public function findOneByCodeAndValid($code)
    {
        $sql="SELECT v
            FROM AppBundle:VoiceCode v
            WHERE
                v.usedAt is null
                AND v.code = :code
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('code' => $code))
            ->getOneOrNullResult();
        ;
    }
} 