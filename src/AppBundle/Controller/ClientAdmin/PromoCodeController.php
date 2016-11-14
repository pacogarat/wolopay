<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Component\HttpFoundation\CsvResponse;
use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Promo;
use AppBundle\Entity\PromoCode;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManager;
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
class PromoCodeController extends Controller
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Route("/app/{app}/promo-codes", name="admin_promo_code_list")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function activeSubscriptionAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $page = $request->get('page') ?: 0;
        $rows = 50;

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $serializer = $this->get('jms_serializer');
        $promoCodes = $em->getRepository("AppBundle:PromoCode")->findByAppId($app->getId());

        $context = SerializationContext::create()->setGroups(array('Default','allTranslations'));

        return new Response($serializer->serialize($promoCodes, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/promo/{promoId}/codes/toCsv/", name="promo_codes_tocsv")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("promo", class="AppBundle:Promo", options={"id" = "promoId"})
     */
     public function promoCodesToCsv(App $app, Promo $promo){
         $sql="
            SELECT  pc.code as promoCode,
                    pc.countNTimeUsed,
                    pc.nUsesPerUser,
                    pc.nTotalUses,
                    pc.beginAt,
                    pc.endAt
            FROM
              AppBundle:PromoCode pc
              JOIN pc.promo p
          WHERE
              p.id = :promoId
        ";

         /** @var EntityManager $em */
         $em = $this->getDoctrine()->getManager();

         $sqlResult = $em
             ->createQuery($sql)
             ->setParameters(array_merge(['promoId' => $promo->getId()]))
             ->getArrayResult()
         ;

         $app = $promo->getApp();
         $header = "promoCode,timesUsed,limitedToNRedemptionsPerUser,LimitedToNTotalRedemptions,validFrom,validTo";

         $headerArr =array();
         $r2 = array();

         $headerArr = explode(",",$header);
         array_push($r2,$headerArr );

         foreach ($sqlResult as $key=>&$line){
             array_push($r2,$line);
         }
         return new CsvResponse($r2,200,[],"promoCodes_". str_replace(" ","-",$app->getName())."_".$promo->getId().".csv");

     }


    /**
     * @Route("/app/{app}/promo_code/{promoCodeId}/copy", requirements={"num": "\d+"}, name="admin_promo_code_copy", methods={"POST"})
     * @ParamConverter("promoCode", class="AppBundle:PromoCode", options={"id" = "promoCodeId"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function copyPromoCodeAction(App $app, PromoCode $promoCode, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($promoCode->getApp()->getId() !== $app->getId())
            throw $this->createAccessDeniedException();

        $num = $request->get('times', 1);

        if (!$clientUser->hasRole(RoleEnum::SUPER_ADMIN))
        {
            if ($num > 1000)
                throw new BadRequestHttpException("limited to 1000 copies");
        }

        for ($i=0; $i<$num;$i++)
        {
            $newPromoCode = clone($promoCode);
            $newPromoCode->setCode($this->generateRandomFromApp($app));
            $this->em->persist($newPromoCode);
        }

        $this->em->flush();

        return new JsonResponse();
    }

    private function generateRandomFromApp(App $app)
    {
        $flag = true;
        while ($flag)
        {
            $random = UtilHelper::generateRandomString(8);
            if (!$this->em->getRepository("AppBundle:PromoCode")->findOneByCodeAndAppId($random, $app->getId()))
                $flag = false;
        }

        return $random;
    }

    /**
     * @Route("/app/{app}/promo/{promoId}/promo_code", name="admin_promo_code_create", methods={"POST"})
     * @Route("/app/{app}/promo/{promoId}/promo_code/{promoCodeId}", name="admin_promo_code_update", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("promo", class="AppBundle:Promo", options={"id" = "promoId"})
     */
    public function createUpdatePromoCodeAction(App $app, Promo $promo, $promoCodeId=null, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($promo->getApp()->getId() !== $app->getId())
            throw $this->createAccessDeniedException();

        if ($promoCodeId === null)
            $promoCode = new PromoCode();
        else
        {
            if (!$promoCode = $this->em->getRepository("AppBundle:PromoCode")->find($promoCodeId))
                throw new BadRequestHttpException("Invalid promo");

            if ($promoCode->getApp()->getId() !== $app->getId())
                throw $this->createAccessDeniedException();
        }

        $promoCode
            ->setCode($request->get("code"))
            ->setPromo($promo)
            ->setApp($app)
            ->setNUsesPerUser(UtilHelper::is0GetNull($request->get('n_uses_per_user')))
            ->setNTotalUses(UtilHelper::is0GetNull($request->get('n_total_uses')))
        ;

        $promoCode->setGamers([]);
        if ($gamersArr = $request->get("gamers"))
        {
            foreach ($gamersArr as $gamerExternalId)
            {
                $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($app->getId(), $gamerExternalId);
                if (!$gamer)
                {
                    $gamer = new Gamer($app, $gamerExternalId);
                    $this->em->persist($gamer);
                    $this->em->flush($gamer);
                }

                $promoCode->addGamer($gamer);
            }
        }

        if ($beginAt = $request->get("begin_at"))
        {
            $promoCode->setBeginAt(new \DateTime($beginAt));
        }else{
            $promoCode->setBeginAt(null);
        }

        if ($endAt = $request->get("end_at"))
        {
            $promoCode->setEndAt(new \DateTime($endAt));
        }else{
            $promoCode->setEndAt(null);
        }

        if ($articleId = $request->get("article"))
        {
            $article = $this->em->getRepository("AppBundle:Article")->find($articleId);
            if ($article && $article->getApp()->getId() !== $app->getId())
                throw new BadRequestHttpException("invalid a rticle");

            $promoCode->setArticle($article);
        }else{

            $promoCode->setArticle(null);
        }

        $validator = $this->get('validator');
        $violations = $validator->validate($promoCode);

        if ($violations->count() > 0)
            throw new BadRequestHttpException((string) $violations);

        $this->em->persist($promoCode);
        $this->em->flush();

        return new JsonResponse(['id' => $promoCode->getId()]);
    }

    /**
     * @Route("/app/{app}/promo_code/{promoCodeId}", name="admin_promo_code_delete3", methods={"DELETE"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function deletePromoAction(App $app, $promoCodeId, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_PROMO_CODES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if (!$promo = $this->em->getRepository("AppBundle:PromoCode")->find($promoCodeId))
            throw new BadRequestHttpException("Invalid promo code");

        if ($promo->getApp()->getId() !== $app->getId())
            throw $this->createAccessDeniedException();

        $this->em->remove($promo);
        $this->em->flush();

        return new JsonResponse();
    }

}
