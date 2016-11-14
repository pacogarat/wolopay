shopApp.factory('APIArticlePMPCA' , ['$http', 'routing', '$rootScope', 'resetVars', 'sliders','$timeout' , function ($http, routing, $rootScope, resetVars, sliders, $timeout) {
    return {
        getAll: function (country, article_id, successCallBackOk){

            country = country || $rootScope.current.country.id;
            if ($rootScope.firstPayMethods)
                article_id = null;
            else
                article_id = article_id || $rootScope.current.appShopHasArticle.article.id;


            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, 'article_tab_id': $rootScope.current.articleTab.id, '_format' : 'json'};
            if (article_id)
                params.article_id = article_id;

            var url = routing.generate('api_pay_method_get_pay_methods', params);
            $rootScope.current.articlePMPCAs = null;

            $http.get(url).success(
                function (data){
                    $rootScope.current.articlePMPCAs = data;
                    $rootScope.current.state = null;

                    sliders.forceMaxWidthPayMethodsBox();
                    $timeout(function() {
                        sliders.restartPayMethodsPosition();

                        if ($rootScope.firstPayMethods)
                            sliders.restartProductsPosition();

                    }, 500);
                    successCallBackOk(data);
                })
            ;

        }

    };
}]);
