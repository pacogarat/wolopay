angular.module('shopApp').factory('APINotification' , ['$http', 'routing' , '$rootScope', function ($http, routing, $rootScope) {
    return {
        updateDelayGacha: function (paymentDetailArticleHasGivenArticleId, successCallBackOk){

            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('update_gacha_notification', { transaction_id: $rootScope.current.transactionId, pdahga_id: paymentDetailArticleHasGivenArticleId, '_format' : 'json', 'IgnoreTranslations': 1});

            $http.patch(url).success(
                function (data){
                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
