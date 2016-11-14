<?php

namespace AppBundle\Entity\Repository;


use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Payment;

class PaymentRepository extends AbstractRepository
{

    public function findOneByIdAndState($id, $state = PaymentStatusCategoryEnum::COMPLETED_ID)
    {
        $sql="
            SELECT p
            FROM AppBundle:Payment p
            WHERE
                p.id = :id
                AND p.statusCategory = :state
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('id' => $id, 'statusCategory' => $state))
            ->getOneOrNullResult()
        ;
    }

    public function findOneByTransactionExternalId($id)
    {
        $sql="SELECT p
            FROM AppBundle:Payment p
            WHERE
                p.transactionExternalId = :id
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('id' => $id))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $id
     * @param int $state
     * @return Payment[]
     */
    public function findByTransactionIdAndState($id, $state = PaymentStatusCategoryEnum::COMPLETED_ID)
    {
        $sql="SELECT p
            FROM AppBundle:Payment p
            WHERE
                p.id = :id
                AND p.statusCategory = :state
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('id' => $id, 'statusCategory' => $state))
            ->getResult()
        ;
    }
} 