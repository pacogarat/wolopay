<?php

namespace AppBundle\Api;

use AppBundle\Entity\App;
use AppBundle\Util\WSSEUtil;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Service("api.make_request")
 */
class ApiRequestClient
{
    /**
     * @Inject("%domain_main%")
     * @var string $domainMain
     */
    public $domainMain;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @param App $app
     * @param $pathUrl
     * @param array $parameters
     * @param string $method
     * @return \Guzzle\Http\Message\Response|Response
     */
    public function makeRequest($app, $pathUrl, $parameters = array(), $method = "GET")
    {
        return $this->makeRequestFinal(
            $app->getAppApiHasCredential()->getCodeKey(), $app->getAppApiHasCredential()->getSecretKey(), $this->domainMain .$pathUrl, $parameters, $method
        );
    }

    /**
     * @param $codeKey
     * @param $secretKey
     * @param $url
     * @param array $parametersArray
     * @param string $method
     * @return \Guzzle\Http\Message\Response|Response
     */
    public function makeRequestFinal($codeKey, $secretKey, $url, $parametersArray = array(), $method = "GET")
    {
        $method = strtoupper($method);

        $headers = [
            'X-WSSE' => WSSEUtil::generateHeaderWSSE(
                $codeKey,
                $secretKey)
        ];

        try {
            switch ($method){
                case "POST":
                    $request = $this->guzzle->post($url, $headers, $parametersArray);
                    break;
                case "HEAD":
                    $request = $this->guzzle->head($url, $headers, $parametersArray);
                    break;
                case "PUT":
                    $request = $this->guzzle->put($url, $headers, $parametersArray);
                    break;
                case "DELETE":
                    $request = $this->guzzle->delete($url, $headers, $parametersArray);
                    break;
                case "OPTIONS":
                    $request = $this->guzzle->options($url, $headers, $parametersArray);
                    break;
                case "PATCH":
                    $request = $this->guzzle->patch($url, $headers, $parametersArray);
                    break;
                case "GET":
                default:
                    $request = $this->guzzle->get($url, $headers, $parametersArray);
                    break;
            }
            $response  = $request->send();
        } catch (\Exception $exception) {
            return new Response($exception->getTraceAsString());
        }
        return $response;
    }
} 