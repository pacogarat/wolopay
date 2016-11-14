<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\Article;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\OfferService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/api")
 */
class OfferController extends Controller
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
     * @var OfferService
     * @Inject("shop_app.offer")
     */
    public $offerService;

    /**
     * @Route("/offer/{app}", name="admin_offer_list")
     * @Method({"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function listAction(App $app)
    {
        $context = SerializationContext::create()->setGroups(array('Default', 'Admin'));
        $offerProgrammers = $this->em->getRepository("AppBundle:OfferProgrammer")->findByAppIdAndActive($app->getId(), 1);
        return new Response($this->serializer->serialize($offerProgrammers, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/offer/{id}", name="admin_offer_delete")
     * @Method({"DELETE"})
     * @ParamConverter("offerProgrammer", class="AppBundle:OfferProgrammer")
     */
    public function deleteAction(OfferProgrammer $offerProgrammer)
    {
        $this->verifyPermissions($offerProgrammer->getApp(), $offerProgrammer);

        $this->offerService->delete($offerProgrammer);

        return new Response(json_encode([]), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/offer/{app}/{id}", name="admin_offer_details")
     * @Method({"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("offerProgrammer", class="AppBundle:OfferProgrammer", options={"id" = "id"})
     */
    public function getDetailsAction(App $app, OfferProgrammer $offerProgrammer)
    {
        $this->verifyPermissions($app, $offerProgrammer);



        $context = SerializationContext::create()->enableMaxDepthChecks();

        return new Response($this->serializer->serialize($offerProgrammer, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/offer/{app}", methods={"POST"}, name="admin_offer_create")
     * @Route("/offer/{app}/{offer_programmer_id}", methods={"PUT"}, name="admin_offer_update")
     *
     * @RequestParam(name="name", nullable=false)
     * @RequestParam(name="shops_ids", nullable=false)
     * @RequestParam(name="countries", nullable=false)
     * @RequestParam(name="articles_extra_ids", nullable=true)
     * @RequestParam(name="articles_ids", nullable=false)
     * @RequestParam(name="date_from", nullable=false)
     * @RequestParam(name="date_to", nullable=false,description="Currency")
     * @RequestParam(name="local_time", nullable=false)
     * @RequestParam(name="price", nullable=false)
     * @RequestParam(name="quantity_extra", nullable=false)
     * @RequestParam(name="limit_purchases", nullable=false)
     * @RequestParam(name="limit_per_user", nullable=false)
     * @RequestParam(name="pretty_price", nullable=false)
     *
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function createAndUpdateAction(App $app, $name, $shops_ids, $countries, $articles_ids, $articles_extra_ids,\DateTime $date_from,
        \DateTime $date_to, $local_time, $price, $quantity_extra, $limit_purchases, $limit_per_user, $pretty_price,
        $offer_programmer_id = null
    )
    {
        // in the future take offset from client
        $local = new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
        $offset = $local->getOffset();

        $offerProgrammer=null;
        if ($offer_programmer_id)
        {
            if (!$offerProgrammer=$this->em->getRepository("AppBundle:OfferProgrammer")->find($offer_programmer_id))
                throw new BadRequestHttpException("Invalid offer programmer id");
        }

        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $this->verifyPermissions($app, $offerProgrammer);

        /** @var AppShop[] $appShops */
        $appShops = UtilHelper::getObjectsFromCSV($shops_ids, "AppBundle:AppShop", $this->em);
        /** @var Country[] $countries */
        $countries = UtilHelper::getObjectsFromCSV($countries, "AppBundle:Country", $this->em);
        /** @var Article[] $articles */
        $articles = UtilHelper::getObjectsFromCSV($articles_ids, "AppBundle:Article", $this->em);
        /** @var Article[] $articles */
        $articlesExtra = UtilHelper::getObjectsFromCSV($articles_extra_ids, "AppBundle:Article", $this->em);

        foreach ($appShops as $shop)
            if ($shop->getApp()->getId() != $app->getId())
                throw new BadRequestHttpException("Invalid Shop");

        foreach (array_merge($articles, $articlesExtra) as $article)
            if ($article->getApp()->getId() != $app->getId())
                throw new BadRequestHttpException("Invalid Article");

        if (count($appShops) < 1 || count($countries) < 1 || count($articles) < 1 )
            throw new BadRequestHttpException('Or appShops or Countries or Articles all are required');

        /** @var OfferProgrammer[] $offerProgrammerAtTheSameTime */
        $offerProgrammerAtTheSameTime = $this->em->getRepository("AppBundle:OfferProgrammer")->findIfExistOtherOfferInSamePeriod(
            UtilHelper::getIdsArrayFromObjects($articles),
            UtilHelper::getIdsArrayFromObjects($appShops),
            UtilHelper::getIdsArrayFromObjects($countries),
            $date_from,
            $date_to,
            $offerProgrammer
        );

        if ($offerProgrammerAtTheSameTime)
        {
            $str = [];

            foreach ($offerProgrammerAtTheSameTime as $offerProgrammer)
                $str[] = $offerProgrammer->getName();

            return new Response(json_encode(['message' => $str]), 422, ['Content-Type' => 'application/json']);
        }

        $offerProgrammer = $this->offerService->createOrUpdate($offerProgrammer, $app, $name, $appShops, $countries, $articles, $articlesExtra, $date_from, $date_to,
            $local_time, $price, $quantity_extra, $limit_purchases, $limit_per_user, $pretty_price, $offset
        );

        $context = SerializationContext::create()->enableMaxDepthChecks();
        return new Response($this->serializer->serialize($offerProgrammer, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    private function verifyPermissions(App $app, OfferProgrammer $offerProgrammer = null)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if (!$clientUser->hasApp($app))
            throw new AccessDeniedException("Permisison denied for this app");

        if ($offerProgrammer)
        {
            if ($offerProgrammer->getApp()->getId() != $app->getId())
                throw new AccessDeniedException("Permisison denied for this app");
        }
    }
}
