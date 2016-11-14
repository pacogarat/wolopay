smartApp.controller('DocsPayMethodsController', function ($scope, APIPayMethods, $rootScope) {

    function exe(){
        APIPayMethods.getByAppId($rootScope.app.id).success(function (data){
            $scope.payMethods = data;
        });
    }

    $scope.paymethodFee = function (payMethod)
    {
        var max = 1.5;
        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {
            if (payMethodHasProvider.fee_provider_percent > max)
                max = payMethodHasProvider.fee_provider_percent;
        });

        return max;
    }

    $scope.hasDirectPayment = function (payMethod)
    {
        var result = false;

        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {
           if (payMethodHasProvider.can_be_custom_transaction)
               result = true;
        });

        return result;
    };

    $scope.getCountriesByPayMethod = function (payMethod)
    {
        var result = [];
        var exist = false;
        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {

            angular.forEach(payMethodHasProvider.pay_method_provider_has_countries, function(country) {

                if (result.indexOf(country.id) == -1)
                {
                    result.push(country.country.id);
                }
            });

        });

        return result;
    };

    exe();
});
