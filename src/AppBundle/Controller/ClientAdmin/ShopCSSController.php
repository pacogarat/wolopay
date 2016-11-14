<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class ShopCSSController extends Controller
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
     * @Route("/shop_templates/app/{app}", name="admin_css_all")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function cssAction(App $app)
    {
        $appShops = $this->em->getRepository("AppBundle:ShopCss")->findByPublicAndAppId($app->getId());

        return new Response($this->serializer->serialize($appShops, 'json'), 200, ['Content-Type' => 'application/json']);
    }
}
