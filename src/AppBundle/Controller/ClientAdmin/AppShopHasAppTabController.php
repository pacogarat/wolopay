<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\ClientUser;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/api")
 */
class AppShopHasAppTabController extends Controller
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
     * @Route("/app_shop_has_app_tabs/{app_id}", name="admin_get_app_shop_has_tabs", methods={"GET"})
     */
    public function getAllAction(Request $request, $app_id)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $context = SerializationContext::create()->setGroups(array('Default','AppShopHasAppTabFull','AppShopHasAppTabs&Tab','Admin'))->enableMaxDepthChecks();

        $apps = $this->em->getRepository("AppBundle:AppShopHasAppTab")->findByAppId($app_id);

        return new Response($this->serializer->serialize($apps, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

}
