angular.module('shopApp').factory('APIPromoCode' , ['$http', 'routing' , '$rootScope', function ($http, routing, $rootScope) {
    return {
        isValid: function (code, successCallBackOk, errorCallBack){

            successCallBackOk = successCallBackOk || function (data){};
            errorCallBack = errorCallBack || function (data){};

            var url = routing.generate('api_promo_code_is_valid',{gamer_id: $rootScope.current.gamerExternalId, 'promo_code': code, '_format' : 'json'});

            $http.get(url).success(
                function (data){
                    successCallBackOk(data);
                }).error(function(data, status, headers, config) {
                    errorCallBack(data);
                })
            ;

        }
    };
}]);
