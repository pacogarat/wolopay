<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class ShopsController extends Controller
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
     * @Route("/shops/app/{app}", name="admin_app_shops")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function shopsAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)) && !in_array(RoleEnum::ADMIN_TEST_SHOP ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $appShops = $this->em->getRepository("AppBundle:AppShop")->findByApp($app->getId());
        $context = SerializationContext::create()->enableMaxDepthChecks();

        return new Response($this->serializer->serialize($appShops, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }


}
