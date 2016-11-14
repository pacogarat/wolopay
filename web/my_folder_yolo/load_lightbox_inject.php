<?php
require_once "../../doc/examples/lib/src/WolopayApi.php";
$wolopayApi = new \Wolopay\WolopayApi($apiClientId='app_5464b24a9eda4', $apiClientSecret='e6c7435cb68030ee739f9bdc2b3b48fb25c831b1', $sandbox=true, $debug=true);

// See the doc to view all optional parameters
$trans = $wolopayApi->createTransaction($gamerId='user13', $level=3, $extraOptions=array('gamer_email'=>'mgarcia@nviasms.com'), $autoRedirect=false);

if (!$trans){
    die("Request can't be generated");
}
?>
<html>
    <head>
        <!-- Lightweight lightbox without jquery -->
        <script src="/plugin/lightbox.js"></script>
    </head>
    <body>

        <div style="height: 500px;padding: 50px">
            <a href="#" onclick="woPlugin.open('<?= $trans->url_js ?>', null, null, null, true)">Click me to open the shop js $trans->url_js</a><br>
            <a href="#" onclick="woPlugin.open('<?= $trans->url ?>')">Click me to open the shop js $trans->url</a><br>
        </div>
    </body>
</html>