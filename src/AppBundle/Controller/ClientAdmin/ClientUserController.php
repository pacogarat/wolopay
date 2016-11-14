<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Language;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/client_user")
 */
class ClientUserController extends Controller
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
     * @Inject("%locale_available%")
     */
    public $localeAvailable;

    /**
     * @Route("/language/set/{language_id}")
     * @ParamConverter("language", class="AppBundle:Language", options={"id" = "language_id"})
     */
    public function setLanguageAction(Language $language)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $clientUser->setLanguage($language);
        $this->em->flush();

        return new JsonResponse();
    }


}
