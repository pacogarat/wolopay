<?php

namespace AppBundle\Controller\Api\AdminClient;;


use AppBundle\Entity\App;
use AppBundle\Exception\NviaApiPublicException;
use AppBundle\Exception\NviaException;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractAPI extends FOSRestController
{
    public function verifyValidAppFromUser(App $app)
    {
        $user = $this->getUser();

        if ($user->getApp()->getId() !== $app->getId())
        {
            throw new NviaApiPublicException("Invalid App. app id requested: ".$app->getId().", app id permission: ".$user->getApp()->getId()
                , NviaException::API_HAVENT_PERMISSION_APP
            );
        }

        return true;
    }

//    /**
//     * @return AppApiCredentials
//     */
//    public function getUser(){
//        return parent::getUser();
//    }

}
