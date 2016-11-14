<?php


namespace AppBundle\Payment\PayMethod\Interact;


use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interact class is used like event, his main function is to pass information from controller to services.
 * but it can also be used to avoid the repetition of basic logic
 *
 * Class PaymentIpnInteract
 * @package AppBundle\Payment\PayMethod\Interact
 */
class AbstractInteract
{
    protected $subRequestDone;

    /**
     * @var Logger
     */
    protected $logger;

    function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $url
     * @param null $post
     * @return $this
     */
    public function setSubRequestDone($url, $post=null)
    {
        $this->subRequestDone = [
            'url' => $url
        ];

        if ($post)
            $this->subRequestDone['post'] = $post;

        $this->logger->addInfo("Sub request: $url".($post ? ', Post: '.urldecode(http_build_query($post)) : ''));

        return $this;
    }

    /**
     * @param $responseBody
     * @param int $httpCode
     * @param bool $responseIsjson
     * @param bool $responseIsXml
     * @return $this
     */
    public function setSubRequestDoneResponse($responseBody, $httpCode=200, $responseIsjson=false, $responseIsXml = false)
    {
        $finalBody =  $responseBody;

        try{
            if ($responseIsXml)
            {
                $dom = new \DOMDocument;
                $dom->preserveWhiteSpace = FALSE;
                $dom->loadXML($responseBody);
                $dom->formatOutput = TRUE;
                $finalBody = "\n".$dom->saveXml();

            }else if ($responseIsjson){

                $finalBody = json_decode($responseBody);
            }

        }catch (\Exception $e){
            $this->logger->addError("Invalid format response body");
        }

        $this->subRequestDone['response'] = $finalBody;
        $this->subRequestDone['httpCode'] = $httpCode;

        $this->logger->addInfo("Sub request response status: $httpCode, response body: $responseBody");

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubRequestDone()
    {
        return $this->subRequestDone;
    }


} 