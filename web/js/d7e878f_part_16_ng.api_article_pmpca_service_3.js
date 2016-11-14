shopApp.factory('APIArticlePMPCA' , ['$http', 'routing', '$rootScope', 'resetVars', 'sliders','$timeout' , function ($http, routing, $rootScope, resetVars, sliders, $timeout) {
    return {
        getAll: function (country, article_id, successCallBackOk){

            country = country || $rootScope.current.country.id;
            article_id = article_id || $rootScope.current.appShopHasArticle.article.id;

            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, 'article_id': article_id, 'article_tab_id': $rootScope.current.articleTab.id, '_format' : 'json'};
            var url = routing.generate('api_pay_method_get_pay_methods', params);
            $rootScope.current.articlePMPCAs = null;

            $http.get(url).success(
                function (data){
                    $rootScope.current.articlePMPCAs = data;
                    $rootScope.current.state = null;

                    sliders.resetPayMethodSlider();
                    $timeout(function() {
                        sliders.resetProductSlider();
                        sliders.resetPayMethodSlider();
                    }, 500);
                    successCallBackOk(data);
                })
            ;

        }

    };
}]);
