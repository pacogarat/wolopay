angular.module('shopApp').factory('APIWallet' , ['$http', 'routing', '$rootScope',
    function ($http, routing, $rootScope) {
    return {
        getConfByCountry: function (country, successCallBackOk ){

            country = country || $rootScope.current.country.id;
            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, '_format': 'json'};

            var url = routing.generate('get_wallet_conf_by_country', params);

            $http.get(url, { cache: true} ).success(
                function (data){
                    $rootScope.options.walletConf = data;
                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
