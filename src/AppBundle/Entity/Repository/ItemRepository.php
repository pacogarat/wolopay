<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\PayMethodProviderHasCountry;

class ItemRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @return PayMethodProviderHasCountry[]
     */
    public function findByApp($appId) {

        return $this->getEntityManager()->createQuery(self::sqlFindByApp())->setParameters(
            array(
                'appId' => $appId,
            )
        )->getResult();
    }

    /**
     * @param $appId
     * @param $itemId
     * @return PayMethodProviderHasCountry
     */
    public function findOneByIdAndAppId($itemId, $appId) {

        return $this->getEntityManager()->createQuery(
            "
            SELECT item
            FROM AppBundle:Item item
            JOIN item.app app

            WHERE
              app = :appId
              AND item = :itemId
              "
        )->setParameters(
            array(
                'appId' => $appId,
                'itemId' => $itemId
            )
        )->getOneOrNullResult();
    }

    static public function sqlFindByApp()
    {
        return "
            SELECT item
            FROM AppBundle:Item item
            JOIN item.app app

            WHERE
              app = :appId
              ";
    }

    public function findByAppIdAndActives($appId, $itemActive = true, $articleActive = true)
    {
        $sql="SELECT i, a, i_c, curr, a_image, i_image, i_descLabel, i_nameLabel, a_descLabel, a_nameLabel, a_articleCategory
            FROM AppBundle:Item i
                JOIN i.descriptionLabel i_descLabel
                JOIN i.nameLabel i_nameLabel
                LEFT JOIN i.unitaryPriceCountry i_c
                LEFT JOIN i_c.currency curr
                JOIN i.image i_image
                LEFT JOIN  i.articles a WITH (a.active = :articleActive OR a.active is NULL)
                LEFT JOIN a.descriptionLabel a_descLabel
                LEFT JOIN a.nameLabel a_nameLabel
                LEFT JOIN a.articleCategory a_articleCategory
                LEFT JOIN a.image a_image
            WHERE
                i.app = :app
                AND i.active= :itemActive

            order by i.createdAt ASC
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId, 'itemActive' => $itemActive, 'articleActive' => $articleActive))
            ->getResult()
        ;
    }
}
