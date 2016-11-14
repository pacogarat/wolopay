smartApp.controller('BlackListedIpsCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIApps',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIApps) {

        $scope.searchText = {$:''};

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        $scope.formValid = function()
        {
            if (!$scope.add_ip)
                return false;

            var result = true;

            angular.forEach($scope.ipsBlacklisted, function(ipIn, index) {
                if ($scope.add_ip == ipIn)
                    result = false;
            });

            return result;
        };

        $scope.setBlackListed = function(state, ip)
        {
            APIApps.setIpsBlackListedByAppId($rootScope.app.id, ip, state).success(function(data){
                if (state)
                {
                    angular.forEach(data, function(obj, ip) {
                        $scope.ipsBlacklisted.push(ip);
                    });

                }else{

                    angular.forEach($scope.ipsBlacklisted, function(ipIn, index) {
                        if (ipIn == ip)
                            $scope.ipsBlacklisted.splice(index, 1);
                    });
                }
            });
        };

        function exe(){


        }

        exe();
}]);

