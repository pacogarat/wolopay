<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Route("/api")
 */
class ArticleCategoryController extends Controller
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
     * @Route("/article_categories", name="admin_get_article_categories", methods={"GET"})
     */
    public function getAllAction(Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $context = SerializationContext::create()->setGroups(array('Default'))->enableMaxDepthChecks();

        $apps = $this->em->getRepository("AppBundle:ArticleCategory")->findAll();

        return new Response($this->serializer->serialize($apps, 'json', $context),  200, ['Content-Type' => 'application/json']);
    }

}
