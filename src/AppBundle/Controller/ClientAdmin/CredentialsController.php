<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class CredentialsController extends Controller
{
    /**
     * @Route("/credentials/{app}", name="admin_credentials")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     */
    public function transactionsAction(App $app)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_CREDENTIALS ,$clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        $credentials = $app->getAppApiHasCredential();

        $resut = [
            'user' => $credentials->getCodeKey(),
            'secret' => $credentials->getSecretKey(),
        ];

        return new JsonResponse($resut);
    }
}
