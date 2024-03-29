angular.module('shopApp').factory('APIAppShopHasArticles' , ['$http', 'routing', '$rootScope', 'sliders', 'alerts', '$timeout',
    function ($http, routing, $rootScope, sliders, alerts, $timeout) {
        return {
            getAll: function (country, article_tab_id, successCallBackOk){

                article_tab_id = article_tab_id || $rootScope.current.articleTab.app_tab.name_unique;
                country = country || $rootScope.current.country.id;
                successCallBackOk = successCallBackOk || function (data){};

                var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, 'tab_category_id': article_tab_id, '_format' : 'json'};

                if ($rootScope.firstPayMethods)
                {
                    params.pmpc_id = $rootScope.current.articlePMPCA.id;
                }

                var url = routing.generate('api_article_get_articles', params);

                $rootScope.current.appShopHasArticles = null;

                $http.get(url).success(
                    function (data){

                        if (data.length == 0)
                            alerts.addWarning('warnings.no_articles');

                        sliders.forceMaxWidthProductsBox();
                        sliders.restartProductsPosition();

                        $timeout(function() {

                            sliders.restartProductsPosition();
                            if (!$rootScope.firstPayMethods)
                                sliders.restartPayMethodsPosition();

                        }, 500);

                        $rootScope.current.appShopHasArticles = data;

                        successCallBackOk(data);

                    })
                ;

            }
        };
}]);
