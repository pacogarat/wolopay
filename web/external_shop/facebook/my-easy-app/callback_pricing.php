<?php

/*
[signed_request] => lFd_bGdvcml0aG0iOiJITUFDLVNIQTI1Ni...
[product] => http://www.friendsmash.com/og/smashingpack.html
[quantity] => 1
[user_currency] => EUR
[request_id] => abc123
[method] => payments_get_item_price
 */
function parse_signed_request($signed_request) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    // decode the data
    $sig = base64_url_decode($encoded_sig);
    $data = json_decode(base64_url_decode($payload));

    return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

function logI($text)
{
    file_put_contents(__DIR__.'/log_pricing',  "$text \n", FILE_APPEND);
}


logI(',GET: '.print_r($_GET, true).', POST: '.print_r($_POST, true));

$json = parse_signed_request($_POST['signed_request']);

logI(json_encode($json));

/*
 Example json
{"algorithm":"HMAC-SHA256","expires":1446040800,"issued_at":1446035943,"oauth_token":"CAAXffzva7DcBAJC731xZBVzZBGwBThTSBuIu3jp4oPxvIqSgoXBZAkz5ZC5PbSDyKsWJatnJyJ2H6FskWNzSlCZBqHIJwxDwnMZCXSv2Ipb8MA2OMSvRqy16OFsxW6bTzjSixXPS7eEdFNpEub8bPfgnKClwO8otc3p2ZCALYcF1eUPuua0m8VFijUrOcoj4gKqFZC69cZAv2we0alS9wvnXM","payment":{"product":"https:\/\/miguel.wolopay.com\/external_shop\/facebook\/my-easy-app\/products\/100coins_dynamic.html","quantity":"10","user_currency":"EUR","request_id":"1446035942356"},"user":{"country":"es","locale":"en_US","age":{"min":21}},"user_id":"120693761623915"}
 */
ob_start("callback");

// BE CAREFUL amount will be multiply by quantity
echo '
{
  "content":
    {
      "product": "'.$json->payment->product.'",
      "amount": 0.99,
      "currency": "EUR"
    },
  "method":"payments_get_item_price"
}
';
ob_end_flush();

function callback($buffer)
{
    logI($buffer);
    return $buffer;
}