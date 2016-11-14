<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\StatusCategoryEnum;

class LanguageRepository extends AbstractRepository
{
    public function findByIds(array $languageIds)
    {
        $sql="
            SELECT l
            FROM AppBundle:Language l
            WHERE
              l.id in (:language)
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('language' => $languageIds))
            ->getResult()
        ;
    }

    public function findByApp($appId)
    {
        $sql="
            SELECT l
            FROM AppBundle:Language l

            WHERE
              l in (select ll.id  FROM AppBundle:App a
                    JOIN a.languages ll where a = :appId
                )
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult()
            ;
    }
} 