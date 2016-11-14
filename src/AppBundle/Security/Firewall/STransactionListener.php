<?php

namespace AppBundle\Security\Firewall;

use AppBundle\Security\Authentication\Token\STransactionShopToken;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class STransactionListener implements ListenerInterface
{
    protected $securityContext;
    protected $authenticationManager;
    protected $templating;


    public function __construct(TokenStorageInterface $securityContext, AuthenticationManagerInterface $authenticationManager
        , EngineInterface $templating)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
        $this->templating = $templating;

    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $transactionId = $request->get('transaction_id');
        // Attribute has more priority than get and post 'transaction_id'
        if ($request->attributes->has('_route_params') && $request->attributes->get('_route_params') && isset($request->attributes->get('_route_params')['transaction_id']))
        {
            $transactionId = $request->attributes->get('_route_params')['transaction_id'];
        }

        if (!$transactionId)
        {
            $this->securityContext->setToken(new AnonymousToken('s_transaction','anonymous'));
            return;
        }

        $token = new STransactionShopToken();
        $token->setUser($transactionId);

        try {
            $authToken = $this->authenticationManager->authenticate($token);
            $this->securityContext->setToken($authToken);

        } catch (AuthenticationException $failed) {

            $this->securityContext->setToken(null);
            throw $failed;
        }

        return;

        // By default deny authorization
//        $response = new Response();
//        $response->setStatusCode(Response::HTTP_FORBIDDEN);
//        $response->sendContent($this->templating->render("AppBundle:Error:invalid_transaction.html.twig"));
//        $event->setResponse($response);
//
//        throw new AuthenticationCredentialsNotFoundException('This transaction is invalid');
    }
} 