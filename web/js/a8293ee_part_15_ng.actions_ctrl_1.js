angular.module('shopApp').controller('ActionsCtrl', ['$rootScope', '$scope', 'routing', 'pageTransition', 'alerts', '$http', '$sce', 'sliders', '$timeout', 'ArticleHelper', '$translate', '$log', 'ExternalStoreFacebook',
    function ($rootScope, $scope, routing, pageTransition, alerts, $http, $sce, sliders, $timeout, ArticleHelper, $translate, $log, ExternalStoreFacebook) {

        $scope.buy=function ()
        {
            if ($rootScope.urlCriticalProcessing == true || ($rootScope.current.articlePMPCA == null && $rootScope.current.code == null) || $rootScope.current.state != 'ready_to_buy')
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

            var params = {'transaction_id': $rootScope.current.transactionId, country: $rootScope.current.country.id};
            var isIframe = false, isAjax = false, url = null;

            if (!$rootScope.current.code)
            {
                var articles_ids = null;

                if ($rootScope.hasCart && $rootScope.current.cart.length > 0)
                {
                    articles_ids = ArticleHelper.getArticleIdsCSV($rootScope.current.cart);
                }else{
                    articles_ids = $rootScope.current.appShopHasArticle.article.id;
                }

                params['pmpc_id'] = $rootScope.current.articlePMPCA.id;

                // BEST HARD CODE EVER
                if ($rootScope.current.appShopHasArticle && $rootScope.current.appShopHasArticle.article.article_category.id == 'subscription')
                    params['pmpc_id'] +='-subscription';

                params['article_ids'] = articles_ids;
                params['_locale'] = $rootScope.current.language.id;

                if ($rootScope.current.articlePMPCA.pay_category && $rootScope.current.articlePMPCA.pay_category.id == 'mobile' && $rootScope.current.articlePMPCA.is_our_implementation)
                    params['sms_id'] = $rootScope.current.payMethodFixedAmount.id;

                if ($rootScope.current.articlePMPCA.pay_category && $rootScope.current.articlePMPCA.pay_category.id == 'voice' && $rootScope.current.articlePMPCA.is_our_implementation)
                    params['voice_id'] = $rootScope.current.payMethodFixedAmount.id;

                // /begin/{transaction_id}/{language}/{pmpc_id}/{article_ids}
                url=routing.generate('payment_begin', params);

                isIframe = $rootScope.current.articlePMPCA.is_iframe;
                isAjax = $rootScope.current.articlePMPCA.is_ajax;

                params = {};
            }


            if ($rootScope.options.externalStore)
            {
                isIframe = false;
                isAjax = true;
            }


            if ($rootScope.current.code)
            {
                params['promo_code'] = $rootScope.current.code.code;
                $rootScope.urlCriticalProcessing = true;
                params['gamer_id'] = $rootScope.current.gamerExternalId;
                params['transaction_id'] = $rootScope.current.transactionId;
                params['_format'] = 'json';

                // /begin/{transaction_id}/{language}/{pmpc_id}/{article_ids}
                url=routing.generate('api_promo_code_create_a_purchase_by_promo', params);

                isAjax = true;
            }

            $log.debug("send url", url, params);

            if(isAjax)
            {
                var ajax = $http.post(url, params);
                ajax['success'](function(data){
                    ExternalStoreFacebook.buy(data.payment_process_id);
                });
                ajax['finally'](function(){
                    $rootScope.urlCriticalProcessing = false;
                });

            }else if (isIframe){

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


        $rootScope.asset = function(url,version)
        {
            if (!url)
                return '';

           version = version !== false;
           var extra = version ? '?v='+$rootScope.v : '';
           return $sce.trustAsResourceUrl($rootScope.domain + url + extra );
        };

        $rootScope.$on('itemTabActivated', function () {

            $rootScope.current.appShopHasArticlesFiltered = [];
            $timeout(function() {

                filterArticles($rootScope.current.appShopHasArticles, $rootScope.current.itemTabs);

                $timeout(function() {
                    sliders.restartProductsPosition();
                }, 700);

            }, 150);
        });

        function watcherArticles (newValue, oldValue)
        {
            if (newValue == oldValue)
                return;

            sliders.restartProductsPosition();
            filterArticles($rootScope.current.appShopHasArticles, $rootScope.current.itemTabs);

            $timeout(function() {
                sliders.restartProductsPosition();
            }, 700);
        }

        $rootScope.$watch('current.appShopHasArticles', function(newValue, oldValue) {
            watcherArticles(newValue, oldValue);
        });
        $rootScope.$watch('search', function(newValue, oldValue) {
            watcherArticles(newValue, oldValue);
        });
        $rootScope.$watch('searchActive', function(newValue, oldValue) {
            watcherArticles(newValue, oldValue);
        });

        $rootScope.$watch('current.articlePMPCAs', function(newValue, oldValue) {

            if (newValue == oldValue)
                return;


            $timeout(function() {
                sliders.restartPayMethodsPosition();
            }, 700);
        });


        function filterArticles (articles, itemTabs)
        {
            var result = [], wasInserted;

            // filter by itemTab
            if (itemTabs != null && itemTabs.length >= 1)
            {
                var hasSomeItemTabSelected = false;
                angular.forEach($rootScope.current.itemTabs, function(itemTab, index) {
                    if(itemTab.selected == true)
                        hasSomeItemTabSelected = true;
                });

                if (!hasSomeItemTabSelected)
                {
                    result = articles;

                }else{
                    angular.forEach(articles, function(article, index) {
                        wasInserted = false;
                        angular.forEach(article.article.item_tabs, function(itemTab, index) {
                            angular.forEach(itemTabs, function(itemTabActual, index) {

                                if (wasInserted)
                                    return;

                                if (hasSomeItemTabSelected && itemTabActual.selected == false )
                                    return;

                                if (itemTab.id == itemTabActual.id )
                                {
                                    result.push(article);
                                    wasInserted = true;
                                }
                            });
                        });
                    });
                }


            }else{
                result = articles;
            }


            // filter by search
            if ($rootScope.searchActive && $rootScope.search)
            {
                $rootScope.current.appShopHasArticlesFiltered = [];

                angular.forEach(result, function(article) {
                    $translate(article.name_label.key, { number: article.current_items_quantity }).then(function(trans){
                        if (trans.toLowerCase().indexOf($rootScope.search.toLowerCase()) != -1)
                            $rootScope.current.appShopHasArticlesFiltered.push(article);
                    })
                });

            }else{
                $rootScope.current.appShopHasArticlesFiltered = result;
            }


        }

        $scope.totalCart = function(){
            var amount = 0;
            for (var i = 0; i < $rootScope.current.cart.length; i++) {
                amount += $rootScope.current.cart[i].amount;
            }
            return amount;
        };

        $rootScope.periodicityToString = function (days)
        {
            var sal = [null,null,null,null];

            if ((days % 7 ==0) &&(days<60)) {
                sal[1] = days/7;
            }else if (days < 30) {
                sal[0] = days;
            }else if (days < 365){
                sal[2] = Math.round(days/30);
            }else{
                sal[3] = Math.round(days/365);
            }

            $log.debug("Periodicity result", sal);

            return sal;
        };
}]);