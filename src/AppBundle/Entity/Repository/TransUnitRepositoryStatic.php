<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Enum\StatusCategoryEnum;
use Lexik\Bundle\TranslationBundle\Entity\TransUnitRepository;

class TransUnitRepositoryStatic extends TransUnitRepository
{
    static public function sqlFindByDomain()
    {
        $sql="
            SELECT t
            FROM LexikTranslationBundle:TransUnit t
            WHERE
              t.domain = :domain

        ";

        return $sql;
    }

} 