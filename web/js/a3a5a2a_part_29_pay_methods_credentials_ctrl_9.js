smartApp.controller('PayMethodsCredentialsController', ['$scope', '$rootScope', '$http', 'alerts', '$translate',
    function ($scope, $rootScope, $http, alerts, $translate) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors  = true;
        });

        function searchProvider(providerName)
        {
            var result;
            angular.forEach($scope.providers, function(provider) {
                if (providerName.toLowerCase() == provider.name.toLowerCase())
                    result=provider;
            });

            return result;
        }

        $http.get('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/available').success(function(data){
            $scope.providers = data;
        });

        $http.get('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials').success(function(data){
            angular.forEach(data, function(obj) {
                $scope[obj.provider.name.toLowerCase()] = obj.details;
                $scope[obj.provider.name.toLowerCase()]['valid'] = true;
            });
        });

        $scope.delete = function (payMethod, payMethodObject)
        {
            var provider = searchProvider(payMethod);
            $http.delete('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/'+provider.id).success(function(data){
                alerts.addInfo();
                for (var key in payMethodObject)
                    delete payMethodObject[key];
                payMethodObject.valid = false;
            });
        };

        $scope.submit = function (payMethod, payMethodObject)
        {
            var provider = searchProvider(payMethod);

            $http.put('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/'+provider.id, payMethodObject).success(function(data){
                alerts.addInfo();
                payMethodObject.valid = true;
            }).error(function (data, httpCode){
                if (httpCode == 400)
                {
                    $translate('merchant.pay_methods.invalid_credentials').then(function(msgError){
                        alerts.addError(msgError);
                    });
                }
            });
        };

}]);