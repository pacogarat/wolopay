shopApp.factory('APIArticleTab' , ['$http', 'routing' , '$rootScope', function ($http, routing, $rootScope) {
    return {
        getAll: function (countryId, successCallBackOk){

            countryId = countryId || $rootScope.current.country.id;
            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('api_article_tab_get_tabs', {transaction_id: $rootScope.current.transactionId, country: countryId, '_format' : 'json'});
            $rootScope.current.articleTabs = null;

            $http.get(url).success(
                function (data){
                    $rootScope.current.articleTabs = data;

                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
