smartApp.controller('ConfiguratorPreConfigureController', ['$scope', '$rootScope', 'APIApps', 'APIPayMethods',
    function ($scope, $rootScope, APIApps, APIPayMethods) {

        APIApps.getAutoConfigurationAction($rootScope.app.id).success(function (data){
            $scope.autoConfiguration = data;
        });

        $scope.$watchCollection('autoConfiguration', function(newValue, oldValue) {

            APIPayMethods.payMethodsWithFiltersCount($rootScope.app.id, $scope.autoConfiguration).success(function (data){
                $scope.payMethodsNum = data;
            });
        });

        $scope.submit = function (){
            APIApps.postAutoConfigurationAction($rootScope.app.id, $scope.autoConfiguration).success(function (data){
                $rootScope.configuratorCurrent.step = 1;
            });
        }

    }]);
