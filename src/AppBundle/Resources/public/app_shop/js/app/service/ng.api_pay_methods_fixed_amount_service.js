angular.module('shopApp').factory('APIPayMethodsFixedAmount' , ['$http', 'routing', '$rootScope',  function ($http, routing, $rootScope) {
    return {
        getAll: function (pmpc, article_id, successCallBackOk){

            pmpc = pmpc || $rootScope.current.articlePMPCA.id;
            if (!article_id)
            {
                if ($rootScope.current.appShopHasArticle)
                    article_id = $rootScope.current.appShopHasArticle.article.id;

                if ($rootScope.current.cart.length > 0 )
                    article_id = $rootScope.current.cart[0].article.id;
            }

            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'pay_method_id' : pmpc, 'article_id': article_id, '_format' : 'json'};
            var url = routing.generate('api_pay_method_get_pay_methods_with_amount_fixed', params);

            $http.get(url).success(
                function (data){
                    $rootScope.current.payMethodFixedAmounts = data;
                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
