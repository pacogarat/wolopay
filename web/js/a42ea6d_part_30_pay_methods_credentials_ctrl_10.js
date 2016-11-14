smartApp.controller('PayMethodsCredentialsController', ['$scope', '$rootScope', '$http', 'alerts', '$translate',
    function ($scope, $rootScope, $http, alerts, $translate) {

        $rootScope.topBoxSelectors = false;
        $scope.adyens = [{}];

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors  = true;
        });

        function searchProvider(providerName)
        {
            var result;
            angular.forEach($scope.providersAvailable, function(provider) {
                if (providerName.toLowerCase() == provider.name.toLowerCase())
                    result=provider;
            });

            return result;
        }

        function exe()
        {
            $http.get('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/available').success(function(data){

                $scope.providersAvailable = data;

                $scope.providers = {};

                $http.get('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials').success(function(data){

                    angular.forEach(data, function(obj) {

                        if (!$scope.providers[obj.provider.name.toLowerCase()])
                            $scope.providers[obj.provider.name.toLowerCase()] = [];

                        angular.forEach(obj.apps, function(app, key) {
                            angular.forEach($rootScope.apps, function(rootApp) {
                                if (app.id == rootApp.id)
                                {
                                    obj.apps[key] = rootApp;
                                }
                            });
                        });

                        $scope.providers[obj.provider.name.toLowerCase()].push(obj);
                        $scope.providers[obj.provider.name.toLowerCase()]['valid'] = true;
                    });

                    angular.forEach($scope.providersAvailable, function(obj) {
                        if (!$scope.providers[obj.name.toLowerCase()])
                            $scope.providers[obj.name.toLowerCase()] = [{details: {}}];
                    });

                });


            });
        }




        $scope.delete = function (payMethod, payMethodObject)
        {
            console.log("delete method");

            var provider = searchProvider(payMethod);
            var removeItem = function (){
                if ($scope.providers[payMethod.toLowerCase()].length > 1)
                    $scope.providers[payMethod.toLowerCase()].splice($scope.providers[payMethod.toLowerCase()].indexOf(payMethodObject), 1);
                else{
                    $scope.providers[payMethod.toLowerCase()] = [{details: {}}];
                }
            } ;

            if (!payMethodObject.id)
            {
                removeItem();
                return;
            }

            $http.delete('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/'+payMethodObject.id).success(function(data){
                alerts.addInfo();
                removeItem();
            });
        };

        $scope.isValidAppsFromProvider = function(payMethodObject)
        {
            console.log(payMethodObject);
            var flagAppIsTwoSites = true;
            angular.forEach(payMethodObject, function(credential) {
                angular.forEach(credential.apps, function(app) {
                    angular.forEach(payMethodObject, function(credentialChild) {
                        if (credential !== credentialChild)
                        {
                            angular.forEach(credentialChild.apps, function(appChild) {
                                if (appChild.id == app.id)
                                    flagAppIsTwoSites = false;
                            });
                        }
                    });
                });
            });

            console.log("devuelvo ", flagAppIsTwoSites);
            return flagAppIsTwoSites;
        };

        $scope.isValidAppsFromProviderNull = function(payMethodObject)
        {
            console.log(payMethodObject);
            var flagAppIsTwoSites = true;
            angular.forEach(payMethodObject, function(credential) {
                console.log(credential.apps);
                if (credential['apps'] === undefined || credential.apps.length === 0)
                {
                    console.log("step1");
                    angular.forEach(payMethodObject, function(credentialChild) {
                        console.log("WTF", credentialChild);
                        if (credential !== credentialChild)
                        {
                            console.log("step2", credentialChild);
                            if (credentialChild['apps'] === undefined || credentialChild.apps.length === 0)
                            {
                                console.log("step3");
                                flagAppIsTwoSites=false;
                            }
                        }
                    });
                }
            });

            console.log("Qdevuelvo ", flagAppIsTwoSites);
            return flagAppIsTwoSites;
        };

        $scope.submit = function (payMethod, payMethodObject)
        {



            var provider = searchProvider(payMethod);
            console.log(payMethod, provider);

            $http.put('/admin/api/app/'+$rootScope.app.id+'/pay_method_credentials/'+provider.id, payMethodObject).success(function(data){
                alerts.addInfo();
                exe();
            }).error(function (data, httpCode){
                if (httpCode == 400)
                {
                    $translate('merchant.pay_methods.invalid_credentials').then(function(msgError){
                        alerts.addError(msgError);
                    });
                }
            });
        };

        exe();
}]).directive('footerButtons', function() {

        return {
            restrict: 'E',
            scope: {
                credentials: '=',
                credential: '=',
                providerName: '=',
                delete: '='
            },
            templateUrl: '/bundles/app/client_admin/views/merchant/pay-forms/footer-buttons.html'
        };
    });
