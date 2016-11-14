<?php
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

ini_set('error_reporting', E_ALL);

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
umask(0000);
// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    && !(in_array(@$_SERVER['REMOTE_ADDR'], array('193.219.96.100', '188.76.203.79', '93.93.70.186', '127.0.0.1', '10.0.2.2', 'fe80::1', '::1')) || php_sapi_name() === 'cli-server')
    && strpos(__FILE__, 'miguel.pay-gateway.net')== -1
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information. '.$_SERVER['REMOTE_ADDR']);
}

require_once 'browser_preflight.php';

$loader = require __DIR__.'/../app/autoload.php';
Debug::enable();

$apcLoader = new \Symfony\Component\ClassLoader\ApcClassLoader('sf2dev', $loader);

require_once __DIR__.'/../app/AppKernel.php';


$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
