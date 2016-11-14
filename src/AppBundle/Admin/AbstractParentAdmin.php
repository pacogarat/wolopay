<?php

namespace AppBundle\Admin;


use EntityManager53b833de54f39_546a8d27f194334ee012bfe64f629947b07e4919\__CG__\Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\Admin;

class AbstractParentAdmin extends Admin
{
    protected $baseRouteName = 'admin_app_bundle_SuperEntityAdmin';
    protected $baseRoutePattern = 'super_entity';

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->modelManager->getEntityManager('AppBundle\Entity\App');
    }
}
