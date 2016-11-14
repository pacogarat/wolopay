smartApp.controller('BlackListedCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIAppShops', 'APIAppTabs', 'APIArticles', 'APIGamers', 'APIApps',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIAppShops, APIAppTabs, APIArticles, APIGamers, APIApps) {

        $rootScope.topBoxSelectors = false;
        $scope.section = 'countries';

        $scope.$on("$destroy", function() {
            delete $rootScope.configuratorCurrent;
            $rootScope.topBoxSelectors = true;
        });

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        function exe(){
            APIGamers.getByAppIdAndBlacklisted($rootScope.app.id).success(function(data){
                $scope.gamerBlacklisted = data;
            });

            APICountries.getBlackListedByAppId($rootScope.app.id).success(function(data){
                $scope.countriesBlacklisted = data;
            });

            APIApps.getIpsBlackListedByAppId($rootScope.app.id).success(function(data){

                if (data == null)
                    $scope.ipsBlacklisted = [];
                else
                {
                    $scope.ipsBlacklisted = [];
                    angular.forEach(data, function(ipObject, ip) {
                        $scope.ipsBlacklisted.push(ip);
                    });
                }

            });
        }

        APICountries.getAllStandard().success(function(data){
            $scope.countries = data;
            exe();
        });

}]);

