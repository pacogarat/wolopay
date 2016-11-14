smartApp.controller('ConfiguratorSelectCountriesController', ['$scope', 'APICountries', '$rootScope', 'Utils', '$filter', 'Watchers',
    function ($scope, APICountries, $rootScope, Utils, $filter, Watchers) {

        Watchers.formIsDirty('form_countries', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        $scope.continents = {};
        $scope.search = {name: 'España'};

        $scope.isAOtherCountry = function(country)
        {
            return country.id.charAt(0) == 'X'
        };

        $scope.otherIsSelected = function(){
            var result = false;
            angular.forEach($rootScope.configuratorCurrent.countries, function(country){
                if (country.selected && $scope.isAOtherCountry(country))
                    result = true;
            });

            return result;
        };


        var copyCountries = angular.copy($rootScope.configuratorCurrent.countries);
        APICountries.getByAppId($rootScope.app.id).success(function (data){

            angular.forEach(data, function(country){
                country.selected = true;
                country.continent.selected = true;

            });

            var copyCountries = data;

            APICountries.getAllByAppIdAvailable($rootScope.app.id).success(function(data){

                var countries = data;
                var continents = $filter('unique')(data, 'continent.id');
                // restore session if exist
                if (copyCountries)
                {
                    var copyContinents = $filter('unique')(copyCountries, 'continent.id');

                    angular.forEach(continents, function(country){

                        angular.forEach(copyContinents, function(copyCountry){

                            if (copyCountry.continent.id == country.continent.id && copyCountry.continent.selected)
                                country.continent.selected = true;
                        });
                    });

                    angular.forEach(countries, function(country){

                        angular.forEach(copyCountries, function(copyCountry){

                            if (copyCountry.id == country.id && copyCountry.selected)
                            {
                                country.activate = true;
                                country.selected = true;
                            }
                        });
                    });

                }

                $rootScope.configuratorCurrent.countries = countries;
                $scope.continents = continents;

                $scope.updateSelectedCountries();
            });
        });

        $scope.updateSelectedCountries = function(){
            var value;

            angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
                value=false;
                angular.forEach($scope.continents, function(continent) {
                    if (continent.continent && continent.continent.id == country.continent.id && continent.continent.selected)
                        value=true;
                });
                country.active = value;
            });


            angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
                if (country.active == false)
                    country.selected = false;
            });
        };

        $scope.addAllContinents = function(){
            angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
                    value.continent.selected=true;
            });

            $scope.updateSelectedCountries();
        };

        $scope.removeAllContinents = function(){
            angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
                value.continent.selected=false;
            });

            $scope.updateSelectedCountries();
        };

        $scope.addAllCountriesAvailable = function(){
            angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
                if (value.active)
                    value.selected=true;
            });
        };

        $scope.removeAllCountriesAvailable = function(){
            angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
                value.selected=false;
            });
        };

        $scope.getCountries = function(){
            var result = [];
            angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
                if (country.active)
                    result.push(country);
            });

            return result;
        };

        $scope.someSelected = function () {

            var result = false;

            angular.forEach($rootScope.configuratorCurrent.countries, function(value) {

                if (value.selected)
                    result = true;
            });

            return result;
        };

        $scope.submit = function (){
            var countries = [];
            angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
                if (country.selected)
                    countries.push(country.id);
            });

            APICountries.updateByApp($rootScope.app.id, countries).success(function (data){
                $rootScope.configuratorCurrent.step = 2;
            });
        }

}]);
