<?php

    require '../../../../tests/E2E/WolopaySDK/WolopayApiWrapper.php';

    $gamerLevel = 5;
    $gamerId = 'Guybrush threepwood';

    $wo = new \AppBundle\Tests\E2E\WolopaySDK\WolopayApiWrapper('app_557ea6ca03e98', '78f1f3bc0b67795e6bfe3e1f05098a7767072d20', 'https://miguel.wolopay.com/api/v1');
    $articles = $wo->getArticlesByCountry('ES', ['gamer_level' => $gamerLevel, 'gamer_id' => $gamerId, 'is_external_store' => true]);

?><!DOCTYPE html>
<html>
    <head>
        <title>Friend Smash!</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta property="og:image" content="https://wolopay.com/img/logo_500x100.png"/>

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//connect.facebook.net/en_US/sdk.js"></script>
        <script src="//www.parsecdn.com/js/parse-1.2.18.min.js"></script>
        <script>

            var TO_TODO = {
                FACEBOOK_APP_ID: 1653112441596983,
                WOLOPAY_APP_URL_PRODUCT_INFO: 'https://miguel.wolopay.com/'
            };

            FB.init({
                appId: TO_TODO.FACEBOOK_APP_ID,
                frictionlessRequests: true,
                status: true,
                version: 'v2.3'
            });

            FB.Event.subscribe('auth.authResponseChange', onAuthResponseChange);
            FB.Event.subscribe('auth.statusChange', onStatusChange);

            function login(callback) {
                FB.login(callback);
            }
            function loginCallback(response) {
                console.log('loginCallback',response);
                if(response.status != 'connected') {
                    top.location.href = 'https://www.facebook.com/appcenter/YOUR_APP_NAMESPACE';
                }
            }
            function onStatusChange(response) {
                if( response.status != 'connected' ) {
                    login(loginCallback);
                } else {
                    console.log("CONNECTED!!!!!", response);

                }
            }

            function onAuthResponseChange(response) {
                console.log('onAuthResponseChange', response);
            }

            function showShop(articleId, gamerLevel, country, quantity)
            {
                var productInfo = 'https://miguel.wolopay.com/external-stores/facebook/product_info/'+articleId+'/'+gamerLevel+'/'+country;
                //var productInfo = 'https://miguel.wolopay.com/external_shop/facebook/my-easy-app/products/100coins_dynamic.html';

                FB.ui({
                        method: 'pay',
                        action: 'purchaseitem',
                        product: productInfo,
                        quantity: quantity,     // optional, defaults to 1
                        request_id: Date.now() // optional, must be unique for each payment
                    },
                    function(response) {
                        console.log('Payment completed', response);
                        if(response.status && response.status == 'completed') {
                            refreshParseUser().then(renderWelcome);
                        }
                    }
                );
            }
        </script>




  </head>

  <body>
    <div id="fb-root"></div>

    <section id="home" class="hidden">
      <div class="panel left">
        <div id="welcome">
          <h1>Welcome to wolopay FACEBOOK APP <span class="first_name">...</span></h1>

        </div>

      </div>
        <h2>Articles</h2>
        <table>
            <tr>
                <td>Article</td>
                <td>Img</td>
                <td>Price</td>
                <td>Old Price</td>
                <td>Buy!</td>
            </tr>

        <?php

        foreach ($articles as $article)
        {
            echo '<tr>'.
                    '<td>'.$wo::replaceNumbersOfItems($article->name_label->translation, $article->current_items_quantity).'</td>'.
                    '<td><img src="https://wolopay.com'.$article->img.'"></td>'.
                    '<td>'.$article->amount.' '.$article->country->currency->symbol.'</td>'.
                    '<td>'.($article->amount != $article->current_amount_without_offer ? $article->current_amount_without_offer.' '.$article->country->currency->symbol : '').'</td>'.

                    "<td><button type='button' onclick='showShop(\"".$article->article->id."\", $gamerLevel, \"ES\", ".$article->current_items_quantity.")'>purchase</td>".
                  '</tr>'
            ;
        }
        ?>
        </table>

  </body>
</html>
