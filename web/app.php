<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

umask(0000);

//echo "OPC RESET ".opcache_reset();
require_once 'browser_preflight.php';

define('FACEBOOK_SDK_V4_SRC_DIR',__DIR__.'/../vendor/facebook/php-sdk-v4/src/Facebook/');
$loader = require __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../var/bootstrap.php.cache';

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
// Using OP CACHE!

//$apcLoader = new ApcClassLoader('sf2', $loader);
//$loader->unregister();
//$apcLoader->register(true);


require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
