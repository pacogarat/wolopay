<?php

/**
 * This file is part of the wolopay.com (c)
 *
 * Example to create a payment without show the shop and also without article.
 */

require_once "WolopayApiWrapperMiguel.php";

$wolopayApi = new WolopayApiWrapperMiguel($apiClientId='app_54eef87b5e0ed', $apiClientSecret='ebebc3c8ccb137d689ee460c1c9b368ee569bf84', $sandbox=true, $debug=true);

// See the doc to view all optional parameters
$result = $wolopayApi->directPayment(
    $gamerId = 'user13',
    $amount = 0.1,
    $currency = 'EUR',
    $country = 'ES',
    $payMethodId = 10,
    $articleTitle = 'My title',
    $articleDescription = 'My description',
    $extraOptions = array(),
    $autoRedirect = true
);

if (!$result){
    die("Request can't be generated");
}

/*<iframe src="<?= $result->url ?>" width="100%" height="100%"></iframe>*/