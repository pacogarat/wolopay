<?php
/**
 * Created by MGDSoftware. 07/10/2015
 */

namespace AppBundle\Controller\ClientsHelper;
use AppBundle\Entity\App;
use AppBundle\Entity\Gamer;
use AppBundle\Util\WSSEUtil;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Router;
use Symfony\Component\Serializer\Encoder\JsonEncode;

/**
 * @Route("/IDCGames")
 */
class IDCGamesHelper extends Controller {
    /**
     * @Inject("router")
     * @var Router
     */
    private $router;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Route("/newGamerNotification/{app}/{gamer}", name="newGamerNotification")
     *
     * @ParamConverter("app", class="AppBundle:App", options={"app" = "id"})
     * @ParamConverter("gamer", class="AppBundle:Gamer", options={"mapping":{"gamer" : "gamerExternalId", "app":"app"}})
     *
     * @param App $app
     * @param $gamer
     * @return boolean
     *
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function receiveNewGamerNotification(App $app,Gamer $gamer, Request $request)
    {
        $cToken="";
        $appId = $app->getId();
        $iJuego = $app->getExternalAppId();
        $gamerExternalId = $gamer->getGamerExternalId();
        $cNickJuego = "";


        /**
        Portal=0
         */

        if ($appId== "PORTAL556432217d59e"){
                $iJuego = 0;
                $cNickJuego = $gamer->getGamerExternalId();
                $gamerExternalId = ""; //needs to be blank for the call to the WS. Will restore it later
                $cToken = md5($cNickJuego . $iJuego . "perryidjuego");
        }
        if (!$cToken) $cToken = md5($gamerExternalId . $iJuego . "perryidjuego");

        try{
            $url = "http://193.219.96.247:8100/wsa/wsa1/wsdl?targetURI=urn:unilogin";
            $client = new \SoapClient($url,array(
                    "trace"=>1,
                    "exceptions"=>1,
                    "connection_timeout" => 30,
                    'cache_wsdl' => WSDL_CACHE_NONE)
            );
            //Llamamos al Webservice
            $params=array(
                "cIDUsuarioJuego" => "". $gamerExternalId . "",
                "cNickJuego" => "". $cNickJuego . "",
                "iIDJuego" => $iJuego,
                "cToken" => "".$cToken.""
            );
            $res=$client->DatosUserJuego($params);
            $this->container->get('logger')->addInfo("New Gamer Call to: $url func: DatosUserJuego. Params: ". http_build_query($params));
            $iResultado = $res->iResultado;
            $gamerExternalId = $gamer->getGamerExternalId(); //Need the for the correct call to "patch".
        }catch(\Exception $exception){
            return new JsonResponse(array("code"=>500, "message"=>"Error in Call to WebServer (".$exception->getMessage().")", "errors"=>$exception->getMessage()), 500);
        }


        if ($iResultado==2){
            return new JsonResponse(array("code"=>404, "message"=>"Gamer External Id ($gamerExternalId) does not exist in IDC", "errors"=>null), 404);
        }
        elseif ($iResultado==0)
        {
            $steamId = null;
            $socialsIds = $res->cSocialID;
            $socialsArr = explode(";",$socialsIds);
            foreach($socialsArr as $socials){
                $social = explode(":", $socials);
                $platform = strtoupper($social[0]);
                $id = $social[1];
                switch ($platform){
                    case "ST":
                    case "STEAM":
                        $steamId = $id;
                        break;
                    default:
                        break;
                }
            }

            $sal = array(
                'cDescripcion' => $res->cDescripcion,
                'cNick' => $res->cNick,
                'cEmail' => $res->cEmail,
                'cAid' => $res->cAid,
                'steamId' => $steamId,
            );

            if ( ($res->cAid) ||($steamId) || ($res->cEmail)){
                $params = array();
                if ($affiliateId = $res->cAid) $params['affiliate_id']= $affiliateId;
                if ($steamId)  $params['steam_id']= $steamId;
                if ($email = $res->cEmail) $params['email'] = $email;

                $appCredentials = $app->getAppApiHasCredential();
                $headers = [
                    'X-WSSE' => WSSEUtil::generateHeaderWSSE($appCredentials->getCodeKey(), $appCredentials->getSecretKey())
                ];

                try {
                    $request   = $this->guzzle->patch(
                        $this->container->getParameter('domain_main'). $this->router->generate('api_gamer_patch_gamer', array('gamer_id'=>$gamerExternalId)),
                        $headers, $params);
                    $response  = $request->send();
                } catch (ClientErrorResponseException $exception) {

                    $r = json_decode($exception->getResponse()->getBody(true));
                    return new JsonResponse($r,$exception->getResponse()->getStatusCode());
                }
                return new JsonResponse($sal);
            }
            return new JsonResponse(true);
        }
        return new JsonResponse(false);
    }

}