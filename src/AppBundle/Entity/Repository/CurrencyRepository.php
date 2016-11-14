<?php

namespace AppBundle\Entity\Repository;

class CurrencyRepository extends AbstractRepository
{
    public function findByProviderId($providerId)
    {
        $sql=$this->sqlFindByProviderId();

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('providerId' => $providerId))
            ->getResult();
        ;
    }

    static public function sqlFindByProviderId()
    {
        return "
            SELECT c
            FROM AppBundle:Currency c
            WHERE
                c.id in (
                    select cur.id
                    from AppBundle:Provider p
                    JOIN p.currenciesAvailable cur
                    where p.id = :providerId
                )
        ";
    }
} 