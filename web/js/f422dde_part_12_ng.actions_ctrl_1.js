angular.module('shopApp').controller('ActionsCtrl', function ($rootScope, $scope, routing, pageTransition, alerts, $http) {

    $scope.buy=function ()
    {
        if ($rootScope.urlCriticalProcessing == true || $rootScope.current.articlePMPCA == null || $rootScope.current.state != 'ready_to_buy')
            return;

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'button continue clicked', 'clicked');
            ga('send', {
                'hitType': 'event',
                'eventCategory': 'shop',
                'eventAction': 'continue',
                'eventLabel': 'continue',
                'eventValue': 1
            });
        }

        var params = {'transaction_id': $rootScope.current.transactionId, '_locale': $rootScope.current.language.id,
            'pmpc_id': $rootScope.current.articlePMPCA.id, 'article_ids': $rootScope.current.appShopHasArticle.article.id
        };

        var providerName = $rootScope.current.articlePMPCA.name;

        if ($rootScope.current.articlePMPCA.pay_category.id == 'mobile' && $rootScope.current.articlePMPCA.is_our_implementation)
            params['sms_id'] = $rootScope.current.operator.id;

        if ($rootScope.current.articlePMPCA.pay_category.id == 'voice' && $rootScope.current.articlePMPCA.is_our_implementation)
            params['voice_id'] = $rootScope.current.articlePMPCA.voice.id;

        if ($rootScope.current.code)
        {
            params['code'] = $rootScope.current.code.code;
            $rootScope.urlCriticalProcessing = true;
        }

        // /begin/{transaction_id}/{language}/{pmpc_id}/{article_ids}
        var url=routing.generate('payment_begin', params);

        if($rootScope.current.articlePMPCA.is_ajax)
        {
            $http.get(url).finally(function(){
                $rootScope.urlCriticalProcessing = false;
            });

        }else if ($rootScope.current.articlePMPCA.is_iframe ){

            pageTransition.iframeOpen(url);

        }else{

            $rootScope.current.inProvider=true;
            pageTransition.newPageOpen(url);

        }

    };


    $scope.closeIframe=function ()
    {
        if (typeof ga !== 'undefined' && $rootScope.current.state != 'completed')
        {
            ga('send', 'event', 'close iframe', 'clicked');
        }
        pageTransition.iframeClose();
    };


});