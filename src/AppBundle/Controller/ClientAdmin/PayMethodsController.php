<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\PayMethod;
use AppBundle\Service\AppService;
use AppBundle\Service\AppShopHasArticleService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class PayMethodsController extends Controller
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var AppShopHasArticleService
     * @Inject("app_shop_has_article")
     */
    public $appShopHasArticleService;

    /**
     * @Route("/pay_methods/", name="api_admin_pay_methods")
     */
    public function payMethodsAllAction()
    {
        /** @var PayMethod[] $payMethods */
        $payMethods = $this->em->getRepository("AppBundle:PayMethod")->findBy(['active'=> true]);

        $serializer = $this->get('jms_serializer');
        $serializationContext = SerializationContext::create()->setGroups(array('Admin'));

        return new Response($serializer->serialize($payMethods, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/pay_methods/specials/app/{app}", name="api_admin_pay_methods_specials_by_app")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function payMethodsSpecialAction(Request $request, App $app)
    {
        /** @var AppService $appService */
        $appService = $this->container->get('app.app');
        $pmpcCountries = $appService->getRealCountriesPMPC($app);

        /** @var PayMethod[] $payMethods */
        $payMethods = $this->em->getRepository("AppBundle:PayMethod")->findByAppIdAndPaymentServiceCategoriesIdAndCountries($app->getId(), PaymentServiceCategoryEnum::$PREFIXED_PRICE_PAYMETHODS, $pmpcCountries);

        $serializer = $this->get('jms_serializer');
        $serializationContext = SerializationContext::create()->setGroups(array('Admin','CountryFull', 'PayMethodProviderHasCountryFull', 'Default'));

        return new Response($serializer->serialize($payMethods, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/pay_methods/app/{app}", name="api_admin_pay_methods_by_app")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function payMethodsAction(Request $request, App $app)
    {
        /** @var PayMethod[] $payMethods */
        $payMethods = $this->em->getRepository("AppBundle:PayMethod")->findByAppId($app->getId(), $request->get('active'));

        $serializer = $this->get('jms_serializer');
        $serializationContext = SerializationContext::create()->setGroups(array('Admin','CountryFull','PayMethodProviderHasCountryFull', 'Default'));

        return new Response($serializer->serialize($payMethods, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/pay_methods/count/app/{app}", name="api_admin_pay_methods_with_filters_count")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function payMethodsWithFiltersCount(Request $request, App $app)
    {
        /** @var PayMethod[] $payMethods */
        $num = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findByAppAndSomeFilters(true, $app->getId(), $request->query->getInt('pay_methods_max_fee_provider_percent', null));

        return new JsonResponse($num);
    }

    /**
     * @Route("/pay_methods/sync/app/{app}", name="api_admin_pay_methods_sync_by_app", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function syncPayMethodsAction(Request $request, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if (!$payMethodsPost = $request->get('pay_methods'))
            return new JsonResponse([], 400);

        foreach ($app->getAppHasPayMethodProviderCountry() as $appHasPayMethodProviderCountry)
            $appHasPayMethodProviderCountry->setActive(false);

        foreach ($payMethodsPost as $payMethodPost)
        {
            foreach ($app->getAppHasPayMethodProviderCountry() as $appHasPayMethodProviderCountry)
            {
                $pmpc = $appHasPayMethodProviderCountry->getPayMethodProviderHasCountry();

                if ($pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId() === PaymentServiceCategoryEnum::NVIA_PROMO_CODE)
                    $appHasPayMethodProviderCountry->setActive(true);

                if (isset($payMethodPost['selected_'.$pmpc->getCountry()->getId()]) && $payMethodPost['selected_'.$pmpc->getCountry()->getId()] === true
                    && $payMethodPost['id'] == $pmpc->getPayMethod()->getId()
                )
                {
//                    echo "ADDED".$pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId()." ".$pmpc->getPayMethodHasProvider()->getPaymentServiceCategory()->getId();

                    $appHasPayMethodProviderCountry->setActive(true);
//                    break;
                }

            }
        }

        $this->em->flush();

        return new JsonResponse();
    }
}
