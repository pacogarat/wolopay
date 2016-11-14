smartApp.controller('BlackListedCountriesCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIAppShops', 'APIAppTabs', 'APIArticles', 'APIGamers',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIAppShops, APIAppTabs, APIArticles, APIGamers) {

        $scope.searchText = {};

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        $scope.formValid = function()
        {
            if (!$scope.add_external_user_id)
                return false;

            var result = true;

            angular.forEach($scope.countriesBlacklisted, function(gamer, index) {
                if (gamer.gamer_external_id == $scope.add_external_user_id)
                    result = false;
            });

            return result;
        };

        $scope.setBlackListed = function(state, countryId)
        {
            APICountries.addBlackListedToApp(countryId, $rootScope.app.id, state).success(function(data){
                if (state)
                    $scope.countriesBlacklisted.push(data);
                else
                {
                    angular.forEach($scope.countriesBlacklisted, function(country, index) {
                        if (country.id == countryId)
                            $scope.countriesBlacklisted.splice(index, 1);
                    });
                }

                setCountriesAvailable();
            });
        };

        function exe(){
            $timeout(function(){setCountriesAvailable()}, 600);
        }

        function setCountriesAvailable()
        {
            var countriesAvailable = [], exist;
            angular.forEach($scope.countries, function(country) {
                exist = false;
                angular.forEach($scope.countriesBlacklisted, function(countryBlack) {
                    if (countryBlack.id == country.id)
                        exist = true;
                });

                if (!exist)
                    countriesAvailable.push(country);
            });

            $scope.countriesAvailable = countriesAvailable;
            $scope.add_external_user_id = null;
        }


        exe();

}]);

