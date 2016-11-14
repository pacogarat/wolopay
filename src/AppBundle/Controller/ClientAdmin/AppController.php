<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\ClientUserHasApp;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\RoleAdminEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\RoleAdminCategory;
use AppBundle\Service\AppService;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Route("/api")
 */
class AppController extends Controller
{
    use SonataMedia;

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
     * @Route("/apps", name="admin_get_apps", methods={"GET"})
     */
    public function getAllAction(Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $context = SerializationContext::create()->setGroups(array('Default','AppFull'));

        $apps = $this->em->getRepository("AppBundle:App")->findByAppAppClientId($clientUser->getClient()->getId());

        return new Response($this->serializer->serialize($apps, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app_id}", name="admin_get_app", methods={"GET"})
     */
    public function getAction(Request $request, $app_id)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $context = SerializationContext::create()->setGroups(array('Default','AppFull'));

        $app = $this->em->getRepository("AppBundle:App")->findOneByAppIdAndClientId($app_id, $clientUser->getClient()->getId());

        return new Response($this->serializer->serialize($app, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app", name="admin_app_new", methods={"POST"})
     */
    public function postAppAction(Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($appId=$request->get('id') )
        {
            $app = $this->em->getRepository("AppBundle:App")->findOneByAppIdAndClientId($appId, $clientUser->getClient()->getId());

            if (!$app)
                throw new BadRequestHttpException("Not found");

            if (!in_array(RoleEnum::ADMIN_MANAGE_PROJECTS , $clientUser->getRolesAdmin($app)))
                throw $this->createAccessDeniedException();

        }else{
            $app = new App();
            $app->setActive(false);
        }

        $app
            ->setName($request->get('name'))
            ->setUrlHomeSite($request->get('url_home_site'))
            ->setUrlNotificationPayment($request->get('url_notification_payment'))
            ->setUrlNotificationSubscription($request->get('url_notification_subscription'))
            ->setOwnerEmail($request->get('owner_email'))
            ->setAdministrationEmail($request->get('administration_email'))
            ->setEndUserSupportEmail($request->get('end_user_support_email'))
            ->setTechnicalEmail($request->get('technical_email'))
            ->setExternalAppId($request->get('external_app_id'))
            ->setClient($clientUser->getClient())
            ->setCommissionCurrency($this->em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO) )
        ;

        if (!$app->getActive())
        {
            $app->setCountries([]);
            for ($i=0; $i <= 1000; $i++)
            {
                if ($countryId = $request->get('country_'.$i))
                {
                    if ($country = $this->em->getRepository("AppBundle:Country")->find($countryId))
                    {
                        $app->addCountry($country);
                    }
                }
            }
        }

        if ($request->files->get('logo'))
        {
            /** @var UploadedFile $file */
            $file = $request->files->get('logo');
            if ($file->getSize() > 100000)
                return new JsonResponse(['message'=>'image_size_exceed', 400]);

            if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                return new JsonResponse(['message'=>'image_invalid_format', 400]);

            $oldImage= $app->getLogo();
            $media = $this->sonataCreateMediaImageFromUploadedFile($file, App::SONATA_CONTEXT);
            $app->setLogo($media);
            $this->sonataRemoveImage($oldImage);
        }

        $this->em->persist($app);
        $this->em->flush();

        // configure project
        if ($clientUser->getClient()->getOnCreateAppActiveByDefault() && !$app->getAppApiHasCredential())
        {
            $credentials = new AppApiCredentials($app);
            $app
                ->setAppApiHasCredential($credentials)
            ;
            $first = $clientUser->getAllApps()[0];

            $clientUser->addClientUserHasApp(new ClientUserHasApp($app, $clientUser, $this->em->getRepository("AppBundle:RoleAdminCategory")->find(RoleAdminEnum::OWNER) ));
            $this->em->persist($credentials);

            foreach ($first->getAppHasPayMethodProviderCountry() as $pmpc)
            {
                $app->addAppHasPayMethodProviderCountry(
                    new AppHasPayMethodProviderCountry($pmpc->getPayMethodProviderHasCountry(), $app)
                );
            }

            $this->em->flush();
            $this->appService->onCreateAppInsertBasicData($app);
        }

        $this->em->flush();


        $context = SerializationContext::create()->setGroups(array('Public'));

        if (!$request->get('id') && !$clientUser->getClient()->getOnCreateAppActiveByDefault())
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Request new app '.$app->getName().', client '.$clientUser->getClient()->getNameCompany())
                ->setFrom($this->container->getParameter('email_app'))
                ->setTo($this->container->getParameter('email_info_wolopay'))
                ->setBody("
                    Request to create a new app

                    Application id:" .$app->getId()."
                    App name id:" .$app->getName()
                )
            ;
            $this->get('mailer')->send($message);
        }

        return new Response($this->serializer->serialize($app, 'json', $context),  201, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/is_configured", name="admin_app_is_configured")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function isConfiguredAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $articles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findNumArticlesConfiguredByAppId($app->getId());

        return new JsonResponse(['is_configured' => $articles > 0]);
    }

    /**
     * @Route("/auto_configuration/app/{app}", name="admin_app_auto_configuration", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getAutoConfigurationAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $context = SerializationContext::create()->setGroups(array('AdminStep0'));

        return new Response($this->serializer->serialize($app, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/auto_configuration/app/{app}", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getAutoConfigurationPostAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $app
            ->setPrettyPriceIsEnabled($request->get('pretty_price_is_enabled'))
            ->setCostOfLiveIsEnabled($request->get('cost_of_live_is_enabled'))
            ->setPayMethodsMaxFeeProviderPercent($request->get('pay_methods_max_fee_provider_percent'))
            ->setPayMethodsAddFeeToFinalAmount($request->get('pay_methods_add_fee_to_final_amount'))
            ->setTaxToFinalAmount($request->get('tax_to_final_amount'))
            ->setWolopayFeeToFinalAmount($request->get('wolopay_fee_to_final_amount'))
        ;

        $this->get('app.app')->enableOrDisablePMPCFromApp($app);

        $this->em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/app/{app}/ips/blacklisted", name="admin_ips_get_all_blacklisted")
     * @Method(methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getIpsBlacklistedAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        return new JsonResponse($app->getBlacklistedIPs());
    }

    /**
     * @Route("/app/{app}/ips/blacklisted", name="admin_ips_set_blacklisted")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @Method(methods={"POST"})
     */
    public function setIpBlacklistedAction(App $app, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if ($request->get('state') === null || $request->get('ip') === null )
            throw new BadRequestHttpException("blacklisted is required");

        $ip = $request->get('ip');

        if (!$app->isBlacklistedIpValid($ip))
            throw new BadRequestHttpException("Ip is invalid");

        if (!in_array(RoleEnum::ADMIN_CONFIGURE,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($request->get('state'))
            $app->addBlacklistedIP($ip);
        else
            $app->removeBlacklistedIP($ip);

        $this->em->flush();

        return new JsonResponse($app->getBlacklistedIPs());
    }
}
