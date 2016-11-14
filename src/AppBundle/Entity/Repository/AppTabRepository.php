<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppTab;

class AppTabRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @param $nameUnique
     * @return AppTab
     */
    public function findOneByAppIdAndNameUnique($appId, $nameUnique)
    {
        $sql="
            SELECT tab
            FROM AppBundle:AppTab tab
            WHERE
                tab.app = :appId
                AND tab.nameUnique = :nameUnique
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'nameUnique' => $nameUnique))
            ->getOneOrNullResult()
        ;
    }


    public function findOneByAppIdAndLevelCategoryIdAndNameUnique($appId, $levelCategory, $nameUnique )
    {
        $sql="
            SELECT tab
            FROM AppBundle:AppTab tab
            JOIN tab.app app
            JOIN app.appShops shops
            JOIN shops.appShop s

            WHERE
                tab.app = :appId
                AND s.levelCategory = :levelCategory
                AND tab.nameUnique = :nameUnique
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId, 'nameUnique' => $nameUnique, 'levelCategory' => $levelCategory))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $appId
     * @param bool $active
     * @return AppTab[]
     */
    public function findByAppId($appId, $active = true)
    {
        $parameters = [
            'appId' => $appId
        ];

        $extra = '';

        if ($active !== null)
        {
            $extra .= ' AND tab.active = :active ';
            $parameters['active'] = $active;
        }

        $sql="
            SELECT tab
            FROM AppBundle:AppTab tab

            WHERE
                tab.app = :appId
                $extra
            ORDER BY tab.order
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters($parameters)
            ->getResult()
        ;
    }



} 