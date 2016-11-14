<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\CountryService;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
class CountryController extends Controller
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
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
     * @var CountryService
     * @Inject("country")
     */
    public $countryService;

    /**
     * @Route("/country/cost_of_life/{amount}/{country_id}/{country_id_wanted}", name="admin_cost_of_life")
     */
    public function costOfLifeAction($amount, $country_id, $country_id_wanted, Request $request)
    {
        $country = $this->em->getRepository("AppBundle:Country")->find($country_id);
        $countryWanted = $this->em->getRepository("AppBundle:Country")->find($country_id_wanted);

        $amount = $this->countryService->getPriceCostOfLifeSimple(
            $amount,
            $country_id,
            $country_id_wanted
        );

        $amount = $this->currencyService->getExchange(
            $amount,
            $country->getCurrency(),
            $countryWanted->getCurrency()->getId()
        );

        if ($request->get('pretty_price'))
        {
            $amount = UtilHelper::prettyPrice(
                $amount,
                $countryWanted->getCurrency()->getDecimalPlaces(),
                $countryWanted->getDecimalFormat()
            );
        }

        return new JsonResponse(['price' => $amount]);
    }

    /**
     * @Route("/country/exchange/{amount}/{country_id}/{country_id_wanted}", name="admin_exchange")
     */
    public function exchangeAction($amount, $country_id, $country_id_wanted, Request $request)
    {
        $country = $this->em->getRepository("AppBundle:Country")->find($country_id);
        $countryWanted = $this->em->getRepository("AppBundle:Country")->find($country_id_wanted);

        $amount = $this->currencyService->getExchange(
            $amount,
            $country->getCurrency(),
            $countryWanted->getCurrency()->getId()
        );

        if ($request->get('pretty_price'))
            $amount = UtilHelper::prettyPrice($amount);

        return new JsonResponse(['price' => $amount]);
    }

    /**
     * @Route("/country/{app}/{shops_ids}", name="admin_countries")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function shopsAction(App $app, $shops_ids)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var AppShop[] $appShops */
        $appShops = UtilHelper::getObjectsFromCSV($shops_ids, "AppBundle:AppShop", $this->em);

        $levelIds=[];

        foreach ($appShops as $as)
            $levelIds[]=$as->getLevelCategory()->getId();

        $countries = $this->em->getRepository("AppBundle:Country")->findByAppIdAndLevelCategoryAndArticlesStatusInCountriesAvailable(
            true,
            $app->getId(),
            $levelIds
        );

        $result ='';
        foreach ($countries as $country)
            $result.=','.$this->serializer->serialize($country, 'json', SerializationContext::create()->setGroups(array('CountryFull', 'Default')));

        $result= '['.substr($result,1).']';

        return new Response($result, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/country", name="admin_countries_all")
     */
    public function getAllAction(Request $request )
    {
        $countries = $this->em->getRepository("AppBundle:Country")->findByAppAndAllAvailableWithPMPC($request->get('app_id'), !$request->get('pmpc'));

        $result ='';
        foreach ($countries as $country)
            $result.=','.$this->serializer->serialize($country, 'json', SerializationContext::create()->setGroups(array('CountryFull', 'Default')));

        $result= '['.substr($result,1).']';

        return new Response($result, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/country/standard", name="admin_countries_standard_all")
     */
    public function getAllStandardAction(Request $request )
    {
        $countries = $this->em->getRepository("AppBundle:Country")->findAllStandard();

        $result ='';
        foreach ($countries as $country)
            $result.=','.$this->serializer->serialize($country, 'json', SerializationContext::create()->setGroups(array('CountryFull', 'Default')));

        $result= '['.substr($result,1).']';

        return new Response($result, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/country/{app}", name="admin_country_app", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function updateAction(Request $request, App $app)
    {
        $countries = $request->get('countries');

        $app->setCountries([]);
        foreach ($countries as $countryId)
            $app->addCountry($this->em->getRepository("AppBundle:Country")->find($countryId));

        $this->em->flush();

        return new Response('', 201, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/country/blacklisted", name="admin_country_get_all_blacklisted")
     * @Method(methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getBlacklistedAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        return new Response($this->serializer->serialize($app->getBlacklistedCountries(), 'json'),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/country/{countryId}/blacklisted", name="admin_country_set_blacklisted")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "countryId"})
     * @Method(methods={"POST"})
     */
    public function setGamerBlacklistedAction(App $app, Request $request, Country $country)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($request->get('blacklisted') === null)
            throw new BadRequestHttpException("blacklisted is required");

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($request->get('blacklisted'))
            $app->addBlacklistedCountry($country);
        else
            $app->removeBlacklistedCountry($country);

        $this->em->flush();

        return new Response($this->serializer->serialize($country, 'json'),  200, ['Content-Type' => 'application/json']);
    }
}
