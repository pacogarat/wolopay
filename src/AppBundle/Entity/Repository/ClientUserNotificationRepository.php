<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\ClientUserNotification;
use AppBundle\Entity\Enum\StatusCategoryEnum;

class ClientUserNotificationRepository extends AbstractRepository
{
    public function findByClientUserIdAndDelete($clientUserId, $deleted = false)
    {
        $sql="
            SELECT n
            FROM AppBundle:ClientUserNotification n
            WHERE
              n.clientUser = :clientUserId
              AND n.deleted = :deleted
              order by n.createdAt DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array(
                    'clientUserId' => $clientUserId,
                    'deleted' => $deleted,
                ))
            ->getResult()
        ;
    }

    /**
     * @param \DateTime $date
     * @param $clientUserId
     * @param bool $deleted
     * @return ClientUserNotification[]
     */
    public function findByClientUserIdAndDateAndDelete(\DateTime $date, $clientUserId, $deleted = false)
    {
        $sql="
            SELECT n
            FROM AppBundle:ClientUserNotification n
            WHERE
              n.clientUser = :clientUserId
              AND n.createdAt <= :date
              AND n.deleted = :deleted
              order by n.createdAt DESC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array(
                    'clientUserId' => $clientUserId,
                    'deleted'      => $deleted,
                    'date'         => $date
                ))
            ->getResult()
            ;
    }
} 