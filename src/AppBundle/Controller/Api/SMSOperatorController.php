<?php

namespace AppBundle\Controller\Api;


use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Request;

class SMSOperatorController extends AbstractAPI
{
    /**
     * @var EntityManagerInterface
     * @DI\Inject("doctrine.orm.default_entity_manager")
     */
    public $em;





}
