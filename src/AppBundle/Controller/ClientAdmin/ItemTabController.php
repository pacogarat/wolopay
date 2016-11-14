<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\ItemTab;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\Collections\ArrayCollection;
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
class ItemTabController extends Controller
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

    private function verifyAccessDeniedByRole(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();
    }

    /**
     * @Route("/app/{app}/item_tab", name="admin_items_category_list", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function listAction(App $app)
    {
        $this->verifyAccessDeniedByRole($app);

        $items = $this->em->getRepository("AppBundle:ItemTab")->findByAppId($app);
        $context = SerializationContext::create()->setGroups(array('allTranslations', 'Default', 'ItemFull&Translations'));

        return new Response($this->serializer->serialize($items, 'json', $context ), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app_id}/item_tab/{item_tab}/photo", name="admin_delete_item_tab_photo", methods={"DELETE"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function deletePhotoAction(Request $request, $app_id, $item_tab=null, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $itemTab = $this->em->getRepository("AppBundle:ItemTab")->find($item_tab);

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($itemTab->getApp())))
            throw new AccessDeniedException();

        if ($itemTab->getImage())
        {
            $this->sonataRemoveImage($itemTab->getImage());
            $itemTab->setImage(null);
            $this->em->flush();
        }

        return new Response(null,  200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/app/{app_id}/item_tab/sync", name="admin_post_item_tab_sync", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function syncAction(Request $request, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw new AccessDeniedException();

        $oldItemTabs = $app->getItemTabs();

        $itemTabsArr = $request->get('itemTabs', [], true);
        $itemTabOrder = 0;
        $itemTabSaved = new ArrayCollection();
        foreach ($itemTabsArr as $itemTabsPost)
        {
            $temp = new ItemTab();
            $temp->setName($itemTabsPost['name']);

            if (isset($itemTabsPost['id']) && $itemTabsPost['id'])
                $itemTab = $this->em->getRepository("AppBundle:ItemTab")->find($itemTabsPost['id']);
            else
                $itemTab = $this->em->getRepository("AppBundle:ItemTab")->findOneByAppIdAndNameUnique($app->getId(), $temp->getNameUnique());


            if (!$itemTab)
            {
                $itemTab = new ItemTab();
                $itemTab->setApp($app);
            }

            $itemTabSaved[] = $itemTab;

            $itemTab
                ->setName($itemTabsPost['name'])
                ->setOrder($itemTabOrder++)
            ;


            $itemTab->setNameLabel(
                $this->translationChange(
                    isset($itemTabsPost['name_label']) ? $itemTabsPost['name_label'] : null,
                    $itemTab->getNameLabel(),
                    $app
                )
            );

            $itemTab->setDescriptionLabel(
                $this->translationChange(
                    isset($itemTabsPost['description_label']) ? $itemTabsPost['description_label'] : null,
                    $itemTab->getDescriptionLabel(),
                    $app
                )
            );

            $this->em->persist($itemTab);
            $this->em->flush();
        }

        /** @var $oldCat ItemTab */
        foreach ($oldItemTabs as $oldCat)
        {
            if (!$itemTabSaved->contains($oldCat))
            {
                $this->sonataRemoveImage($oldCat->getImage());

                if ($oldCat->getNameLabel())
                    $this->em->remove( $oldCat->getNameLabel() );

                if ($oldCat->getDescriptionLabel())
                    $this->em->remove( $oldCat->getDescriptionLabel() );

                $this->em->remove($oldCat);
            }
        }

        $this->em->flush();

        return $this->listAction($app);
    }

    private function translationChange($post, \Lexik\Bundle\TranslationBundle\Entity\TransUnit $translationLabel= null, App $app)
    {
        $transLexik = $this->get('lexik_translation.trans_unit.manager');

        if (!$post)
        {
            if ($translationLabel && $translationLabel->getDomain() == $app->getTranslationDomain())
                $this->em->remove($translationLabel);

            return null;
        }

        foreach ($app->getLanguages() as $language)
        {
            $message =  isset($post['translation_'.$language->getId()]) ? $post['translation_'.$language->getId()] : '';

            // verify modified
            if ($translationLabel && $translationLabel->getTranslation($language->getId()) !== $message || !$translationLabel)
            {
                if (!$translationLabel || $translationLabel->getDomain() !== $app->getTranslationDomain())
                {
                    // create new lexiktrans
                    $translationLabel = $transLexik->create('app_tab.'.uniqid(),  $app->getTranslationDomain());
                }

                if ($translationLabel->hasTranslation($language->getId()))
                {
                    $transLexik->updateTranslation($translationLabel, $language->getId(), $message);
                }else{
                    $transLexik->addTranslation($translationLabel, $language->getId(), $message);
                }
            }
        }

        return $translationLabel;
    }

    /**
     * @Route("/app/{app_id}/item_tab/photo/{item_tab}", name="admin_post_item_tab_photo", methods={"POST"})
     * @Route("/app/{app_id}/item_tab/photo/", name="admin_post_item_tab_photo_new", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})
     */
    public function postPhotoAction(Request $request, $item_tab=null, App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($app)))
            throw new AccessDeniedException();

        if ($item_tab)
        {
            $itemTab = $this->em->getRepository("AppBundle:ItemTab")->find($item_tab);
            if (!in_array(RoleEnum::ADMIN_CONFIGURE, $clientUser->getRolesAdmin($itemTab->getApp())))
                throw new AccessDeniedException();
        }else{

            $itemTab = new ItemTab();
            $itemTab
                ->setApp($app)
                ->setName('pending_'.time())
            ;

            $this->em->persist($itemTab);
        }

        if ($request->files->get('file'))
        {
            /** @var UploadedFile $file */
            $file = $request->files->get('file');
            if ($file->getSize() > 100000)
                return new JsonResponse(['message'=>'image_size_exceed', 400]);

            if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                return new JsonResponse(['message'=>'image_invalid_format', 400]);

            $oldImage = $itemTab->getImage();

            $media = $this->sonataCreateMediaImageFromUploadedFile($file, ItemTab::SONATA_CONTEXT);

            $itemTab->setImage($media);
            $this->sonataRemoveImage($oldImage);
        }

        $this->em->flush();

        $context = SerializationContext::create()->setGroups(array('AppTabFull','Default'))->enableMaxDepthChecks();

        return new Response($this->serializer->serialize($itemTab, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }


}
