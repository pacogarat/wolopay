<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppShopHasArticle;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/api")
 */
class AppShopHasArticleController extends Controller
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
     * @Route("/app_shop_has_articles/app/{app}", name="admin_app_shop_has_articles_by_app")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function appShopHasArticlesByAppIdAction(App $app)
    {
        $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByAppIdAndActive($app->getId());

        $context = SerializationContext::create()->setGroups(array('ArticleFull', 'Default', 'AppShopArticleHasPMPCFull'));

        return new Response($this->serializer->serialize($appShopHasArticles, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/article/app_shop_has_articles/article/{articleId}", name="admin_app_shop_has_articles_by_id")
     */
    public function getAppShopHasArticleById(Request $request, $articleId)
    {
        $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByArticleIdAndActive($articleId);
        $context = SerializationContext::create()->setGroups(array('ArticleFull', 'Default', 'AppShopArticleHasPMPCFull'));

        return new Response($this->serializer->serialize($appShopHasArticles, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }
}
