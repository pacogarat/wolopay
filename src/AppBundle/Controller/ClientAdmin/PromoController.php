<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Promo;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api")
 */
class PromoController extends Controller
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Route("/app/{app}/promos", name="admin_promos_list", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getPromosAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $page = $request->get('page') ?: 0;
        $rows = 20;

        $serializer = $this->get('jms_serializer');
        $promoCodes = $this->em->getRepository("AppBundle:Promo")->findByAppId($app->getId(), $page*$rows, $rows);

        $context = SerializationContext::create()->setGroups(array('Default','allTranslations','PromoAddPromoCodes','PromoFull', 'PromoCodeFull'));

        return new Response($serializer->serialize($promoCodes, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/promo", name="admin_promo_create", methods={"POST"})
     * @Route("/app/{app}/promo/{promoId}", name="admin_promo_update", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function createPromoAction(App $app, $promoId=null, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($promoId === null)
            $promo = new Promo();
        else
        {
            if (!$promo = $this->em->getRepository("AppBundle:Promo")->findOneByPromoIdAndAppId($promoId, $app->getId()))
                throw new BadRequestHttpException("Invalid promo");
        }

        $promo
            ->setApp($app)
            ->setName($request->get('name'))
            ->setNUsesPerUser(UtilHelper::is0GetNull($request->get('n_uses_per_user')))
            ->setNTotalUses(UtilHelper::is0GetNull($request->get('n_total_uses')))
        ;

        if ($beginAt = $request->get("begin_at"))
        {
            $promo->setBeginAt(new \DateTime($beginAt));
        }else{
            $promo->setBeginAt(null);
        }

        if ($endAt = $request->get("end_at"))
        {
            $promo->setEndAt(new \DateTime($endAt));
        }else{
            $promo->setEndAt(null);
        }

        $validator = $this->get('validator');
        $violations = $validator->validate($promo);

        if ($violations->count() > 0)
        {
            throw new BadRequestHttpException();
        }

        $this->em->persist($promo);
        $this->em->flush();

        return new JsonResponse(['id' => $promo->getId()]);
    }

    /**
     * @Route("/app/{app}/promo/{promoId}", name="admin_promo_delete", methods={"DELETE"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function deletePromoAction(App $app, $promoId, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if (!$promo = $this->em->getRepository("AppBundle:Promo")->findOneByPromoIdAndAppId($promoId, $app->getId()))
            throw new BadRequestHttpException("Invalid promo");

        $this->em->remove($promo);
        $this->em->flush();

        return new JsonResponse();
    }

}
