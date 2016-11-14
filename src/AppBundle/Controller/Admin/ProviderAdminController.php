<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/provider")
 */
class ProviderAdminController extends AbstractSonataController
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
     * @Inject("serializer")
     */
    public $serialize;

    /**
     * @Route("/insert_all_pmpc_to_apps/{provider_id}", name="insert_all_pmpc_to_apps")
     * @ParamConverter("provider", class="AppBundle:Provider", options={"id" = "provider_id"})
     */
    public function indexAction(Request $request, Provider $provider)
    {
        $apps = $this->em->getRepository("AppBundle:App")->findAll();
        $pmpcs = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findByProviderId($provider->getId());

        $added = 0;

        foreach ($apps as $app) {
            foreach ($pmpcs as $pmpc) {
                if ($pmpc->getActiveCurrent() && $app->hasPayMethodProviderCountry($pmpc))
                    continue;

                $added++;
                $obj = new AppHasPayMethodProviderCountry($pmpc, $app);
                $this->em->persist($obj);
            }
        }

        $this->em->flush();

        $this->addFlash('success', "PMPC added $added");

        return $this->redirectToRoute('admin_app_bundle_Provider_list');
    }

}
