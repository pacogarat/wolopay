<?php


namespace AppBundle\Payment\Util;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentRedirect
{

    public static function getResponse(Request $request, $extraImg=null)
    {
        function curPageURL()
        {
            if (!isset($_SERVER["SERVER_NAME"]))
                return '';

            $pageURL = 'http';
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
                $pageURL .= "s";

            $pageURL .= "://".$_SERVER["SERVER_NAME"];

            return $pageURL;
        }

        $method = $request->getMethod();
        $url = $request->getUri();

        if ($method == 'GET')
        {
            return new RedirectResponse($url);
        }

        if ($method == 'POST')
        {
            // Hack post client
            $parameters = '';
            foreach($request->request->all() as $key => $param)
            {
                $parameters .= " $key: '$param',";
            }
            $parameters = substr($parameters, 0, -1);

            $html =
"<html style='height:100%'>
<head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
</head>
<body style='text-align:center; height:100%; overflow: hidden;  '>
    <div style='width: 180px; background: #FFFFCC;border: 2px solid #666; -webkit-border-radius: 100px !important; -moz-border-radius: 100px !important; border-radius: 100px !important; -moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;-webkit-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);-moz-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);padding: 30px 20px 15px 20px;text-align:center; width: 130px; margin:10% auto 0 auto'>
        <img src='".curPageURL()."/img/wolopay.gif' width='100' height='100'>
	    <div style='padding-bottom:10px; text-shadow: 1px 1px 0 #fff; font-size: 18px; color: #333; '>♠ <em>Loading</em> ♠</div>
    </div>
    <div style='margin-top: 5%'>
        <img src='".curPageURL().$extraImg."'>
    </div>
</body>
<script>
    function post(path, params, method) {
        method = method || 'post'; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement('form');
        form.setAttribute('method', method);
        form.setAttribute('action', path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', key);
                hiddenField.setAttribute('value', params[key]);
                console.log(key, params[key]);
                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        setTimeout(function(){ form.submit(); }, 500)

    }

    post('$url', { $parameters });

</script>
</html>
";

            return new Response($html);
        }
    }
} 