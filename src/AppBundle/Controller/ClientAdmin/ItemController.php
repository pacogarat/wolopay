<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Item;
use AppBundle\Service\TranslateHelperService;
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
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api")
 */
class ItemController extends Controller
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
     * @Route("/item/{app}", name="admin_items_list", methods={"GET"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function listAction(App $app)
    {
        $this->verifyAccessDeniedByRole($app);

        $items = $this->em->getRepository("AppBundle:Item")->findByAppIdAndActives($app);
        $context = SerializationContext::create()->setGroups(
            array(
                'allTranslations',
                'ArticleFull',
                'ItemTabDefault',
                'ItemFull',
                'ItemFull&Translations',
                'ArticleOnlyName',
                'OriginalArticle',
                'SpecialTypeFull'
            )
        );

        return new Response($this->serializer->serialize($items, 'json', $context ), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/item/{id}", name="admin_items_delete", methods={"delete"})
     * @ParamConverter("item", class="AppBundle:Item")
     */
    public function deleteAction(Request $request, Item $item)
    {
        $this->verifyAccessDeniedByRole($item->getApp());

        $item->setActive(false);

        $this->em->flush();

        $context = SerializationContext::create()->setGroups(array('Public'));
        return new Response($this->serializer->serialize($item, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    private function verifyAccessDeniedByRole(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CONFIGURE ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();
    }

    /**
     * @Route("/item/{app}", name="admin_items_create", methods={"POST"})
     * @Route("/item/{app}/{item_id}", name="admin_items_update", methods={"POST"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("item", class="AppBundle:Item", options={"id" = "item_id"})
     */
    public function updateOrCreateAction(App $app, Request $request, Item $item=null)
    {
        $this->verifyAccessDeniedByRole($app);

        if ($item && $item->getApp()->getId() != $app->getId())
            throw $this->createAccessDeniedException();

        $create = false;

        if (!$item)
        {
            $item = new Item();
            $create = true;
            $item->setApp($app);

            if ($request->get('special_type') && $request->get('special_type') !== 'normal')
            {
                if (!$special = $this->em->getRepository("AppBundle:ArticleSpecialType")->find($request->get('special_type')))
                    throw new BadRequestHttpException('not found special '.$request->get('special_type'));

                $item->setSpecialType($special);
            }
        }

        $special = $item->getSpecialType();

        /** @var TranslateHelperService $transLexik */
        $transLexik = $this->get('app.translate_helper');

        $transLexik->setLabelItemFromRequest($request, $item, 'name_label_translation_', 'name_label', 'item.title.');
        $transLexik->setLabelItemFromRequest($request, $item, 'desc_label_translation_', 'description_label', 'item.desc.');
        $transLexik->setLabelItemFromRequest($request, $item, 'desc_short_label_translation_', 'description_short_label', 'item.desc_short.');

        $item
            ->setName($request->request->get('name_label_translation_en'))
            ->setExternalItemId($request->request->get('external_item_id'))
            ->setUnitaryPriceCountry($this->em->getRepository("AppBundle:Country")->find($request->get('unitary_price_country')))
        ;

        if (!$special)
        {
            $item
                ->setUnitaryPrice($request->get('unitary_price'))
            ;
        }

        $item->setItemTabs([]);
        if ($request->get('item_tabs'))
        {
            foreach (json_decode($request->get('item_tabs'), true) as $itemTab)
            {
                $itemTab = $this->em->getRepository("AppBundle:ItemTab")->findOneByAppIdAndNameUnique($app, $itemTab['name_unique']);
                if (!$itemTab)
                    throw new BadRequestHttpException('item category is invalid');

                $item->addItemTab($itemTab);
            }
        }


        if ($request->files->get('file'))
        {
            /** @var UploadedFile $file */
            $file = $request->files->get('file');
            if ($file->getSize() > 100000)
                return new JsonResponse(['message'=>'image_size_exceed', 400]);

            if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg','jpeg','png','gif']))
                return new JsonResponse(['message'=>'image_invalid_format', 400]);

            $oldImage= $item->getImage();
            $media = $this->sonataCreateMediaImageFromUploadedFile($file,Item::SONATA_CONTEXT);
            $item->setImage($media);
            $this->sonataRemoveImage($oldImage);
        }

        $this->em->persist($item);
        $this->em->flush();

        $context = SerializationContext::create()->setGroups(array('Public'));

        return new Response($this->serializer->serialize($item, 'json', $context), $create ? 201 : 200, ['Content-Type' => 'application/json']);
    }

}
