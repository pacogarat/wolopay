<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\RoleEnum;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api")
 */
class TransactionsController extends AbstractController
{
    /**
     * @Route("/transactions/{app}/{date_from}/{date_to}/{currency}", name="admin_transactions")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function transactionsAction(App $app, \DateTime $date_from, \DateTime $date_to, Currency $currency, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();
        $page = $request->get('page') ?: 0;

        $rows = $this->getRows($request);

        if ($date_from->getTimestamp() > $date_to->getTimestamp())
            throw new BadRequestHttpException("date from is higher than date to");

        if (!in_array(RoleEnum::ADMIN_TRANSACTIONS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $serializer = $this->get('jms_serializer');

        $transactions = $em->getRepository("AppBundle:Transaction")->findByAppIdAndDateRangeAndGroupByMonths(
            $app->getId(),
            $date_from,
            $date_to,
            false,
            $page * $rows,
            $rows,
            [
                'g.gamerExternalId' => $request->get('gamer_external_id'),
                'IDENTITY(t.countryDetected)' => $request->get('country_client_id'),
                't.id' => $request->get('transaction_id'),
                't.country' => $request->get('country_shop_id'),
            ]
        );

        $serializationContext = SerializationContext::create()->setGroups(array('Basic'));

        return new Response($serializer->serialize($transactions, 'json', $serializationContext), 200, ['Content-Type' => 'application/json']);
    }
}
