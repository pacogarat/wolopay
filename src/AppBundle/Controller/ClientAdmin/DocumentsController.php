<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/documents")
 */
class DocumentsController extends Controller
{
    /**
     * @var Serializer
     * @Inject("jms_serializer")
     */
    public $serializer;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;


    private function validateAccess(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_INVOICES, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();
    }

    /**
     * @Route("/", name="admin_documents_merchant")
     */
    public function getDocuments(Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $this->validateAccess($clientUser->getAllApps()[0]);

        $finInvoices = $this->em->getRepository("AppBundle:ClientDocument")->findByClientId(
            $clientUser->getClient()->getId(),
            $request->get('year')
        );

        return new Response($this->serializer->serialize($finInvoices, 'json'),  200, ['Content-Type' => 'application/json']);
    }

}
