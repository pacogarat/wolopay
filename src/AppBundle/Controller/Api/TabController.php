<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Country;
use AppBundle\Entity\Transaction;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TabController extends AbstractAPI
{

    /**
     * Get all available article categories reference to transaction and country
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/tab")
     * @QueryParam(name="transaction_id", description="Transaction Id", strict=true, nullable=false)
     * @QueryParam(name="country", strict=true, requirements="[A-Z]{2}", description="Country")
     *
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})*
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     *
     * @param Transaction $transaction
     * @param \AppBundle\Entity\Country $country
     * @return array
     */
    public function getTabsAction(Transaction $transaction, Country $country)
    {
        $countryConfigured = $this->verifyValidCountry($transaction, $country);

        $tabs = $this->getDoctrine()->getRepository("AppBundle:AppShopHasAppTab")
            ->findByAppIdAndCountryAndLevelCategoryAndLevelCategoryIdAndStatus(
                $transaction->getApp()->getId(),
                $countryConfigured->getId(),
                $country->getId(),
                $transaction->getLevelCategory()->getId(),
                $transaction->getAppTabsAvailable()->toArray(),
                $transaction->getArticlesAvailable()->toArray(),
                $transaction->getPayMethodsAvailable()->toArray(),
                $transaction->getExternalStore()
            );

        $view = $this->view($tabs, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

        return $this->handleView($view);
    }

}
