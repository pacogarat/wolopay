<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\PayMethodProviderHasCountry;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/pay_method_provider_has_country")
 */
class PayMethodProviderHasCountryAdminController extends AbstractSonataController
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var \JMS\Serializer\Serializer
     * @Inject("sorta")
     */
    public $serialize;

    /**
     * @Route("/move/{pmpc_id}/{position}", name="pmpc_admin_move")
     * @ParamConverter("pmpc", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pmpc_id"})
     */
    public function indexAction(Request $request, PayMethodProviderHasCountry $pmpc, $position)
    {
        $pmpc->setOrder($position);

        $this->em->flush();

        return $this->redirectToRoute('admin_app_bundle_Provider_list');
    }

}
