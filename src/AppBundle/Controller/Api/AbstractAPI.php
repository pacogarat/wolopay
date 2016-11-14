<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Country;
use AppBundle\Entity\Transaction;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\DiExtraBundle\Annotation as DI;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

abstract class AbstractAPI extends FOSRestController
{
    /**
     * @return AppApiCredentials
     */
    public function getUser()
    {
        return parent::getUser();
    }

    /**
     * @param Transaction $transaction
     * @param Country $country
     * @return Country
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    protected function verifyValidCountry(Transaction $transaction, Country $country)
    {
        $countryService = $this->get('country');
        $countryConfigured = $countryService->getCountryConfiguredAndCloserFromTransaction($transaction, $country);

        if (!$countryConfigured)
            throw new BadRequestHttpException("You can't choose this country, transaction doesn't accept it");

        return $countryConfigured;
    }

    /**
     * @param $tab_id
     * @param Transaction $transaction
     * @return \AppBundle\Entity\AppTab
     */
    protected function getAppTab($tab_id, Transaction $transaction)
    {
        $appShop = $this->getDoctrine()->getManager()->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory(
            $transaction->getApp()->getId(), $transaction->getLevelCategory()->getId()
        );
        return $this->getAppTabSimple($appShop->getId(), $tab_id);
    }

    /**
     * @param $appShopId
     * @param $tabId
     * @return \AppBundle\Entity\AppTab
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    protected function getAppTabSimple($appShopId, $tabId)
    {
        if ($tabId)
        {
            $appTab = $this->getDoctrine()->getManager()->getRepository("AppBundle:AppShopHasAppTab")
                ->findOneByAppShopIdAndNameUnique(
                    $appShopId, $tabId
            );

            if (!$appTab)
                throw new BadRequestHttpException('Invalid tab');

            return $appTab;
        }

        return null;
    }

    protected function throwExceptionIfItsGrantedByJWT()
    {
        $token = $this->get('security.token_storage')->getToken();

        if (!$token)
            return;

        if ($token instanceof JWTUserToken)
            throw new AccessDeniedException();
    }
}
