angular.module('shopApp').factory('ExternalStoreFacebook', ['$rootScope', '$log', '$timeout', 'routing', function ($rootScope, $log, $timeout, routing) {

    if (!$rootScope.options.facebook || !$rootScope.options.facebook.app_id)
        return {};

    function waitForElement(){

        if(typeof FB !== 'undefined'){
            FB.init({
                appId: $rootScope.options.facebook.app_id,
                frictionlessRequests: true,
                status: true,
                version: 'v2.3'
            });

            FB.Event.subscribe('auth.authResponseChange', onAuthResponseChange);
            FB.Event.subscribe('auth.statusChange', onStatusChange);

        }else{
            setTimeout(function(){
                waitForElement();
            }, 1000);
        }
    }

    waitForElement();


    function login(callback) {
        FB.login(callback);
    }

    function loginCallback(response) {
        $log.debug('loginCallback', response);

        if(response.status != 'connected') {
            $log.error("Error in login");
        }
    }
    function onStatusChange(response) {
        if( response.status != 'connected' ) {
            login(loginCallback);
        } else {
            $log.debug("Facebook connected!", response);
        }
    }

    function onAuthResponseChange(response) {
        $log.debug('onAuthResponseChange', response);
    }

    return {
        buy: function(paymentProcessId, isAsubscription)
        {
            $log.debug('trying to buy with facebook');

            var articleId = $rootScope.current.appShopHasArticle.article.id, quantity = 1;
            var productInfo = routing.generate('facebook_products_info', {article_id: articleId, level_category_id: $rootScope.options.levelCategoryId, country: $rootScope.options.country.id });
            var objectToSend;

            if (isAsubscription)
            {
                objectToSend = {
                    method: 'pay',
                    action: 'create_subscription',
                    product: productInfo,
                    request_id: paymentProcessId // optional, must be unique for each payment
                };

            }else{

                objectToSend = {
                    method: 'pay',
                    action: 'purchaseitem',
                    product: productInfo,
                    quantity: quantity,     // optional, defaults to 1
                    request_id: paymentProcessId // optional, must be unique for each payment
                };
            }

            $log.debug('productInfoUrl', productInfo, objectToSend);

            FB.ui(
                objectToSend,
                function(response) {
                    $log.debug('Purchase Updated', response);
                    if(response.status && response.status == 'completed') {
                        $log.debug('completed');
                    }
                }
            );
        }
    }

}]);