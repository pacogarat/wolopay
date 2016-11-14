<?php

namespace AppBundle\Controller\ClientAdmin;

use AppBundle\Entity\App;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Subscription;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class SubscriptionsController extends AbstractController
{

    /**
     * @Route("/app/{app}/subscriptions/active/{currency}", name="admin_active_subscriptions")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("date_from")
     * @ParamConverter("date_to")
     * @ParamConverter("currency", class="AppBundle:Currency", options={"id" = "currency"})
     */
    public function activeSubscriptionAction(App $app, Currency $currency, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        $page = $request->get('page') ?: 0;
        $rows = $this->getRows($request);

        if (!in_array(RoleEnum::ADMIN_SUBSCRIPTIONS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        /** @var EntityManager $em */
        $em = $this->getDoctrine();

        $serializer = $this->get('jms_serializer');
        /** @var CurrencyService $currencyService */
        $currencyService = $this->get('common.currency');

        $subscriptions = $em->getRepository("AppBundle:Subscription")->findByAppIdAndDateRange(
            $app->getId(), null, null, PaymentStatusCategoryEnum::SUBSCRIPTION_ACTIVE_ID,false, $page*$rows, $rows
        ,
            [
                's.id'              => $request->get('subscription_id'),
                'g.gamerExternalId' => $request->get('gamer_external_id'),
                't.id'              => $request->get('transaction_id'),
                'p.id'              => $request->get('purchase_id'),
            ]
        );


        foreach ($subscriptions as $subscription)
        {
            $subscription->setAmountTotalInTempCurrency($currency->getId());
            $subscription->setAmountGameInTempCurrency($currency->getId());

            if ($subscription->getPaymentDetail()->getCurrency()->getId() === $currency->getId())
                continue;

            $subscription->setAmountForEachPayment(
                $currencyService->getExchange($subscription->getAmountForEachPayment(), $subscription->getPaymentDetail()->getCurrency(), $currency->getId())
            );

            $subscription->setAmountForEachPaymentToComplete(
                $currencyService->getExchange($subscription->getAmountForEachPaymentToComplete(), $subscription->getPaymentDetail()->getCurrency(), $currency->getId())
            );
        }

        $context = SerializationContext::create()->setGroups(array('Default', 'allTranslations', 'SubscriptionAddAmounts', 'SubscriptionAddAmountsTotal'));

        return new Response($serializer->serialize($subscriptions, 'json', $context), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/active-subscriptions/cancel/{app}/{subscription_id}", name="admin_active_subscriptions_cancel")
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app"})
     * @ParamConverter("subscription", class="AppBundle:Subscription", options={"id" = "subscription_id"})
     */
    public function cancelSubscriptionAction(App $app, Subscription $subscription, Request $request)
    {
        /** @var ClientUser $clientUser */
        $clientUser = $this->getUser();

        if (!in_array(RoleEnum::ADMIN_SUBSCRIPTIONS, $clientUser->getRolesAdmin($app)))
            throw $this->createAccessDeniedException();

        if ($subscription->getApp()->getId() != $app->getId())
            throw $this->createAccessDeniedException();

        $paymentDetails = $subscription->getPaymentDetail();
        $transaction = $paymentDetails ->getTransaction();

        $url = $this->generateUrl(
            'cancel_subscription',
            [
                'transaction_id' => $transaction->getId(),
                'subscription_id' => $subscription->getId(),
                'security' => $paymentDetails->getSecurityRandomIpn(),
                'reason' => $request->get('reason')
            ]
        );

        $guzzle = $this->get('guzzle.client');
        $requestToDo = $guzzle->get($this->container->getParameter('domain_main') . $url);
        $response = $requestToDo->send();
        $code = $response->getStatusCode();

        if ($code == 202)
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Cancel subscription request by Merchant: '.$subscription->getId())
                ->setFrom($this->container->getParameter('email_app'))
                ->setTo($this->container->getParameter('email_payment_manager'))
                ->setBody("
                Application id:" .$app->getId()."
                Subscription id:" .$subscription->getId()."
                Subscription state:" .$subscription->getStatusCategory()->getName()."
                Reason: ".$request->request->get('reason')."
            "
                )
            ;
            $this->get('mailer')->send($message);
        }

        return new JsonResponse([], $code);
    }
}
