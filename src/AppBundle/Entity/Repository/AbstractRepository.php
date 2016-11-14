<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class AbstractRepository extends EntityRepository
{
    const OPTION_INJECT_NO_PARAMS = 'SQLINJECT_NO_PARAMS';
    const OPTION_SQL_INJECT = 'SQLINJECT';

    /**
     * @param string $sql
     * @param array $parameters
     * @param array $filters
     */
    protected function loadFilters(&$sql, &$parameters, $filters)
    {
        foreach ($filters as $key => $value)
        {
            if ($value === null || $value === '')
                continue;

            if ($key == self::OPTION_INJECT_NO_PARAMS)
            {
                $sql.=" $value";

                continue;
            }

            if ($key == self::OPTION_SQL_INJECT)
            {
                if (isset($value['sql']))
                    $sql.=" $value[sql] ";

                if (isset($value['parameters']))
                    $parameters = array_merge($parameters, $value['parameters']);

                continue;
            }

            $keyToReplace = str_replace(['.','(',')'], ['','',''], $key);

            $sql.="AND $key LIKE :$keyToReplace ";
            $parameters[$keyToReplace] = "%$value%";
        }
    }
}