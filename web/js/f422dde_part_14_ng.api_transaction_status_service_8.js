shopApp.factory('APITransactionStatus' , ['$http', 'routing' , '$rootScope', function ($http, routing, $rootScope) {
    return {
        getCurrent: function (successCallBackOk){

            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('api_transaction_get_transaction_info',{transaction_id: $rootScope.current.transactionId, '_format' : 'json'});

            $http.get(url).success(
                function (data){
                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
