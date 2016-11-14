<?php

namespace AppBundle\Controller\ClientAdmin;

use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class LevelCategoryController extends Controller
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Serializer
     * @Inject("jms_serializer")
     */
    public $serializer;

    /**
     * @Route("/app_shops_categories/{app_id}", name="admin_app_shops_categories_list")
     */
    public function listAction(Request $request, $app_id)
    {
        if ($request->get('available'))
            $levels = $this->em->getRepository("AppBundle:LevelCategory")->findAvailableByAppId($app_id);
        else
            $levels = $this->em->getRepository("AppBundle:LevelCategory")->findByAppId($app_id);

        $result ='';
        foreach ($levels as $level)
            $result.=','.$this->serializer->serialize($level, 'json');

        $result= '['.substr($result,1).']';

        return new Response($result, 200, ['Content-Type' => 'application/json']);
    }



}
