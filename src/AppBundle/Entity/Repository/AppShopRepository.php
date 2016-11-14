<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\AppShop;

class AppShopRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @param $gamerLevel
     * @return AppShop
     */
    public function findOneByAppIdAndLevelGamer($appId, $gamerLevel)
    {
        $sql="
            SELECT s
            FROM AppBundle:AppShop s

            WHERE
               s.app = :appId
               AND s.active = :active
               AND s.valueLower <= :gamerLevel
               AND s.valueHigher > :gamerLevel
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('gamerLevel' => $gamerLevel , 'appId' => $appId, 'active' => true ))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $appId
     * @param $levelCategory
     * @return AppShop
     */
    public function findOneByAppIdAndLevelCategory($appId, $levelCategory)
    {
        $sql="
            SELECT s
            FROM AppBundle:AppShop s

            WHERE
               s.app = :appId
               AND s.levelCategory = :levelCategory
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('levelCategory' => $levelCategory , 'appId' => $appId ))
            ->getOneOrNullResult();
        ;
    }

    /**
     * @param $appId
     * @return AppShop[]
     */
    public function findByApp($appId) {

        return $this->getEntityManager()->createQuery(self::sqlFindByApp())->setParameters(
            array(
                'appId' => $appId,
            )
        )->getResult();
    }

    static public function sqlFindByApp()
    {
        return "
            SELECT shop
            FROM AppBundle:AppShop shop
            JOIN shop.css css
            JOIN shop.levelCategory level_category
            WHERE
              shop.app = :appId
              AND shop.active=true
              ";
    }

} 