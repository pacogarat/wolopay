smartApp.controller('ConfiguratorSelectPayMethodsController', function ($scope, APICountries, APIPayMethods, $rootScope, Utils, filterFilter, $http) {

    APICountries.getByAppId($rootScope.app.id).success(function (countries){


        APIPayMethods.getByAppId($rootScope.app.id).success(function (data){

            $scope.pay_methods = data;

            APIPayMethods.getByAppId($rootScope.app.id, true).success(function (data){

                angular.forEach($scope.pay_methods, function(payMethod){
                    angular.forEach(data, function(pm){
                        if (payMethod.id == pm.id)
                        {
                            angular.forEach(pm.pay_method_has_provider, function(pmp){
                                angular.forEach(pmp.pay_method_provider_has_countries, function(country){
                                    payMethod['selected_'+country.country.id]=true;
                                });
                            });
                        }
                    });
                });

            });

            var toDelete = [];

            var exist ;
            // delete countries with empty custom paymethods
            angular.forEach(countries, function(country){

                angular.forEach($scope.pay_methods, function(pm){
                    angular.forEach(pm.pay_method_has_provider, function(pmp){
                        angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc){

                            if (country.id == pmpc.country.id)
                            {
                                exist=true;
                            }
                        });
                        if (exist)
                            return;
                    });
                    if (exist)
                        return;
                });

                if (!exist)
                    toDelete.push(country);
            });

            angular.forEach(toDelete, function(country){
                countries.splice( countries.indexOf(country), 1 );
            });

            $scope.countries = countries;
            $scope.search = countries[0];

        });

    });

    $scope.selectAll = function ()
    {
        var data = filterFilter($scope.pay_methods, $scope.search.name);
        angular.forEach(data, function(pay_method){
            pay_method['selected_' + $scope.search.id ]=true;
        });
    };

    $scope.removeAll = function ()
    {
        var data = filterFilter($scope.pay_methods, $scope.search.name);
        angular.forEach(data, function(pay_method){
            pay_method['selected_' + $scope.search.id ]=false;
        });
    };

    function findPMPC(payMethod)
    {
        var val = null;
        angular.forEach(payMethod.pay_method_has_provider, function(pmp) {
            angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc) {
                if (pmpc.country.id == $scope.search.id)
                    val = pmpc;
            });
        });

        return val;
    }

    $scope.paymethodFeePercent = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_provider_percent ? pmpc.fee_provider_percent : 'N/A' ;
    };

    $scope.paymethodEachPayment = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_extra_each_payment ? pmpc.fee_extra_each_payment + '' + pmpc.country.currency.symbol : null ;
    };

    $scope.paymethodMinimal = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_provider_minimal ? pmpc.fee_provider_minimal + '' + pmpc.country.currency.symbol : '-' ;
    };

    $scope.someSelected = function (){
        var result = false;

        angular.forEach($scope.pay_methods, function(pay_method){
            angular.forEach($scope.countries, function(country){
                if (pay_method['selected_'+country.id])
                    result = true;
            });
        });

        return result;
    };

    $scope.submit = function (){
        $http.put('/admin/api/pay_methods/sync/app/'+$rootScope.app.id, {pay_methods: $scope.pay_methods}).success(function (data){
             $rootScope.configuratorCurrent.step = 6
        });
    };

});
