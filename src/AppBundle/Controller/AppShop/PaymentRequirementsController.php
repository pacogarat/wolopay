<?php

namespace AppBundle\Controller\AppShop;

use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\GamerEmailType;
use AppBundle\Form\Type\TigoType;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\FormHelper;
use AppBundle\Util\SteamSignIn;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/{transaction_id}/requirements/{_locale}/{pmpc_id}")
 */
class PaymentRequirementsController extends Controller
{
    /**
     * @Inject("logger")
     * @var Logger
     */
    private $logger;

    /**
     * @Inject("validator")
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @Inject("app.form_helper")
     * @var FormHelper
     */
    private $formHelper;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Route("/email", name="payment_email_required_form")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("pmpc", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pmpc_id"})
     * @Template()
     */
    public function emailAction(Transaction $transaction, Request $request, PayMethodProviderHasCountry $pmpc)
    {
        $gamer = $transaction->getGamer();

        if (!in_array(RoleEnum::TRANSACTION_SHOPPING, $transaction->getRoles()) )
            return $this->redirect($this->get('router')->generate('shop_finished', ['transaction_id' => $transaction->getId()]));

        if ($gamer->getEmail() !== null)
            return $this->redirectToPay($request);

        //Try to get info from game/publisher
        if ($baseUrl = $transaction->getApp()->getUrlNotificationNewGamer()){
            $options['verify'] = false;
            $appId = $transaction->getApp()->getId();
            $gamerExternalId = $gamer->getGamerExternalId();
            /**newGamerNotification/{app}/{gamer} **/
            $baseUrl.= "/$appId/$gamerExternalId";
            try{
                $client = new \GuzzleHttp\Client($options);
                $res = $client->request("GET", $baseUrl, $options);
            }catch (\Exception $e){

            }

            $this->em->clear();
            $nGamer = $this->em->getRepository("AppBundle:Gamer")->find($gamer->getId());
            if ($nGamer->getEmail() !== null)
                return $this->redirectToPay($request);
        }

        $form = $this->createForm(new GamerEmailType(), $gamer);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            $newEmail = $form->get('email')->getData();
            if ($newEmail<>""){
                $gamer->setEmail($newEmail);
                $this->em->merge($gamer);
                $this->em->flush();
                return $this->redirectToPay($request);
            }

//            if ($form->isValid())
//            {
//                $this->em->flush();
//                $this->em->persist($gamer->getApp());
//                return $this->redirectToPay($request);
//            }
        }

        return array(
            'form' => $form->createView(),
            'transaction' => $transaction,
            'pmpc' => $pmpc
        );

    }

    /**
     * @Route("/steamId", name="payment_steam_id_required_form")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("pmpc", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pmpc_id"})
     * @Template()
     */
    public function steamIdAction(Transaction $transaction, Request $request, PayMethodProviderHasCountry $pmpc)
    {
        $provider = new SteamSignIn();

        return $this->redirect(
            $provider->genUrl(
                $this->container->getParameter('domain_main') .
                $this->generateUrl('payment_steam_id_callback_required_form',
                [
                    'transaction_id' => $transaction->getId(),
                    'pmpc_id' => $pmpc->getId()
                ])
                , false
            )
        );
    }

    /**
     * @Route("/steamId/callback", name="payment_steam_id_callback_required_form")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function steamCallbackAction(Transaction $transaction, Request $request)
    {
        $provider = new SteamSignIn();
        $steamId = $provider->validate();

        if (!$steamId)
        {
            $this->logger->addError("Invalid steam id $steamId");
            return new RedirectResponse($this->generateUrl('payment_steam_id_required_form'));
        }

        $gamer = $transaction->getGamer();
        $gamer->setSteamId($steamId);
        $this->em->persist($gamer);

        $this->em->flush();
        return $this->redirectToPay($request);
    }

    private function redirectToPay($request)
    {
        return $this->redirect($request->getSession()->get('url_to_pay'));
    }

    /**
     * @Route("/dynamic", name="dynamic_required_form")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("pmpc", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pmpc_id"})
     * @Template()
     */
    public function genericRequirementsAction(Transaction $transaction, Request $request, PayMethodProviderHasCountry $pmpc)
    {
        if (!$groups = $request->get('groups'))
            throw new BadRequestHttpException("Need a valid group");

        // decript data
        foreach ($groups as $key => $group)
            $groups[$key] = UtilHelper::decrypt($group);

        $gamer = $transaction->getGamer();

        if (!in_array(RoleEnum::TRANSACTION_SHOPPING, $transaction->getRoles()) )
            return $this->redirect($this->get('router')->generate('shop_finished', ['transaction_id' => $transaction->getId()]));

        $form = $this->formHelper->createFormWithOnlyValidatorGroups($gamer, $groups)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToPay($request);
        }


        return array(
            'form' => $form->createView(),
            'transaction' => $transaction,
            'pmpc' => $pmpc
        );

    }

}
