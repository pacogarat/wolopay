<?php

    require '../../../../doc/examples/lib/src/WolopayApi.php';

    $wo = new \Wolopay\WolopayApi('app_546a21417b510', '448b72b02668b6d817f65ab83f1b7b53a1ba4993', false, true); // demo app 1
//    $wo = new \Wolopay\WolopayApi('app_5464b24a9eda4', 'e6c7435cb68030ee739f9bdc2b3b48fb25c831b1', true); // demo
    $data = $wo->createTransaction($gamerId='asd', $level=3, $extraOptions=array('external_store' => 'facebook', 'test' => 1), $autoRedirect=false);

?><!DOCTYPE html>
<html>
    <head>
        <title>Wolopay shop :P</title>
        <style>
            html, body, .wolo-shop{
                height: 100%;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  </head>

  <body>
    <div id="fb-root"></div>

    <div class="wolo-shop"></div>
    <script src="<?= $data->url_js ?>"></script>

  </body>
</html>
