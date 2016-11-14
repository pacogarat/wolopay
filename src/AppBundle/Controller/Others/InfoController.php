<?php

namespace AppBundle\Controller\Others;

use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/info")
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 */
class InfoController extends Controller
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
    * @Route("/apc", name="info_apc")
    * @Method(methods={"GET"})
    */
    public function apcAction(Request $request)
    {
       return new Response(print_r(apc_cache_info(), true));
    }

    /**
     * @Route("/apc/clear", name="info_apc_clear")
     * @Method(methods={"GET"})
     */
    public function apcClearAction(Request $request)
    {
        apc_clear_cache();
        return new Response('apc cleared');
    }

    /**
     * @Route("/nginx/clear", name="info_nginx_clear")
     * @Method(methods={"GET"})
     */
    public function nginxClearAction(Request $request)
    {
        $nginxCacheClear = $this->container->get('command.nginx_clear_cache');
        $nginxCacheClear->clearCache();
        return new Response('cleared');
    }


    /**
     * @Route("/php", name="info_php")
     * @Method(methods={"GET"})
     */
    public function phpInfoAction(Request $request)
    {
        phpinfo();
        die();
    }

}
