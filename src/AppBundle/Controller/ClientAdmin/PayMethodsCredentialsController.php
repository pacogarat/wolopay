<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientHasProviderCredential;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Provider;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
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
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/api")
 */
class PayMethodsCredentialsController extends Controller
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
     * @Route("/app/{app}/pay_method_credentials/available", name="api_admin_pay_methods_credentials_available", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getListAvailableAction(Request $request, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_MANAGE_PROJECTS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $credentials = $this->em->getRepository("AppBundle:Provider")->findByHasClientCredentials();
        $serializer = $this->get('jms_serializer');
        $serializationContext = SerializationContext::create()->setGroups(array('Default', 'ProviderAddPMP'));

        return new Response($serializer->serialize($credentials, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/pay_method_credentials", name="api_admin_pay_methods_credentials", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function getListAction(Request $request, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_MANAGE_PROJECTS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $credentials = $this->em->getRepository("AppBundle:ClientHasProviderCredential")->findByAppId($app->getId());
        $serializer = $this->get('jms_serializer');
        $serializationContext = SerializationContext::create()->setGroups(array('Default'));

        return new Response($serializer->serialize($credentials, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app}/pay_method_credentials/{client_provider_credentials_id}", name="api_admin_pay_methods_credentials_delete", methods={"DELETE"})
     * @ParamConverter("clientProviderCredentials", class="AppBundle:ClientHasProviderCredential", options={"id" = "client_provider_credentials_id"})
     */
    public function deletePayMethodAction(Request $request, App $app, ClientHasProviderCredential $clientProviderCredentials)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_MANAGE_PROJECTS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($clientUser->getClient()->getId() !== $clientProviderCredentials->getClient()->getId())
            throw new BadRequestHttpException();

        $this->em->remove($clientProviderCredentials);
        $this->em->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/app/{app}/pay_method_credentials/{providerId}", name="api_admin_pay_methods_credentials_provider", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("provider", class="AppBundle:Provider", options={"id" = "providerId"})
     */
    public function postPayMethodAction(Request $request, App $app, Provider $provider)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_MANAGE_PROJECTS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if (!$provider->getHasClientCredentials())
            throw new BadRequestHttpException();

        $pmp = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findBy(['provider' => $provider]);
        $serviceId = $pmp[0]->getPaymentServiceCategory()->getId();

        if (!$this->validateCredentials($request, $serviceId))
            throw new BadRequestHttpException();

        foreach ($request->request->all() as $row)
        {
            $arrayCredentials = $this->getArrayCredentialsFromRequest($row, $serviceId);

            if (!isset($row['id']) || !$clientHasProviderCredential = $this->em->getRepository("AppBundle:ClientHasProviderCredential")->find($row['id']))
                $clientHasProviderCredential = new ClientHasProviderCredential($clientUser->getClient(), $provider);

            if ($clientHasProviderCredential->getClient()->getId() !== $clientUser->getClient()->getId())
                throw new AccessDeniedException();

            $clientHasProviderCredential->setDetails($arrayCredentials);
            $clientHasProviderCredential->setApps([]);

            if (isset($row['apps']))
            {
                foreach ($row['apps'] as $appRequest)
                {
                    $app = $this->em->getRepository("AppBundle:App")->find($appRequest['id']);
                    if ($app->getClient()->getId() !== $clientUser->getClient()->getId())
                        throw new AccessDeniedException();

                    $clientHasProviderCredential->addApp($app);
                }
            }

            $this->em->persist($clientHasProviderCredential);
        }

        $this->em->flush();

        return new JsonResponse();
    }

    private function validateCredentials(Request $request, $serviceId)
    {
        /** @var PayMethodVerifyCredentialsInterface $providerPayMethod */
        $providerPayMethod=$this->get($serviceId);

        if (!$providerPayMethod instanceof PayMethodVerifyCredentialsInterface)
            throw new BadRequestHttpException();

        try{

            foreach ($request->request->all() as $row)
            {
                $credentialsDetails = $this->getArrayCredentialsFromRequest($row, $serviceId);

                if (!$providerPayMethod->verifyCredentials($credentialsDetails))
                    return false;

            }

        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }


        return true;
    }

    private function getArrayCredentialsFromRequest($rowRequest, $serviceId)
    {
        /** @var PayMethodVerifyCredentialsInterface $providerPayMethod */
        $providerPayMethod=$this->get($serviceId);

        $credentialsDetails = $providerPayMethod->getShapeProviderClientCredentials();

        foreach ($credentialsDetails as $key=>&$value)
            $value = trim($rowRequest['details'][$key]);

        return $credentialsDetails;
    }
}
