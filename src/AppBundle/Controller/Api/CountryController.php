<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Country;
use AppBundle\Entity\Transaction;
use AppBundle\Service\CountryService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends AbstractAPI
{

    /**
     * @var CountryService
     * @DI\Inject("country")
     */
    public $countryService;

    /**
     * Get all available countries reference to transaction
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/country")
     * @QueryParam(name="transaction_id", description="Application Id", strict=true, nullable=false)
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     *
     * @param Transaction $transaction
     * @throws \AppBundle\Exception\NviaApiPublicException
     * @return Country[]
     */
    public function getCountriesAction(Transaction $transaction)
    {
        $stopwatch = null;

        if ($this->has('debug.stopwatch')) {
            $stopwatch = $this->get('debug.stopwatch');
            $stopwatch->start('Query Countries');
        }

        $countries = $this->countryService->getCountriesClientAvailableByTransaction($transaction);

        if ($stopwatch)
            $stopwatch->stop('Query Countries');

        $view = $this->view($countries, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

        return $this->handleView($view);
    }



}
