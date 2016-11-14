<?php

namespace AppBundle\Controller\Others;

use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\TransactionTemp;
use AppBundle\Service\IPInfoService;
use AppBundle\Util\WSSEUtil;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @Route("/widgets")
 */
class WidgetsController extends Controller
{
    /**
     * @Inject("logger")
     * @var Logger
     */
    private $logger;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    private $guzzle;


    /**
     * @Inject("common.ip_info")
     * @var IPInfoService
     */
    private $ipInfoService;

    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    private $em;

    /**
     * @Route("/direct/{transaction_id}/{pmpc_id}", name="widget_selected_pmpc")
     * @Route("/direct/{transaction_id}", name="widget_select_pmpc")
     * @ParamConverter("transaction", class="AppBundle:TransactionTemp", options={"id" = "transaction_id"})
     * @Template()
     */
    public function selectPMPCAction(TransactionTemp $transaction, $pmpc_id=null, Request $request)
    {
        $country = $transaction->getCustomCountry();

        if (!$country )
        {
            $country = $this->ipInfoService->getCountryFromIp($request->getClientIp());

            if (!$country)
                $country = $this->em->getRepository("AppBundle:Country")->find(CountryEnum::OTHER);
        }

        if ($pmpc_id && $pmpc=$this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->find($pmpc_id))
        {

            $credentials = $transaction->getApp()->getAppApiHasCredential();
            $headers = [
                'X-WSSE' => WSSEUtil::generateHeaderWSSE($credentials->getCodeKey(), $credentials->getSecretKey())
            ];

            $params = [
                'gamer_id' => $transaction->getGamerId(),
                'country' => $country->getId(),
                'amount' => $transaction->getCustomAmount(),
                'currency' =>$transaction->getCustomCurrency()->getId(),
                'pay_method_id' => $pmpc->getPayMethod()->getId(),
                'article_title' => $transaction->getCustomArticleTitle(),
                'article_description' => $transaction->getCustomArticleDescription(),
                'custom_param' => $transaction->getCustomParam(),
                'test' => $transaction->getTest(),
            ];

            $request = $this->guzzle->post(
                $this->generateUrl('api_transaction_create_transaction_custom',[],true),
                $headers,
                $params
            );
            try{
                $response = $request->send();
            } catch (ClientErrorResponseException $exception) {

                $this->log->addError("Error ".$exception->getResponse()->getBody(true));
                throw $exception;
            }
            $responseJSon = json_decode($response->getBody(true));

            return $this->redirect($responseJSon->url);
        }

        if ($transaction->getCustomAmount() == null)
            throw new BadRequestHttpException('Is a invalid transaction (CustomAmount) amount need to be configured');

        $pmpcs = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")
            ->findByCountryAndCanBeCustomTransaction($country->getId());

        if (!$pmpcs)
            throw new UnprocessableEntityHttpException('Not found a pmpc for this country: '.$country->getId());

        return array(
            'transaction' => $transaction,
            'pmpcs' => $pmpcs,
        );
    }

}
