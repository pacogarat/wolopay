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
<p>//Create transaction, and get transactionId and URL from the result.
$result = $wolopayApi-&gt;createTransaction($gamerId = 'user13', $level = 3);
$result-&gt;id; //  have a transactionId
header(&quot;Location: &quot; . $result-&gt;url);</p>


            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </body>
</html>
