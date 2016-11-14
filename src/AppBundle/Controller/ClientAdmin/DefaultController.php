<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Util\WSSEUtil;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Route("/test/js", name="test_js")
     * @Template()
     */
    public function testJsAction()
    {
        return [];
    }

    /**
     * @Route("/", name="admin_home")
     * @Template()
     */
    public function indexAction()
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $languageDefault = $clientUser->getLanguage();

        $em =$this->getDoctrine();
        $currency = $em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO);
        $currencies = $em->getRepository("AppBundle:Currency")->findBy(['id'=>[CurrencyEnum::EURO, CurrencyEnum::DOLLAR, CurrencyEnum::POUND_STERLING]]);

        $dateFrom = new \DateTime('-14 days', new \DateTimeZone($clientUser->getCountry()->getTimeZone()));
        $dateFrom->setTime(0, 0, 1);

        $dateTo = new \DateTime('now', new \DateTimeZone($clientUser->getCountry()->getTimeZone()));
        $dateTo->setTime(23, 59, 59);

        if ($clientUser->getClientUserHasApps()->isEmpty())
            throw $this->createAccessDeniedException();

        $timeLastLogin = '';

        if ($lastLogin = $clientUser->getLastLogin())
        {
            $timeLastLogin = $lastLogin->diff(new \DateTime());
            $timeLastLogin = $timeLastLogin->format('%h');
        }

        $languages = $em->getRepository("AppBundle:Language")->findBy(['id' => $this->container->getParameter('locale_available')]);

        return array(
            'apps' => $clientUser->getAllApps(),
            'currency' => $currency,
            'currencies' => $currencies,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'last_login_hours' => $timeLastLogin,
            'languageDefault' => $languageDefault,
            'languages' => $languages
        );
    }

    /**
     * @Route("/load/shop/test/{app}")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function loadShopTestAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $em =$this->getDoctrine();

        if (!in_array(RoleEnum::ADMIN_TEST_SHOP, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $appShop = $em->getRepository('AppBundle:AppShop')->findOneByAppIdAndLevelCategory($app->getId(), $request->get('level_category_id'));

        if (!$request->get('gamer_id') || !$appShop)
            return new Response('Bad Request');

        $params = [
            'gamer_id'  => $request->get('gamer_id'),
            'gamer_level'  => $appShop->getValueLower(),
            'test' => 1,
            'fixed_country' => 0,
        ];

        if ($request->get('country'))
            $params['countries'] = strtoupper($request->get('country'));

        if ($request->get('language'))
            $params['default_language'] = strtolower($request->get('language'));

        if ($request->get('selected_article_id'))
            $params['selected_article_id'] = strtolower($request->get('selected_article_id'));

        if ($request->get('selected_tab_category_id'))
            $params['selected_tab_category_id'] = strtolower($request->get('selected_tab_category_id'));

        $appDemoCredentials = $app->getAppApiHasCredential();
        $headers = [
            'X-WSSE' => WSSEUtil::generateHeaderWSSE($appDemoCredentials->getCodeKey(), $appDemoCredentials->getSecretKey())
        ];

        try {
            $request   = $this->guzzle->post($this->container->getParameter('domain_main'). $this->generateUrl('api_transaction_create_transaction'), $headers, $params);
            $response  = $request->send();
        } catch (ClientErrorResponseException $exception) {
            return new Response($exception->getResponse()->getBody(true));
        }

        $obj = json_decode($response->getBody(true));

        return new RedirectResponse($obj->url);
    }

    /**
     * @Route("/api/roles/{app}")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function rolesAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        return new JsonResponse($clientUser->getRolesAdmin($app));
    }
}
