<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Service\AppService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Route("/api")
 */
class GamerController extends Controller
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
     * @var AppService
     * @Inject("app.app")
     */
    public $appService;

    /**
     * @Route("/app/{app}/gamers/for_testing", name="admin_gamer_get_all_for_testing")
     * @Method(methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getForTestingAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_TEST_SHOP,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $gamers = $app->getForTestingGamers();

        return new Response($this->serializer->serialize($gamers->toArray(), 'json'),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/gamers/{gamerExternalId}/for_testing", name="admin_gamer_set_for_testing")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @Method(methods={"POST"})
     */
    public function setGamerForTestingAction(App $app, Request $request, $gamerExternalId)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($request->get('for_testing') === null)
            throw new BadRequestHttpException("ignored is required");

        if (!in_array(RoleEnum::ADMIN_TEST_SHOP,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($app->getId(), $gamerExternalId);
        if (!$gamer)
        {
            $gamer = new Gamer($app, $gamerExternalId);
            $this->em->persist($gamer);
        }

        $gamer->setForTesting($request->get('for_testing'));
        $this->em->flush();

        return new Response($this->serializer->serialize($gamer, 'json'),  200, ['Content-Type' => 'application/json']);
    }


    /**
     * @Route("/app/{app}/gamers/blacklisted", name="admin_gamer_get_all_blacklisted")
     * @Method(methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getBlacklistedAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $gamers = $app->getBlacklistedGamers();

        return new Response($this->serializer->serialize($gamers->toArray(), 'json'),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/gamers/{gamerExternalId}/blacklisted", name="admin_gamer_set_blacklisted")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @Method(methods={"POST"})
     */
    public function setGamerBlacklistedAction(App $app, Request $request, $gamerExternalId)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($request->get('blacklisted') === null)
            throw new BadRequestHttpException("blacklisted is required");

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($app->getId(), $gamerExternalId);

        if (!$gamer)
        {
            $gamer = new Gamer($app, $gamerExternalId);
            $this->em->persist($gamer);
        }

        $gamer->setBlacklisted($request->get('blacklisted'));
        $this->em->flush();

        return new Response($this->serializer->serialize($gamer, 'json'),  200, ['Content-Type' => 'application/json']);
    }
}
