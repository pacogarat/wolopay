<?php

namespace AppBundle\Controller\Api;


use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractAPI
{
//    Deactivated because WSSE is more secure
//    /**
//     * Get JWT Token
//     *
//     * @ApiDoc(
//     *   resource = true,
//     *   statusCodes = {
//     *     200 = "Returned when successful"
//     *   }
//     * )
//     *
//     * @Post("/jwt-token", name="api_security_post_jwtoken")
//     * @RequestParam(name="apiCode", description="Api id credentials")
//     * @RequestParam(name="apiSecret", description="Api secret credentials")
//     *
//     * @param $apiCode
//     * @param $apiSecret
//     * @throws \Symfony\Component\Security\Core\Exception\BadCredentialsException
//     * @return array
//     */
//    public function postJwtokenAction($apiCode, $apiSecret)
//    {
//        // The security layer will intercept this request
//        return new Response('', 401);
//    }

}
