<?php

namespace AppBundle\Security\Authentication\Provider;


use AppBundle\Entity\Transaction;
use AppBundle\Logger\Util\StreamHandlerDynamicFileHelper;
use AppBundle\Security\Authentication\Token\STransactionShopToken;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class STransactionProvider implements AuthenticationProviderInterface
{
    private $userProvider;
    protected $streamHandlerHelper;


    public function __construct(UserProviderInterface $userProvider, StreamHandlerDynamicFileHelper $streamHandlerHelper)
    {
        $this->userProvider = $userProvider;
        $this->streamHandlerHelper = $streamHandlerHelper;
    }

    public function authenticate(TokenInterface $token)
    {
        /** @var Transaction $user */
        try{
            $user = $this->userProvider->loadUserByUsername($token->getUsername());
        }catch (UsernameNotFoundException $e){
            throw new UnprocessableEntityHttpException( sprintf('Transaction "%s" not found ', $token->getUsername()));
        }

        if (!$user)
        {
            throw new Exception('Invalid Transaction Id');
        }

        if ($user->getApp()->getActive() == false)
            throw new AuthenticationException('App is inactive, contact with support');

        $authenticatedToken = new STransactionShopToken($user->getRoles());
        $authenticatedToken->setUser($user);

        $this->streamHandlerHelper->changeLogFileByTransaction($user);

        return $authenticatedToken;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof STransactionShopToken;
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }
}