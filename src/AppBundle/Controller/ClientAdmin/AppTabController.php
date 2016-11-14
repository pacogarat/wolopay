<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppTab;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Traits\SonataMedia;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * @Route("/api")
 */
class AppTabController extends Controller
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
     * @Route("/app_tabs/{app_id}", name="admin_get_tabs", methods={"GET"})
     */
    public function getAllAction(Request $request, $app_id)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $context = SerializationContext::create()->setGroups(array('allTranslations', 'Default', 'AppTabFull'))->enableMaxDepthChecks();

        $apps = $this->em->getRepository("AppBundle:AppTab")->findByAppId($app_id);

        return new Response($this->serializer->serialize($apps, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app_tab/app/{app_id}/photo/{app_tab_id}", name="admin_post_tabs_photo", methods={"POST"})
     * @Route("/app_tab/app/{app_id}/photo/", name="admin_post_tabs_photo_new", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function postPhotoAction(Request $request, $app_id, $app_tab_id=null, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw new AccessDeniedException();

        if ($app_tab_id)
        {
            $appTab = $this->em->getRepository("AppBundle:AppTab")->find($app_tab_id);
            if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($appTab->getApp())))
                throw new AccessDeniedException();
        }else{

            $appTab = new AppTab();
            $appTab
                ->setApp($app)
                ->setName('pending_'.time())
                ->setActive(false)
            ;


            $this->em->persist($appTab);
        }

        if ($request->files->get('file'))
        {
            /** @var UploadedFile $file */
            $file = $request->files->get('file');
            if ($file->getSize() > 100000)
                return new JsonResponse(['message'=>'image_size_exceed', 400]);

            if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                return new JsonResponse(['message'=>'image_invalid_format', 400]);

            $oldImage = $appTab->getImage();

            $media = $this->sonataCreateMediaImageFromUploadedFile($file, AppTab::SONATA_CONTEXT);

            $appTab->setImage($media);
            $this->sonataRemoveImage($oldImage);
        }

        $this->em->flush();

        $context = SerializationContext::create()->setGroups(array('AppTabFull','Default'))->enableMaxDepthChecks();

        return new Response($this->serializer->serialize($appTab, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app_tab/app/{app_id}/photo/{app_tab_id}", name="admin_delete_tabs_photo", methods={"DELETE"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function deletePhotoAction(Request $request, $app_id, $app_tab_id=null, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $appTab = $this->em->getRepository("AppBundle:AppTab")->find($app_tab_id);

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($appTab->getApp())))
            throw new AccessDeniedException();

        if ($appTab->getImage())
        {
            $this->sonataRemoveImage($appTab->getImage());
            $appTab->setImage(null);
            $this->em->flush();
        }

        return new Response(null,  200, ['Content-Type' => 'application/json']);
    }
}
