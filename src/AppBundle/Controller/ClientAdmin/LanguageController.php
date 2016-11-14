<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class LanguageController extends Controller
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
     * @Route("/language", name="admin_language_all")
     */
    public function getAllAction(Request $request)
    {
        if ($request->get('app_id'))
            $languages = $this->em->getRepository("AppBundle:Language")->findByApp($request->get('app_id'));
        else
            $languages = $this->em->getRepository("AppBundle:Language")->findBy(['id'=> $this->localeAvailable]);

        $result ='';
        foreach ($languages as $language)
            $result.=','.$this->serializer->serialize($language, 'json');

        $result= '['.substr($result,1).']';

        return new Response($result, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/language/{app}", name="admin_language_app", methods={"PUT"})
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function updateAction(Request $request, App $app)
    {
        $languages = $request->get('languages');

        $app->setLanguages(new \Doctrine\Common\Collections\ArrayCollection());
        foreach ($languages as $languageId)
        {
            if ($language = $this->em->getRepository("AppBundle:Language")->find($languageId))
                $app->addLanguage($language);
        }

        $this->em->flush();

        return new Response('', 200, ['Content-Type' => 'application/json']);
    }


}
