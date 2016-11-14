<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Wolopay!</title>
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

            <link rel="stylesheet" href="/css/1376e32_bootstrap_extra_1.css" media="screen" />
    
        <link rel="icon" type="image/x-icon" href="http://sym2_pay_gateway.dev/favicon.ico?1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>
    <body>
            
    <p>&lt;?php</p>
<p>require_once &quot;vendor/autoloader.php&quot;; // if you are using composer
// require_once &quot;WolopayApi.php&quot;; // if you are not using composer</p>
<p>// Variables for creating WolopayApi object
$apiClientId     = '5432'; //Provided by Wolopay at integration time
$apiClientSecret = '123456'; //Provided by Wolopay at integration time
$sandbox         = false;
$debug           = true;</p>
<p>// Variables for creating the transaction
$gamerId      = 'user132'; //Unique User Id. (always the same id for that specific user)
$level        = '3'; //Level of the user, as agreed with Wolopay at integration time
$extraOptions = array();
$autoRedirect = true;</p>
<p>// Create object
$wolopayApi = new WolopayApi($apiClientId, $apiClientSecret, $sandbox, $debug);</p>


            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </body>
</html>
