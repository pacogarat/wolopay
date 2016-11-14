angular.module('shopApp').factory('APISMSOperator' , ['$http', 'routing', '$rootScope',  function ($http, routing, $rootScope) {
    return {
        getAll: function (pmpc, article_id, successCallBackOk){

            pmpc = pmpc || $rootScope.current.articlePMPCA.id;
            article_id = article_id || $rootScope.current.appShopHasArticle.article.id;

            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'pay_method_id' : pmpc, 'article_id': article_id, '_format' : 'json'};
            var url = routing.generate('api_sms_operator_get_operators', params);

            $http.get(url).success(
                function (data){
                    $rootScope.current.smsOperators = data;
                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
