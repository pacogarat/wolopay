smartApp.controller('OfferSelectCountriesController', function ($scope, APICountries, $rootScope, Utils, $filter) {

    $scope.continents = {};
    $scope.search = {name: 'España'};

    var copyCountries = angular.copy($rootScope.offerCurrent.countries);

    APICountries.getByAppIdAndShops($rootScope.app.id, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops)).success(function(data){

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

        $rootScope.offerCurrent.countries = countries;
        $scope.continents = continents;

        $scope.updateSelectedCountries();
    });

    $scope.updateSelectedCountries = function(){
        var value;

        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            value=false;
            angular.forEach($scope.continents, function(continent) {
                if (continent.continent && continent.continent.id == country.continent.id && continent.continent.selected)
                    value=true;
            });
            country.active = value;
        });


        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            if (country.active == false)
                country.selected = false;
        });
    };

    $scope.addAllContinents = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
                value.continent.selected=true;
        });

        $scope.updateSelectedCountries();
    };

    $scope.removeAllContinents = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            value.continent.selected=false;
        });

        $scope.updateSelectedCountries();
    };

    $scope.addAllCountriesAvailable = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            if (value.active)
                value.selected=true;
        });
    };

    $scope.removeAllCountriesAvailable = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            value.selected=false;
        });
    };

    $scope.getCountries = function(){
        var result = [];
        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            if (country.active)
                result.push(country);
        });

        return result;
    };

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.countries, function(value) {

            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.nextStep = function(){
        $rootScope.offerCurrent.step = 3;
    };
});
