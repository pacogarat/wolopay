<?php


namespace AppBundle\Security\Authentication\Provider;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ProviderWSSEOverride extends \Escape\WSSEAuthenticationBundle\Security\Core\Authentication\Provider\Provider
{
    public function authenticate(TokenInterface $token)
    {
        if (!$token->hasAttribute('nonce'))
            throw new AuthenticationException('WSSE authentication failed.');

        return parent::authenticate($token);
    }

    /**
     * Added 15 seconds
     *
     * @param $created
     * @return bool
     */
    protected function isTokenFromFuture($created)
    {
        return strtotime($created) > (strtotime($this->getCurrentTime() ) + (60*5));
    }
} 