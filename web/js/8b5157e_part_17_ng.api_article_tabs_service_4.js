angular.module('shopApp').factory('APIArticleTab' , ['$http', 'routing' , '$rootScope', 'alerts', function ($http, routing, $rootScope, alerts){
    return {
        getAll: function (countryId, successCallBackOk){

            countryId = countryId || $rootScope.current.country.id;
            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('api_article_tab_get_tabs', {transaction_id: $rootScope.current.transactionId, country: countryId, '_format' : 'json', 'IgnoreTranslations': 1});
            $rootScope.current.articleTabs = null;

            $http.get(url).success(
                function (data){

                    if (data.length == 0)
                        alerts.addWarning('warnings.no_articles');

                    $rootScope.current.articleTabs = data;

                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
