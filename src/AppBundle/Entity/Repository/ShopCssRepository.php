<?php

namespace AppBundle\Entity\Repository;

class ShopCssRepository extends AbstractRepository
{
    public function findByPublicAndAppId($appId)
    {
        $sql="SELECT css
            FROM AppBundle:ShopCss css
            LEFT JOIN css.apps a
            WHERE
                css.public = true OR a = :appId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('appId' => $appId))
            ->getResult();
        ;
    }
} 