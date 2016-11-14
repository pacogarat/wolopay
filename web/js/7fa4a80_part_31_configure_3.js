smartApp.controller('ProjectConfigureController', function ($scope, $routeParams, APIApps, $rootScope, APICountries, $filter, alerts) {

    $scope.project = {};

    if ($routeParams.id)
    {
        APIApps.getOneById($routeParams.id).success(function (data){
            $scope.project = data;

            APICountries.getByAppId($scope.project.id).success(function (countriesSelected){

                angular.forEach($scope.countries, function(country) {
                    angular.forEach(countriesSelected, function(countrySelected) {
                        if (country.id == countrySelected.id)
                        {
                            country.selected = true;
                        }
                    });

                });

                // auto select continents
                angular.forEach($scope.continents, function(continent) {
                    angular.forEach($scope.countries, function(country) {
                        if (country.selected && continent.continent.id == country.continent.id)
                            continent.continent.selected = true;
                    });
                });

                $scope.updateSelectedCountries();

            });
        });

    }else{

        $scope.project = {};
    }

    $rootScope.dateSelector = false;
    $scope.$on("$destroy", function() {
        $rootScope.dateSelector = true;
    });


    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.notifications = [];
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });

    $scope.continents = {};
    $scope.search = {name: 'España'};

    $scope.otherIsSelected = function(){
        var result = false;
        angular.forEach($scope.countries, function(country){
            if (country.id == 'DF' && country.selected)
                result = true;
        });

        return result;
    };


    var copyCountries = angular.copy($scope.countries);


    APICountries.getAll().success(function(data){

        var countries = data;
        var continents = $filter('unique')(data, 'continent.id');

        $scope.countries = countries;
        $scope.continents = continents;

        $scope.updateSelectedCountries();
    });


    $scope.updateSelectedCountries = function(){
        var value;

        angular.forEach($scope.countries, function(country) {
            value=false;
            angular.forEach($scope.continents, function(continent) {
                if (continent.continent && continent.continent.id == country.continent.id && continent.continent.selected)
                    value=true;
            });
            country.active = value;
        });


        angular.forEach($scope.countries, function(country) {
            if (country.active == false)
                country.selected = false;
        });
    };



    $scope.getCountries = function(){
        var result = [];
        angular.forEach($scope.countries, function(country) {
            if (country.active)
                result.push(country);
        });

        return result;
    };

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($scope.countries, function(value) {

            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.uploadComplete  = function (content){

        if (content.id)
        {
            $scope.project.id = content.id;
            $scope.project.logo.img = null;
            alerts.addInfo('action_completed');

        }else if (typeof content == 'object'){
            alerts.addError(content.message);
        }else{
            alerts.addError('internal_server_error');
        }
        $rootScope.loading = false;
    };



});

smartApp.controller('asd', function ($scope, $modalInstance, notification){

    $scope.notification = notification;

});