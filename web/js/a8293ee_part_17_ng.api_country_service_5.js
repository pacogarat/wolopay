angular.module('shopApp').factory('APICountry' , ['$http', 'routing' , '$rootScope', 'findObject', 'alerts', function ($http, routing, $rootScope, findObject, alerts) {
    return {
        getAll: function (successCallBackOk){

            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('api_country_get_countries',{transaction_id: $rootScope.current.transactionId, '_format' : 'json', 'IgnoreTranslations': 1});
            $rootScope.current.countries = null;

            $http.get(url).success(
                function (data){

                    $rootScope.current.countries = data;

                    if (findObject.byObjId($rootScope.current.countries, $rootScope.current.country) == -1)
                    {
                        $rootScope.current.country = $rootScope.current.countries[0];
                    }

                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
